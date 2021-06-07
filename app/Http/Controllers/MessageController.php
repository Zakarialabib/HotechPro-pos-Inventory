<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Biller;
use App\Sale;
use App\Product_Sale;
use App\Product;
use App\ProductVariant;
use App\Message;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Auth;
use App\Mail\UserNotification;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
	public function index()
	{
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('message')) {
    		if(Auth::user()->role_id > 2 && config('staff_access') == 'own')
                $lims_message_all = Message::orderBy('id', 'desc')->where('user_id', Auth::id())->get();

            else
                $lims_message_all = Message::orderBy('id', 'desc')->get();
                $lims_biller_list = Biller::where('is_active', true)->get();

    		return view('message.index', compact('lims_message_all','lims_biller_list'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
	}
    public function create($id){
    	$lims_message_data = Message::where('sale_id', $id)->first();
    	if($lims_message_data){
    		$customer_sale = DB::table('sales')->join('customers', 'sales.customer_id', '=', 'customers.id')->where('sales.id', $id)->select('sales.reference_no','customers.name')->get();
            $biller_sale = DB::table('sales')->join('billers', 'sales.biller_id', '=', 'billers.id')->where('sales.id', $id)->select('sales.reference_no','billers.name')->get();

    		$message_data[] = $lims_message_data->reference_no;
    		$message_data[] = $customer_sale[0]->reference_no;
    		$message_data[] = $lims_message_data->status;
    		$message_data[] = $customer_sale[0]->name;
    		$message_data[] = $biller_sale[0]->name;
    		$message_data[] = $lims_message_data->message;
    	}
    	else{
    		$customer_sale = DB::table('sales')->join('customers', 'sales.customer_id', '=', 'customers.id')->where('sales.id', $id)->select('sales.reference_no','customers.name', 'customers.address', 'customers.city', 'customers.country')->get();
            $biller_sale = DB::table('sales')->join('billers', 'sales.biller_id', '=', 'billers.id')->where('sales.id', $id)->select('sales.reference_no','billers.name')->get();

    		$message_data[] = 'dr-' . date("Ymd") . '-'. date("his");
    		$message_data[] = $customer_sale[0]->reference_no;
    		$message_data[] = '';
    		$message_data[] = '';
    		$message_data[] = '';
    		$message_data[] = $customer_sale[0]->name;
    		$message_data[] = $customer_sale[0]->address.' '.$customer_sale[0]->city.' '.$customer_sale[0]->country;
    		$message_data[] = '';
    	}        
    	return $message_data;
    }

    public function store(Request $request)
    {
    	$data = $request->except('file');
    	$message = Message::firstOrNew(['reference_no' => $data['reference_no'] ]);
    	$document = $request->file;
        if ($document) {
            $ext = pathinfo($document->getClientOriginalName(), PATHINFO_EXTENSION);
            $documentName = $data['reference_no'] . '.' . $ext;
            $document->move('public/documents/message', $documentName);
            $message->file = $documentName;
        }
        $message->sale_id = $data['sale_id'];
        $message->user_id = Auth::id();
        $message->status = $data['status'];
        $message->message = $data['message'];
        $message->save();
        $lims_sale_data = Sale::find($data['sale_id']);
        $lims_customer_data = Customer::find($lims_sale_data->customer_id);
        $lims_biller_data = Biller::find($lims_sale_data->biller_id);
        $message = 'Message created successfully';
        
        return redirect('message')->with('message', $message);
    }

    public function productMessageData($id)
    {
        $lims_message_data = Message::find($id);
        //return 'madarchod';
        $lims_product_sale_data = Product_Sale::where('sale_id', $lims_message_data->sale->id)->get();

        foreach ($lims_product_sale_data as $key => $product_sale_data) {
            $product = Product::select('name', 'code')->find($product_sale_data->product_id);
            if($product_sale_data->variant_id) {
                $lims_product_variant_data = ProductVariant::select('item_code')->FindExactProduct($product_sale_data->product_id, $product_sale_data->variant_id)->first();
                $product->code = $lims_product_variant_data->item_code;
            }

            $product_sale[0][$key] = $product->code;
            $product_sale[1][$key] = $product->name;
            $product_sale[2][$key] = $product_sale_data->qty;
        }
        return $product_sale;
    }

    public function sendMail(Request $request)
    {
        $data = $request->all();
        $lims_message_data = Message::find($data['message_id']);
        $lims_sale_data = Sale::find($lims_message_data->sale->id);
        $lims_product_sale_data = Product_Sale::where('sale_id', $lims_message_data->sale->id)->get();
        $lims_customer_data = Customer::find($lims_sale_data->customer_id);
        if($lims_customer_data->email) {
            //collecting male data
            $mail_data['email'] = $lims_customer_data->email;
            $mail_data['date'] = date(config('date_format'), strtotime($lims_message_data->created_at->toDateString()));
            $mail_data['message_reference_no'] = $lims_message_data->reference_no;
            $mail_data['sale_reference_no'] = $lims_sale_data->reference_no;
            $mail_data['status'] = $lims_message_data->status;
            $mail_data['customer_name'] = $lims_customer_data->name;
            $mail_data['phone_number'] = $lims_customer_data->phone_number;
            $mail_data['message'] = $lims_message_data->message;
            $mail_data['prepared_by'] = $lims_message_data->user->name;
          
            //return $mail_data;

            foreach ($lims_product_sale_data as $key => $product_sale_data) {
                $lims_product_data = Product::select('code', 'name')->find($product_sale_data->product_id);
                $mail_data['codes'][$key] = $lims_product_data->code;
                $mail_data['name'][$key] = $lims_product_data->name;
                if($product_sale_data->variant_id) {
                    $lims_product_variant_data = ProductVariant::select('item_code')->FindExactProduct($product_sale_data->product_id, $product_sale_data->variant_id)->first();
                    $mail_data['codes'][$key] = $lims_product_variant_data->item_code;
                }
                $mail_data['qty'][$key] = $product_sale_data->qty;
            }

            //return $mail_data;

            try{
                Mail::send( 'mail.message_challan', $mail_data, function( $message ) use ($mail_data)
                {
                    $message->to( $mail_data['email'] )->subject( 'Message Challan' );
                });
                $message = 'Mail sent successfully';
            }
            catch(\Exception $e){
                $message = 'Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
            }
        }
        else
            $message = 'Customer does not have email!';
        
        return redirect()->back()->with('message', $message);
    }

    public function edit($id)
    {
    	$lims_message_data = Message::find($id);
    	$customer_sale = DB::table('sales')->join('customers', 'sales.customer_id', '=', 'customers.id')->where('sales.id', $lims_message_data->sale_id)->select('sales.reference_no','customers.name')->get();
    	$biller_sale = DB::table('sales')->join('billers', 'sales.biller_id', '=', 'billers.id')->where('sales.id', $lims_message_data->sale_id)->select('sales.reference_no','billers.name')->get();

    	$message_data[] = $lims_message_data->reference_no;
		$message_data[] = $customer_sale[0]->reference_no;
		$message_data[] = $lims_message_data->status;
		$message_data[] = $customer_sale[0]->name;
		$message_data[] = $biller_sale[0]->name;
		$message_data[] = $lims_message_data->message;
    	return $message_data;
    }

    public function update(Request $request)
    {
    	$input = $request->except('file');
        //return $input;
    	$lims_message_data = Message::find($input['message_id']);
    	$document = $request->file;
        if ($document) {
            $ext = pathinfo($document->getClientOriginalName(), PATHINFO_EXTENSION);
            $documentName = $input['reference_no'] . '.' . $ext;
            $document->move('public/documents/message', $documentName);
            $input['file'] = $documentName;
        }
    	$lims_message_data->update($input);
        $lims_sale_data = Sale::find($lims_message_data->sale_id);
        $lims_customer_data = Customer::find($lims_sale_data->customer_id);
        $lims_biller_data = Biller::find($lims_sale_data->biller_id);
        $message = 'Message updated successfully';
        
    	return redirect('message')->with('message', $message);
    }

    public function deleteBySelection(Request $request)
    {
        $message_id = $request['messageIdArray'];
        foreach ($message_id as $id) {
            $lims_message_data = Message::find($id);
            $lims_message_data->delete();
        }
        return 'Message deleted successfully';
    }

    public function delete($id)
    {
    	$lims_message_data = Message::find($id);
    	$lims_message_data->delete();
    	return redirect('message')->with('not_permitted', 'Message deleted successfully');
    }
}

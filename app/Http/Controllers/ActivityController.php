<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Customer;
use App\HrmSetting;
use App\Activity;
use Auth;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ActivityController extends Controller
{
    public function index()
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('activity')) {
            $lims_employee_list = Employee::where('is_active', true)->get();
            $lims_customer_list = Customer::where('is_active', true)->get();
            $general_setting = DB::table('general_settings')->latest()->first();
            if(Auth::user()->role_id > 2 && $general_setting->staff_access == 'own')
                $lims_activity_all = Activity::orderBy('id', 'desc')->where('user_id', Auth::id())->get();
            else
                $lims_activity_all = Activity::orderBy('id', 'desc')->get();
            return view('activity.index', compact('lims_employee_list', 'lims_customer_list', 'lims_activity_all'));
        }
        else
            return redirect()->back()->with('not_permitted', __('Sorry! You are not allowed to access this module!'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $data = $request->all();
        $employee_id =  $data['employee_id'];
        $customer_id =  $data['customer_id'];
        $expense = $data['expense'];
        foreach ($employee_id as $id) {
            $data['date'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['date'])));
            $data['user_id'] = Auth::id();
            $lims_activity_data = Activity::whereDate('date', $data['date'])->where('employee_id', $id)->first();
            if(!$lims_activity_data){
                $data['employee_id'] = $id;
                $data['customer_id'] = $id;
                $data['expense'] = $expense;
                if($expense >= 0)
                    $data['status'] = 1;
                else
                    $data['status'] = 0;
                Activity::create($data);
            }
        }
        return redirect()->back()->with('message', 'Activity created successfully');
        //return date('h:i:s a', strtotime($data['from_time']));
    }

    
    public function show($id)
    {
        $lims_activity_data = Activity::find($id);
        return view('activity.show',compact('lims_activity_data'));
    }

    
    public function edit($id)
    {
        $activity_data = Activity::find($id);
        return $activity_data;
    }

    
    public function update(Request $request, $id)
    {
        
        $data = $request->all();
        $activity_data = Activity::find($id);
        $activity_data->update($data);

        return redirect('activity', compact('activity_data'))->with('message', 'Account updated successfully');

    }

    public function deleteBySelection(Request $request)
    {
        $activity_id = $request['activityIdArray'];
        foreach ($activity_id as $id) {
            $lims_activity_data = Activity::find($id);
            $lims_activity_data->delete();
        }
        return 'Activity deleted successfully!';
    }
    
    public function destroy($id)
    {
        $lims_activity_data = Activity::find($id);
        $lims_activity_data->delete();
        return redirect()->back()->with('not_permitted', 'Activity deleted successfully');
    }
}

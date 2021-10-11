<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Customer;
use App\Resume;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use DB;
use Auth;

class ResumeController extends Controller
{
    public function index()
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('resume')) {

      $lims_employee_list = Employee::where('is_active', true)->get();
      $lims_customer_list = Customer::where('is_active', true)->get();
      $lims_resume_all = Resume::orderBy('id', 'desc')->get();
      
      $general_setting = DB::table('general_settings')->latest()->first();
      if(Auth::user()->role_id > 2 && $general_setting->staff_access == 'own')
      $lims_resume_all = Resume::orderBy('id', 'desc')->where('user_id', Auth::id())->get();
  else
      $lims_resume_all = Resume::orderBy('id', 'desc')->get();
      return view('resume.index',compact('lims_resume_all','lims_employee_list','lims_customer_list'));
    }
    else
        return redirect()->back()->with('not_permitted', __('Sorry! You are not allowed to access this module!'));  
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $employee_id =  $data['employee_id'];
        $customer_id =  $data['customer_id'];
       
        foreach ($employee_id as $id) {
            $data['date'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['date'])));
            $data['user_id'] = Auth::id();
            $lims_activity_data = Resume::whereDate('date', $data['date'])->where('employee_id', $id)->first();
            if(!$lims_activity_data){
                $data['employee_id'] = $id;
                $data['customer_id'] = $id;
                    Resume::create($data);
            }
        }
        return redirect('resume')->with('message', 'Data inserted successfully');
    }

    public function show($id)
    {
        $lims_resume_data = Resume::find($id);
        return view('resume.show',compact('lims_resume_data'));
    }

    public function edit($id)
    {
        $lims_resume_data = Resume::find($id);
        return $lims_resume_data;
    }

    public function update(Request $request, $id)
    {
       
        $input = $request->all();
        $lims_resume_data = Resume::find($input['resume_id']);

        $lims_resume_data->update($input);
        return redirect('resume')->with('message', 'Données à jour et enregistrées avec succès');
    }


    public function deleteBySelection(Request $request)
    {
        $resume_id = $request['resumeIdArray'];
        foreach ($resume_id as $id) {
            $lims_resume_data = Resume::find($id);
            $lims_resume_data->save();
        }
        return 'Data deleted successfully!';
    }

    public function destroy($id)
    {
        $lims_resume_data = Resume::find($id);
        $lims_resume_data->save();
        return redirect('resume')->with('not_permitted', 'Data deleted successfully');
    }
}

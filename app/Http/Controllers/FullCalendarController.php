<?php
   
namespace App\Http\Controllers;
   
use App\Event;
use Illuminate\Http\Request;
use Redirect,Response;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;


use Auth;

class FullCalendarController extends Controller
{
 
    public function index()
    {

        if(request()->ajax()) 
        {

         $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
         $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');

         $data = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','start', 'end']);
         return Response::json($data);
        }
        return view('fullcalendar');
      
    }   
    
    public function ajaxUpdate(Request $request)
{
    $fullcalendar = Event::with('client')->findOrFail($request->event_id);
    $fullcalendar->update($request->all());

    return response()->json(['fullcalendar' => $fullcalendar]);
}
   
public function create(Request $request)
    {  
      
        $insertArr = [ 'title' => $request->title,
                       'start' => $request->start,
                       'end' => $request->end
                    ];


        $event = Event::insert($insertArr);   

        return Response::json($event);

    }

 
    public function update(Request $request)
    {   
        $where = array('id' => $request->id);
       
        $updateArr = ['title' => $request->title,'start' => $request->start, 'end' => $request->end];
       
        $event  = Event::where($where)->update($updateArr);

        return Response::json($event);


    } 
 
 
    public function destroy(Request $request)
    {
        $event = Event::where('id',$request->id)->delete();
   
        return Response::json($event);
    }    
 
 
}
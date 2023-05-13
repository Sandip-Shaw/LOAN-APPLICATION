<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CalenderEvents;

class CalenderController extends Controller
{
    public function index()
    {
       
        return view('backend.pages.calender');
    }
 
    // public function calendarEvents(Request $request)
    // {
 
    //     switch ($request->type) {
    //        case 'create':
    //           $event = CalenderEvents::create([
    //               'event_name' => $request->event_name,
    //               'event_start' => $request->event_start,
    //               'event_end' => $request->event_end,
    //           ]);
 
    //           return response()->json($event);
    //          break;
  
    //        case 'edit':
    //           $event = CalenderEvents::find($request->id)->update([
    //               'event_name' => $request->event_name,
    //               'event_start' => $request->event_start,
    //               'event_end' => $request->event_end,
    //           ]);
 
    //           return response()->json($event);
    //          break;
  
    //        case 'delete':
    //           $event = CalenderEvents::find($request->id)->delete();
  
    //           return response()->json($event);
    //          break;
             
    //        default:
    //          # ...
    //          break;
    //     }
    // }
}


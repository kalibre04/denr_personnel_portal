<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Session;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Promotion;
use App\Models\Personnel_Assignment;
use App\Models\TravelOrder;

class TravelApproverController extends Controller
{
    public function chief_index(){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();

        $travels = TravelOrder::where('application_status', 'Pending')->where('office', $user_office->office->officename)->orderBy('created_at', 'DESC')->get();
        
        return view('travel_order.approverindex', compact('travels'));
    }

    public function chief_approvedindex(){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();

        $travels = TravelOrder::where('application_status', 'Division Chief Approved')->where('office', $user_office->office->officename)->orderBy('created_at', 'DESC')->get();
        
        return view('travel_order.approvedindex', compact('travels'));
    }
    public function chief_cancelledindex(){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        $travels = TravelOrder::where('application_status', 'Disapproved')->where('office', $user_office->office->officename)->orderBy('created_at', 'DESC')->get();
        
        return view('travel_order.cancelledindex', compact('travels'));
    }
    
    public function chief_edit($id){
        $travel_order = TravelOrder::find($id);
        return view('travel_order.edittraveldivchief', compact('travel_order'));        
    }

    public function chief_disapprove($id){
        $travel_order = TravelOrder::find($id);
        return view('travel_order.disapprovetraveldivchief', compact('travel_order'));
    }

    public function chief_approvefromcancelled($id){
        $travel_order = TravelOrder::find($id);
        return view('travel_order.approvetraveldivchief', compact('travel_order'));
    }

    public function chief_editto($id){
        $travel_order = TravelOrder::find($id);
        return response()->json(compact('travel_order'));
    }


    public function update_travel(Request $request, $id){
        $validator = Validator::make($request->all(), [ 
            'destination'        => 'required',
            'purpose'       => 'required',
            'datedepart'         => 'required|date',
            'datearrive'    => 'required|date'
            
        ]);
        if ($validator->fails()) { 
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();          
        }
        
        $travel = TravelOrder::find($id);
        
        
        $travel->date_depart = $request->datedepart;
        $travel->date_arrived = $request->datearrive;
        $travel->destination = $request->destination;
        $travel->purpose = $request->purpose;
        $travel->expenses = $request->expenses;
        $travel->assist_labor_allowed = $request->assist_labor_allowed;
        $travel->instructions = $request->instructions;
        $travel->divchief_approval_date = Carbon::now();
        $travel->div_chief_approval = Auth::user()->id;
        $travel->application_status = 'Division Chief Approved';
        
        $travel->save();

        return response()->json(['message' => 'Travel Order Approved' ]);
    }
    public function disapprove_travel(Request $request, $id){
        $travel = TravelOrder::find($id);
        $travel->application_status = 'Disapproved';
        $travel->disapprove_date = Carbon::now();
        $travel->disapprove_reason = $request->input('value');
        $travel->save();
        return response()->json(['message' => 'Travel Order Disapproved' ]);
    }

}

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

class TravelApproverCenroController extends Controller
{
    // FUNCTIONS FOR CENRO
    public function cenro_index(){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        
        $trav = TravelOrder::where('application_status', 'Pending')->where('office', $user_office->office->officename)->orderBy('created_at', 'DESC')->get();
        $travels = $trav->where('account_type', 'Personnel');
        return view('travel_order.cenro.approverindex', compact('travels'));
    }

    public function cenro_approvedindex(){
        //$user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();

        //$trav = TravelOrder::where('application_status', 'CENRO Approved')->where('office', $user_office->office->officename)->orderBy('created_at', 'DESC')->get();
        
        $trav = TravelOrder::where('application_status', 'ARED MS Approved')
            ->orwhere('application_status', 'CENRO Approved')
            ->orwhere('application_status', 'RED Approved')
            ->orwhere('application_status', 'PENRO Approved')->orderBy('created_at', 'DESC')->get();
        $trav_personnel = $trav->where('account_type', 'Personnel');
        

        $travels = $trav_personnel->where('cenro_approval', Auth::user()->id);
        
        return view('travel_order.cenro.approvedindex', compact('travels'));
    }
    public function cenro_cancelledindex(){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        $trav = TravelOrder::where('application_status', 'Disapproved')->where('office', $user_office->office->officename)->orderBy('created_at', 'DESC')->get();
        $travels = $trav->where('account_type', 'Personnel');
        return view('travel_order.cenro.cancelledindex', compact('travels'));
    }
    
    public function cenro_completedindex(){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        $travels = TravelOrder::where('application_status', 'Completed')->where('office', $user_office->office->officename)->orderBy('created_at', 'DESC')->get();
        
        return view('travel_order.cenro.completedindex', compact('travels'));
    }

    public function cenro_edit($id){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        
        $travel_order = TravelOrder::where('id', $id)->where('office', $user_office->office->officename)->first();
        return view('travel_order.cenro.edittravelcenro', compact('travel_order'));        
    }

    public function cenro_disapprove($id){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        
        $travel_order = TravelOrder::where('id', $id)->where('office', $user_office->office->officename)->first();
        return view('travel_order.cenro.disapprovetravelcenro', compact('travel_order'));
    }

    public function cenro_approvefromcancelled($id){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        
        $travel_order = TravelOrder::where('id', $id)->where('office', $user_office->office->officename)->first();
        return view('travel_order.cenro.approvetravelcenro', compact('travel_order'));
    }

    public function cenro_editto($id){
        $travel_order = TravelOrder::find($id);
        return response()->json(compact('travel_order'));
    }


    public function cenro_update_travel(Request $request, $id){
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
        $travel->cenro_approval_date = Carbon::now();
        $travel->cenro_approval = Auth::user()->id;
        $travel->application_status = 'CENRO Approved';
        $travel->travel_type = $request->travel_type;
        $travel->save();

        return response()->json(['message' => 'Travel Order Approved' ]);
    }
    public function cenro_disapprove_travel(Request $request, $id){
        $reason = $request->input('value');
        $travel = TravelOrder::find($id);
        $travel->application_status = 'Disapproved';
        $travel->disapprove_date = Carbon::now();
        $travel->disapprove_reason = $reason ."       /Disapproved By: " . Auth::user()->firstname . " " . Auth::user()->lastname ;
        $travel->save();
        return response()->json(['message' => 'Travel Order Disapproved' ]);
    }

    //END OF FUNCTIONS FOR CENRO
}

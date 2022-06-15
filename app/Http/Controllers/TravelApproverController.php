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

    //FUNCTIONS FOR DIV CHIEF

    public function chief_index(){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();

        $trav = TravelOrder::where('application_status', 'Pending')->where('office', $user_office->office->officename)->orderBy('created_at', 'DESC')->get();
        $travels = $trav->where('account_type', 'Personnel');
        return view('travel_order.approverindex', compact('travels'));
    }

    public function chief_approvedindex(){
        // $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        // $trav = TravelOrder::where('application_status', 'Division Chief Approved')->where('office', $user_office->office->officename)->orderBy('created_at', 'DESC')->get();
        // $travels = $trav->where('account_type', 'Personnel');
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        $trav = TravelOrder::where('office', $user_office->office->officename)->orderBy('created_at', 'DESC')->get();

        // $travels_ms = TravelOrder::where('office', 'Planning and Management Division')
        //         ->orWhere('office', 'Finance Division')
        //         ->orWhere('office', 'Legal Division')
        //         ->orWhere('office', 'Admin Division')
        //         ->orWhere('office', 'ARED for Management Services')
        //         ->orderBy('created_at', 'DESC')->get();
        // $travels_ts = TravelOrder::where('office', 'Conservation and Development Division')
        //         ->orWhere('office', 'Enforcement Division')
        //         ->orWhere('office', 'Surveys and Mapping Division')
        //         ->orWhere('office', 'Licenses Patents and Deeds Division')
        //         ->orWhere('office', 'ARED for Technical Services')
        //         ->orderBy('created_at', 'DESC')->get();
        // $trav = $travels_ts->merge($travels_ms);
        $travels_divchief_approved = $trav->where('application_status', 'Division Chief Approved');
        $travels_aredts_approved = $trav->where('application_status', 'ARED TS Approved');
        $travels_aredms_approved = $trav->where('application_status', 'ARED MS Approved');
        $travels_red_approved = $trav->where('application_status', 'RED Approved');

        $trav_approved = $travels_divchief_approved->merge($travels_aredts_approved)->merge($travels_aredms_approved)->merge($travels_red_approved);
        //$trav_outside = $trav_outside_merge->where('travel_type', 'Outside AOR');
        
        $trav_within_per_id = $trav_approved->where('divchief_approval', Auth::user()->id);

        // $trav = TravelOrder::where('application_status', 'ARED MS Approved')
        //     ->orwhere('application_status', 'Division Chief Approved')
        //     ->orwhere('application_status', 'RED Approved')->orderBy('created_at', 'DESC')->get();

        // $trav_personnel = $trav->where('account_type', 'Personnel');
        
        $travels = $trav_within_per_id;
        // $travels = $trav_personnel->where('divchief_approval', Auth::user()->id);

        return view('travel_order.approvedindex', compact('travels'));
    }
    public function chief_cancelledindex(){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        
        $trav1 = TravelOrder::where('application_status', 'Disapproved')->where('office', $user_office->office->officename)->orderBy('created_at', 'DESC')->get();
        $trav = $trav1->where('disapproved_by_id', Auth::user()->id);
        $travels = $trav->where('account_type', 'Personnel');
        return view('travel_order.cancelledindex', compact('travels'));
    }
    
    public function chief_completedindex(){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        $travels = TravelOrder::where('application_status', 'Completed')->where('office', $user_office->office->officename)->orderBy('created_at', 'DESC')->get();
        
        return view('travel_order.completedindex', compact('travels'));
    }

    public function chief_edit($id){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        
        $travel_order = TravelOrder::where('id', $id)->where('office', $user_office->office->officename)->first();
        return view('travel_order.edittraveldivchief', compact('travel_order'));        
    }

    public function chief_disapprove($id){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        
        $travel_order = TravelOrder::where('id', $id)->where('office', $user_office->office->officename)->first();
        
        return view('travel_order.disapprovetraveldivchief', compact('travel_order'));
    }

    public function chief_approvefromcancelled($id){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        
        $travel_order = TravelOrder::where('id', $id)->where('office', $user_office->office->officename)->first();
        return view('travel_order.approvetraveldivchief', compact('travel_order'));
    }

    public function chief_editto($id){
        $travel_order = TravelOrder::find($id);
        return response()->json(compact('travel_order'));
    }


    public function divchief_update_travel(Request $request, $id){
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
        $travel->divchief_approval = Auth::user()->id;
        $travel->application_status = 'Division Chief Approved';
        $travel->travel_type = $request->travel_type;
        $travel->disapprove_date = NULL;
        $travel->disapprove_reason = NULL;
        $travel->disapproved_by_id = NULL;
        $travel->save();

        return response()->json(['message' => 'Travel Order Approved' ]);
    }
    public function divchief_disapprove_travel(Request $request, $id){
        $reason = $request->input('value');
        $travel = TravelOrder::find($id);
        $travel->application_status = 'Disapproved';
        $travel->disapprove_date = Carbon::now();
        $travel->disapprove_reason = $reason ."       /Disapproved By: " . Auth::user()->firstname . " " . Auth::user()->lastname ;
        $travel->disapproved_by_id = Auth::user()->id;
        $travel->divchief_approval_date = NULL;
        $travel->divchief_approval = NULL;
        $travel->save();
        return response()->json(['message' => 'Travel Order Disapproved' ]);
    }

    //END OF FUNCTIONS FOR DIV CHIEF
    /********************************************************************************************************/

    



}

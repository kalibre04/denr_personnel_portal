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

class TravelApproverOredController extends Controller
{
    // FUNCTIONS FOR ORED
    public function ored_index(){
        
        
        $travel_msapproved = TravelOrder::where('application_status', 'ARED MS Approved')->get();
        $travel_ored_ared = TravelOrder::where('account_type', 'ORED')->orWhere('account_type', 'ARED MS')->orWhere('account_type', 'ARED TS')->get();
        $travel_rscig = TravelOrder::where('office', 'Regional Strategic Communications Initiatives Group')->get();
        $travel_pmcc = TravelOrder::where('office', 'Program Monitoring and Coordination Center')->get();
        $travel_ored = TravelOrder::where('office', 'Office of the Regional Executive Director')->get();
        $trav_pmcc_ored_rscig = $travel_pmcc->merge($travel_rscig)->merge($travel_ored);
        
        $trav_pending = $travel_ored_ared->where('application_status', 'Pending');
        $trav_pending2 = $trav_pmcc_ored_rscig->where('application_status', 'Pending');
        $travels = $travel_msapproved->merge($trav_pending)->merge($trav_pending2);
        return view('travel_order.ored.approverindex', compact('travels'));
    }

    public function ored_approvedindex(){
        // $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
                
        $travels = TravelOrder::where('application_status', 'RED Approved')->orderBy('created_at', 'DESC')->get();
        
        return view('travel_order.ored.approvedindex', compact('travels'));
    }
    public function ored_cancelledindex(){
        //$user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        // $travels_ts = TravelOrder::where('office', 'Conservation and Development Division')
        //         ->orWhere('office', 'Enforcement Division')
        //         ->orWhere('office', 'Surveys and Mapping Division')
        //         ->orWhere('office', 'Licenses Patents and Deeds Division')
        //         ->orWhere('office', 'ARED for Technical Services')
        //         ->orderBy('created_at', 'DESC')->get();
        // $travels_ms = TravelOrder::where('office', 'Planning and Management Division')
        //         ->orWhere('office', 'Finance Division')
        //         ->orWhere('office', 'Legal Division')
        //         ->orWhere('office', 'Admin Division')
        //         ->orWhere('office', 'ARED for Management Services')
        //         ->orderBy('created_at', 'DESC')->get();
        // $travels_penro = TravelOrder::where('travel_type', 'Outside AOR')->get();
        // $travels_outside_aor = $travels_penro->where('application_status', 'Disapproved');
        // $trav_ms = $travels_ms->where('application_status', 'Disapproved');
        // $trav_ts = $travels_ts->where('application_status', 'Disapproved');
        // $trav = $trav_ms->merge($trav_ts);
        // $travels = $trav->merge($travels_outside_aor);
        // // $travels = TravelOrder::where('application_status', 'Disapproved')->orderBy('created_at', 'DESC')->get();
        $trav = TravelOrder::where('application_status', 'Disapproved')->get();
        $travels = $trav->where('disapproved_by_id', Auth::user()->id);
        return view('travel_order.ored.cancelledindex', compact('travels'));
    }
    
    public function ored_completedindex(){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        $travels = TravelOrder::where('application_status', 'Completed')->where('office', $user_office->office->officename)->orderBy('created_at', 'DESC')->get();
        
        return view('travel_order.ored.completedindex', compact('travels'));
    }

    public function ored_edit($id){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        
        $travel_order = TravelOrder::where('id', $id)->first();
        return view('travel_order.ored.edittravelored', compact('travel_order'));        
    }

    public function ored_disapprove($id){
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
        // $travels_penro = TravelOrder::where('travel_type', 'Outside AOR')->get();
        // $travels_outside_aor = $travels_penro->where('application_status', 'ARED MS Approved');

        // $travels_ro = $travels_ts->merge($travels_ms);
        // $trav_approved = $travels_ro->where('application_status', 'ARED MS Approved');
        // $trav = $travels_outside_aor->merge($trav_approved);
        // $travel_order = $trav->where('id', $id)->first();
        $travel_approved = TravelOrder::where('application_status', 'RED Approved')->get();
        $travel_order = $travel_approved->where('id', $id)->first();
        return view('travel_order.ored.disapprovetravelored', compact('travel_order'));
    }

    public function ored_approvefromcancelled($id){
        //$user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
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
    
        // $travels_ro = $travels_ms->merge($travels_ts);

        // $travels_cancelled = $travels_ro->where('application_status', 'Disapproved');

        // $travels_penro = TravelOrder::where('travel_type', 'Outside AOR')->get();
        // $travels_outside_aor = $travels_penro->where('application_status', 'Disapproved');
        // $trav = $travels_outside_aor->merge($travels_cancelled);
        // $travel_order = $trav->where('id', $id)->first();
        $travel_disapp = TravelOrder::where('application_status','Disapproved')->get();
        $travel_red_approved = $travel_disapp->where('red_approval', '!=', null);
        $travel_order = $travel_red_approved->where('id', $id)->first();
        return view('travel_order.ored.approvetravelored', compact('travel_order'));
    }

    public function ored_editto($id){
        $travel_order = TravelOrder::find($id);
        return response()->json(compact('travel_order'));
    }


    public function ored_update_travel(Request $request, $id){
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
        $travel->red_approval_date = Carbon::now();
        $travel->red_approval = Auth::user()->id;
        $travel->application_status = 'RED Approved';
        $travel->travel_type = $request->travel_type;
        $travel->disapproved_by_id = NULL;
        $travel->disapprove_date = NULL;
        $travel->disapprove_reason = NULL ;
        $travel->save();
        return response()->json(['message' => 'Travel Order Approved' ]);
    }
    public function ored_disapprove_travel(Request $request, $id){
        $reason = $request->input('value');
        $travel = TravelOrder::find($id);
        $travel->application_status = 'Disapproved';
        $travel->disapproved_by_id = Auth::user()->id;
        $travel->disapprove_date = Carbon::now();
        $travel->disapprove_reason = $reason ."       /Disapproved By: " . Auth::user()->firstname . " " . Auth::user()->lastname ;
        $travel->red_approval_date = NULL;
        $travel->red_approval = NULL;
        $travel->save();
        return response()->json(['message' => 'Travel Order Disapproved' ]);
    }

    //END OF FUNCTIONS FOR ORED

}

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


class TravelApproverPenroController extends Controller
{
    // FUNCTIONS FOR PENRO
    public function penro_index(){
        // $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        //  $aredms_offices = ['office' => 'Planning and Management Division', 'office' => 'Legal Division',  'office'=>'CENRO Manay'];
                
                //->orWhere('office', 'Conservation and Development Division')
                // ->orWhere('office', 'Licences Patents and Deeds Division')
                // ->orWhere('office', 'Surveys and Mapping Division')
                // ->orWhere('office', 'Enforcement Division')
        

        $travels_davnor = TravelOrder::where('office', 'PENRO Davao del Norte')
                ->orWhere('office', 'CENRO Panabo')
                ->orWhere('office', 'CENRO New Corella')
                ->orderBy('created_at', 'DESC')->get();
        
        $travels_davor = TravelOrder::where('office', 'PENRO Davao Oriental')
                ->orWhere('office', 'CENRO Mati')
                ->orWhere('office', 'CENRO Manay')
                ->orWhere('office', 'CENRO Lupon')
                ->orWhere('office', 'CENRO Baganga')
                ->orderBy('created_at', 'DESC')->get();
        $travels_davsur = TravelOrder::where('office', 'PENRO Davao del Sur')
                ->orWhere('office', 'CENRO Davao')
                ->orWhere('office', 'CENRO Malalag')
                ->orWhere('office', 'CENRO Digos')
                ->orderBy('created_at', 'DESC')->get();
        $travels_davdeoro = TravelOrder::where('office', 'PENRO Davao de Oro')
                ->orWhere('office', 'CENRO Maco')
                ->orWhere('office', 'CENRO Monkayo')
                ->orderBy('created_at', 'DESC')->get();

        
        
        $travel_ms_divchief = $travels_ms->where('account_type', 'Division Chief');
        $travel_ms_personnel = $travels_ms->where('account_type', 'Personnel');

        $travel_ms_approved = $travel_ms_personnel->where('application_status', 'Division Chief Approved');
        $travel_ms_pending = $travel_ms_divchief->where('application_status', 'Pending');

        $travels_ms_approved_pending = $travel_ms_approved->merge($travel_ms_pending);

        $travels_ts = TravelOrder::where('office', 'Conservation and Development Division')
                ->orWhere('office', 'Enforcement Division')
                ->orWhere('office', 'Surveys and Mapping Division')
                ->orWhere('office', 'Licenses Patents and Deeds Division')
                ->orWhere('office', 'ARED for Technical Services')
                ->orderBy('created_at', 'DESC')->get();
        
        $travel_ts_divchief = $travels_ts->where('account_type', 'Division Chief');
        $travel_ts_personnel = $travels_ts->where('account_type', 'Personnel');
        
        $travel_ts_approved = $travel_ts_personnel->where('application_status', 'Division Chief Approved');
        $travel_ts_pending = $travel_ts_divchief->where('application_status', 'Pending');
        
        $travels_ts_approved_pending = $travel_ts_approved->merge($travel_ts_pending);
        

        $travels = $travels_ms_approved_pending->merge($travels_ts_approved_pending);


        return view('travel_order.penro.approverindex', compact('travels'));

    }

    public function penro_approvedindex(){
        // $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
                
        $travels = TravelOrder::where('application_status', 'ARED MS Approved')->orderBy('created_at', 'DESC')->get();
        
        return view('travel_order.penro.approvedindex', compact('travels'));
    }
    public function penro_cancelledindex(){
        //$user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        
        $travels_ts = TravelOrder::where('office', 'Conservation and Development Division')
                ->orWhere('office', 'Enforcement Division')
                ->orWhere('office', 'Surveys and Mapping Division')
                ->orWhere('office', 'Licenses Patents and Deeds Division')
                ->orWhere('office', 'ARED for Technical Services')
                ->orderBy('created_at', 'DESC')->get();
        $travels_ms = TravelOrder::where('office', 'Planning and Management Division')
                ->orWhere('office', 'Finance Division')
                ->orWhere('office', 'Legal Division')
                ->orWhere('office', 'Admin Division')
                ->orWhere('office', 'ARED for Management Services')
                ->orderBy('created_at', 'DESC')->get();
        
        $trav_ms = $travels_ms->where('application_status', 'Disapproved');
        $trav_ts = $travels_ts->where('application_status', 'Disapproved');
        $travels = $trav_ms->merge($trav_ts);
        // $travels = TravelOrder::where('application_status', 'Disapproved')->orderBy('created_at', 'DESC')->get();
        
        return view('travel_order.penro.cancelledindex', compact('travels'));
    }
    
    public function penro_completedindex(){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        $travels = TravelOrder::where('application_status', 'Completed')->where('office', $user_office->office->officename)->orderBy('created_at', 'DESC')->get();
        
        return view('travel_order.penro.completedindex', compact('travels'));
    }

    public function penro_edit($id){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        
        $travel_order = TravelOrder::where('id', $id)->first();
       
        return view('travel_order.penro.edittravelpenro', compact('travel_order'));        
    }

    public function penro_disapprove($id){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();

        $travel_order = TravelOrder::where('id', $id)->where('office', $user_office->office->officename)->first();
        return view('travel_order.penro.disapprovetravelpenro', compact('travel_order'));
    }

    public function penro_approvefromcancelled($id){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        
        $travel_order = TravelOrder::where('id', $id)->first();
        return view('travel_order.penro.approvetravelpenro', compact('travel_order'));
    }

    public function penro_editto($id){
        $travel_order = TravelOrder::find($id);
        return response()->json(compact('travel_order'));
    }


    public function penro_update_travel(Request $request, $id){
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
        $travel->aredms_approval_date = Carbon::now();
        $travel->aredms_approval = Auth::user()->id;
        $travel->application_status = 'PENRO Approved';
        
        $travel->save();

        return response()->json(['message' => 'Travel Order Approved' ]);
    }
    public function penro_disapprove_travel(Request $request, $id){
        $reason = $request->input('value');
        $travel = TravelOrder::find($id);
        $travel->application_status = 'Disapproved';
        $travel->disapprove_date = Carbon::now();
        $travel->disapprove_reason = $reason ."       /Disapproved By: " . Auth::user()->firstname . " " . Auth::user()->lastname ;
        $travel->save();
        return response()->json(['message' => 'Travel Order Disapproved' ]);
    }

    //END OF FUNCTIONS FOR PENRO
}

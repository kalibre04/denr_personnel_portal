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
        $office_assigned = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        if($office_assigned->office->officename == "PENRO Davao del Norte"){
            $travels_province = TravelOrder::where('office', 'PENRO Davao del Norte')
                ->orWhere('office', 'CENRO Panabo')
                ->orWhere('office', 'CENRO New Corella')
                ->orderBy('created_at', 'DESC')->get();
        }elseif($office_assigned->office->officename == "PENRO Davao Oriental"){
            $travels_province = TravelOrder::where('office', 'PENRO Davao Oriental')
                ->orWhere('office', 'CENRO Mati')
                ->orWhere('office', 'CENRO Manay')
                ->orWhere('office', 'CENRO Lupon')
                ->orWhere('office', 'CENRO Baganga')
                ->orderBy('created_at', 'DESC')->get();
        }elseif($office_assigned->office->officename == "PENRO Davao del Sur"){
            $travels_province = TravelOrder::where('office', 'PENRO Davao del Sur')
                ->orWhere('office', 'CENRO Davao')
                ->orWhere('office', 'CENRO Malalag')
                ->orWhere('office', 'CENRO Digos')
                ->orderBy('created_at', 'DESC')->get();
        }elseif($office_assigned->office->officename == "PENRO Davao de Oro"){
            $travels_province = TravelOrder::where('office', 'PENRO Davao de Oro')
                ->orWhere('office', 'CENRO Maco')
                ->orWhere('office', 'CENRO Monkayo')
                ->orderBy('created_at', 'DESC')->get();
        }else{
            $travels_province = TravelOrder::where('office', 'PENRO Davao Occidental');
        }

        $travels_cenr_officer = $travels_province->where('account_type', 'CENRO');
        $travels_penr_officer = $travels_province->where('account_type', 'PENRO');
        $travels_penr_cenr = $travels_cenr_officer->merge($travels_penr_officer);

        $travels_cenroapproved = $travels_province->where('application_status', 'CENRO Approved');
        $travels_penropending = $travels_penr_officer->where('application_status', 'Pending');
        $travels = $travels_cenroapproved->merge($travels_penropending);

        //$travels = $travels_penr_cenr->merge($trav);


        return view('travel_order.penro.approverindex', compact('travels'));

    }

    public function penro_approvedindex(){
        //$user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        
        $office_assigned = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        
        if($office_assigned->office->officename == "PENRO Davao del Norte"){
            $travels_province = TravelOrder::where('office', 'PENRO Davao del Norte')
                ->orWhere('office', 'CENRO Panabo')
                ->orWhere('office', 'CENRO New Corella')
                ->orderBy('created_at', 'DESC')->get();
        }elseif($office_assigned->office->officename == "PENRO Davao Oriental"){
            $travels_province = TravelOrder::where('office', 'PENRO Davao Oriental')
                ->orWhere('office', 'CENRO Mati')
                ->orWhere('office', 'CENRO Manay')
                ->orWhere('office', 'CENRO Lupon')
                ->orWhere('office', 'CENRO Baganga')
                ->orderBy('created_at', 'DESC')->get();
        }elseif($office_assigned->office->officename == "PENRO Davao del Sur"){
            $travels_province = TravelOrder::where('office', 'PENRO Davao del Sur')
                ->orWhere('office', 'CENRO Davao')
                ->orWhere('office', 'CENRO Malalag')
                ->orWhere('office', 'CENRO Digos')
                ->orderBy('created_at', 'DESC')->get();
        }elseif($office_assigned->office->officename == "PENRO Davao de Oro"){
            $travels_province = TravelOrder::where('office', 'PENRO Davao de Oro')
                ->orWhere('office', 'CENRO Maco')
                ->orWhere('office', 'CENRO Monkayo')
                ->orderBy('created_at', 'DESC')->get();
        }else{
            $travels_province = TravelOrder::where('office', 'PENRO Davao Occidental');
        }    

        //$travels_approved = TravelOrder::where('application_status', 'PENRO Approved')->orderBy('created_at', 'DESC')->get();
        $travels_penro_approved = $travels_province->where('application_status', 'PENRO Approved');
        $travels_aredms_approved = $travels_province->where('application_status', 'ARED MS Approved');
        $travels_red_approved = $travels_province->where('application_status', 'RED Approved');

        $trav_outside_merge = $travels_penro_approved->merge($travels_aredms_approved)->merge($travels_red_approved);
        $trav_outside = $trav_outside_merge->where('travel_type', 'Outside AOR');
        
        $trav_within_per_id = $travels_penro_approved->where('penro_approval', Auth::user()->id);
        $trav_outside_per_id = $trav_outside->where('penro_approval', Auth::user()->id);


        $travels = $trav_within_per_id->merge($trav_outside_per_id);

        return view('travel_order.penro.approvedindex', compact('travels'));
    }
    public function penro_cancelledindex(){
        //$user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        
        $office_assigned = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        
        if($office_assigned->office->officename == "PENRO Davao del Norte"){
            $travels_province = TravelOrder::where('office', 'PENRO Davao del Norte')
                ->orWhere('office', 'CENRO Panabo')
                ->orWhere('office', 'CENRO New Corella')
                ->orderBy('created_at', 'DESC')->get();
        }elseif($office_assigned->office->officename == "PENRO Davao Oriental"){
            $travels_province = TravelOrder::where('office', 'PENRO Davao Oriental')
                ->orWhere('office', 'CENRO Mati')
                ->orWhere('office', 'CENRO Manay')
                ->orWhere('office', 'CENRO Lupon')
                ->orWhere('office', 'CENRO Baganga')
                ->orderBy('created_at', 'DESC')->get();
        }elseif($office_assigned->office->officename == "PENRO Davao del Sur"){
            $travels_province = TravelOrder::where('office', 'PENRO Davao del Sur')
                ->orWhere('office', 'CENRO Davao')
                ->orWhere('office', 'CENRO Malalag')
                ->orWhere('office', 'CENRO Digos')
                ->orderBy('created_at', 'DESC')->get();
        }elseif($office_assigned->office->officename == "PENRO Davao de Oro"){
            $travels_province = TravelOrder::where('office', 'PENRO Davao de Oro')
                ->orWhere('office', 'CENRO Maco')
                ->orWhere('office', 'CENRO Monkayo')
                ->orderBy('created_at', 'DESC')->get();
        }else{
            $travels_province = TravelOrder::where('office', 'PENRO Davao Occidental');
        }
                
        $travels = $travels_province->where('application_status', 'Disapproved');
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
        
        $office_assigned = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        
        if($office_assigned->office->officename == "PENRO Davao del Norte"){
            $travels_province = TravelOrder::where('office', 'PENRO Davao del Norte')
                ->orWhere('office', 'CENRO Panabo')
                ->orWhere('office', 'CENRO New Corella')
                ->orderBy('created_at', 'DESC')->get();
        }elseif($office_assigned->office->officename == "PENRO Davao Oriental"){
            $travels_province = TravelOrder::where('office', 'PENRO Davao Oriental')
                ->orWhere('office', 'CENRO Mati')
                ->orWhere('office', 'CENRO Manay')
                ->orWhere('office', 'CENRO Lupon')
                ->orWhere('office', 'CENRO Baganga')
                ->orderBy('created_at', 'DESC')->get();
        }elseif($office_assigned->office->officename == "PENRO Davao del Sur"){
            $travels_province = TravelOrder::where('office', 'PENRO Davao del Sur')
                ->orWhere('office', 'CENRO Davao')
                ->orWhere('office', 'CENRO Malalag')
                ->orWhere('office', 'CENRO Digos')
                ->orderBy('created_at', 'DESC')->get();
        }elseif($office_assigned->office->officename == "PENRO Davao de Oro"){
            $travels_province = TravelOrder::where('office', 'PENRO Davao de Oro')
                ->orWhere('office', 'CENRO Maco')
                ->orWhere('office', 'CENRO Monkayo')
                ->orderBy('created_at', 'DESC')->get();
        }else{
            $travels_province = TravelOrder::where('office', 'PENRO Davao Occidental');
        }

        $travel_order = $travels_province->where('id', $id)->first();
        return view('travel_order.penro.disapprovetravelpenro', compact('travel_order'));
    }

    public function penro_approvefromcancelled($id){
        $office_assigned = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        
        if($office_assigned->office->officename == "PENRO Davao del Norte"){
            $travels_province = TravelOrder::where('office', 'PENRO Davao del Norte')
                ->orWhere('office', 'CENRO Panabo')
                ->orWhere('office', 'CENRO New Corella')
                ->orderBy('created_at', 'DESC')->get();
        }elseif($office_assigned->office->officename == "PENRO Davao Oriental"){
            $travels_province = TravelOrder::where('office', 'PENRO Davao Oriental')
                ->orWhere('office', 'CENRO Mati')
                ->orWhere('office', 'CENRO Manay')
                ->orWhere('office', 'CENRO Lupon')
                ->orWhere('office', 'CENRO Baganga')
                ->orderBy('created_at', 'DESC')->get();
        }elseif($office_assigned->office->officename == "PENRO Davao del Sur"){
            $travels_province = TravelOrder::where('office', 'PENRO Davao del Sur')
                ->orWhere('office', 'CENRO Davao')
                ->orWhere('office', 'CENRO Malalag')
                ->orWhere('office', 'CENRO Digos')
                ->orderBy('created_at', 'DESC')->get();
        }elseif($office_assigned->office->officename == "PENRO Davao de Oro"){
            $travels_province = TravelOrder::where('office', 'PENRO Davao de Oro')
                ->orWhere('office', 'CENRO Maco')
                ->orWhere('office', 'CENRO Monkayo')
                ->orderBy('created_at', 'DESC')->get();
        }else{
            $travels_province = TravelOrder::where('office', 'PENRO Davao Occidental');
        }

        $travel_disapproved = $travels_province->where('application_status', 'Disapproved');
        
        $travel_order = $travel_disapproved->where('id', $id)->first();
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
        $travel->penro_approval_date = Carbon::now();
        $travel->penro_approval = Auth::user()->id;
        $travel->application_status = 'PENRO Approved';
        $travel->travel_type = $request->travel_type;
        
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

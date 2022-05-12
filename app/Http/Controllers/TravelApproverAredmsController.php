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


class TravelApproverAredmsController extends Controller
{
    // FUNCTIONS FOR ARED MS
    public function aredms_index(){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();

        $travels = TravelOrder::where('application_status', 'Division Chief Approved')
                ->where('office', 'Planning and Management Division')
                ->orWhere('office', 'Finance Division')
                ->orWhere('office', 'Legal Division')
                ->orWhere('office', 'Admin Division')
                ->orWhere('office', 'ARED for Management Services')
                ->orWhere('office', 'ARED for Techincal Services')
                ->orWhere('office', 'Conservation and Development Division')
                ->orWhere('office', 'Licences Patents and Deeds Division')
                ->orWhere('office', 'Surveys and Mapping Division')
                ->orWhere('office', 'Enforcement Division')
                ->orderBy('created_at', 'DESC')->get();
        
        return view('travel_order.aredms.approverindex', compact('travels'));
    }

    public function aredms_approvedindex(){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();

        $travels = TravelOrder::where('application_status', 'ARED MS Approved')->where('office', $user_office->office->officename)->orderBy('created_at', 'DESC')->get();
        
        return view('travel_order.aredms.approvedindex', compact('travels'));
    }
    public function aredms_cancelledindex(){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        $travels = TravelOrder::where('application_status', 'Disapproved')->where('office', $user_office->office->officename)->orderBy('created_at', 'DESC')->get();
        
        return view('travel_order.aredms.cancelledindex', compact('travels'));
    }
    
    public function aredms_completedindex(){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        $travels = TravelOrder::where('application_status', 'Completed')->where('office', $user_office->office->officename)->orderBy('created_at', 'DESC')->get();
        
        return view('travel_order.aredms.completedindex', compact('travels'));
    }

    public function aredms_edit($id){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        
        $travel_order = TravelOrder::where('id', $id)->where('office', $user_office->office->officename)->first();
        return view('travel_order.aredms.edittravelaredms', compact('travel_order'));        
    }

    public function aredms_disapprove($id){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        
        $travel_order = TravelOrder::where('id', $id)->where('office', $user_office->office->officename)->first();
        return view('travel_order.aredms.disapprovetravelaredms', compact('travel_order'));
    }

    public function aredms_approvefromcancelled($id){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        
        $travel_order = TravelOrder::where('id', $id)->where('office', $user_office->office->officename)->first();
        return view('travel_order.aredms.approvetravelaredms', compact('travel_order'));
    }

    public function aredms_editto($id){
        $travel_order = TravelOrder::find($id);
        return response()->json(compact('travel_order'));
    }


    public function aredms_update_travel(Request $request, $id){
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
        $travel->application_status = 'ARED MS Approved';
        
        $travel->save();

        return response()->json(['message' => 'Travel Order Approved' ]);
    }
    public function aredms_disapprove_travel(Request $request, $id){
        $travel = TravelOrder::find($id);
        $travel->application_status = 'Disapproved';
        $travel->disapprove_date = Carbon::now();
        $travel->disapprove_reason = $request->input('value');
        $travel->save();
        return response()->json(['message' => 'Travel Order Disapproved' ]);
    }

    //END OF FUNCTIONS FOR ARED MS
}

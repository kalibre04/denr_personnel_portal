<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\User;
use App\Models\Promotion;
use App\Models\Personnel_Assignment;
use App\Models\TravelOrder;
use App\Models\Region;


class TravelController extends Controller
{
    public function index(){
        $office_assigned = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        $travels = TravelOrder::where('user_id', Auth::user()->id)->where('office', $office_assigned->office->officename)->orderBy('date_submitted', 'ASC')->get();

        return view('travel_order.index', compact('travels'));
    }

    public function view_traveldetailsdivchief($id){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        
        $travel_order = TravelOrder::where('id', $id)->where('office', $user_office->office->officename)->first();
        return view('travel_order.viewtravel', compact('travel_order'));
    }

    public function view_traveldetailscenro($id){
        $user_office = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        
        $travel_order = TravelOrder::where('id', $id)->where('office', $user_office->office->officename)->first();
        return view('travel_order.cenro.viewtravel', compact('travel_order'));
    }

    public function create()
    {
		$now = Carbon::now()->format('y');
		$rounded = TravelOrder::IDGenerator(new TravelOrder,'to_number', 5, $now);
		$office_assigned = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
        $account_type = Auth::user()->account_type;
        return view('travel_order.create', compact('rounded', 'office_assigned', 'account_type'));
    }


    public function create_travel(Request $request){

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

        
        $now = Carbon::now()->format('y');
        $to_num = TravelOrder::IDGenerator(new TravelOrder,'to_number', 5, $now);    
        
        $travel = new TravelOrder;

        $travel->user_id = Auth::user()->id;
        $travel->date_depart = $request->datedepart;
        $travel->date_arrived = $request->datearrive;
        $travel->destination = $request->destination;
        $travel->purpose = $request->purpose;
        $travel->expenses = $request->expenses;
        $travel->assist_labor_allowed = $request->assist_labor_allowed;
        $travel->instructions = $request->instructions;
        $travel->date_submitted = Carbon::now();
        


        $travel->to_number = $to_num;
        $travel->office = $request->currentDept;
        $travel->office_id = $request->currentDeptid;
        $travel->account_type = $request->accounttype;
        if($request->travel_type == "True"){
            $travel->travel_type = 'Outside AOR';
        }
        
        $travel->save();

        return response()->json(['message' => 'Travel Order Successfully Created' ]);
        // $input = $request;
        // return response()->json(['message' => $input ]);

    }
}

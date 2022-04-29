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


        return view('travel_order.index');
    }

    public function region()
    {
        $regions = Region::get();
        return response()->json(compact('regions'));
    }

    public function create()
    {
        $now = Carbon::now();
        $travel_id = TravelOrder::latest()->first();
        if($travel_id == NULL){
            $office_assigned = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
            $default = "000001";
            $val = $now->year .'-'.$default;
            return view('travel_order.create', compact('val', 'office_assigned'));
        }else{
            $office_assigned = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
            $default = "000000";
            $after_year = sprintf('%06d', $default + intval($travel_id->id + 000001));
            $val = $now->year .'-'.$after_year;
            return view('travel_order.create', compact('val', 'office_assigned'));
        }
        
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

        // $now = Carbon::now();
        // $travel_id = TravelOrder::latest()->first();
        // if($travel_id == NULL){
        //     $default = "000001";
        //     $val = $now->year .'-'.$default;
            
        // }else{
        //     $default = "000000";
        //     $after_year = sprintf('%06d', $default + intval($travel_id->id + 000001));
        //     $val = $now->year .'-'.$after_year;
            
        // }

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

        $travel->to_number = $request->toNumber;
        $travel->office = $request->currentDept;
        $travel->save();

        return response()->json(['message' => 'Travel Order Successfully Created' ]);
    }
}

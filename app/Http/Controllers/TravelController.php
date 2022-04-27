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

        return view('travel_order.create');
    }
}

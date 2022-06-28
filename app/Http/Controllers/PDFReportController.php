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
use PDF;


class PDFReportController extends Controller
{
    public function printTravel($id){
        $trav = TravelOrder::find($id);
        $user = User::find($trav->user_id);
        
        $filename = $trav->to_number. " - " .$user->lastname . ", " . $user->firstname;
        $fullname = $user->lastname . ", " . $user->firstname . " " . substr($user->middlename, 0, 1). ".";
        $position = Promotion::where('user_id', $trav->user_id)->with('plantilla')->latest()->first();

        $travel = [
            'to_number' => $trav->to_number,
            'date_depart' => $trav->date_depart,
            'date_arrived' => $trav->date_arrived,
            'destination' => $trav->destination,
            'salary' => $trav->salary,
            'purpose' => $trav->purpose,
            'expenses' => $trav->expenses,
            'assist_labor_allowed' => $trav->assist_labor_allowed,
            'instructions' => $trav->instructions,
            'fullname' => $fullname,
            'position' => $position, 
            'office' => $trav->office
        ];
        
        //$travels_penro_approved->merge($travels_aredms_approved);

        $pdf = PDF::loadView('travel_order.reports.travelorders_pdf.travelpdf', $travel);
    
        return $pdf->download($filename . '.pdf');
    }
}

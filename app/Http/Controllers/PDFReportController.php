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
        $office_assigned = Personnel_Assignment::where('user_id', $trav->user_id)->with('office')->latest()->first();

        if($office_assigned == "Conservation and Development Division"){
            $approver = User::find($trav->aredts_approval);
            $approver_fullname = $approver->firstname . " " . substr($approver->middlename, 0, 1) . "." . " " . $approver->lastname;
        }elseif($office_assigned == "Enforcement Division"){
            $approver = User::find($trav->aredts_approval);
            $approver_fullname = $approver->firstname . " " . substr($approver->middlename, 0, 1) . "." . " " . $approver->lastname;
        }elseif($office_assigned == "Licences Patents and Deeds Division"){
            $approver = User::find($trav->aredts_approval);
            $approver_fullname = $approver->firstname . " " . substr($approver->middlename, 0, 1) . "." . " " . $approver->lastname;
        }elseif($office_assigned == "Surveys and Mapping Division"){
            $approver = User::find($trav->aredts_approval);
            $approver_fullname = $approver->firstname . " " . substr($approver->middlename, 0, 1) . "." . " " . $approver->lastname;
        }elseif($office_assigned == "ARED for Technical Services"){
            $approver = User::find($trav->aredts_approval);
            $approver_fullname = $approver->firstname . " " . substr($approver->middlename, 0, 1) . "." . " " . $approver->lastname;
        }elseif($office_assigned == "Planning and Management Division"){
            $approver = User::find($trav->aredms_approval);
            $approver_fullname = $approver->firstname . " " . substr($approver->middlename, 0, 1) . "." . " " . $approver->lastname;
        }elseif($office_assigned == "Legal Division"){
            $approver = User::find($trav->aredms_approval);
            $approver_fullname = $approver->firstname . " " . substr($approver->middlename, 0, 1) . "." . " " . $approver->lastname;
        }elseif($office_assigned == "ARED for Management Services"){
            $approver = User::find($trav->aredms_approval);
            $approver_fullname = $approver->firstname . " " . substr($approver->middlename, 0, 1) . "." . " " . $approver->lastname;
        }elseif($office_assigned == "Finance Division"){
            $approver = User::find($trav->aredms_approval);
            $approver_fullname = $approver->firstname . " " . substr($approver->middlename, 0, 1) . "." . " " . $approver->lastname;
        }elseif($office_assigned == "Admin Division"){
            $approver = User::find($trav->aredms_approval);
            $approver_fullname = $approver->firstname . " " . substr($approver->middlename, 0, 1) . "." . " " . $approver->lastname;
        }elseif($office_assigned == "Planning and Management Division"){
            $approver = User::find($trav->aredms_approval);
            $approver_fullname = $approver->firstname . " " . substr($approver->middlename, 0, 1) . "." . " " . $approver->lastname;
        }elseif($office_assigned == "Planning and Management Division"){
            $approver = User::find($trav->aredms_approval);
            $approver_fullname = $approver->firstname . " " . substr($approver->middlename, 0, 1) . "." . " " . $approver->lastname;
        }elseif($office_assigned == "Planning and Management Division"){
            $approver = User::find($trav->aredms_approval);
            $approver_fullname = $approver->firstname . " " . substr($approver->middlename, 0, 1) . "." . " " . $approver->lastname;
        }elseif($office_assigned == "Planning and Management Division"){
            $approver = User::find($trav->aredms_approval);
            $approver_fullname = $approver->firstname . " " . substr($approver->middlename, 0, 1) . "." . " " . $approver->lastname;
        }


        if($office_assigned == "Conservation and Development Division"){
            $aredtype = "Technical";
        }elseif($office_assigned == "Enforcement Division"){
            $aredtype = "Technical";
        }elseif($office_assigned == "Licences Patents and Deeds Division"){
            $aredtype = "Technical";
        }elseif($office_assigned == "Surveys and Mapping Division"){
            $aredtype = "Technical";
        }elseif($office_assigned == "ARED for Technical Services"){
            $aredtype = "Technical";
        }

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
            'office' => $trav->office,
            'official_station' => $office_assigned,
            'aredtype' => $aredtype
        ];
        
        //$travels_penro_approved->merge($travels_aredms_approved);

        $pdf = PDF::loadView('travel_order.reports.travelorders_pdf.travelpdf', $travel);
    
        return $pdf->download($filename . '.pdf');
    }
}

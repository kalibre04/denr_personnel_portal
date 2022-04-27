<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Validator;
use Session;

use App\Models\User;
use App\Models\Promotion;
use App\Models\Plantilla;
use App\Models\Personnel_Assignment;
use App\Models\Office;

class PersonnelController extends Controller
{
    public function profile($id)
    {
        if(Auth::user()->id == $id){
            $user = User::find($id);
            $promotion = Promotion::where('user_id', Auth::user()->id)->with('plantilla')->orderBy('created_at', 'DESC')->get();
            //$plantillas = Plantilla::get(['plantilla_position', 'item_no', 'id']);
            $plantillas = Plantilla::selectRaw('id, CONCAT(plantilla_position, " - ", item_no) as item')->pluck('item', 'id');
            $officeassignments = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->orderBy('created_at', 'DESC')->get();
            $office_assigned = Personnel_Assignment::where('user_id', Auth::user()->id)->with('office')->latest()->first();
            $offices = Office::get()->pluck('officename', 'id');

            return view('personnel.profile', compact('user', 'promotion', 'plantillas', 'officeassignments', 'offices', 'office_assigned'));
        }else{
            return redirect()->back();
        }
    }

    public function profilepasswordupdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [ 
            'password'         => 'required', 
            'confirm_password' => 'required|same:password', 
        ]);
        if ($validator->fails()) { 
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();          
        }
        $user = User::find($id);
        $user->password = bcrypt($request->password);

        $user->save();
        Session::flash('flash_message','Your Password Was Successfully Updated');
        return redirect()->back();
    }
    public function updateprofile(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [ 
            'firstname'        => 'required',
            'middlename'       => 'required',
            'lastname'         => 'required',
            'date_of_birth'    => 'required|date',
            'contact_no'       => 'required',
            'email'            => 'required|email|', 
        ]);
        if ($validator->fails()) { 
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();          
        }
        $user = User::find($id);
        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->date_of_birth = $request->date_of_birth;
        $user->contact_no = $request->contact_no;
        $user->email = $request->email;

        $user->save();
        Session::flash('flash_message','Your Profile Was Successfully Updated');
        return redirect()->back();

    }
    

}
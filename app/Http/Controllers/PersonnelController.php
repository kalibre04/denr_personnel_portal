<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Validator;
use Session;

use App\Models\User;



class PersonnelController extends Controller
{
    public function profile($id)
    {
        if(Auth::user()->id == $id){
            $user = User::find($id);
            return view('personnel.profile',compact('user'));
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
        Session::flash('flash_message','Your Profile Was Successfully Updated');
        return redirect()->back();
    }

}

<?php

namespace App\Http\Controllers;


use App\Models\contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
class contactController extends Controller
{
    public function contact(){
        return view('frontend.contact');
    }

    public function contactStore(Request $request){
        try {
           
            $validation = Validator::make( $request->all(),[
                'name' => 'required|string',
                'email' => 'required|email',
                'subject' => 'required|string',
                'message' => 'required|string',
            ]);

            if($validation->fails()){
                dd($request);
                return redirect()->route('contact')
                    ->withInput()
                    ->withErrors($validation);
            }
            if($validation){
              
                $addcontact = contact::create([
                    'name' => $request->name,
                    'email' => $request->email, // Use filename here
                    'subject' => $request->subject,
                    'message' => $request->message,
                ]);

                return redirect()->route('contact')->with('success','Create Contact Successfull');
            }

        } catch (\Exception $e) {
            // Handle the exception
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    
}

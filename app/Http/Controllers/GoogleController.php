<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\CustomerTemp;
use File;
use Carbon\Carbon;
use Session;

class GoogleController extends Controller
{
    public function redirectToGoogle(Request $request)
    {
        
        
        if(Auth::guard('customer')->check())
        {
            return redirect()->route('account-dashboard');
        }
        else{
            $redirectUrl = route('first.details'); // The URL you want to redirect to after authentication
            return Socialite::driver('google')->stateless()->with(['redirect_url' => $redirectUrl])->redirect();
        }
         
    }

    public function handleGoogleCallback(Request $request)
    {
         
        $googleUser = Socialite::driver('google')->stateless()->user();
        
        $user = Customer::where('email', $googleUser->email)->first();
        if ($user) 
        {
            if($user && is_null($user->mobile)){
                $request->session()->flash('error','Please complete the sign up...');
                return redirect()->route('first.details');
            }
            Auth::guard('customer')->login($user);
        	return redirect()->route('account-dashboard');
     
        } else {
      
             $newUser = CustomerTemp::create([
                 'name'      => $googleUser->getName(),
                 'email'     => $googleUser->getEmail(),
                 'google_id' => $googleUser->getId(),
                 'profile_pic' => $googleUser->getAvatar(),
                 'email_verified_at' => date('Y-m-d H:i:s'),
                ]);
        
                $request->session()->put('id_tempuser',$newUser->id);
                
    		    return redirect()->route('first.details');
        }
    }
    
    
    
}
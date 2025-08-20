<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerTemp;
use App\Models\CustomerVerify;
use App\Models\Address;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Constraint\Count;
use Session;
use Validator;
use Illuminate\Support\Str;
use DB;
use Mail;
use App\Mail\EmailVerificationEmail;
use App\Mail\MailForgotPassword;
use Carbon\Carbon;
use App\Models\State;
use App\Models\City;


class CustomerController extends Controller
{
    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $exists = Customer::where('email', $email)->exists();

        return response()->json(['exists' => $exists]);
    }



    public function authenticate(Request $request)
    {
        // dd('ger');
        if (Auth::guard('customer')->check()) {
            return redirect()->route('account-dashboard');
        } else {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);


            $credentials = $request->only('email', 'password');
            $customer = Customer::where('email', $request->email)->first();
            if (!empty($customer)) {
                if ($customer->email_verified_at == NULL) {
                    $token = Str::random(64);
                    CustomerVerify::create([
                        'customer_id' => $customer->id,
                        'token' => $token
                    ]);
                    $mailData = ['token' => $token];
                    $mailContent = Mail::to($request->email)->send(new EmailVerificationEmail($mailData));
                    return redirect()->route('authentication-signin')
                        ->withErrors('Your email has not been verified yet, Verification Email sent, Please check your email in inbox, spam and junk folder.');
                } else if ($customer->status != 'Active') {
                    return redirect()->route('authentication-signin')
                        ->withErrors('Your account has been blocked please contact to Admin.');
                } else {
                    if (Auth::guard('customer')->attempt($credentials)) {
                        // dd(Auth::guard('customer')->user());
                        return redirect()->route('account-dashboard')
                            ->withSuccess('You have successfully logged in!');
                    }


                }

            } else {
                return back()->withErrors(['email' => 'Invalid email'])->onlyInput('email');
            }
            // return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');

        }

    }


    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:250',
            'last_name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:customers',
            'mobile' => 'required|unique:customers',
            'password' => 'required|min:8',
            'country' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $customerm = Customer::where('mobile', $request->mobile)->first();
        if ($customerm) {
            \Session::put('error', 'Already Exists Mobile Number');
            return redirect("authentication-signin");
        }


        $customer = new customer();

        $customer->first_name = ucfirst($request->first_name);
        $customer->last_name = ucfirst($request->last_name);
        $customer->email = $request->email;
        $customer->mobile = $request->mobile;
        $customer->customer_id = 'NUMPRINT' . date('y') . rand(1000, 9999);
        $customer->mobile_verified_at = date('Y-m-d H:i:s');
        $customer->password = Hash::make($request->password);
        $customer->country = $request->country;
        $customer->save();

        $token = Str::random(64);
        CustomerVerify::create([
            'customer_id' => $customer->id,
            'token' => $token
        ]);

        $mailData = ['token' => $token];
        $mailContent = Mail::to($request->email)->send(new EmailVerificationEmail($mailData));

        return redirect()->route('authentication-signin')
            ->withSuccess('Verification Email sent, Please check your email in inbox, spam and junk folder.');
    }

    public function verifyAccount($token)
    {
        $verifyUser = customerVerify::where('token', $token)->first();

        // echo "<pre/>"; print_r($verifyUser); die('sjbfvkjber');
        $message = 'Sorry your email cannot be identified.';

        if (!is_null($verifyUser)) {
            $user = $verifyUser->customer;

            if (!$user->email_verified_at) {
                $verifyUser->customer->email_verified_at = date('Y-m-d H:i:s');
                $verifyUser->customer->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

        \Session::put('success', $message);
        return redirect()->route('authentication-signin');

    }


    public function addRequiredDetails(Request $request)
    {

        $user_id = session()->get('id_tempuser');

        $data['user'] = CustomerTemp::findOrFail($user_id);
        return view('front.add-details', $data);
    }

    public function storeRequiredDetails(Request $request)
    {
        $request->validate([
            'mobile' => 'required|unique:customers',
            'password' => 'required|min:8',
            'country' => 'required'
        ]);


        $user_id = session()->get('id_tempuser');

        $customer_temp = customerTemp::find($user_id);

        if (!$user_id) {
            return redirect()->back()->with('error', 'User not found in session.');
        }

        $nameArr = explode(' ', $customer_temp->name);

        $customer = Customer::create([
            'first_name' => $nameArr[0] ?? "",
            'last_name' => $nameArr[1] ?? "",
            'email' => $customer_temp->email,
            'google_id' => $customer_temp->google_id,
            'profile_pic' => $customer_temp->profile_pic,
            'mobile_verified_at' => date('Y-m-d H:i:s'),
            'email_verified_at' => date('Y-m-d H:i:s'),

        ]);

        $customer = Customer::find($customer->id);
        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not found.');
        }


        $customer->password = Hash::make($request->password);
        $customer->customer_id = 'NUMPRINT' . date('y') . rand(1000, 9999);
        $customer->mobile = $request->mobile;
        $customer->save();

        Auth::guard('customer')->login($customer);

        return redirect()->route('account-dashboard');
    }

    public function showForgetPasswordForm()
    {
        return view('front.forgot-password');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:customers',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $mailData = ['token' => $token];

        $mailContent = Mail::to($request->email)->send(new MailForgotPassword($mailData));

        return back()->with('success', 'We have e-mailed your password reset link! Please check your email in inbox, spam and junk folder.');
    }

    public function showResetPasswordForm($token)
    {
        return view('front.forget-password-link', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')->where(['token' => $request->token])->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = Customer::where('email', $updatePassword->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_resets')->where(['token' => $request->token])->delete();

        return redirect()->route('authentication-signin')->with('success', 'Your password has been changed!');
    }




    public function dashboard()
    {
        if (Auth::guard('customer')->check()) {
            $user_id = Auth::guard('customer')->user()->id;
            $data['user'] = Customer::findOrFail($user_id);
            // dd($data);
            return view('front.dashboard', $data);
        } else {
            return redirect()->route('authentication-signin')
                ->withErrors('Please login to access the dashboard.');
        }
    }

    public function orders()
    {
        if (Auth::guard('customer')->check()) {
            $user = Auth::guard('customer')->user();

            // Fetch customer with their quotes
            $data['user'] = $user;
            $data['quotes'] = Quote::with(['items', 'billingAddress', 'deliveryAddress', 'documents', 'departments', 'payments', 'invoice'])
                ->where('customer_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();

            return view('front.account-orders', $data);
        } else {
            return redirect()->route('authentication-signin')
                ->withErrors('Please login to access the dashboard.');
        }
    }


    public function downloads()
    {
        if (Auth::guard('customer')->check()) {
            $user_id = Auth::guard('customer')->user()->id;
            $data['user'] = Customer::findOrFail($user_id);
            return view('front.account-downloads', $data);
        } else {
            return redirect()->route('authentication-signin')
                ->withErrors('Please login to access the dashboard.');
        }
    }
    public function paymentmethods()
    {
        if (Auth::guard('customer')->check()) {
            $user_id = Auth::guard('customer')->user()->id;
            $data['user'] = Customer::findOrFail($user_id);
            return view('front.account-payment-methods', $data);
        } else {
            return redirect()->route('authentication-signin')
                ->withErrors('Please login to access the dashboard.');
        }
    }
    public function addresses()
    {
        if (Auth::guard('customer')->check()) {
            $user_id = Auth::guard('customer')->user()->id;
            $data['user'] = Customer::findOrFail($user_id);
            $data['addresses'] = Auth::guard('customer')->user()->addresses()->get();
            return view('front.account-addresses', $data);
        } else {
            return redirect()->route('authentication-signin')
                ->withErrors('Please login to access the dashboard.');
        }
    }
    public function userDetails()
    {
        if (Auth::guard('customer')->check()) {
            $user_id = Auth::guard('customer')->user()->id;
            $data['user'] = Customer::with('countryname')->where('id', $user_id)->first();
            return view('front.account-user-details', $data);
        } else {
            return redirect()->route('authentication-signin')
                ->withErrors('Please login to access the dashboard.');
        }
    }

    public function updateProfile(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            $user = Auth::guard('customer')->user();

            $request->validate([
                'first_name' => 'required|string|max:155',
                'display_name' => 'required|string|max:155',
                'last_name' => 'required|string|max:155',
                'email' => 'required|email|unique:customers,email,' . $user->id,
                'mobile' => 'required|digits_between:10,15|unique:customers,mobile,' . $user->id,
                'whatsapp_number' => 'required|digits_between:10,15',
            ]);

            $user->first_name = $request->first_name;
            $user->display_name = $request->display_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->whatsapp_number = $request->whatsapp_number;

            $user->save();
            return response()->json(['success' => true, 'message' => 'Profile updated successfully.']);

        } else {
            return redirect()->route('authentication-signin')
                ->withErrors('Please login to access the dashboard.');
        }
    }

    public function updateProfilePic(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            $user = Auth::guard('customer')->user();

            $request->validate([
                'profile_pic' => 'required|image|max:2048',
            ]);

            if ($request->hasFile('profile_pic')) {
                $path = $request->file('profile_pic')->store('customers', 'public');// Example storage locatio
                $user->profile_pic = $path;
            }

            $user->save();

            return response()->json(['success' => true, 'message' => 'Profile updated successfully.']);
        } else {
            return redirect()->route('authentication-signin')
                ->withErrors('Please login to access the dashboard.');
        }
    }

    public function changePassword(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            $request->validate([
                'old_password' => 'required|string',
                'new_password' => 'required|string|min:8|confirmed',
            ]);

            $user = Auth::guard('customer')->user();

            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json(['errors' => ['old_password' => ['Old password is incorrect.']]], 422);
            }

            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            return response()->json(['success' => true, 'message' => 'Password successfully updated.']);
        } else {
            return redirect()->route('authentication-signin')
                ->withErrors('Please login to access the dashboard.');
        }

    }

    public function addressStore(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            $data = $request->validate([
                'type' => 'required|in:billing,shipping',
                'address_line1' => 'required',
                'address_line2' => 'nullable',
                'city' => 'required',
                'state' => 'required',
                'postal_code' => 'required',
                'country' => 'required',
                'is_default' => 'boolean',
                'address_tag' => 'required|in:Home,Office,Others',
            ]);


            if ($data['is_default']) {
                Auth::guard('customer')->user()->addresses()->where('type', $data['type'])->update(['is_default' => false]);
            }

            Auth::guard('customer')->user()->addresses()->create($data);

            return response()->json(['success' => true, 'message' => 'Address added successfully.']);

        } else {
            return redirect()->route('authentication-signin')
                ->withErrors('Please login to access the dashboard.');
        }
    }
    public function statesByCountry(Request $request)
    {
        $id = $request->country_id;
        $states = State::where('country_id', $id)->get();
        //dd($city);
        if (isset($states)) {
            $response = '<option value="">Select State </option>';
            foreach ($states as $row) {
                $response .= '<option value=' . $row->id . '>' . $row->name . '</option>';
            }
        } else {
            $response = "";
            $response .= '<option value="">No State Found </option>';
        }

        return response()->json($response);
    }
    public function citiesByState(Request $request)
    {
        $id = $request->state_id;
        $city = City::where('state_id', $id)->get();
        //dd($city);
        if (isset($city)) {
            $response = '<option value="">Select City </option>';
            foreach ($city as $row) {
                $response .= '<option value=' . $row->id . '>' . $row->name . '</option>';
            }
        } else {
            $response = "";
            $response .= '<option value="">No City Found </option>';
        }

        return response()->json($response);
    }
    public function logout()
    {
        if (Auth::guard('customer')->check()) // this means that the admin was logged in.
        {
            Auth::guard('customer')->logout();
            return redirect()->route('authentication-signin');
        }
    }

    public function getCustomerData()
    {

        // dd('hello',Auth::guard('customer')->check());
        if (Auth::guard('customer')->check()) {
            $user_id = Auth::guard('customer')->user()->id;
            $data['user'] = Customer::findOrFail($user_id);
            // dd($data);
            return response()->json($data);
        }

    }

    public function orderDetails($id)
    {
        $quote = Quote::with([
            'customer',
            'items.attributes.attribute',
            'items.attributes.attributeValue',
            'documents',
            'deliveryAddress',
            'departments' // eager load existing departments
        ])->findOrFail($id);


        return view('front.order-details', [
            'quote' => $quote,
        ]);
    }


    public function viewInvoice($quoteId)
    {
        $quote = Quote::with([
            'customer',
            'billingAddress',
            'deliveryAddress',
            'items.attributes.attribute',
            'items.attributes.attributeValue',
            'payments',
            'invoice'
        ])->findOrFail($quoteId);
        return view('front.view-invoice', [
            'quote' => $quote,
            'invoice' => $quote->invoice,
            'payments' => $quote->payments,
            'customer' => $quote->customer,
        ]);
    }

}

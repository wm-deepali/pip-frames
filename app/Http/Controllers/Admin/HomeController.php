<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BasicSetting;
use App\Models\LoginActivity;
use App\Models\User;
use App\Models\UserMeta;
use App\Models\UserSocialLink;
use App\Traits\CSC;
use Illuminate\Http\Request;
use App\Models\SiteMetaContent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    use CSC;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function profile()
    {
        $user = User::with(['user_metas', 'user_social_links'])->findOrFail(Auth::id());
        return view('manage-profile.profile', ['user' => $user]);
    }

    public function profileSettings()
    {
        $activities = LoginActivity::latest()->take(5)->get();
        $basic_settings = BasicSetting::all();
        $countries = $this->getCountryList();
        return view('manage-profile.setting', [
            'activities' => $activities,
            'basic_settings' => $basic_settings,
            'countries' => $countries
        ]);
    }

    public function socialFormSubmit(Request $request)
    {
        $request->validate([
            'facebook' => 'required',
            'twitter' => 'required',
            'linkedin' => 'required',
            'youtube' => 'required'
        ]);
        
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $result = UserSocialLink::updateOrCreate(['user_id' => Auth::id()],
            [
                'user_id' => $data['user_id'],
                'facebook' => $data['facebook'],
                'twitter' => $data['twitter'],
                'linkedin' => $data['linkedin'],
                'youtube' => $data['youtube'],

            ]);
        if($result){ 
            $arr = array('msg' => 'Social links Added Successfully!', 'status' => true);
        }else{

            $arr = array('msg' => 'Something went wrong. Please try again!', 'status' => false);
        }
        return Response()->json($arr);
    }

    public function changePassword(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        if ($user) {
            if (Hash::check($request->old_password, $user->password)) {
                $user->update(['password' => bcrypt($request->new_password)]);
                $arr = array('msg' => 'Password updated Successfully!', 'status' => true); 

            }else{
               $arr = array('msg' => 'Password not matched. Please try again!', 'status' => false); 
            }
        }else{
            $arr = array('msg' => 'User not found. Please try again!', 'status' => false);
        }
        return Response()->json($arr);
    }

    public function basicSettingSubmit(Request $request)
    {
        $setting = BasicSetting::where('id', $request->setting_id)->update(['status' => $request->status]);
        return true;
    }

    public function userInfoSubmit(Request $request)
    {
        $request->validate([
            'bio' => 'required',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'website' => 'required',
        ]);
        
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $result = UserMeta::updateOrCreate(['user_id' => Auth::id()],
            [
                'user_id' => $data['user_id'],
                'bio' => $data['bio'],
                'address' => $data['address'],
                'country_id' => $data['country'],
                'state_id' => $data['state'],
                'city_id' => $data['city'],
                'website' => $data['website'],

            ]);
        if($result){ 
            $arr = array('msg' => 'User information Added Successfully!', 'status' => true);
        }else{

            $arr = array('msg' => 'Something went wrong. Please try again!', 'status' => false);
        }
        return Response()->json($arr);
    }

    public function userBasicInfoSubmit(Request $request)
    {
        $request->validate([
            'profile' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'username' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.Auth::id(),
            'phone' => 'required',
            'company' => 'required|string',
            'gender' => 'required',
            'dob' => 'required',
        ]);

        $data = User::findOrFail(Auth::id());

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            // for store resized image
            $website_logo = time().'.'.$file->getClientOriginalExtension(); 
            $destinationPath = public_path('images/logo');
            $file->move($destinationPath, $website_logo);
            $data->logo_img = $website_logo;
            
        }
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            // for store resized image
            $profile_img = time().'.'.$file->getClientOriginalExtension(); 
            $destinationPath = public_path('images/profiles');
            $file->move($destinationPath, $profile_img);
            $data->profile_img = $profile_img;
            
        }

        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->company = $request->company;
        $data->gender = $request->gender;
        $data->birth_date = $request->dob;

        $data->save();

        return back()->withStatus('Profile updated Successfully!');
    }
	
	public function manageSiteMetas() {
        $metas = SiteMetaContent::get();
        return view('admin.site-metas.index', compact('metas'));
    }

    public function editMetaContent($id) {
        $picked = SiteMetaContent::find(base64_decode($id));
        return view('admin.site-metas.edit', compact('picked'));
    }

    public function updateSiteMetas(Request $request) {
        $request->validate(
            [
                'id'               => 'required|integer',
                'meta_title'       => 'required|max:150',
                'meta_keyword'     => 'required|max:600',
                'meta_description' => 'required|max:2000',
                'canonical_link'   => 'required|url',
                'og_tag'           => 'nullable|url',
                'twitter_tag_url'  => 'nullable|url',
            ]
        );
        $picked = SiteMetaContent::find($request->id);
        $picked->update(
            [
                'title'          => $request->meta_title,
                'keywords'       => $request->meta_keyword,
                'description'    => $request->meta_description,
                'canonical_link'      => $request->canonical_link,
                'og_locale'           => $request->og_locale,
                'og_type'             => $request->og_type,
                'og_title'            => $request->og_title,
                'og_image'            => $request->og_image,
                'og_description'      => $request->og_description,
                'og_site_name'        => $request->og_site_name,
                'twitter_card'        => $request->twitter_card,
                'twitter_description' => $request->twitter_description,
                'twitter_title'       => $request->twitter_title,
                'twitter_site'        => $request->twitter_site,
                'twitter_creator'     => $request->twitter_creator,
                'twitter_image'       => $request->twitter_image,
                'publisher'           => $request->publisher,
                'og_tag'              => $request->og_tag,
                'twitter_tag_url'     => $request->twitter_tag_url,
            ]
        );
        return back()->with('success', 'Content Updated Successfully.');
    }
}

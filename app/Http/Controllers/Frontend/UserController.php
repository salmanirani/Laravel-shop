<?php

namespace App\Http\Controllers\Frontend;

use App\Address;
use App\City;
use App\Domain;
use App\Http\Requests\FrontRegisterUserRequest;
use App\Http\Requests\ResetRequest;
use App\Mail\Forgot;
use App\Mtcategory;
use App\Order;
use App\Shop;
use App\User;
use App\Wishlists;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function clearRoute()
    {
        Artisan::call('route:clear');
        Artisan::call('clear-compiled');
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
    }
    public function reset(ResetRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!empty($user->email)) {
            $email = $user->email;
            $id = $user->id;
            $new_password = rand('9999999', '99999999');
            $password = Hash::make($new_password);
            $usersave = User::findOrFail($id);
            $usersave->password = $password;
            $usersave->save();
            $mobile = array();
            array_push($mobile, $request->number);
            $message = 'اطلاعات کاربری شمابازیابی شد
نام کاربری:' . $email . '
رمز عبور:' . $new_password . '
';
//           $this->send_sms($mobile, $message);
            Mail::to($email)->send(new Forgot($email,$new_password));

            Session::flash('warning', 'اطلاعات کاربری به ایمیل شما ارسال شد' );
            return view('auth.login');
        } else {
            Session::flash('danger', 'ایمیل وارد شده یافت نشد');
            return back();
        }

    }

    public function register(FrontRegisterUserRequest $request)
    {


//        $client = new \GuzzleHttp\Client();
//        $shop = '2';
//        $response = $client->request('POST', 'https://www.ishopsaz.com/api/v1/register', [
//            'form_params' => [
//                'name' => $request->input('name'),
//                'last_name' => $request->input('last_name'),
//                'email' => $request->input('email'),
//                'password' => $request->input('password'),
//                'national_code' => $request->input('national_code'),
//                'phone' => $request->input('phone'),
//                'shop_id' => $shop,
//            ]
//        ]);
//        $json_user = json_decode($response->getBody(), true);
//        $users = $json_user['data'];
        $getHost = request()->getHost();
        if ($getHost == 'localhost') {
            $shop = '2';
        } else {
            $domain = Domain::where('domain', $getHost)->first();
            if (empty($domain->id)) {
                $getHost2 = request()->getSchemeAndHttpHost();
                $domain = Domain::where('domain', $getHost2)->first();
                if (empty($domain->id)) {
                    dd('دامنه به درستی تنظیم نشده است.بدون http و www هم وارد نمایید');
                }
            }
            $shop = $domain->shop_id;

        }
        $user = new User();
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->national_code = $request->input('national_code');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->status = 1;
        $user->shop_id = $shop;
        $user->password = Hash::make($request->input('password'));
        $user->api_token = Str::random(100);

        $user->save();
//        $user->roles()->sync($request->input('rols'));
        $user->roles()->sync(3);
//        $address = new Address();
//        $address->country = 'Iran';
//        $address->address = $request->input('address');
//        $address->company = $request->input('company');
//        $address->province_id = $request->input('province_id');
//        $address->city_id = $request->input('city_id');
//        $address->post_code = $request->input('post_code');
//        $address->user_id = $user->id;
//        $address->save();
        $mobile = array();
        array_push($mobile, $request->input('phone'));
        $message = 'ثبت نام شما با موفقیت انجام شد
نام کاربری:' . $request->input('email') . '
رمز عبور:' . $request->input('password') . '
چرلو
CHERLLO';
        $this->send_sms($mobile, $message);
        Session::flash('success', 'ثبت نام شما با موفقیت انجام شد.');
        if(!empty($request->demo)){
            return redirect($request->demo.'/login');
        }else{
            return redirect('/login');
        }
    }

    public function send_sms($mobile, $text)
    {

        // your sms.ir panel configuration
        $APIKey = "3af5d11e52492cff108bd11e";
        $SecretKey = "Salione842";
        $LineNumber = "30004523123456";
        $APIURL = "https://ws.sms.ir/";

        // your mobile numbers
        $MobileNumbers = $mobile;
//        $MobileNumbers = $mobile;

        // your text messages
        $Messages = array($text);

        // sending date
        @$SendDateTime = date("Y-m-d") . "T" . date("H:i:s");

        $SmsIR_SendMessage = new \App\SmsIR_SendMessage($APIKey, $SecretKey, $LineNumber, $APIURL);
        $SendMessage = $SmsIR_SendMessage->sendMessage($MobileNumbers, $Messages, $SendDateTime);

    }

    public function profile()
    {
        $check = '';
        $users = User::with('roles')->where('id', Auth::id())->first();

        foreach ($users->roles as $role) {
            if ($role->id != 4) {
                $check = 1;
            }
        }
        $user = Auth::user();
        $client = new \GuzzleHttp\Client();
        $getHost = request()->getHost();
        $getHost2 = request()->getSchemeAndHttpHost();
        if ($getHost == 'localhost:8000' or $getHost == 'localhost') {
            $shop = '2';
        } else {
            $domain = Domain::where('domain', $getHost)->first();
            if (empty($domain->id)) {
                $domain = Domain::where('domain', $getHost2)->first();
                if (empty($domain->id)) {
                    dd('دامنه به درستی تنظیم نشده است.بدون http و www هم وارد نمایید');
                }
            }
            $shop = $domain->shop_id;

        }
        $addresses = Address::with('user.addresses.province','user.addresses.city')
            ->where('user_id',Auth::id())
            ->get();
        $theme = Shop::where('id', $shop)->first();

        if ($theme->theme == 'theme1') {
            return view('frontend.profile.index', compact(['user', 'check']));
        } elseif ($theme->theme == 'theme2') {
            $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->paginate(10);
            $wishlists = Wishlists::with('product')->where('user_id',Auth::id())->paginate(10);
            return view('frontend.theme2.profile.index', compact(['user', 'check', 'orders', 'addresses', 'wishlists']));

        }
    }


    public function storeProfile()
    {

        $user = Auth::user();

        return view('frontend.profile.edit', compact(['user']));
    }

    public function editProfile(Request $request, $id)
    {
        $user = Auth::user();

        $user = User::findOrFail($id);

        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->phone = $request->input('phone');
        $user->save();
        Session::flash('success', 'پروفایل با موفقیت ویرایش شد');

        return back();
    }


    public function addressAdd()
    {

        return view('frontend.profile.addressadd');

    }

    public function getAllCities($provinceId)
    {
        $cities = City::where('province_id', $provinceId)->get();
        $response = [
            'cities' => $cities
        ];
        return response()->json($response, 200);
    }


    public function showPassword()
    {

        $user = Auth::user();
        return view('frontend.profile.password', compact(['user']));

    }

    public function editPassword(Request $request)
    {
        $user = Auth::user();

//        dd(Hash::make($request->get('old_password')));
        if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
            // The passwords not matches
            //return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
            Session::flash('danger', 'پسورد فعلی اشتباه است');
//            return view('frontend.profile.password', compact(['user']));
            return back();


//            return response()->json(['errors' => ['current'=> ['Current password does not match']]], 422);
        }

        //uncomment this if you need to validate that the new password is same as old one

        if (strcmp($request->get('old_password'), $request->get('new_password')) == 0) {
            //Current password and new password are same
            //return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
//            return response()->json(['errors' => ['current'=> ['New Password cannot be same as your current password']]], 422);
            Session::flash('danger', 'پسورد فعلی و جدید نمیتوانند مثل هم باشند');
//            return view('frontend.profile.password', compact(['user']));
            return back();

        }

        //        $validatedData = $request->validate([
        //            'old_password' => 'required',
        //            'new_password' => 'required|string|min:6|confirmed',
        //        ]);

        if ($request->get('re_new_password') != $request->get('new_password')) {
            // The passwords not matches
            //return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
//            return response()->json(['errors' => ['current'=> ['repeat password does not match']]], 422);
            Session::flash('danger', 'تکرار رمز عبور ها همخوانی ندارند');
//            return view('frontend.profile.password', compact(['user']));
            return back();

        }
        //Change Password

        $user->password = Hash::make($request->get('new_password'));
        $user->save();
        Session::flash('success', 'رمز با موفقیت ویرایش شد');

        return back();
    }

    public function destroy()
    {
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('/');
    }

}

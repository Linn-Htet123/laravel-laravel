<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            "name"=> "required|min:4|max:15",
            "email"=> "required|email|unique:students,email",
            "password"=> "required|min:8",
            "password_confirmation" =>"same:password"
        ]);
        $verify_code = rand(100000,999999);
        logger('Your verification code is: '.$verify_code);
        Student::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password" => Hash::make($request->password),
            "verify_code" => $verify_code,
            "user_token" => md5($verify_code)
        ]);
        return redirect()->route('auth.login')->with(['message'=>'Register created successfully'] );
    }

    public function login(){
        return view('auth.login');
    }

    public function check(Request $request)
    {
        $request->validate([
            "email"=> "required|email|exists:students,email",
            "password"=> "required|min:8",
        ],[
            "email.exists" => "Please enter the correct email or password"
        ]);


        $student = Student::where('email',$request->email)->first();
        if(!Hash::check($request->password,$student->password)){
            return redirect()->route('auth.login')->withErrors(['email' => 'Please enter the correct email or password']);
        }
        session(['auth'=>$student]);
        return redirect()->route('dashboard.home');


    }

    public function logout()
    {
        session()->forget('auth');
        return redirect()->route('auth.login');
    }

    public function passwordChange()
    {
        return view('auth.change-password');
    }

    public function passwordChanging(Request $request)
    {
        $request->validate([
            "current_password"=> "required|min:8",
            "password"=> "required|min:8|confirmed",
        ]);

        if (!Hash::check($request->current_password,session('auth')->password)){
            return redirect()->back()->withErrors(['current_password'=>'password does not match the old password']);
        }

        $student = Student::find(session('auth')['id']);
        $student->password = Hash::make($request->password);
        $student->update();

        session()->forget('auth');
        return redirect()->route('auth.login');
        return $request;
    }

    public function verify()
    {
        return view('auth.verify');
    }

    public function verifying(Request $request)
    {
        $request->validate([
            'verify_code' => 'required|numeric',
        ]);
        if ($request->verify_code != session('auth')->verify_code){
            return redirect()->back()->withErrors(['verify_code'=>'incorrect verify code']);
        }

        $student = Student::find(session('auth')['id']);
        $student->email_verified_at =now();
        $student->update();
        session(['auth'=>$student]);
        return redirect()->route('dashboard.home');
    }
    public function forgot(){
        return view('auth.forgot');
    }

    public function checkEmail(Request $request){
        $request->validate([
            "email" => "required|email|exists:students,email"
        ]);
        $student = Student::where('email',$request->email)->first();
        $link = route('auth.newPassword',['user_token'=>$student->user_token]);
        logger('Click here to reset your email:'.$link);
        return redirect()->route('auth.login')->with(['message'=>'Reset link has been sent']);
    }

    public function newPassword(Request $request){
        $user_token = $request->user_token;
        $student = Student::where("user_token",$user_token)->first();
        if (is_null($student)){
            return abort(403,'You are not allowed');
        }
        return view('auth.new-password',['user_token'=>$user_token]);
    }
    public function resetPassword(Request $request){
        $request->validate([
            "user_token"=>"required|exists:students,user_token",
            "password" => "required|min:8|confirmed",
            "password_confirmation" => "required|min:8"
        ],[
            "user_token.exists" => "something is wrong!!!!"
        ]);
        $student = Student::where('user_token',$request->user_token)->first();
        $student->password = Hash::make($request->password);
        $student->user_token = md5(rand(100000,999999));
        $student->update();

        return redirect()->route("auth.login")->with(['message'=>'please enter your new password to login']);
    }
}

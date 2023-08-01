<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Rules\CheckPassword;
use Illuminate\Container\RewindableGenerator;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            "name"=> "required|min:4|max:15",
            "email"=> "required|email|unique:students,email",
            "password"=> "required|min:8",
            "password_confirmation" =>"same:password"
        ]);
        $verify_code = rand(100000,999999);
        logger('Your verification code is: '.$verify_code);
        $student = new Student();
        $student->name=$request->name;
        $student->email=$request->email;
        $student->password = Hash::make($request->password);
        $student->verify_code = $verify_code;
        $student->user_token = md5($verify_code);
        $student->api_token = md5(rand(100000,999999));
        $student->save();
        return response()->json([
            "message" => "register successfully",
        ]);
    }
    public function login(Request $request){

        $request->validate([
            "email"=> "required|email|exists:students,email",
            "password"=> ['required','min:8', new CheckPassword()],
        ],[
            "email.exists" => "Please enter the correct email or password"
        ]);

        $student = Student::where('email',$request->email)->first();
        if(!Hash::check($request->password,$student->password)){
            return response()->json([
                "message" => "email or password is wrong",
            ]);
        }
        return response()->json([$student,"message"=>"login is success"]);
    }

    public function logout()
    {
        $student = Student::find(session('auth')['id']);
        $student->api_token = md5(rand(100000,999999));
        $student->update();
        session()->forget('auth');
        return response()->json([
            "message" =>'logout successfully'
        ]);

    }
}

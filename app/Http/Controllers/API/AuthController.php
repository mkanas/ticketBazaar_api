<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Validator;

class AuthController extends BaseController
{
    public function login(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $output['token']=$user->createToken('LaravelSanctumAuth')->plainTextToken;
            $output['name']=$user->name;
            return $this->handleResponse($output, 'user has login');
        }else{
            return $this->handleError('Unauthorized.');
        }
    }


    public function register(Request $request){
        $validator=Validator::make($request->all(),[
            'name' => 'required',
            'email'=> 'required|email',
            'password'=> 'required',
            'confirm_password'=> 'required|same:password',
        ]);
        if($validator->fails()) {
            return $this->handleError($validator->errors());
        }

        $user = User::where('email',$request->email)->first();

        if($user){
            return $this->handleError('Email is already registered');
        }

        $input =$request->all();
        $input ['password'] =bcrypt($input['password']);

        $user = User::create($input);
        $output['token']=$user->createToken('LaravelSanctumAuth')->plainTextToken;
        $output['name']=$user->name;
        return $this->handleResponse($output, 'user succesfully registered');
    }
}

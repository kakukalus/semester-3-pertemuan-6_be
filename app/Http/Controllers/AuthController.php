<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;
class AuthController extends Controller
{
    public function login(Request $request){
        $input = [
            'email'=> $request->email,
            'password' => Hash::make($request->password),
        ];

        $user = User::where('email' , $input['email'])->first();
        $email = $user->email;
        $password = $user->password;
        $isLoginSuccessFully = $input['email'] == $email && Hash::make($password == $password);
        if($isLoginSuccessFully === true){
            $token = $user->createToken('auth_token');
            $data = [
                'Message' => 'Login SuccesFully',
                'token'   => $token->plainTextToken
            ];
            return response()->json($data,200);
        }else{
            $data = [
                'Message' => 'Username or Password is wrong',
            ];
        }
    }

    public function register(Request $request){
        $input = [
            'name' => $request->name,
            'email'=> $request->email,
            'password' => $request->password,
        ];

        $user = User::create($input);
        return response()->json([
            'Message' => 'User is created Succesfully',
            'Data' => $user,
        ]);      
    }
}

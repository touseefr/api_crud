<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    // function index(Request $request)
    // {
    //     $user= User::where('email', $request->email)->first();
    //     // print_r($data);
    //         if (!$user || !Hash::check($request->password, $user->password)) {
    //             return response([
    //                 'message' => ['These credentials do not match our records.']
    //             ], 404);
    //         }

    //          $token = $user->createToken('my-app-token')->plainTextToken;

    //         $response = [
    //             'user' => $user,
    //             'token' => $token
    //         ];

    //          return response($response, 201);
    // }

    public function register(Request $req)
    {
        $validator = Validator::make($req->all(), [
            "name" => "required",
            "email" => "required",
            "password" => "required"
        ]);
        if ($validator->fails()) {
          //  return response()->json(['status_code' => 200, 'message' => 'bad request']);
          return response()->json($validator->errors(),401);
        }
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = bcrypt($req->password);
        $user->save();
        return $user;
      //  return response()->json(['status_code' => 200, 'message' => 'User added successfully']);
    }
    public function login(Request $req)
    {
        $validator = Validator::make($req->all(), [
            "email" => "required",
            "password" => "required"
        ]);
        if ($validator->fails()) {
           // return response()->json(['status_code' => 200, 'message' => 'bad request']);
           return response()->json($validator->errors(),401);
        }

        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials))
         {
            return response()->json([
                "status_code" => 500,
                "message" => "Unautharized"
            ]);
        }
        $user = User::where('email', $req->email)->first();
      //  $tokenResult = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'status_code'=> 200,
             'user'=> $user
         //   'token' => $tokenResult
         ] );
    }

    public function logout(Request $req)
    {
        $req->user()->currentAccessToken()->delete();
        return response()->json([
            'status_code' => 200,
            'message' => 'token deleted'
        ]);
    }
}

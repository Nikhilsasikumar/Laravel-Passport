<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name'       => 'required',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required',
            'c_password' => 'required|same:password'
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 202);
        }
        $data              = $request->all();
        $data['password']  = bcrypt($data['password']);
        $user              = User::create($data);
        $resArray          = [];
        $resArray['token'] = $user->createToken('api-appilication')->accessToken;
        $resArray['name']  = $user->name;
        return response()->json($resArray, 200);
    }
    public function login(Request $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $user = Auth::user();
            $resArray          = [];
            $resArray['token'] = $user->createToken('api-appilication')->accessToken;
            $resArray['name']  = $user->name;
            return response()->json($resArray, 200);
        } else {
            return response()->json(['error' => 'Unauthorized Access'], 203);
        }
    }

    public function logout(Request $request)
    {
        $user = Auth::user()->token();
        $user->revoke();
        // return $user;
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
    public function logoutAll()
    {
        DB::table('oauth_access_tokens')
            ->where('user_id', Auth::user()->id)
            ->update([
                'revoked' => true
            ]);
    }
}

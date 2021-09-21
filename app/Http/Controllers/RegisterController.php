<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function post(Request $request)
    {
        $validate_rule = [
            'name' => 'required',
            'email' => 'requiredlemail',
            'password' => 'required|current_password'
        ];
        $this->validate($request, $validate_rule);
        $now = Carbon::now();
        $hashed_password = Hash::make($request->password);
        $param = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => $hashed_password,
            "created_at" => $now,
            "updated_at" => $now,
        ];
        DB::table('users')->insert($param);
        return response()->json([
            'message' => 'User created successfully',
            'data' => $param
        ], 200);
    }

    public function delete(Request $request)
    {
        $item = DB::table('users')->where('id', $request->id)->delete();
        if ($item) {
            return response()->json(
                ['message' => 'User deleted successfully'],
                200
            );
        } else {
            return response()->json(
                ['message' => 'User not found'],
                404
            );
        }
    }
}

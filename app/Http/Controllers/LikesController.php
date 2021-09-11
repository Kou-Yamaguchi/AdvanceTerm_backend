<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Like;

class LikesController extends Controller
{
    public function post(Request $request)
    {
        $now = Carbon::now();
        $param = [
            "shop_id" => $request->shop_id,
            "user_id" => $request->user_id,
            "created_at" => $now,
            "updated_at" => $now
        ];
        DB::table('likes')->insert($param);
        return response()->json([
            'message' => 'Like created successfully',
            'data' => $param
        ], 200);
    }
    public function delete(Request $request)
    {
        DB::table('likes')->where('shop_id', $request->shop_id)->where('user_id', $request->user_id)->delete();
        return response()->json([
            'message' => 'Like deleted successfully',
        ], 200);
    }
    //テスト
    public function get()
    {
        $item = Like::with(['shop' => function($query){
            $query->with('genre','location');
        }])->get();
        return response()->json([
            'message' => 'Like got successfully',
            'data' => $item
        ], 200);
    }
}

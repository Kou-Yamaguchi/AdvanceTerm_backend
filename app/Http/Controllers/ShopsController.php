<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopsController extends Controller
{
    public function get(Request $request)
    {
        $items = DB::table('shops')->get();
        return response()->json([
            'message' => 'Shops got successfully',
            'data' => $items
        ], 200);
    }
}

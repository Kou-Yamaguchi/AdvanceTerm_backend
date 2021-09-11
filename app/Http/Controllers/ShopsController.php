<?php

namespace App\Http\Controllers;

use App\Models\Shop;
//追記
// use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Shop::with('genre')->with('location')->with('like')->get();
        return response()->json([
            'message' => 'OK',
            'data' => $items,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $item = new Shop;
        // $item->location_id = $request->location_id;
        // $item->genre_id = $request->genre_id;
        // $item->shopName = $request->shopName;
        // $item->comment = $request->comment;
        // $item->img_url = $request->img_url;
        // $item->save();
        // return response()->json([
        //     'message' => 'Shop created successfully',
        //     'data' => $item
        // ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        $item = Shop::where('id', $shop->id)->first();
        if ($item) {
            return response()->json([
                'message' => 'OK',
                'data' => $item,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        //
    }

    // public function reservation(Request $request)
    // {
    //     $now = Carbon::now();
    //     $param = [
    //         "user_id" => $request->user_id,
    //         "shop_id" => $request->shop_id,
    //         "date" => $request->date,
    //         "time" => $request->time,
    //         "number" => $request->number,
    //         "created_at" => $now,
    //         "updated_at" => $now
    //     ];
    //     DB::table('reservations')->insert($param);
    //     return response()->json([
    //         'message' => 'Reservation created successfully',
    //         'data' => $param
    //     ], 200);
    // }
}

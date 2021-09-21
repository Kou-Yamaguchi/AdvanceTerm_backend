<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Reservation::with('shop')->get();
        return response()->json([
            'message' => 'OK',
            'data' => $items
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
        $validate_rule = [
            'user_id' => 'required',
            'shop_id' => 'required',
            'date' => 'required|after:today',
            'time' => 'required',
            'number' => 'required'
        ];
        $this->validate($request, $validate_rule);
        $now = Carbon::now();
        $param = [
            "user_id" => $request->user_id,
            "shop_id" => $request->shop_id,
            "date" => $request->date,
            "time" => $request->time,
            "PersonNumber" => $request->number,
            "created_at" => $now,
            "updated_at" => $now
        ];
        DB::table('reservations')->insert($param);
        return response()->json([
            'message' => 'Reservation created successfully',
            'data' => $param
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        $item = Reservation::where('id', $reservation->id)->with('shop')->first();
        $reservation_data = array();
        if(empty($item->toArray())) {
            $items = [
                "comment" => '予約している店舗はありません'
            ];
            return response()->json($items, 200);
        }
        foreach ($reservation as $value) {
            $reservation_user = DB::table('users')->where('id', $value->user_id)->first();
            $reservation_shop = DB::table('shops')->where('id', $value->shop_id)->first();
            $reservations = [
                "reservation_user" => $reservation_user,
                "reservation_shop" => $reservation_shop
            ];
            array_push($reservation_data, $reservations);
        }
        $items = [
            "item" => $item,
            "reservation_data" => $reservation_data
        ];
        return response()->json($items, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $item = Reservation::where('id', $reservation->id)->delete();
        if($item) {
            return response()->json(
                ['message' => 'Reservation deleted successfully'],
                200
            );
        } else {
            return response()->json(
                ['message' => 'Reservation not found'],
                404
            );
        }
    }
}

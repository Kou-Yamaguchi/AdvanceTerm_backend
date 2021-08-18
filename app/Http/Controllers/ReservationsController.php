<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Reservation::all();
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
        $item = new Reservation;
        $item->user_id = $request->user_id;
        $item->shop_id = $request->shop_id;
        $item->reservation = $request->reservation;
        $item->save();
        return response()->json([
            'message' => 'Reservation created successfully',
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
        $item = Reservation::where('id', $reservation->id)->first();
        $date = DB::table('date')->where('reservation_id', $reservation->id)->get();
        $time = DB::table('time')->where('reservation_id', $reservation->id)->get();
        $personNumber = DB::table('personNumber')->where('reservation_id', $reservation->id)->get();
        $user_id = $item->user_id;
        $shop_id = $item->shop_id;
        $shop = DB::table('shops')->where('id', (int)$shop_id)->first();
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
            "date" => $date,
            "time" => $time,
            "number" => $personNumber,
            "shopName" => $shop->name,
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
        $item = Reservation::where('id', $reservation->id)->first();
        $item->date = $request->date;
        $item->time = $request->time;
        $item->number = $request->number;
        $item->shop_id = $request->shop_id;
        $item->user_id = $request->user_id;
        $item->save();
        if ($item) {
            return response()->json([
                'message' => 'Updated successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
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

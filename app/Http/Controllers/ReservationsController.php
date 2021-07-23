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
        if(empty($item->toArray())) {
            $items = [
                'comment' => '予約している店舗はありません'
            ];
        }
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

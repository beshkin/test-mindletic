<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Professional;
use App\Models\User;
use App\Services\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    private BookingService $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function create(Request $request)
    {
        $userId = $request->get('user_id');
        $professionalId = $request->get('professional_id');
        $timeStart = $request->get('time_start');
        $timeEnd = $request->get('time_end');
        $date = $request->get('date');

        $user = User::find($userId);
        $professional = Professional::find($professionalId);
        if (!$user || !$professional){
            return response([
                'status'=>'error',
                'message'=>'some data is incorrect'
            ], 404);
        }

        try {
            $booking = $this->bookingService->create(user: $user, professional: $professional, timeStart: $timeStart, timeEnd: $timeEnd, date:$date);

            if ($booking) {
                return response([
                    'status' => 'success',
                    'message' => 'appointment is booked',
                    'booking_id'=>$booking->id
                ]);
            }
        } catch (\Exception $e) {
            return response(['decline'=>$e->getMessage()]);
        }

        return response([
            'status'=>'error',
            'message'=>'Oops, something went wrong!'
        ]);
    }
}

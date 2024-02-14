<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Professional;
use App\Models\User;

class BookingService
{
    public function create(User $user, Professional $professional, string $timeStart, string $timeEnd, string $date)
    {
        $client = $user->client;

        if (!$professional->isAvailable( $timeStart, $timeEnd, $date)){
            throw new \Exception('professional is busy');
        }

        $booking = Booking::create(
            [
                'client_id'=>$client->id,
                'company_id'=>$client->company->id,
                'professional_id'=>$professional->id,
                'start'=>$timeStart,
                'end'=>$timeEnd,
                'date'=>$date
            ]
        );

        return $booking;
    }
}

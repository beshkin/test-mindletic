<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Client;
use App\Models\ClientCompany;
use App\Models\Company;
use App\Models\Professional;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class BookingControllerTest extends TestCase
{
    use WithFaker;

    public function testSuccessfulBooking()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();
        $client = Client::factory([
            'user_id' => $user->id,
        ])->create();
        DB::table('client_companies')->insert([
            'client_id'=>$client->id,
            'company_id'=>$company->id
        ]);
        $professional = Professional::factory()->create();

        $date = $this->faker->date;
        $response = $this->put(route('booking.create'), [
            'user_id' => $user->id,
            'professional_id' => $professional->id,
            'time_start'=>'09:00',
            'time_end'=>'10:00',
            'date'=>$date,
        ]);
        $response->assertOk();

        $data = json_decode($response->getContent(), true);

        $this->assertEquals($data['status'],'success');

        $this->assertDatabaseHas('bookings', [
            'client_id'=>$client->id,
            'professional_id'=>$professional->id,
            'start'=>'09:00',
            'end'=>'10:00',
            'date'=>$date
        ]);
    }

}

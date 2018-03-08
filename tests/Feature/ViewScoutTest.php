<?php

namespace Tests\Feature;

use App\Scout;
use Carbon\Carbon;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewScoutTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function AUserCanViewAScout()
    {
        $this->withoutExceptionHandling();

        $scout = factory(Scout::class)->create([
            "first_name" => "John",
            "last_name" => "Scout",
            "birth_date" => Carbon::parse("-8 years"),
            "address" => "123 Main St.",
            "city" => "Scoutsville",
            "state" => "UT",
            "postal_code" => "84062",
            "phone_number" => "(801)555-1212",
            'email'=>'scout@scouts.test'
        ]);

        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get("/scouts/$scout->id");

        $response->assertStatus(200);

        $response->assertSee('John Scout');
        $response->assertSee(Carbon::parse("-8 years")->format('M d,Y'));
        $response->assertSee('123 Main St.');
        $response->assertSee('Scoutsville, UT 84062');
        $response->assertSee('(801)555-1212');
        $response->assertSee('scout@scouts.test');
    }

    /**
     * @test
     */
    public function AGuestCannotViewAScout()
    {
        $response = $this->get('/scouts/1');

        $response->assertStatus(302);

        $response->assertRedirect('/login');
    }
}

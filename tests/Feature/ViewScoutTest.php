<?php

namespace Tests\Feature;

use App\Scout;
use Carbon\Carbon;
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

        $response = $this->get("/scouts/$scout->id");

        $response->assertStatus(200);
        $response->assertViewIs('scouts.view');

        $response->assertSee('John Scout');
        $response->assertSee(Carbon::parse("-8 years")->format('M d,Y'));
        $response->assertSee('123 Main St.');
        $response->assertSee('Scoutsville, UT 84062');
        $response->assertSee('(801)555-1212');
        $response->assertSee('scout@scouts.test');
    }
}

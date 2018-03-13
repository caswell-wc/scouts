<?php

namespace Tests\Feature;

use App\Rank;
use App\Requirement;
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

        factory(Rank::class)->create(['name'=>'Bobcat']);

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

    /**
     * @test
     */
    public function TheScoutViewShowsTheRankBeingWorkedOn()
    {
        $user = factory(User::class)->create();
        $scout = factory(Scout::class)->create();
        factory(Rank::class)->create(['name'=>'Bobcat']);

        $response = $this->actingAs($user)->get("/scouts/$scout->id");

        $response->assertStatus(200);
        $response->assertSee('Working On: Bobcat');
    }

    /**
     * @test
     */
    public function TheScoutViewShowsTheCurrentRankForTheScout()
    {
        $user = factory(User::class)->create();
        $wolfRank = factory(Rank::class)->create([
        'name'=>'Wolf'
        ]);
        $bobcatRank = factory(Rank::class)->create([
            'name'=>'Bobcat',
            'next_rank_id'=> $wolfRank->id
        ]);
        $scout = factory(Scout::class)->create([
            'rank_id'=>$bobcatRank->id
        ]);

        $response = $this->actingAs($user)->get("/scouts/$scout->id");

        $response->assertStatus(200);
        $response->assertSee('Current Rank: Bobcat');
        $response->assertSee('Working On: Wolf');
    }

    /**
     * @test
     */
    public function ItShowsTheRequirementsForTheRankBeingWorkedOn()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $bobcatRank = factory(Rank::class)->create([
            'name'=>'Bobcat',
            'next_rank_id'=>factory(Rank::class)->create([
                'name'=>'Wolf'
            ])->id
        ]);
        $scout = factory(Scout::class)->create();

        factory(Requirement::class)->create([
            'rank_id' => $bobcatRank->id,
            'number' => '1',
            'description' => 'Learn and say the Scout Oath, with help if needed.'
        ]);
        factory(Requirement::class)->create([
            'rank_id' => $bobcatRank->id,
            'number' => '2',
            'description' => 'Learn and say the Scout Law, with help if needed.'
        ]);

        $response = $this->actingAs($user)->get("/scouts/$scout->id");

        $response->assertStatus(200);
        $response->assertSee('Learn and say the Scout Oath, with help if needed.');
        $response->assertSee('Learn and say the Scout Law, with help if needed.');
    }
}

<?php

namespace Tests\Unit;

use App\Rank;
use App\Requirement;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RankTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function itHasANextRank()
    {
        $secondRank = factory(Rank::class)->create();
        $rank = factory(Rank::class)->create(['next_rank_id'=>$secondRank->id]);

        $this->assertEquals($secondRank->id, $rank->nextRank->id);
        $this->assertEquals($secondRank->name, $rank->nextRank->name);
    }

    /**
     * @test
     */
    public function itHasRequirements()
    {
        $rank = factory(Rank::class)->create(['name'=>'Bobcat']);

        $req1 = factory(Requirement::class)->create([
            'rank_id' => $rank->id,
            'number' => '1',
            'description' => 'Learn and say the Scout Oath, with help if needed.'
        ]);
        $req2 = factory(Requirement::class)->create([
            'rank_id' => $rank->id,
            'number' => '2',
            'description' => 'Learn and say the Scout Law, with help if needed.'
        ]);

        $this->assertCount(2, $rank->requirements);
        $requirementIds = $rank->requirements->pluck('id')->toArray();
        $this->assertTrue(in_array($req1->id, $requirementIds));
        $this->assertTrue(in_array($req2->id, $requirementIds));
    }
}

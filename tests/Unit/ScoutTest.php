<?php

namespace Tests\Unit;

use App\Rank;
use App\Scout;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScoutTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function scoutHasARank()
    {
        $scout = factory(Scout::class)->create();

        $rank = factory(Rank::class)->create();

        $scout->rank()->associate($rank);

        $this->assertEquals($rank->name, $scout->rank->name);
    }

    /**
     * @test
     */
    public function scoutHasANextRank()
    {
        $nextRank = factory(Rank::class)->create();
        $rank = factory(Rank::class)->create(['next_rank_id'=>$nextRank->id]);
        $scout = factory(Scout::class)->create(['rank_id'=>$rank->id]);


        $this->assertEquals($nextRank->name, $scout->nextRank->name);
    }
}

<?php

namespace Tests\Unit;

use App\Rank;
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
}

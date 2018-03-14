<?php

namespace Tests\Unit;

use App\Adventure;
use App\CompleteRequirement;
use App\Rank;
use App\Requirement;
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


        $this->assertEquals($nextRank->name, $scout->nextRank()->name);
    }

    /**
     * @test
     */
    public function aNewScoutHasANextRank()
    {
        $bobcatRank = factory(Rank::class)->create(['name'=>'Bobcat']);

        $scout = factory(Scout::class)->create(['rank_id'=>null]);

        $this->assertEquals($bobcatRank->id, $scout->nextRank()->id);
    }

    /**
     * @test
     */
    public function determineIfAScoutHasCompletedARequirement()
    {
        $scout = factory(Scout::class)->create();

        $requirement = factory(Requirement::class)->create();

        $completedRequirement = factory(CompleteRequirement::class)->create([
            'scout_id'=>$scout->id,
            'requirement_id'=>$requirement->id
        ]);

        $this->assertTrue($scout->hasCompletedRequirement($requirement->id));
    }

    /**
     * @test
     */
    public function determineThatAScoutHasNotCompletedARequirement()
    {
        $scout = factory(Scout::class)->create();

        $requirement = factory(Requirement::class)->create();

        $completedRequirement = factory(CompleteRequirement::class)->create([
            'scout_id' => $scout->id,
            'requirement_id' => $requirement->id
        ]);

        $secondRequirement = factory(Requirement::class)->create();

        $this->assertFalse($scout->hasCompletedRequirement($secondRequirement->id));

    }
}

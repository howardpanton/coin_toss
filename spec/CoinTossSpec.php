<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CoinTossSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('CoinToss');
    }

    function it_gets_teams()
    {
        $this->getTeams()->shouldBeArray();
    }

    function it_gets_players()
    {
        $this->getPlayers()->shouldBeArray();
    }

    function it_has_players_that_have__a_name_and_team()
    {
        $this->getPlayers()->shouldContain('Red');
    }

    function it_has_matches()
    {
        $this->playCompetition();
    }
}

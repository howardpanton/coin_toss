<?php
class CoinToss

{

    /**
     * @var array
     * returns array
     */
    protected $teams;
    /**
     * @var array
     * returns array
     */
    protected $players = array();

    Protected $rounds = 6;

    protected $score = array("heads", "tails");

    function __construct() {

        // Create 8 teams
        $this->createTeams();
        // Create 51 players
        $this->createPlayers();

    }

    public function playCompetition()
    {

    }

    public function match()
    {
        // max 6 rounds
        // two players contest each match
        // outcome its either head or tails
        // maybe reurn result in JSON

    }


    public function createTeams()
    {
        $this->teams = array('Red', 'yellow','Green','Blue','Orange','Pink','Black','White');
    }

    public function createPlayers()
    {
        // This should create a multi-dimensional array [ name => "player1", team => "orange"]
        $max_players = 51;
        $x = 0;

        // Loop though and creat players
        for ($i = 0; $i < $max_players; $i++)
        {
            $this->players[] = array("name" => "player{$i}", "teams" => $this->teams[$x]);
            $x ++;
            // Using $x for looping through team array, this needs to be reset once it reaches 8
            if ($x == 8)
            {
                $x = 0;
            }
        }

    }

    public function getPlayers()
    {
        // TODO: write logic here
        return $this->players;
    }

    public function getTeams()
    {
        // TODO: write logic here
        return $this->teams;
    }
}

$coin = new CoinToss;
var_dump($coin->getPlayers());

?>
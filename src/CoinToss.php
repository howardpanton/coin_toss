<?php
class CoinToss
{

    /**
     * @var array
     * returns array
     */
    protected $teams = array();


    protected $results = array();

    /**
     * @var array
     *will use this to store the players array
     * returns array
     */
    protected $players = array();

    const MAX_PLAYERS = 51;

    const ROUNDS = 6;

    function __construct() {

        // Create 8 teams
        $this->createTeams();
        // Create 51 players
        $this->createPlayers();
        $this->playRound();
        //$test2 = new Match($this->players);
        //var_dump($this->results);
        $this->outputResults();

    }


    public function createTeams()
    {
        $this->teams = array('Red', 'Yellow','Green','Blue','Orange','Pink','Black','White');
    }

    public function createPlayers()
    {
        // This should create a multi-dimensional array [ name => "player1", team => "orange"]

        $x = 0;

        // Loop though and create players
        for ($i = 1; $i < self::MAX_PLAYERS + 1; $i++)
        {
            $this->players[] = array("name" => "player{$i}", "teams" => $this->teams[$x]);
            $x ++;
            // Using $x for looping through team array, this needs to be reset once it reaches 8
            if ($x == count($this->teams))
            {
                $x = 0;
            }
        }

    }

    public function playRound()
    {
        for ($i = 0; $i < self::ROUNDS; $i++)
        {
            $round = ($i + 1);
            $test_{$round} = new Match($this->players);
            $this->results[] = array(
                "Round {$round}" => $test_{$round}->competition
            );
        }
    }

    public function outputResults()
    {
        foreach($this->results[0] as $key => $value) { ?>
            <h2><?php echo $key; ?></h2>
            <table>
                <thead>
                <tr>
                    <th>Player 1</th>
                    <th>Team</th>
                    <th>Coin Toss</th>
                    <th>Player 2</th>
                    <th>Team</th>
                    <th>Coin Toss</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        <?php }
        var_dump($this->results[0]);
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

class Match extends CoinToss
{
    protected $players;
    protected $competition = array();

    protected $played_games = array();

    protected $array = array();

    protected $score = array("heads", "tails");


    const MATCH_PLAYERS = 2;

    function __construct($players) {
        $this->players = $players;
        //var_dump($this->players);
        $this->new_match();
    }
    public function playMatch($match_1, $match_2)
    {

        return $this->players[$match_1]["name"]. " (Team " . $this->players[$match_1]["teams"]. ") Vs " . $this->players[$match_2]["name"]. " (Team " . $this->players[$match_2]["teams"]. ")" ;
    }

    private function new_match()
    {


        // max 6 rounds
        // two players contest each match
        // outcome its either head or tails
        // maybe return result in JSON
        // Should use recursive functions
        $total_matches = (int) floor(self::MAX_PLAYERS / self::MATCH_PLAYERS);


        for ($i = 0; $i < $total_matches; $i++) {
            $this->setGames();

        }


        //var_dump($this->played_games);
    }


    private function setGames()
    {
        $match_1 = rand(0, 50);
        $match_2 = rand(0, 50);
        $team_1 = (string) $this->players[$match_1]["teams"];
        $team_2 = (string) $this->players[$match_2]["teams"];
        $pattern = "/" . $this->players[$match_1]["name"] . "/i";

        // The same team cant play itself
        if ( (strcmp($team_1 , $team_2) !== 0) && (!in_array($this->players[$match_1]["name"], $this->played_games))  ) {
            // Needed to add this to store the values of the players who have laready played a game
            $this->played_games[] = $this->players[$match_1]["name"];
            $this->played_games[] = $this->players[$match_2]["name"];
            $this->competition[] = $this->playMatch($match_1, $match_2);
            //$this->rounds()
            //var_dump($team_1);
        } else {
            $this->setgames();
        }

    }

}

?>
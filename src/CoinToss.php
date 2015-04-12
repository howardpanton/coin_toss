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


    /**
     *
     */
    public function createTeams()
    {
        $this->teams = array('Red', 'Yellow','Green','Blue','Orange','Pink','Black','White');
    }

    /**
     *
     */
    public function createPlayers()
    {
        // This should create a multi-dimensional array [ name => "player1", team => "orange"]

        $x = 0;

        // Loop though and create players
        for ($i = 1; $i < self::MAX_PLAYERS + 1; $i++)
        {
            $this->players[] = array("name" => "Player_{$i}", "teams" => $this->teams[$x]);
            $x ++;
            // Using $x for looping through team array, this needs to be reset once it reaches 8
            if ($x == count($this->teams))
            {
                $x = 0;
            }
        }

    }

    /**
     *
     */
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

    /**
     *
     */
    public function outputResults()
    {

        for ($i = 0; $i < count($this->results); $i++)
        {
        foreach($this->results[$i] as $key => $value) { ?>
            <h2><?php echo $key; ?></h2>
            <table class="table">
                <thead>
                <tr>
                    <th>Game No.</th>
                    <th>Player 1</th>
                    <th>Team</th>
                    <th>Coin Toss</th>
                    <th>Player 2</th>
                    <th>Team</th>
                    <th>Coin Toss</th>
                </tr>
                </thead>
                <tbody>
                <?php //var_dump($value[0]); ?>
                <?php $x = 1; foreach ($value as $game)
            {
                //var_dump($game);
                echo "<tr>
                    <td>{$x}</td>
                    <td>{$game['player1']}</td>
                    <td style=\"background-color:{$game['player1_team']};\">{$game['player1_team']}</td>
                    <td>{$game['player_1_toss']}</td>
                    <td>{$game['player2']}</td>
                    <td style=\"background-color:{$game['player2_team']};\">{$game['player2_team']}</td>
                    <td>{$game['player_2_toss']}</td>
                </tr>";

                $x++; } ?>

                </tbody>
            </table>
        <?php } }
//        var_dump($this->results[0]);
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

    /**
     * @var
     */
    protected $players;

    /**
     * @var array
     */
    protected $competition = array();

    /**
     * @var array
     */
    protected $played_games = array();

    /**
     * @var array
     */
    protected $previous_round = array();

    /**
     * @var array
     */
    protected $array = array();

    /**
     * @var
     */
    public $match_array;

    /**
     * @var array
     */
    protected $score = array("0" => "heads", "1" => "tails");

    /**
     *
     */
    const MATCH_PLAYERS = 2;

    /**
     * @param $players
     *
     */
    function __construct($players) {
        $this->players = $players;
        foreach (range(0, 50) as $number) {
            $this->match_array[] = $number;
        }


        $this->new_match();
        //var_dump($this->previous_round);
    }


    /**
     *
     */
    function __destruct() {
        unset($this->previous_round);
    }

    /**
     * @param $match_1
     * @param $match_2
     * @return array
     */
    public function playMatch($match_1, $match_2)
    {
        $array = array("player1" => $this->players[$match_1]["name"], "player1_team" => $this->players[$match_1]["teams"], "player_1_toss" => $this->tossCoin(rand(0,1)),"player2" => $this->players[$match_2]["name"], "player2_team" => $this->players[$match_2]["teams"], "player_2_toss" => $this->tossCoin(rand(0,1)) );
        $this->previous_round[] = $this->players[$match_1]["name"]. "Vs" .$this->players[$match_2]["name"];
        return $array;
        //return $this->players[$match_1]["name"]. " (Team " . $this->players[$match_1]["teams"]. ") Vs " . $this->players[$match_2]["name"]. " (Team " . $this->players[$match_2]["teams"]. ")" ;
    }

    /**
     * @param $coin
     * Lets each player flip coin
     * @return string
     */
    public function tossCoin($coin)
    {
        switch($coin) {
            case 0:
                $coin = "Heads";
                break;
            case 1:
                $coin = "Tails";
                break;

        }
        return $coin;
    }

    /**
     * @return array
     */
    public function previous_round()
    {
        $round = $this->previous_round;
        return $round;
    }

    /**
     *
     */
    private function new_match()
    {


        // max 6 rounds
        // two players contest each match
        // outcome its either head or tails
        // maybe return result in JSON
        // Should use recursive functions
        $total_matches = (int) floor(self::MAX_PLAYERS / self::MATCH_PLAYERS);

        // Loop through total matches and play games
        for ($i = 0; $i < $total_matches; $i++) {
            $this->playGames();

        }


        //var_dump($this->played_games);
    }


    /**
     *
     */
    private function playGames()
    {
        // Set a random number for each team using array rand, tried rand() but that failed!

        $match_1 = array_rand($this->match_array,1);
        $match_2 = array_rand($this->match_array,1);
        $team_1 = (string) $this->players[$match_1]["teams"];
        $team_2 = (string) $this->players[$match_2]["teams"];

        // The same team cant play itself!
        if ((strcmp($team_1 , $team_2) !== 0)) {
            // Need to check whether these teams have previously played in the last round
        if ( (!in_array($this->players[$match_1]["name"]. "Vs" .$this->players[$match_2]["name"], $this->previous_round)) )
        {

            // Needed to add this to store the values of the players who have laready played a game
            $this->played_games[] = $this->players[$match_1]["name"];
            $this->played_games[] = $this->players[$match_2]["name"];
            // Create an array of previous round matches
            $this->previous_round[] = $this->players[$match_1]["name"] . "Vs" . $this->players[$match_2]["name"];
            // e can now play the match and add to the competition array
            $this->competition[] = $this->playMatch($match_1, $match_2);
            // We need to remove the players from available array so that they cant compete again in this round
            // As we are using array_rand instead of rand() we can now unset the players
            unset($this->match_array[$match_1]);
            unset($this->match_array[$match_2]);
            //var_dump($this->previous_round);
        }
        } else {
            $this->playGames();
        }

    }

}

?>
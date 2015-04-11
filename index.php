<?php
	class CoinToss


	{
	    protected $teams;
	    protected $players = array();

	    function __construct() {

	        $this->createTeams();
				$this->createPlayers();

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
	
			for ($i = 0; $i < $max_players; $i++) {
				$this->players[] = array("name" => "player{$i}", "teams" => $this->teams[$x] );
				$x++;
				if ($x == 8) {
					$x = 0;
				}
			}
			$this->assignTeams();
			
		}

		    public function getPlayers()
		    {
		        // TODO: write logic here
		        return $this->players;
		    }
		
		public function assignTeams()
		{

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
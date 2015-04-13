# coin_toss

#ToDo

Add project to Github - done
Install Composer - done
Install PHPSpec - done

# Set up Coin Toss program

- Coin Toss is a Competion
    - Competition has 6 rounds of matches, each round needs to have as many matches scheduled as possible
    - Each Match is contested by two players
    - Each player is assigned heads or tails

    Restrictions

    - Each player can  only play one match per round done
    - No matched pair can be from the same team done
    - No matched pair can be a repeat of the previous round's fixture
    - The process for creating matches should be random done
    - It should be possible for any two player in different teams to have the possibility of being paired


- Coin Toss has 51 players [player1, player2, player3...] done

- Each player belongs to a team done
    - There are 8 teams done
    - Each team has a color [Red, yellow, Green, Blue, Orange, Pink, Black and White] done

-

Have to use a recursuve function to check whether matches can be player

- Maybe Factory model will be better, we can create Competition and play matches using a new object

- Main issue was the check to see if two player have already played, this wast causing error with the function recursion

I ran into problems trying to make sure that each match was contested by different teams who havent previously played.
I had to create two arrays one to hold the previously played games from the last round and another to hold each player who has played already.
This caused some more issues and I refactored the way in whcih each game was generated.

I changed from using rand() to array_rand(), this allowed me to create an array of 51 players. When a game was being set the methid would take a random plater number from the draw.
After they have been drawn the player numbers would be unset to stop them being drawn again in the round.

To fix the error with multiple nesting of functions I moved some of the methods into a match Class, the CoinToss Class is then used to create new matches.

Still to do

- Allow for more that 51 players without getting nesting errors.
- Allow for matches with more that 2 players to be displayed
- Refactor code to remove duplication
- Add more tests, this is still incomplete

The play_match method needs re-writing, it needs to allow for more than one competitor. This could be done by create an Array of
competitors using the array_rand()
The passing the array into play_match()

- Was also looking at outputting the results and previous round as a JSON file, this would allow for the file to be checked
before a next round is played. We could also use the PHP standard libray and write a query.




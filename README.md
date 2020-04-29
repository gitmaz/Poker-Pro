## About Poker-Pro

Poker-Pro is a demo application that demonstrates basic oop concepts (SOLID principals) and how to use Strategy Design Pattern.

   - Functionality:  It picks a random set of playing cards hand and checks whether they are "Straight" or "Straight Flush" according to Poker's
   high low standard rules.
   
   Reference:
   Straight : http://en.wikipedia.org/wiki/List_of_poker_hands#Straight
   
   Straight Flush : http://en.wikipedia.org/wiki/List_of_poker_hands#Straight_flush
 
#### How to install

After cloning this code repository to your local computer and changing directory to the created folder, run fallowing commands on the console:
(first make sure php, composer are installed on your computer).

1. composer install
2. composer dump-autoload


#### How to run
 
Note: to run, type: 

php Play.php 

on the console and then press enter.

  To test with arbitrary set of hands, just write a new strategy similar to StraightHandSelection.php to see if
  the application really works (you need to then add this at the end of $strategies array defined at the beginning Play.php in root folder).
 
  Alternatively, pay attention to the random selection of cards appearing on the first line of output when running this
  app and check the results logically.
  
  To see how the app deals with the wrong input, simply uncomment /*"WrongRank", "MisspelledSuit",*/ in Play.php individually and rerun 
  the program.
  
#### Unit tests

Test cases for final functionality of project is put in test directory for each of the main classes

to run test cases individually use this syntax:
vendor/bin/phpunit --filter testExampleCase ExampleTests ./tests/ExampleTests.php 
 

## License

This source code is based on vendor libraries, therefore fallows all included open source vendor copyrights. Users are granted 
the right to copy/modify and distribute Poker-Pro by keeping all main code and included library's copyright details including  @author tags. 

- Author:
Maziar Navabi  mn.usyd@gmail.com
23/04/2020



tic_tac_toe
===========

One of the issues that was solved in this implementation of tic-tac-toe was 
that indexation was incorrect for cells, so it was outputting errors while trying to 
click on last row or column of the bord. 

Second issue that I spotted and fixed was that the system was not correctly counting 
if the second diagonal was won or not. That issue was also solved

Feature I added was 9X9 board implementation and this can be changed to any square 
dimension, constant for controlling the board dimensions is saved in Tic/Game.php (DIMENSION = 9;)

Unittests were not running, so I extended it from \PHPUnit\Framework\TestCase; so I
could test that everything was correct.

Also, if the winning person's icon is X the winning cells will change it's color to 
red and if O won than the cells' background will be blue.

Sincerely,
Lika

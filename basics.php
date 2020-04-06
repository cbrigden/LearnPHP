<?php
/*
 * following tutorial on youtube https://www.youtube.com/watch?v=95RU58kZlbc&list=PLZKmsnEW-vU5j01-jJ4Adhkt8jN4iJsuP&index=4&t=8s
 */

// single line comment
// alternate single line comment
/*
 * multiline comment
 */
$game_name = 'Mass Effect 3'; // string
                              // $release_year = 2012; //int
$cost_now = 10.99; // float
$awesome = true;

// boolean

// constants have naming convention of all caps
// define('NAME', value);
const BR = '<br />';
define('RELEASE_YEAR', 2012);

// echo outputs text to screen
// echo "The game $game_name was released in $release_year and it now costs $$cost_now at amazon.com<br />";

// . is concatonate
echo "The game $game_name was released in " . RELEASE_YEAR . " and it now costs $$cost_now at amazon.com" . BR;
// ' are literal quotes, so they will print out the variable names
// echo 'The game $game_name was released in $release_year and it now costs $$cost_now at amazon.com<br />';

// operators
$num = "100.77";
var_dump($num); // function to find out what the data types are in PHP
var_dump(+ $num); // + converts string to number, int or float as appropriate

// numeric and associative arrays (maps?)
$game_genres = array(
    'rpg',
    'adventure',
    'action',
    'puzzle',
    'strategy',
    'mmorpg',
    'fps'
);

echo BR . $game_genres[0] . BR;

// multidimensional array
$game_genres2 = array(
    'rpg',
    array(
        'adventure',
        'action',
        'puzzle'
    ),
    'strategy',
    'mmorpg',
    'fps'
);
echo $game_genres2[0] . BR;
// accesses first character of first string, strings are arrays of characters so this makes sense
echo $game_genres2[0][0] . BR;
echo $game_genres2[1][0] . BR;
echo $game_genres2[1][1] . BR;
echo $game_genres2[1][2] . BR;

pre_r($game_genres2);

// associative array
$years = array(
    'StartCraft' => 1998,
    'The Witcher' => 2009,
    'Mass Effect 3' => RELEASE_YEAR,
    'Diablo' => 1996
);
pre_r($years);

$num = add(100, 100);
echo $num . BR;

// functions
function pre_r($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

function add($x, $y)
{
    return $x + $y;
}

// if statements

if (18 < 21) {
    echo "It's true!" . BR;
} else { // if it's false
    echo "it's false" . BR;
}

if (RELEASE_YEAR > 2010) {
    echo "the game was released after the year 2010" . BR;
} else if (RELEASE_YEAR == 2000) {
    echo "the game was relesed in the year 200" . BR;
} else if (RELEASE_YEAR < 2010) {
    echo "the game was released before the year 2010" . BR;
} else {
    echo "the game was relesed in 2010";
}

// switch statement
$best_game = "The Witcher";
switch ($best_game) {
    case 'StarCraft':
        echo "mmk" . BR;
        break; // don't forget the break else it keeps going
    case "The Witcher":
        echo "The best RPG game of all time!" . BR;
        break;
    case "Mass Effect 3":
        echo "The best action RPG of all time!" . BR;
        break;
    case "Diablo":
        echo "One of the best game of all time" . BR;
        break;
}

// loops
for ($i = 0; $i <= 10; $i ++) {
    echo $i . BR;
}

// count gets the length of the array
for ($key = 0; $key < count($game_genres); $key ++) {
    echo $game_genres[$key] . BR;
}
echo BR;

/*
 * 2d array, need to be able to access the array contained in the array
 */
for ($key = 0; $key < count($game_genres2); $key ++) {
    if (is_array($game_genres2[$key])) { // detects if the value is an array
        for ($key2 = 0; $key2 < count($game_genres2[$key]); $key2 ++) { // iterate over the array and print the values contained
            echo $game_genres2[$key][$key2] . BR;
        }
    } else {
        echo $game_genres2[$key] . BR;
    }
}

// for each loop
foreach ($years as $game => $year) { // game = key, year = value
    echo "$game was released in $year" . BR;
}

// while loop
$i = 0;
while ($i > 10) {
    echo $i . BR;
    $i ++;
}

echo BR;
// do while loop
/*
 * while expression is evaluated at end of loop, so it will always execute the loop at least once,
 * vs while which evaluates while statement first and will only execute if that statement is true
 */
$c = 0;
do {
    echo $c . BR;
    $c ++;
} while ($c > 10);
echo BR;

// objects

/*
 * class className
 * {
 *
 * var $variableName = value;
 *
 * // var keyword is how variables are defined inside the class
 * function functionName()
 * {
 * // statement
 * }
 * }
 *
 * $obj = new className(); // $obj variable becomes data type object
 * $obj->functionName(); // call function in class
 * $obj->variableName;
 */

// access variable in class
class car
{

    var $make;

    var $type;

    var $color;

    var $max_speed;

    const BR = '<br />';

    function stop()
    {
        echo "stopping... <br />";
    }

    function accelerate()
    {
        // vars require $this inside the class to access them
        echo "the $this->color $this->make $this->type is now accelerating..." . BR;
    }

    function decelerate()
    {
        echo "the $this->color $this->make $this->type is now decelerating..." . BR;
    }

    function honk()
    {
        echo "the $this->color $this->make $this->type is honking loudly...  HONK!!! HONK!!!" . BR;
    }

    function signal_right()
    {
        echo "the $this->color $this->make $this->type has turned on the right signal!" . BR;
    }

    function print_info()
    {
        echo "Here is the information about the car:" . BR;
        echo "<strong>Make: </strong>" . $this->make . BR;
        echo "<strong>Type: </strong>" . $this->type . BR;
        echo "<strong>Color: </strong>" . $this->color . BR;
        echo "<strong>Max Speed: </strong>" . $this->max_speed . BR;
    }
}

$acura = new Car(); // object is created, it is now an object data type
$acura->make = 'Acura';
$acura->color = 'Black';
$acura->max_speed = 140;
$acura->type = 'RSX';

$acura->accelerate();
$acura->honk();
$acura->signal_right();
$acura->decelerate();
$acura->stop();
$acura->print_info();
?>
<?php

$score  = 0;
$lines  = file('input.txt');
$scores = [
    'A' => ['X' => 3, 'Y' => 6, 'Z' => 1],
    'B' => ['X' => 1, 'Y' => 3, 'Z' => 6],
    'C' => ['X' => 6, 'Y' => 1, 'Z' => 3],
    'X' => 1, 
    'Y' => 2, 
    'Z' => 3,
];

foreach ($lines as $line) {
    $line = trim($line);
    
    list($opponent, $me) = explode(' ', $line);
    
    $score += $scores[$me];

    if ($scores[$opponent][$me] > 1) {
        $score += $scores[$opponent][$me];
    }
}

echo $score;
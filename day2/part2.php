<?php

$score       = 0;
$lines       = file('input.txt');
$scores      = [
    'A' => ['X' => 3, 'Y' => 6, 'Z' => 1],
    'B' => ['X' => 1, 'Y' => 3, 'Z' => 6],
    'C' => ['X' => 6, 'Y' => 1, 'Z' => 3],
];
$shapeScores = [
    'A' => 1, 'B' => 2, 'C' => 3,
    'X' => 1, 'Y' => 2, 'Z' => 3,
];

foreach ($lines as $line) {
    $line = trim($line);
    
    list($opponent, $me) = explode(' ', $line);

    switch ($me) {
        case 'Y': $score += $shapeScores[$opponent] + 3; break;
        case 'X':
        case 'Z':
            foreach ($scores[$opponent] as $shape => $roundScore) {
                if ($roundScore === ($me === 'X' ? 1 : 6)) {
                    $score += $shapeScores[$shape] + ($me === 'Z' ? $roundScore : 0);
                    break;
                }
            }
            break;
    }
}

echo $score;
<?php

$grid = file('input.txt');

foreach ($grid as $i => $line) {
    $grid[$i] = str_split(trim($line));
}

$score      = 0;
$gridWidth  = count($grid);
$gridHeight = count($grid[0]);

for ($y = 1; $y <= $gridHeight - 2; $y++) {
    for ($x = 1; $x <= $gridWidth - 2; $x++) {
        $tree   = $grid[$y][$x];
        $scores = array_fill(0, 4, 0);

        for ($i = $x - 1; $i >= 0; $i--) {
            $scores[0]++;
            if ($grid[$y][$i] >= $tree) {
                break;
            }
        }

        for ($j = $x + 1; $j <= $gridWidth - 1; $j++) {
            $scores[1]++;
            if ($grid[$y][$j] >= $tree) {
                break;
            }
        }

        for ($k = $y - 1; $k >= 0; $k--) {
            $scores[2]++;
            if ($grid[$k][$x] >= $tree) {
                break;
            }
        }

        for ($l = $y + 1; $l <= $gridHeight - 1; $l++) {
            $scores[3]++;
            if ($grid[$l][$x] >= $tree) {
                break;
            }
        }

        $total = $scores[0] * $scores[1] * $scores[2] * $scores[3];
        if ($total > $score) {
            $score = $total;
        }
    }
}

echo $score;
<?php

$grid  = file('input.txt');
$trees = [];

foreach ($grid as $i => $line) {
    $grid[$i] = str_split(trim($line));
}

$gridWidth  = count($grid);
$gridHeight = count($grid[0]);

for ($x = 1; $x <= $gridWidth - 2; $x++) {
    $highestLeft = $grid[$x][0];
    for ($y = 1; $y <= $gridHeight - 2; $y++) {
        $tree = $grid[$x][$y];
        if ($tree > $highestLeft) {
            $highestLeft = $tree;
            
            $trees[] = implode(',', [$x, $y]);
        }
    }
    
    $highestRight = $grid[$x][$gridHeight - 1];
    for ($y = $gridHeight - 2; $y >= 1; $y--) {
        $tree = $grid[$x][$y];
        if ($tree > $highestRight) {
            $highestRight = $tree;
            
            $trees[] = implode(',', [$x, $y]);
        }
    }
}

for ($y = 1; $y <= $gridWidth - 2; $y++) {
    $highestTop = $grid[0][$y];
    for ($x = 1; $x <= $gridHeight - 2; $x++) {
        $tree = $grid[$x][$y];
        if ($tree > $highestTop) {
            $highestTop = $tree;
            
            $trees[] = implode(',', [$x, $y]);
        }
    }
    
    $highestBottom = $grid[$gridHeight - 1][$y];
    for ($x = $gridWidth - 2; $x >= 1; $x--) {
        $tree = $grid[$x][$y];
        if ($tree > $highestBottom) {
            $highestBottom = $tree;
            
            $trees[] = implode(',', [$x, $y]);
        }
    }
}

$visibleOnEdges = (2 * $gridHeight) + (2 * $gridWidth) - 4;
$visible        = $visibleOnEdges + count(array_unique($trees));

echo $visible;
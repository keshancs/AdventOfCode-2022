<?php

$lines       = file('input.txt');
$elves       = [];
$i           = 0;
$maxCalories = 0;

foreach ($lines as $line) {
    $line = trim($line);

    $elves[$i] = ($elves[$i] ?? 0) + intval($line);

    if ($line == '') {
        $i++;
    }
}

rsort($elves);

for ($i = 0; $i < 3; $i++) {
    $maxCalories += $elves[$i];
}

echo $maxCalories;
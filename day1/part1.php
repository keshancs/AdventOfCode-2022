<?php

$lines       = file('input.txt');
$elves       = [];
$i           = 0;
$maxCalories = 0;

foreach ($lines as $line) {
    $line = trim($line);

    $elves[$i] = ($elves[$i] ?? 0) + intval($line);

    if ($line == '') {
        if ($elves[$i] > $maxCalories) {
            $maxCalories = $elves[$i];
        }

        $i++;
    }
}

echo $maxCalories;
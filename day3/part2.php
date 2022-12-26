<?php

$lines         = file('input.txt');
$characters    = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$priorities    = array_map(fn (int $i) => ++$i, array_flip(str_split($characters)));
$totalPriority = 0;
$group         = [];

foreach ($lines as $i => $line) {
    $line = trim($line);
    
    $group[] = $line;

    if ((($i + 1) % 3) === 0) {
        $group = array_map(fn ($line) => str_split($line), $group);
        $test  = array_intersect(...$group);

        if ($character = array_shift($test)) {
            $totalPriority += $priorities[$character];
        }

        $group = [];
    }
}

echo $totalPriority;
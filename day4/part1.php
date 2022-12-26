<?php

$lines    = file('input.txt');
$overlaps = 0;

foreach ($lines as $line) {
    $line   = trim($line);
    $ranges = explode(',', $line);
    
    foreach ($ranges as $i => $range) {
        list ($from, $to) = explode('-', $range);

        $ranges[$i] = range($from, $to);
    }

    if (!array_diff($ranges[0], $ranges[1]) || !array_diff($ranges[1], $ranges[0])) {
        $overlaps++;
    }
}

echo $overlaps;
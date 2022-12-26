<?php

$lines         = file('input.txt');
$characters    = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$priorities    = array_map(fn (int $i) => ++$i, array_flip(str_split($characters)));
$totalPriority = 0;

foreach ($lines as $line) {
    $line       = trim($line);
    $halfLength = strlen($line) / 2;
    $firstHalf  = str_split(substr($line, 0, $halfLength));
    $secondHalf = str_split(substr($line, $halfLength));

    foreach ($firstHalf as $firstHalfCharacter) {
        $found = false;
        foreach ($secondHalf as $secondHalfCharacter) {
            if ($firstHalfCharacter === $secondHalfCharacter) {
                $totalPriority += $priorities[$firstHalfCharacter];
                $found = true;
                break;
            }
        }
        if ($found) {
            break;
        }
    }
}

echo $totalPriority;
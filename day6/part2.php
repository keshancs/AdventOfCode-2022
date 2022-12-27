<?php

$contents   = file_get_contents('input.txt');
$characters = str_split($contents);

for ($i = 0; $i < strlen($contents) - 14; $i++) {
    $slice = array_slice($characters, $i, 14);
    if ($slice === array_unique($slice)) {
        echo $i + 14;
        break;
    }
}
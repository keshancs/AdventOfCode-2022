<?php

$contents   = file_get_contents('input.txt');
$characters = str_split($contents);

for ($i = 0; $i < strlen($contents) - 4; $i++) {
    $slice = array_slice($characters, $i, 4);
    if ($slice === array_unique($slice)) {
        echo $i + 4;
        break;
    }
}
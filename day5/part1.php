<?php

$lines     = file('input.txt');
$positions = [];
$stacks    = [];

foreach ($lines as $line) {
    $line = trim($line, "\n");
    
    if (str_contains($line, 'move')) {
        $matches = [];
        preg_match_all('~move\s([0-9]+)\sfrom\s([0-9]+)\sto\s([0-9]+)~', $line, $matches);

        if ($matches[0]) {
            $amount = $matches[1][0];
            $from   = $matches[2][0];
            $to     = $matches[3][0];

            for ($i = 0; $i < $amount; $i++) {
                $crate = array_shift($stacks[$from]);

                array_unshift($stacks[$to], $crate);
            }
        }

        continue;
    }
    
    $characters = str_split($line);

    foreach ($characters as $i => $character) {
        if ($character === '[') {
            $position = strpos($line, $characters[$i + 1]);
            $line     = substr_replace($line, ' ', $position, 1);

            $positions[$position][] = $characters[$i + 1];

            continue;
        }

        if (is_numeric($character)) {
            $position = strpos($line, $character);

            foreach ($positions[$position] ?? [] as $crate) {
                $stacks[$character][] = $crate;
            }
        }
    }
}

$crates = [];
foreach ($stacks as $position => $stack) {
    $crates[] = $stack[0];
}

echo implode('', $crates);
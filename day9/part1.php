<?php

$rope = [];
for ($length = 0; $length < 10; $length++) {
    $rope[] = [0, 0];
}

$tail  = [];
$lines = file('input.txt', FILE_IGNORE_NEW_LINES);

foreach ($lines as $line) {
    list($direction, $steps) = explode(' ', $line);

    for ($i = 0; $i < $steps; $i++) {
        switch ( $direction ) {
            case 'L': $rope[0][0]--; break;
            case 'R': $rope[0][0]++; break;
            case 'D': $rope[0][1]--; break;
            case 'U': $rope[0][1]++; break;
        }

        for ($length = 1; $length < 10; $length++) {
            $prev = $length - 1;

            if ($rope[$prev][0] === $rope[$length][0] && $rope[$prev][1] === $rope[$length][1]) {
                break;
            }

            if ($rope[$prev][0] === $rope[$length][0]) {
                $distance = $rope[$prev][1] - $rope[$length][1];

                if ($distance === -2) {
                    $rope[$length][1]--;
                } else if ( $distance === 2 ) {
                    $rope[$length][1]++;
                }
            } else if ($rope[$prev][1] === $rope[$length][1]) {
                $distance = $rope[$prev][0] - $rope[$length][0];

                if ($distance === -2) {
                    $rope[$length][0]--;
                } else if ($distance === 2) {
                    $rope[$length][0]++;
                }
            } else {
                $distanceX = $rope[$prev][0] - $rope[$length][0];
                $distanceY = $rope[$prev][1] - $rope[$length][1];

                if (abs($distanceY) === 2) {
                    $rope[$length][1] += $distanceY / 2;

                    if (abs($distanceX) === 1) {
                        $rope[$length][0] = $rope[$prev][0];
                    }
                }

                if (abs($distanceX) === 2) {
                    $rope[$length][0] += $distanceX / 2;

                    if (abs($distanceY) === 1) {
                        $rope[$length][1] = $rope[$prev][1];
                    }
                }
            }
        }

        $tail[1][$rope[1][0] . '|' . $rope[1][1]] = true;
    }
}

echo count($tail[1]);
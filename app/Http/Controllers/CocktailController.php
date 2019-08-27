<?php

namespace App\Http\Controllers;

use App\Models\Cocktail;
use App\Models\Ingredient;

class CocktailController extends Controller
{
    public function serve($id): void
    {
        /** @var Cocktail $cocktail */
        $cocktail = Cocktail::find($id);
        $ingredients = $cocktail->ingredients();
        $volume = 200; // ml // TODO invoerbaar maken

        $arg = '';
        $states = [];
        $first = true;

        /** @var Ingredient $ingredient */
        foreach ($ingredients as $ingredient) {
            $pump = $ingredient->pump;
            $vol = $ingredient->coupling_percentage / 100 * $volume;
            $speed = $pump->ml_per_minute / 60;
            $time = $vol / $speed * 1000; // to ms
            $states[$pump->pin] = $time;

            if (!$first) $arg .= ' ';
            else $first = false;
            $arg .= "$pump->pin:$time";
        }

        unset($ingredients);
        unset($first);

        $start = $this->currentMillis();
        foreach ($states as $pin => $time) {
            echo("Starting pin $pin<br>");
            shell_exec("gpio export $pin out");
        }

        while (true) {
            $elapsed = $this->currentMillis() - $start;
            foreach ($states as $pin => $time) {
                if ($elapsed >= $time) {
                    echo("Stopping pin $pin after $time<br>");
                    shell_exec("echo \"$pin\" > /sys/class/gpio/unexport");
                    unset ($states[$pin]);
                }
            }

            if (empty($states)) {
                echo("Done");
                break;
            }
        }
    }

    private function currentMillis(): float
    {
        // https://stackoverflow.com/questions/3656713/how-to-get-current-time-in-milliseconds-in-php
        return round(microtime(true) * 1000);
    }
}

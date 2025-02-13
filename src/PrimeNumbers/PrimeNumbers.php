<?php

/**
 * PHP script that prints all integer values from 1 to 100.
 * Beside each number, print the numbers it is a multiple of (inside brackets and comma-separated). If
 * only multiple of itself then print “[PRIME]”.
 */

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Helpers\LogHelper;

try {
    for ($i = 1; $i <= 100; $i++) {

        $primeArr = [];

        for ($j = 1; $j <= $i; $j++) {
            if ($i % $j == 0) {
                $primeArr[] = $j;
            }
        }
        if (isPrimeNumber($i)) {
            $output = "$i [PRIME]\n";
            LogHelper::logMessage("INFO", "Prime number found: $i");
        } else {
            $output = "$i [" . implode(", ", $primeArr) . "]\n";
        }
        echo $output;
    }

} catch (Exception $e) {
    LogHelper::logMessage("ERROR", "Error: " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine());
}

function isPrimeNumber(int $num): bool
{
    if ($num < 2) {
        return false;
    }
    for ($i = 2; $i <= sqrt($num); $i++) {
        if ($num % $i == 0) {
            return false;
        }
    }
    return true;
}

?>

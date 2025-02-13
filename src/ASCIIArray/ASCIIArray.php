<?php

/**
 * PHP script to generate a random array containing all the ASCII characters from comma (“,”) to
 * pipe (“|”). Then randomly remove and discard an arbitrary element from this newly generated array.
 * Write the code to efficiently determine the missing character.
 */

use App\Helpers\LogHelper;

try {
    // Create an array with ASCII characters
    $asciiArray = range(',', '|');
    if (empty($asciiArray)) {
        throw new Exception("The ASCII array is empty.");
    }

    // original array
    LogHelper::logMessage("INFO", "Original ASCII Array: " . implode(', ', $asciiArray));

    // Remove a random element from the array
    $randomKey = array_rand($asciiArray);
    $removedCharacter = $asciiArray[$randomKey];
    unset($asciiArray[$randomKey]);

    // Array after removal
    LogHelper::logMessage("INFO", "Array after removing the random element ($removedCharacter): " . implode(', ', $asciiArray));

    // Find the missing character
    $allAscii = range(',', '|');
    $missingCharacter = array_diff($allAscii, $asciiArray);

    if (empty($missingCharacter)) {
        throw new Exception("No missing character found.");
    }

    $missingCharacter = reset($missingCharacter);

    // Missing character
    LogHelper::logMessage("INFO", "The missing character is: $missingCharacter");

    // Output the missing character
    echo "\nThe missing character is: $missingCharacter\n";

} catch (Exception $e) {
    LogHelper::logMessage("ERROR", "Error: " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine());
    echo "An error occurred: " . $e->getMessage();
}

?>

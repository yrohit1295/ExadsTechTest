<?php

/**
 * Populate a MySQL (InnoDB) database with data from at least 3 TV Series using the following structure:
 * tv_series -> (id, title, channel, gender);
 * tv_series_intervals -> (id_tv_series, week_day, show_time);
 *  Provide the SQL scripts that create and populate the DB;
 * Using OOP, write a code that tells when the next TV Series will air based on the current time-date or an
 * inputted time-date, and that can be optionally filtered by TV Series title.
 */

require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\TVSeriesSchedule;
use App\Helpers\LogHelper;

$inputDate = $_GET['date'] ?? null;
$title = $_GET['title'] ?? null;

try {
    $schedule = new TVSeriesSchedule();
    $nextShow = $schedule->getNextShow($inputDate, $title);

    if ($nextShow) {
        echo json_encode([
            "data" => [
                "title" => $nextShow['title'],
                "genre" => $nextShow['genre'],
                "channel" => $nextShow['channel'],
                "week_day" => $nextShow['week_day'],
                "show_time" => $nextShow['show_time']
            ]
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "No upcoming shows found."]);
    }
} catch (Exception $e) {
    LogHelper::logMessage("ERROR", "Unexpected error: " . $e->getMessage());
    echo json_encode(["status" => "error", "message" => "An error occurred. Check logs for details."]);
}

<?php

namespace App\Models;

use App\Helpers\LogHelper;
use App\Helpers\DBHelper;
use App\Interfaces\ScheduleInterface;
use DateTime;
use PDO;
use PDOException;
use Exception;

class TVSeriesSchedule implements ScheduleInterface
{
    private $pdo;

    public function __construct()
    {
        $dbHelper = new DBHelper();
        $dsn = "mysql:host={$dbHelper->host};port={$dbHelper->port};dbname={$dbHelper->dbname};charset=utf8mb4";

        try {
            $this->pdo = new PDO($dsn, $dbHelper->username, $dbHelper->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
            LogHelper::logMessage("INFO", "Connected to MySQL successfully.");
        } catch (PDOException $e) {
            LogHelper::logMessage("ERROR", "database Connection Failed: " . $e->getMessage());
            die("database Connection Failed. Check logs.");
        }
    }

    public function getNextShow($inputDate = null, $title = null): ?array
    {
        try {
            $now = $inputDate ? new DateTime($inputDate) : new DateTime();
            $currentWeekday = $now->format('l');  // Get current weekday name
            $currentTime = $now->format('H:i:s'); // Get current time

            // SQL Query to fetch the next airing show
            $query = "SELECT ts.title, ts.channel, ts.genre, tsi.week_day, tsi.show_time FROM tv_series_intervals tsi JOIN tv_series ts ON tsi.id_tv_series = ts.id WHERE (tsi.week_day = :currentWeekday AND tsi.show_time > :currentTime OR tsi.week_day > :currentWeekday)";

            if ($title) {
                $query .= " AND ts.title = :title ";
            }

            $query .= " ORDER BY FIELD(tsi.week_day, 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'), tsi.show_time LIMIT 1";

            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':currentWeekday', $currentWeekday);
            $stmt->bindParam(':currentTime', $currentTime);

            if ($title) {
                $stmt->bindParam(':title', $title);
            }

            $stmt->execute();
            $nextShow = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($nextShow) {
                LogHelper::logMessage("INFO", "Next show found: " . $nextShow['title'] . " on " . $nextShow['channel'] . " at " . $nextShow['show_time']);
            } else {
                LogHelper::logMessage("INFO", "No upcoming shows found.");
            }

            return $nextShow ?: null;
        } catch (Exception $e) {
            LogHelper::logMessage("ERROR", "Error fetching next show: " . $e->getMessage());
            return null;
        }
    }
}

?>

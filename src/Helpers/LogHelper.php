<?php
namespace App\Helpers;

class LogHelper
{
    private static string $logDir = __DIR__ . '/../../logs/';

    private static string $logFile = 'custom.log';

    public static function logMessage(string $level, string $message): void
    {
        $timestamp = date("Y-m-d H:i:s");
        $logPath = self::$logDir . self::$logFile;
        error_log("[$timestamp] [$level] $message\n", 3, $logPath);
    }
}

?>

<?php
namespace App\Helpers;

class DBHelper
{
    public string $host;
    public string $port;
    public string $username;
    public string $dbname;
    public string $password;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config.php';
        $this->host = $config['host'];
        $this->port = $config['port'];
        $this->dbname = $config['dbname'];
        $this->username = $config['username'];
        $this->password = $config['password'];
    }
}

?>

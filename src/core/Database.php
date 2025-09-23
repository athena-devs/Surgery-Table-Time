<?php 

require_once __DIR__ . '../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$password = getenv('DB_PASSWORD');
$name = getenv('DB_NAME');


final class Database extends mysqli {
  
    private $conn = null;

    public function __construct()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $host = getenv('DB_HOST');
            $user = getenv('DB_USER');
            $password = getenv('DB_PASSWORD');
            $name = getenv('DB_NAME');

            $this->conn = mysqli_connect($host, $user, $password, $name);
        } catch (mysqli_sql_exception $err) {

            error_log('Error atempting to connect DB' . $err->getMessage());
            throw new mysqli_sql_exception('Wasnt possible to connect with db' . $err->getCode());
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }

}

?>
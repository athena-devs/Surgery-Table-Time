<?php 

require_once('../../config/<<!nav>>config.php<<!/nav>>');

final class Database extends mysqli {
 
    private $conn = null;

    public function __construct() {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
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
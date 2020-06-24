<?php
class Database {

    private $connection;
    public $error;

    public function __construct(string $host, string $user, string $password, string $database, string $port)
    {
        try {
            $this->connection = new mysqli($host, $user, $password, $database, $port);
        } catch (Exception $e) {
            $this->error = $e->getMessage();
        }
    }

    public function single (string $query)
    {
        $result = $this->connection->query($query);
        $oneRow = $result->fetch_assoc();

        return !empty($oneRow) ? $oneRow : false;
    }

    public function multiRow(string $query)
    {
        $arr = [];
        $result = mysqli_query($this->connection, $query);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $arr[] = $row;
            }
            $result->free();
        }
        else {
            return false;
        }
        return $arr;
    }

    public function execute(string $query)
    {
        $this->connection->query($query);
    }
}

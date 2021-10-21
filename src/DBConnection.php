<?php


namespace App;

/**
 * Class DBConnection
 * @package App
 */
class DBConnection
{
    public  $connection;
    private $servername = "localhost";
    private $username = "Username";
    private $password = "Password";
    private $dbname = "Dbname";
    private $port = '3306';
    private $socket ='';
    private $charset;

    /**
     * DBConnection constructor.
     * @param $servername
     * @param $username
     * @param $password
     */
    public function __construct($servername,$username,$password, $database)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $database;
    }

    /**
     * @return mysqli
     */
    public function getConnection(){
        try {
            $this->connection = new \mysqli($this->servername,
                $this->username,
                $this->password,
            $this->dbname);


        }catch(\Exception $e){
            if ($this->connection->connect_error) {
                echo "SERVER NAME=",$this->servername,NEW_LINE;
                echo "USERNAME=",$this->username ,NEW_LINE;
                echo "PASSWORD=",$this->password,NEW_LINE;
                die("Connection failed: " . $this->connection->connect_error);

            }

        }
        return $this->connection;
    }

    /**
     * @param $dbname
     */
    public function createDB($dbname){
        try {

            $sql = "CREATE DATABASE $dbname";
            if ($this->connection->query($sql) === TRUE) {
                $this->dbname = $dbname;
                echo "Database created successfully";
            }
        }catch(\Exception $e) {

            echo "Error creating database: " . $this->connection->error;

        }

    }

    public function executeQuery($query){

    }


}
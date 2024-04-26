<?php


class Database {
    private $serverName = 'localhost';
    private $userName = 'root';
    private $password = '';
    private $dbName = 'company';
    private $conn ;
    public function __construct()
    {   
        $this-> conn = mysqli_connect($this->serverName, $this->userName, $this->password, $this->dbName);
        if (!$this->conn) {
            die("Error : " . mysqli_connect_error());
        }
    }

    public function enc_password ($password) {
        return sha1($password);
    }

    public function insert ($sql) {
        if (mysqli_query($this->conn , $sql)) {
            return 'Added Successfully';
        }else {
            die('Error : ' . mysqli_error($this->conn));
        }
    }

    public function read($table)
    {
        $sql2 = "SELECT * FROM $table";

        $result = mysqli_query($this->conn, $sql2);

        $data = [];
        if ($result) 
        {
            if (mysqli_num_rows($result)) 
            {
                while ($row = mysqli_fetch_assoc($result))
                {
                    $data[] = $row;
                }
            }
            return $data;
        } 
        else
        {
            die('Error : ' . mysqli_error($this->conn));
        }
    }


    public function update($sql)
    {
        if (mysqli_query($this->conn, $sql)) {
            return 'updated Successfully';
        } else {
            die('Error : ' . mysqli_error($this->conn));
        }
    }


    public function find($table,$id)
    {
        $sql2 = "SELECT * FROM $table WHERE `id`='$id'";

        $result = mysqli_query($this->conn, $sql2);

        if ($result) {
        if( mysqli_num_rows($result)) 
        {
            return mysqli_fetch_assoc($result);
        } 
        return false;
            
        } 
        else
        {
            die('Error : ' . mysqli_error($this->conn));
        }
    }



public function delete ($table , $id) {
    $sql = "DELETE FROM $table WHERE `id` = '$id' ";
        if (mysqli_query($this->conn, $sql)) {
            return 'Deleted Successfully';
        } else {
            die('Error : ' . mysqli_error($this->conn));
        }
}



    }

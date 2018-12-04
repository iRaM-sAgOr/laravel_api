<?php

    class db_operations{

        private $con;
        //create a constructor to have the connection 
        //connection is proveided from db_connecti.php page
        //to use it we use an object
        function _construct(){
            require_once dirname(__FILE__) . '/db_connect.php';
            $db = new db_connect();//this is the object of db_connect class of db_connect.php page
            $this->con = $db->connect();
            //connect() is the method defined in the 
            //db_connect class.then this->con holds the connection link;

        }

        public function createUser($email,$password,$name,$school){
            $stmt = $this->con->prepare("INSERT INTO users (email,password,name,school) VALUES (?,?,?,?)");
        }
    }
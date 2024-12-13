<?php
    class DBController 
    {
        //Variable Declaration 
        private $host;
        private $database;
        private $user;
        private $password;
        private $conn;

        //Variable declaration 
        //private $host = "localhost";
        //private $database = "shric8ey_demo_cms";
        //private $database = "shric8ey_cms";
        //private $user = "shric8ey_root";
        //private $password = "Rollout@123#";

        function __construct() {
            $ini_file_path = $_SERVER['DOCUMENT_ROOT'] ."/app.ini";
            $ini_file = parse_ini_file($ini_file_path);
            $this->host = $ini_file["host"];
            $this->user = $ini_file["db_user"];
            $this->password = $ini_file["db_password"];
            $this->database = $ini_file["db_name"];
            $this->conn = $this->connectDB();
        }   
        
        function connectDB() {
            $conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
            return $conn;
        }

        function beginTrans()
        {
            $this->conn->begin_transaction();
        }

        function commitTrans()
        {
            $this->conn->commit();
        }

        function rollbackTrans()
        {
            $this->conn->rollback();
        }

        function runBaseQuery($query) 
        {
            $result = $this->conn->query($query);
            return $result;
        }
      
        function executeQuery($query, $param_type, $param_value_array) 
        {
            $sql = $this->conn->prepare($query);
            $this->bindQueryParams($sql, $param_type, $param_value_array);
            $sql->execute();
            $result = $sql->get_result();
            return $result;        
        }   

        function runQuery($query, $param_type, $param_value_array) 
        {
            $sql = $this->conn->prepare($query);
            $this->bindQueryParams($sql, $param_type, $param_value_array);
            $sql->execute();
            $result = $sql->get_result();
            // if ($result->num_rows > 0) {
            //     while($row = $result->fetch_assoc()) {
            //         $resultset[] = $row;
            //     }
            // }
            // if(!empty($resultset)) {
            //     return $resultset;
            // }
            return $result;
        }
        
        function bindQueryParams($sql, $param_type, $param_value_array) 
        {
            $param_value_reference[] = & $param_type;
            for($i=0; $i<count($param_value_array); $i++) {
                $param_value_reference[] = & $param_value_array[$i];
            }
            call_user_func_array(array(
                $sql,
                'bind_param'
            ), $param_value_reference);
        }
        
        function insert($query, $param_type, $param_value_array) 
        {
            $sql = $this->conn->prepare($query);
            $this->bindQueryParams($sql, $param_type, $param_value_array);
            $sql->execute();
            $insertId = $sql->insert_id;
            return $insertId;
        }
        
        function update($query, $param_type, $param_value_array) 
        {
            $sql = $this->conn->prepare($query);
            $this->bindQueryParams($sql, $param_type, $param_value_array);
            $sql->execute();       
        }

        function updateWithStatus($query) 
        {
            $response = mysqli_query($this->conn, $query);
            return $response;   
        }

        function getUserAccessRoleByID($id)
        {
            global $conn;    
            $query = "select user_role from tbl_user_role where  id = ".$id;
            $rs = mysqli_query($conn,$query);
            $row = mysqli_fetch_assoc($rs);
            return $row['user_role'];
        }
    }
?>
<?php
    class connectDB
    {
        private $host='localhost';
        private $username ='root';
        private $password ='';
        private $databaseName='quanlybanbalo';
        private $conn;
        public function __construct()
        {
            $this -> connect();
        } 
        public function connect()
        {
            try
            {
                if(($this->conn=mysqli_connect($this->host,$this->username,$this->password,$this->databaseName)))
                {
                    return $this->conn;
                }
                else{
                    throw new Exception("Khong the ket noi den database <br />");
                }
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function query($sql ="",$return =true)
        {
            mysqli_query($this->conn,"SET NAMES 'utf8'");
            if($result=mysqli_query($this->conn,$sql))
            {
                if($return==true)
                {
                    while($row=mysqli_fetch_array($result))
                    {
                        $data[]=$row;
                    }
                    mysqli_free_result($result);
                    return $data;
                }
                else
                    return true;
            }
            else
                return false;
        }
    }
?>
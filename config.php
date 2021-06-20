<?php
    $DB_NAME = "tugasakhir";
    $DB_USER = "root";
    $DB_PASS =  "";
    $DB_SERVER_LOC = "localhost";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conn = mysqli_connect($DB_SERVER_LOC,$DB_USER,$DB_PASS,$DB_NAME);
        $mode = $_POST['mode'];
        $respon = array(); $respon['kode'] = '000';
        switch($mode){
            case "login":
            $nim = $_POST["nim"];
            $password = $_POST["password"];
            $sql = "SELECT * from users where nim='$nim'";
            $result = mysqli_query($conn,$sql);
            if (mysqli_num_rows($result)>0) {
                $sql = "SELECT * from users where nim='$nim' and password='$password'";
                $result = mysqli_query($conn,$sql);
                 if (mysqli_num_rows($result)>0) {
                    $respon=mysqli_fetch_array($result);
                        $respon['kode'] = "222";
                        echo json_encode($respon); exit();	//login sukses
                }else{
                    $respon['kode'] = "333";
                    echo json_encode($respon); exit();		//password salah
                }
            }else{
                $respon['kode'] = "555";
                echo json_encode($respon); exit();			//username tid_pegak ditemukan
            }
            break;
        }
    }
?>

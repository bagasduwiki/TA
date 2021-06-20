<?php
    $DB_NAME = "tugasakhir2";
    $DB_USER = "root";
    $DB_PASS = "";
    $DB_SERVER_LOC = "localhost";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conn = mysqli_connect($DB_SERVER_LOC,$DB_USER,$DB_PASS,$DB_NAME);
        $respon = array(); $respon['kode'] = '000';
				$id_cakahim = $_POST["id_cakahim"];
        $sql = "SELECT `status` from cakahim WHERE id_user='$id_cakahim'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0){
          header("Access-Control-Allow-Origin: *");
          header("Content-type: application/json; charset-UTF-8");

          $data_cakahim = mysqli_fetch_array($result);
          // while($cakahim = mysqli_fetch_assoc($result)){
          //   array_push($data_cakahim, $cakahim);
          // }
          echo json_encode($data_cakahim);
        }
		}

    // if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //   $conn = mysqli_connect($DB_SERVER_LOC,$DB_USER, $DB_PASS, $DB_NAME);
    //   $sql = "SELECT `status` from cakahim WHERE id=id";
    //   $result = mysqli_query($conn, $sql);
    //   if(mysqli_num_rows($result)>0){
    //     header("Access-Control-Allow-Origin: *");
    //     header("Content-type: application/json; charset-UTF-8");
    //
    //     $data_berkas = array();
    //     while($berkas = mysqli_fetch_assoc($result)){
    //       array_push($data_berkas, $berkas);
    //     }
    //     echo json_encode($data_berkas);
    //   }
    // }
 ?>

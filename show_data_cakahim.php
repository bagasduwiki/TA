<?php
    $DB_NAME = "tugasakhir2";
    $DB_USER = "root";
    $DB_PASS = "";
    $DB_SERVER_LOC = "localhost";

    // $DB_SERVER_LOC = "localhost";
    // $DB_NAME = "g1931733010_tugas_akhir";
    // $DB_USER = "g1931733010_admin";
    // $DB_PASS = "diaksizz123";

    // if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
      $conn = mysqli_connect($DB_SERVER_LOC,$DB_USER, $DB_PASS, $DB_NAME);
      $sql = "SELECT b.id, a.nama_panjang, a.nim, a.kelas, CONCAT('http://192.168.43.170/laravel/public/images/image/', foto) as url FROM users a, cakahim b WHERE a.id = b.id_user AND `status`='LULUS'";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result)>0){
        header("Access-Control-Allow-Origin: *");
        header("Content-type: application/json; charset-UTF-8");

        $data_cakahim = array();
        while($cakahim = mysqli_fetch_assoc($result)){
          array_push($data_cakahim, $cakahim);
        }
        echo json_encode($data_cakahim);
      }
    }
 ?>

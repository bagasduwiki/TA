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
      $sql = "SELECT p.id_cakahim, u.nama_panjang, CONCAT('http://192.168.43.170/laravel/public/images/image/', c.foto) as url, COUNT(p.id) AS jumlahpemilih FROM pemilihan p
              LEFT JOIN cakahim c ON p.id_cakahim = c.id
              LEFT JOIN users u ON c.id_user = u.id
              GROUP BY id_cakahim";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result)>0){
        header("Access-Control-Allow-Origin: *");
        header("Content-type: application/json; charset-UTF-8");

        $data_hasil = array();
        while($hasil = mysqli_fetch_assoc($result)){
          array_push($data_hasil, $hasil);
        }
        echo json_encode($data_hasil);
      }
    }
 ?>

<?php
    $DB_NAME = "tugasakhir";
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
      $sql = "SELECT judul_artikel, artikel_slug, created_at, CONCAT('http://192.168.43.170/proyekta/image/', artikel_thumbnail) AS url FROM artikel GROUP BY artikel_id";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result)>0){
        header("Access-Control-Allow-Origin: *");
        header("Content-type: application/json; charset-UTF-8");

        $data_artikel = array();
        while($artikel = mysqli_fetch_assoc($result)){
          array_push($data_artikel, $artikel);
        }
        echo json_encode($data_artikel);
      }
    }
 ?>

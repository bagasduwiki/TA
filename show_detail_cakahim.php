<?php
    $DB_NAME = "tugasakhir2";
    $DB_USER = "root";
    $DB_PASS =  "";
    $DB_SERVER_LOC = "localhost";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conn = mysqli_connect($DB_SERVER_LOC,$DB_USER,$DB_PASS,$DB_NAME);
        $mode = $_POST['mode'];
        $respon = array(); $respon['kode'] = '000';
        switch($mode){
			case "detailcakahim":
				$id_cakahim = $_POST["id_cakahim"];
        $conn = mysqli_connect($DB_SERVER_LOC,$DB_USER, $DB_PASS, $DB_NAME);
        $sql = "SELECT b.id, a.nama_panjang, a.nim, a.kelas, b.visi, b.misi, CONCAT('http://192.168.43.170/laravel/public/images/image/', foto) as url FROM users a, cakahim b WHERE a.id = b.id_user AND `status`='LULUS'
        AND b.id = '$id_cakahim'";
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
				//
      break;
      case "pilihcakahim":
				$id_user = $_POST["id_user"];
				$id_cakahim = $_POST["id_cakahim"];
        $sql = "SELECT id_user FROM pemilihan WHERE id_user='$id_user'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0){
            $respon['kode'] = "222";  //sudah milih
            // $respon['alasan'] = "insert awal gagal";
            echo json_encode($respon); exit();
          }else{
            $sql = "INSERT INTO pemilihan(id, id_user, id_cakahim) VALUES('', '$id_user', '$id_cakahim')";
    				$result = mysqli_query($conn,$sql);
    				if($result){
        				echo json_encode($respon); exit(); //update data sukses semua
    					}else{
    						$respon['kode'] = "111";
                // $respon['alasan'] = "insert awal gagal";
    						echo json_encode($respon); exit();
    					}
          }
				//
      break;
		}
}
?>

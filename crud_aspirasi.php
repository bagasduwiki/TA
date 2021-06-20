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
			case "aspirasi":
				$id_user = $_POST["id_user"];
				$deskripsi = $_POST["deskripsi"];
        $foto_aspirasi = $_POST["foto_aspirasi"];
        $file = $_POST['file'];
        $path = "public/images/aspirasi/";
        // echo "$id_user dan $deskripsi"; exit();
				$sql = "INSERT aspirasi (id, deskripsi, id_user, foto_aspirasi) VALUES('','$deskripsi','$id_user', '$file')";
				$result = mysqli_query($conn,$sql);
					if($result){
            if(file_put_contents($path.$file, base64_decode($foto_aspirasi)) == false){
                $sql = "DELETE FROM aspirasi WHERE id='$id'";
                mysqli_query($conn, $sql);
                $respon['kode'] = "111";
                $respon['alasan'] = "insert foto gagal";
    						echo json_encode($respon); exit(); //update data sukses semua
            }else {
              echo json_encode($respon); exit(); //update data sukses semua
            }
						// echo json_encode($respon); exit(); //update data sukses semua
					}else{
						$respon['kode'] = "111";
            $respon['alasan'] = "insert awal gagal";
						echo json_encode($respon); exit();
					}
				//
      break;
		}
}
?>

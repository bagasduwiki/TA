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
      case "cekDaftar":
        $id_user = $_POST["id_user"];
        $sql = "SELECT id_user FROM cakahim WHERE id_user='$id_user'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0){
            $respon['kode'] = "111";  //sudah milih
            // $respon['alasan'] = "insert awal gagal";
            echo json_encode($respon); exit();
          }else{
            echo json_encode($respon); exit(); //update data sukses semua
          }
      break;
      case "cekLulus":
        $id_user = $_POST["id_user"];
        $sql = "SELECT id_user FROM cakahim WHERE id_user='$id_user' AND `status`='LULUS'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0){
            $respon['kode'] = "111";  //sudah milih
            // $respon['alasan'] = "insert awal gagal";
            echo json_encode($respon); exit();
          }else{
            echo json_encode($respon); exit(); //update data sukses semua
          }
      break;
			case "daftarpemilihan":
				$id_user = $_POST["id_user"];
				$ipk = $_POST["ipk"];
        $foto = $_POST["foto"];
        $file = $_POST['file'];
        $file2 = $_POST['file2'];
        $path = "public/images/image/";
        $cv = $_POST["cv"];
        $visi = $_POST["visi"];
        $misi = $_POST["misi"];
				$sql = "INSERT into cakahim (id, id_user, ipk, foto, cv, visi, misi) VALUES('','$id_user','$ipk','$file','$file2','$visi','$misi')";
				$result = mysqli_query($conn,$sql);
					if($result){
            if(file_put_contents($path.$file, base64_decode($foto)) == false){
                $sql = "DELETE FROM cakahim WHERE id='$id'";
                mysqli_query($conn, $sql);
                $respon['kode'] = "111";
                $respon['alasan'] = "insert foto gagal";
    						echo json_encode($respon); exit(); //update data sukses semua
            } else {
              if(file_put_contents($path.$file2, base64_decode($cv)) == false){
                  $sql = "DELETE FROM cakahim WHERE id='$id'";
                  mysqli_query($conn, $sql);
                  $respon['kode'] = "111";
                  $respon['alasan'] = "insert CV gagal";
      						echo json_encode($respon); exit(); //update data sukses semua
              } else {
    						echo json_encode($respon); exit(); //update data sukses semua
              }
            }
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

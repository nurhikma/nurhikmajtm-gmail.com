<?php
	// header harus json
	header("Content-Type:application/json");

	// conf koneksi db
	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbnamea = "bukalapak";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbnamea);

	// tangkap method request
	$smethod = $_SERVER['REQUEST_METHOD'];

	// inisialisasi variable hasil
	$result = array();

	// kondisi metode
	parse_str(file_get_contents('php://input'),$_PUT);
	if($smethod == 'PUT'){
		// tangkap input
		$id_customer = $_PUT['id_customer'];
		$nama_lengkap = $_PUT['nama_lengkap'];
		$no_hp = $_PUT['no_hp'];

		// insert data
		$sql = "UPDATE customer SET
					nama_lengkap = '$nama_lengkap',
					no_hp = '$no_hp'
				WHERE id_customer = '$id_customer'";
		$conn->query($sql);

		$result['status']['code'] = 200;
		$result['status']['description'] = "1 data updated";
		$result['result'] = array(
			"nama_lengkap"=>$nama_lengkap,
			"no_hp"=>$no_hp
		);

	}else{
		$result['status']['code'] = 400;
	}

	// parse ke format json
	echo json_encode($result);
?>

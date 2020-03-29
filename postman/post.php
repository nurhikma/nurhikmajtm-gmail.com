<?php
	// header harus json
	header("Content-Type:application/json");

	// conf koneksi db
	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbnamea = "mahasiswa";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbnamea);

	// tangkap method request
	$smethod = $_SERVER['REQUEST_METHOD'];

	// inisialisasi variable hasil
	$result = array();

	// kondisi metode
	if($smethod == 'POST'){
		// tangkap input
		$nama = $_POST['nama'];
		$nim = $_POST['nim'];
		$email = $_POST['email'];
		$alamat = $_POST['alamat'];

		// insert data
		$sql = "INSERT INTO mhs (
					nama,
					nim,
					email,
					alamat)
				VALUES (
					'$nama',
					'$nim',
					'$email',
					'$alamat'
				)";
		$conn->query($sql);

		$result['status']['code'] = 200;
		$result['status']['description'] = "1 data inserted";
		$result['result'] = array(
			"nama"=>$nama,
			"nim"=>$nim,
			"email"=>$email,
			"alamat"=>$alamat
		);

	}else{
		$result['status']['code'] = 400;
	}

	// parse ke format json
	echo json_encode($result);
?>

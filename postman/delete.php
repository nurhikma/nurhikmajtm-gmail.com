<?php
	// header harus json
	// var_dump(file_get_contents('php://input'));
	// die;
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

	function status($kode, $pesan)
	{
		$result['status']['code'] = $kode;
		$result['status']['description'] = $pesan;

		return $result;
	}

	// pengecekan metode request
	if($smethod == $smethod){

		 parse_str(file_get_contents("php://input"),$post_vars);
    	$id_customer = $post_vars['id_customer'];

		$sql = "DELETE FROM customer WHERE id_customer = '$id_customer'";
		$conn->query($sql);

		$result['status']['code'] = 200;
		$result['status']['description'] = "1 data DELETED";
		$result['result'] = array(
			"id_customer"=>$id_customer,
		);

	}else{
		$result['status']['code'] = 400;
	}


	echo json_encode($result);
?>

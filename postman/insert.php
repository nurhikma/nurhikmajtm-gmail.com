<?php 
    header('Content-Type: application/json');

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bukalapak";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $method = $_SERVER['REQUEST_METHOD'];
    $headers = apache_request_headers();
    $key = $headers['key'];

    $result = array();

    $nama_lengkap = $_POST['nama_lengkap'];
    $no_hp = $_POST['no_hp'];

    if ($method=='POST') {
            if (empty($key)) {
                $result['status']['code'] = 400;
                $result['status']['description'] = 'Error Headers';
            }
            else {

                $sql = "SELECT COUNT(id_customer) as jumlah FROM customer where id_customer = '$key'";
                $result1 = $conn->query($sql);
                $cek = $result1->fetch_assoc();

                   if ($cek['jumlah'] == 0) {
                        $result['status']['code'] = 400;
                        $result['status']['description'] = 'wrong token';            
                }
                else
                {    

                    $result['status']['code'] = 'success';
                    $result['status']['description'] = 'Request OK';
                    $sql = "INSERT INTO customer (nama_lengkap, no_hp) VALUES ('$nama_lengkap', '$no_hp');";
                    $conn->query($sql);
                    $result['results'] = '1 row inserted';
            }
                
        }
    }
        else{
            $result['status']['code'] = 400;
            $result['status']['description'] = 'Error Request';
        }

        echo json_encode($result);
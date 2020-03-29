<?php
header('Content-Type: application/json');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mahasiswa";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT id, nama, nim, email, alamat FROM mhs";
$result = $conn->query($sql);
$json = [];
$i = 1;
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
$json[$i] = [
'id' => $row["id"],
'nama' => $row["nama"],
'nim' => $row["nim"],
'email' => $row["email"],
'alamat' => $row["alamat"]
];
$i = $i + 1;
}
} else {
echo "0 results";
}
$conn->close();
$data = ['data' => $json];
$baru = json_encode($data,true);
print_r($baru)
?>
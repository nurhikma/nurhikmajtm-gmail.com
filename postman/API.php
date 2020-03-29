<?php
header('Content-Type: application/json');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bukalapak";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT id_customer, id_merchant, nama_lengkap, no_hp FROM customer";
$result = $conn->query($sql);
$json = [];
$i = 1;
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
$json[$i] = [
'id_customer' => $row["id_customer"],
'id_merchant' => $row["id_merchant"],
'nama_lengkap' => $row["nama_lengkap"],
'no_hp' => $row["no_hp"]
];
$i = $i + 1;
}
} else {
echo "0 results";
}
$conn->close();
$data = ['data' => $json];
echo json_encode($data);
?>
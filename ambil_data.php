<?php
include 'koneksi.php';

$query = "SELECT * FROM tbl_karyawan ORDER BY id DESC";
$dewan1 = $db1->prepare($query);
$dewan1->execute();
$res1 = $dewan1->get_result();

if ($res1->num_rows > 0) {
    while ($row = $res1->fetch_assoc()) {
  		$data[] = $row;
 	}
 	echo json_encode($data);
}
?>
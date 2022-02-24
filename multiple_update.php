<?php
include 'koneksi.php';

if(isset($_POST['hidden_id'])){
   $nama_lengkap =$_POST['nama_lengkap'];
   $alamat = $_POST['alamat'];
   $jenkel = $_POST['jenkel'];
   $jabatan = $_POST['jabatan'];
   $umur = $_POST['umur'];
   $id = $_POST['hidden_id'];

   for($count = 0; $count < count($id); $count++){
    $query = "UPDATE tbl_karyawan SET nama_lengkap=?, alamat=?, jenkel=?, jabatan=?, umur=? WHERE id=?";
    $dewan1 = $db1->prepare($query);
    $dewan1->bind_param('ssssii', $nama_lengkap[$count], $alamat[$count], $jenkel[$count], $jabatan[$count], $umur[$count], $id[$count]);
    $dewan1->execute();
   }
}
?>
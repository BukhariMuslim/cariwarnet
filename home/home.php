<?php
include("../options/config.php");

$par = "";
$query = "SELECT *, mbr_name AS wrnet_owner_nm FROM tblwarnet LEFT JOIN tblmember ON tblmember.mbr_id = tblwarnet.wrnet_owner ";

$isParExists = !empty($_GET["search"]);
if ($isParExists) {
	$par = $_GET["search"];
	$query .= "WHERE wrnet_name LIKE '%$par%' OR wrnet_kota LIKE '%$par%' OR wrnet_alamat LIKE '%$par%' ";
}

$hasil = mysql_query($query);
$jumlah = mysql_num_rows($hasil);	
?>
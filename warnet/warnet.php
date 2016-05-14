<?php
$prefix = "http://" . $_SERVER['HTTP_HOST'] . "/cariwarnet/";

$isLogin = !empty($sessionUsername);
$hasil = "";
$curId = "";
$isDetail = !empty($_GET["id"]);
if ($isDetail) {
	$curId = $_GET["id"];
}
$netId = $curId;
$editId = "";
$netName = "";
$netOwnerName = "";
$netKota = "";
$netAlamat = "";
$netImage = "";
$netImageNm = "";
$netPhone = "";
$isEdit = FALSE;

if (!$isLogin) {
    if ($isDetail) {
        include("../options/config.php");
        $query = "SELECT *, mbr_name AS wrnet_owner_nm FROM tblwarnet LEFT JOIN tblmember ON tblmember.mbr_id = tblwarnet.wrnet_owner WHERE wrnet_id = '$netId'";
		$hasil = mysql_query($query);
		$data = mysql_fetch_array($hasil);
		
		$count = mysql_num_rows($hasil);
		
		if ($count == 1)
		{
			$netName = $data["wrnet_name"];
			$netKota = $data["wrnet_kota"];
            $netOwnerName = $data["wrnet_owner_nm"];
            $netPhone = $data["wrnet_phone"];
			$netAlamat = $data["wrnet_alamat"];
			$netImageNm = $data["wrnet_img_nm"];
		}
    }
    else header("location:../home");
}
else {
    if (isset($_POST["name"])
        && isset($_POST["kota"])
        && isset($_POST["alamat"])
        && isset($_POST["phone"])
        ) {
        
        $netImage = "NULL";
        $netImageNm = "";
        $filename = "";
        
        if(isset($_FILES['gambar'])) {
        	try {
        		if (is_uploaded_file($_FILES['gambar']['tmp_name']) && getimagesize($_FILES['gambar']['tmp_name']) != false) {
        			$size = getimagesize($_FILES['gambar']['tmp_name']);
                    $filename = $_FILES['gambar']['tmp_name'];
        			/*** assign our variables ***/
        			$type = $size['mime'];
        			// $image = "'" . fopen($_FILES['gambar']['tmp_name'], 'rb') . "'";
                    $netImage = "'" . file_get_contents($filename) . "'";
                    // echo $image;
        			$dimension = $size[3];
        			$netImageNm = $_FILES['gambar']['name'];
        			$maxsize = 2097152;
        			
        			 /***  check the file is less than the maximum file size ***/
        			if($_FILES['gambar']['size'] < $maxsize ) {
        				
                    }
        			else {
        				/*** throw an exception is image is not of type ***/
        				throw new Exception("File Size Error");
        			}
        		}
        		else {
        			// if the file is not less than the maximum allowed, print an error
        			throw new Exception("Unsupported Image Format!");
        		}
        	}
        	catch(Exception $e) {
        		echo $e->getMessage();
        		echo 'Sorry, could not upload file';
        	}
        }
        
        $id = $_POST['id'];
        $isUpdate = !empty($id);
         
        $netName = $_POST['name'];
        $netKota = $_POST['kota'];
        $netAlamat = $_POST['alamat'];
        $netPhone = $_POST['phone'];
        
        $id = AvoidSI($id);
        $netName = AvoidSI($netName);
        $netKota = AvoidSI($netKota);
        $netAlamat = AvoidSI($netAlamat);
        $netImageNm = AvoidSI($netImageNm);
        $netPhone = AvoidSI($netPhone);
        
        // $dateLahir = strtotime($dateLahir);
        // $dateCheck = true;
        // $dateCheck = $dateCheck && !empty($dateLahir);
        // if($dateCheck) {
        //     $dateLahir = date("Y-m-d", $dateLahir);
        //     $dateCheck = !empty($dateLahir);
        // }
        
        if($dateCheck) {
		    include("../options/config.php");
            $query = "";
            if ($isUpdate) {
                $query = "UPDATE cariwarnet.tblwarnet SET " .
                            "wrnet_name = '$netName', " . 
                            "wrnet_kota = '$netKota', " .
                            "wrnet_alamat = '$netAlamat', " . 
                            "wrnet_img = " . (empty($filename) ? "NULL" : "'".  mysql_escape_string(file_get_contents($filename)) . "'") . ", " . 
                            "wrnet_img_nm = '$netImageNm' " . 
                            "WHERE wrnet_id = $id";
            }
            else {
                $query = "INSERT INTO tblmember (wrnet_id, wrnet_name, wrnet_kota, wrnet_alamat, wrnet_img, wrnet_img_nm, wrnet_phone) " .
					 "VALUES (NULL, '$netName', '$netKota', '$netAlamat', " . (empty($filename) ? "NULL" : "'".  mysql_escape_string(file_get_contents($filename)) . "'") . ", '$netImageNm', '$netPhone')";
            }
            $sql = mysql_query($query);
            if ($sql) {
                $sessionName = $name;
                header("location:../warnet?id=$id&success=1");
            }
            else header("location:../warnet?id=$id&success=2");
        }
        else header("location:../warnet?id=$id&success=3");
    }
    else if (!empty($_GET["add"])) {
        $isEdit = TRUE;
        $isDetail = TRUE;
        $netOwnerName = $sessionName;
    }
	else if ($isDetail) {
		include("../options/config.php");
        if (!empty($_GET["del"])) {
            $query = "DELETE FROM tblwarnet LEFT JOIN tblmember ON tblmember.mbr_id = tblwarnet.wrnet_owner WHERE wrnet_id = '$netId' AND wrnet_owner = '$sessionId' ";
            $hasil = mysql_query($query);
            if ($hasil) {
                header("location:../warnet?id=$id&success=4");
            }
            else header("location:../warnet?id=$id&success=5");
        }
        else {
            $query = "SELECT *, mbr_name AS wrnet_owner_nm FROM tblwarnet LEFT JOIN tblmember ON tblmember.mbr_id = tblwarnet.wrnet_owner WHERE wrnet_id = '$netId' AND wrnet_owner = '$sessionId' ";
            $isEdit = !empty($_GET["edit"]);
            $hasil = mysql_query($query);
            $data = mysql_fetch_array($hasil);
            
            $count = mysql_num_rows($hasil);
            
            if ($count == 1)
            {
                $netName = $data["wrnet_name"];
                $netKota = $data["wrnet_kota"];
                $netOwnerName = $data["wrnet_owner_nm"];
                $netAlamat = $data["wrnet_alamat"];
                $netImageNm = $data["wrnet_img_nm"];
            }
            else header("location:../");
        }
	}
	else {
        include("../options/config.php");
        $query = "SELECT *, mbr_name AS wrnet_owner_nm FROM tblwarnet LEFT JOIN tblmember ON tblmember.mbr_id = tblwarnet.wrnet_owner WHERE wrnet_owner = '$sessionId' ";
		$hasil = mysql_query($query);
    }
}
?>
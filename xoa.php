<?php 
	include('lib\server.php');

	$ma=isset($_GET['macn'])?$_GET['macn']:'';
	$sql="DELETE from retailer where id='$ma'";
	$stm=$conn->query($sql);

	echo '<script language="javascript">alert("Xóa thành công!"); window.location="chinhanh.php";</script>';

 ?>
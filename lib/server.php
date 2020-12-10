<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
// initializing variables
$username = "";
$email    = "";
$Name="";
$password_1="";
$password_2="";
$date=date('y-m-d H:i:s');

require_once("connection.php");

function postIndex($e){
	return isset($_POST[$e])?$_POST[$e]:'';
}
// REGISTER USER
if (isset($_POST['reg_user'])) {
// receive all input values from the form
$username = $_POST['username'];
$email = $_POST['email'];
$name= $_POST['name'];
$password_1 = $_POST['password_1'];
$password_2 = $_POST['password_2'];
$admin=$_POST['op'];
if (!$username || !$password_1 || !$password_2 || !$email || !$name){
echo '<script language="javascript">alert("Vui lòng nhập đầy đủ thông tin!"); window.location="register.php";</script>';
exit;
}
if ($password_1 != $password_2) {
echo '<script language="javascript">alert("Mật khẩu không trùng khớp"); window.location="register.php";</script>';
exit;
}
//Kiểm tra password
$password_check='/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/';
if(!preg_match($password_check, $password_1)){
echo '<script language="javascript">alert("password không hợp lệ!"); window.location="register.php";</script>';
exit;
}
$password = md5($password_1);
//Kiểm tra email
$email_check='#^[a-z][a-z0-9\._]{2,31}@[a-z0-9\-]{3,}(\.[a-z]{2,4}){1,2}$#';
if(!preg_match($email_check, $email)){
echo '<script language="javascript">alert("Email không hợp lệ!"); window.location="register.php";</script>';
exit;
}
//Kiểm tra username
$username_check='/^[a-z0-9_\.]{6,32}$/';
if(!preg_match($username_check, $username)){
echo '<script language="javascript">alert("username không hợp lệ!"); window.location="register.php";</script>';
exit;
}

$user_check_query =$conn->prepare("SELECT * FROM users WHERE username=:username OR email=:email");
$user_check_query->setFetchMode(PDO::FETCH_ASSOC);
$user_check_query->execute(array('username'=>$username,'email'=>$email));

while ($user=$user_check_query->fetch()) {
if ($user['username'] === $username) {

echo '<script language="javascript">alert("Tên đăng nhập này đã có người dùng. Vui lòng chọn tên đăng nhập khác"); window.location="register.php";</script>';
exit;
}
if ($user['email'] === $email) {
// array_push($errors, "email already exists");
echo '<script language="javascript">alert("Email này đã có người dùng. Vui lòng chọn Email khác."); window.location="register.php";</script>';
exit;
}
}
$query =$conn->prepare ("INSERT INTO users (username, email, password,fullname,createdate,admin) VALUES(?,?,?,?,?,?)");

$query->bindParam(1, $username);
$query->bindParam(2, $email);
$query->bindParam(3, $password);
$query->bindParam(4, $name);
$query->bindParam(5, $date);
$query->bindParam(6, $admin);
if($query->execute()){
echo '<script language="javascript">alert("Đăng ký thành công! Vui lòng đăng nhập."); window.location="index.php";</script>';
}
}
//LOGIN
if (isset($_POST['log_user'])){
$usernamelg = $_POST['usernamelg'];
$passwordlg_m = $_POST['passwordlg'];
if(!$usernamelg || !$passwordlg_m){
echo '<script language="javascript">alert("Vui lòng nhập đầy đủ thông tin!!"); window.location="index.php";</script>';
exit;
}
else{
$passwordlg = md5($passwordlg_m);
$sql = "SELECT * FROM users WHERE (username=:username OR email=:email) AND password=:password";
$query = $conn->prepare($sql);
$query->setFetchMode(PDO::FETCH_ASSOC);
$query->execute(array('username'=>$usernamelg,'email'=>$usernamelg,'password'=>$passwordlg));
while ($user=$query->fetch()) {

if ($user['username'] === $usernamelg || $user['email']===$usernamelg ){
if($user['password']===$passwordlg) {
	$name=$user['fullname'];
  $_SESSION['username'] = $name;
  $_SESSION['id-us']=$user['id'];
    $_SESSION['admin']=$user['admin'];
	if($user['admin']==0){
  $_SESSION['logged'] = true;
  
echo '<script language="javascript">alert("Đăng nhập nhân viên thành công! "); window.location="trangnv.php";</script>';
}
else{
  $_SESSION['logged'] = true;

echo '<script language="javascript">alert("Đăng nhập quản lý thành công! "); window.location="trangadmin.php";</script>';
}
}
}
if(($user['username'] != $usernamelg || $user['email']!=$usernamelg)||$user['password']!=$passwordlg) {
echo '<script language="javascript">alert("Username or password is not correct!! vui lòng nhập lại"); window.location="index.php";</script>';
exit;
}

}

}
}

//DOI MAT KHAU
if(isset($_POST['doimk'])){
	$mkcu=md5(postIndex('mkcu'));
	$mkmoi=postIndex('mkmoi');
	$mkmoixn=postIndex('mkmoi2');
	$id=$_SESSION['id-us'];
	$query=$conn->query("SELECT password FROM users where id='$id'");
	$data=$query->fetchAll(PDO::FETCH_ASSOC);
	foreach ($data as $key => $value) {
		$pass=$value['password'];
		break;
	}
	if($mkcu!=$pass){
		echo '<script language="javascript">alert("Password is not correct!! vui lòng nhập lại"); window.location="doimk.php";</script>';
		exit;
	}
	if ($mkmoi != $mkmoixn) {
	echo '<script language="javascript">alert("Mật khẩu không trùng khớp"); window.location="doimk.php";</script>';
	exit;
	}
	//Kiểm tra password có 1 từ viết hoa từ 5-31 ký tự
	$password_check='/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/';
	if(!preg_match($password_check, $mkmoi)){
	echo '<script language="javascript">alert("password không hợp lệ!"); window.location="doimk.php";</script>';
	exit;
	}
	$mk = md5($mkmoi);
	$query =$conn->prepare ("UPDATE users set password='$mk'where id='$id'");
    $query->execute();
    echo '<script language="javascript">alert("Đổi mật khẩu thành công! Vui lòng đăng nhập lại"); window.location="index.php";</script>';


}


///Them phieu nhap
if (isset($_POST['them'])) {
// receive all input values from the form
$arrncc=[
$ten=postIndex('ncc'),
$ncc=postIndex('email'),
$dc=postIndex('dc'),
$dt=postIndex('dt'),
];
$arrpn=[
$mapn=postIndex('mapn'),
$nv=postIndex('nv'),
$ten,
$dc,
$dt,
$date,
$date
];
$kt=$conn->query("SELECT id_im from import where id_im='$mapn'");
$ktp=$kt->fetchAll(PDO::FETCH_ASSOC);
foreach($ktp as $key => $value){
if($mapn==$value['id_im']){
    echo '<script language="javascript">alert("Đã có mã đơn này"); window.location="Nhappn.php";</script>';
	exit;
}
}

$query=$conn->query("SELECT * FROM distributor where email='$ncc'");
$data=$query->fetchAll(PDO::FETCH_ASSOC);
if(!empty($data)){
foreach ($data as $key => $value) {
		if ($ncc==""||$mapn==""){
		echo '<script language="javascript">alert("Điền đủ thông tin"); window.location="Nhappn.php";</script>';
		exit;
		}
		$email_check='#^[a-z][a-z0-9\._]{2,31}@[a-z0-9\-]{3,}(\.[a-z]{2,4}){1,2}$#';
		if(!preg_match($email_check, $ncc)){
		echo '<script language="javascript">alert("Email không hợp lệ!"); window.location="Nhappn.php";</script>';
		exit;
		}
		$arrpn=[
			$mapn=postIndex('mapn'),
			$nv=postIndex('nv'),
			$value['distributor_name'],
			$value['address'],
			$value['phone'],
			$date,
			$date
		];	
		$sql="INSERT INTO import (id_im,user_id,distributor_name,address_im,phone_im,createdate,updatedate) VALUES (?,?,?,?,?,?,?)";
		$query=$conn->prepare($sql);
		if($query->execute($arrpn)){
			$_SESSION['id']=$mapn;
			$_SESSION['ncc']=$ncc;
			header("location:nhapct.php");
		}else{echo "Lỗi";}
		//}

	}

}else{
	if ($ten="" || $dc=="" || $dt==""){
		echo '<script language="javascript">alert("Email không có trong hệ thống, nhập thông tin chi tiết để cập nhật"); window.location="Nhappn.php";</script>';
		exit;
		}
		$email_check='#^[a-z][a-z0-9\._]{2,31}@[a-z0-9\-]{3,}(\.[a-z]{2,4}){1,2}$#';
		if(!preg_match($email_check, $ncc)){
		echo '<script language="javascript">alert("Email không hợp lệ!"); window.location="Nhappn.php";</script>';
		exit;
		}
		$sql="INSERT INTO distributor (distributor_name,email,address,phone) VALUES (?,?,?,?)";
		$dis=$conn->prepare($sql);
		if($dis->execute($arrncc)){
			$sql2="INSERT INTO import (id_im,user_id,distributor_name,address_im,phone_im,createdate,updatedate) VALUES (?,?,?,?,?,?,?)";
			$query=$conn->prepare($sql2);
				if($query->execute($arrpn)){
					$_SESSION['id']=$mapn;
					$_SESSION['ncc']=$ncc;
				header("location:nhapct.php");
			}else{echo "Lỗi";}
}
}
}

//Thêm phiếu xuất
if (isset($_POST['thempx'])) {

// receive all input values from the form

$tench=postIndex('ch');
$dc=postIndex('dc');
$dt=postIndex('dt');
$id=postIndex('mapx');
$nv=postIndex('nv');
$ch=postIndex('email');


$kt=$conn->query("SELECT id_ex from export where id_ex='$id'");
$ktp=$kt->fetchAll(PDO::FETCH_ASSOC);
foreach($ktp as $key => $value){
if($id==$value['id_ex']){
    echo '<script language="javascript">alert("Đã có mã đơn này"); window.location="nhappx.php";</script>';
	exit;
}
}

$query=$conn->query("SELECT * FROM retailer where email='$ch'");
$data=$query->fetchAll(PDO::FETCH_ASSOC);
if(!empty($data)){
foreach ($data as $key => $value) {

		if (!$ch||!$id){
		echo '<script language="javascript">alert("Điền đủ thông tin"); window.location="nhappx.php";</script>';
		exit;
		}
		$email_check='#^[a-z][a-z0-9\._]{2,31}@[a-z0-9\-]{3,}(\.[a-z]{2,4}){1,2}$#';
		if(!preg_match($email_check, $ch)){
		echo '<script language="javascript">alert("Email không hợp lệ!"); window.location="nhappx.php";</script>';
		exit;
		}
		
			$retailer_id=$value['id'];
			$tench=$value['name'];
			$dc=$value['address'];
			$dt=$value['phone'];

		$sql="INSERT INTO export (id_ex,user_id,retailer_id,retailer_name,address_ex,phone_ex,createdate,updatedate) VALUES ('$id','$nv','$retailer_id','$tench','$dc','$dt','$date','$date')";
		$query=$conn->prepare($sql);
		if($query->execute()){
			$_SESSION['id']=$id;
			$_SESSION['ch']=$ch;
			header("location:nhapctpx.php");
		}else{echo "Lỗi";}
		//}

	}

}
else{
	if (!$tench||!$ch||!$dt||!$dc||!$id){
		echo '<script language="javascript">alert("Email không có trong hệ thống, nhập thông tin chi tiết để cập nhật"); window.location="nhappx.php";</script>';
		exit;
		}
		$email_check='#^[a-z][a-z0-9\._]{2,31}@[a-z0-9\-]{3,}(\.[a-z]{2,4}){1,2}$#';
		if(!preg_match($email_check, $ch)){
		echo '<script language="javascript">alert("Email không hợp lệ!"); window.location="nhappx.php";</script>';
		exit;
		}
		$sql="INSERT INTO retailer (name,email,address,phone) VALUES ('$tench','$ch','$dc','$dt')";
		$dis=$conn->prepare($sql);
		$retailer_id=$value['id'];
		if($dis->execute()){
			$sql2="INSERT INTO export (id_ex,user_id,retailer_id,retailer_name,address_ex,phone_ex,createdate,updatedate) VALUES ('$id','$nv','$retailer_id','$tench','$dc','$dt','$date','$date')";
			$query=$conn->prepare($sql2);
				if($query->execute()){
					$_SESSION['id']=$id;
					$_SESSION['ch']=$ch;
				header("location:nhapctpx.php");
			}else{echo "Lỗi";}
			}else{echo "Lỗi";}
}
}

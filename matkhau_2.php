<?php include('lib\server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ĐĂNG NHẬP - QUẢN LÝ KHO</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
	
     <div class="container">
<div class="row justify-content-center">  
	<div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="text-align: center;background-color: black;color: white"><b>Đổi mật khẩu</b></div>
                    <div class="card-body">
                         <form class="form-horizontal" method="Post" action="matkhau_2.php?mod=user&ac=dosendmail">
						
                                     <div class="form-group">
                                        <label for="password_1" class="cols-sm-2 control-label">New Password:</label>
                                        <div class="cols-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                                <input type="email" class="form-control" name="email"  placeholder="Enter your email" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group ">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block login-button" name="log_reset" style="background-color: black">Gửi mail</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>s
</div>
<?php
$ac=isset($_GET['ac'])?$_GET['ac']:'';


if ($ac=="dosendmail")
{
        //sử dụng để load thư viện 
        $email=$_REQUEST["email"];
        $passmoi=rand();
        $query =$conn->prepare ("SELECT email from users where email='$email'");
        $query->execute();
        $row=$query->fetchAll(PDO::FETCH_ASSOC);
        if($row!=""){
        include ("PHPMailer\PHPMailerAutoload.php");
        $mail = new PHPMailer();
        $mail->IsSMTP(); // set mailer to use SMTP
        $mail->Host = "smtp.gmail.com"; // specify main and backup server
        $mail->Port = 465; // set the port to use
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->SMTPSecure = 'ssl';
        $mail->Username = "lings2709@gmail.com"; //Địa chỉ gmail sử dụng để gửi email
        $mail->Password = "Giale123456789"; // your SMTP password or your gmail password
        $from = "giale4545@gmail.com"; // Khi người sử dụng bấm reply sẽ gửi đến email này
        $to=$email; // Email người nhận (email thực)
        $name="New Password"; // Tên người nhận
        $mail->From = $from;
        $mail->FromName = "Manager"; // Tên người gửi 
        $mail->AddAddress($to,$name);
        $mail->AddReplyTo($from,"Suport");
        $mail->WordWrap = 50; // set word wrap
        $mail->IsHTML(true); // send as HTML
        $mail->Subject = "Reset password";
        $mail->Body = "mật khẩu mới .". $passmoi ;
        $mail->SMTPDebug = 2;//Hiện debug lỗi. Mặc định sẽ tắt lỗi này

        if($mail->Send()){
            $passmoimh=md5($passmoi);
            $query =$conn->prepare ("UPDATE users set password='$passmoimh' where email='$email'");
            $query->execute();
            echo '<script language="javascript">alert("Gửi mail thành công!"); window.location="index.php";</script>';
        }
        }
        else{
            echo "<h3>Mail chưa được đăng ký</h3>";
        }
}

// if($ac=="finish")
// {
//  echo "Thong bao";  
// }
?>
	
	
</body>
</html>
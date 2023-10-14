<?php
//connert database
include ('./includes/connect_database.php');
session_start();

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
function send_password_reset($get_name,$get_email,$token)
{
$mail = new PHPMailer(true);
 //Server settings
// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
 $mail->isSMTP();                                            //Send using SMTP
 $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
 $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
 $mail->Username   = 'uitcarshop@gmail.com';                     //SMTP username
 $mail->Password   = 'joucvfymmvauhjxm';                               //SMTP password
 $mail->SMTPSecure = "tls"; //PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
 $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

 //Recipients
 $mail->setFrom('uitcarshop@gmail.com', $get_name);
 //$mail->addAddress('joe@example.net', );     //Add a recipient
 $mail->addAddress($get_email);               //Name is optional
 //$mail->addReplyTo('info@example.com', 'Information');
 //$mail->addCC('cc@example.com');
 //$mail->addBCC('bcc@example.com');

 //Attachments
 //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
 //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

 //Content
 $mail->isHTML(true);                                  //Set email format to HTML
 $mail->Subject = 'Reset password';
 
$mail_tempalde="
<h5>Thông báo</h5>  
<p>Bạn đã yêu cầu đặt lại mật khẩu. Vui lòng nhấn vào link bên dưới để đặt lại mật khẩu</P>  
<a href='http://localhost:8080/UITMotorcycle/UITMotorcycle-Solution/password_change.php?token=$token&email=$get_email'>Nhấn vào đây để đặt lại mật khẩu</a>";
$mail->Body=$mail_tempalde;
 $mail->send();
}

if(isset($_POST['password_reset_link']))
{
    if($_POST['email'] == '')
    {
        $_SESSION['status']="Vui lòng điền đầy đủ thông tin";
        header("Location:password_reset.php");
        exit(0);
    }
    else
    {
        $email=mysqli_real_escape_string($con, $_POST['email']);
        $token=md5(rand());
        $check_email="select * from `taikhoan` where email='$email' limit 1";
        $check_email_query=mysqli_query($con,$check_email);
      var_dump( mysqli_num_rows($check_email_query));
        if(mysqli_num_rows($check_email_query)>0)
        {
            $row=mysqli_fetch_array($check_email_query);
           $get_name=$row['tendangnhap'];
            $get_email=$row['email'];
            
            $update_password="update `taikhoan` set matkhau='$token' where email='$get_email' limit 1";
            $update_password_run=mysqli_query($con,$update_password);
            if($update_password_run)
            {
                send_password_reset($get_name,$get_email,$token);
                $_SESSION['status']="Chúng tôi đã gửi link đặt lại mật khẩu đến email của bạn <a href='https://mail.google.com/'>nhấn vào đây để đi đến gmail</a>";
                header("Location:password_reset.php");
                exit(0);
            }
            else
            {
                $_SESSION['status']="Đã có lỗi xảy ra";
                header("Location:password_reset.php");
                exit(0);
               // echo "co loi";
            }
        }
        else
        {
            $_SESSION['status']="Không thể tìm thấy email";
            header("Location:password_reset.php");
            exit(0);
           // echo "k tim thay email";
        }
    }
    
}

if(isset($_POST['password_update']))
{
    
    $email=mysqli_real_escape_string($con, $_POST['email']);
    $new_password=mysqli_real_escape_string($con, $_POST['new_password']);
    $confirm_password=mysqli_real_escape_string($con, $_POST['confirm_password']);
    $token=mysqli_real_escape_string($con, $_POST['password_token']);
    if($token!='')
    {
        if($email=='' or $new_password=='' or  $confirm_password=='')
        {
            $_SESSION['status']="Vui lòng điền đầy đủ thông tin";
            header("Location:password_change.php");
            exit(0);
        }
        else
        {
            $check_token="select * from `taikhoan` where matkhau='$token'";
            $check_token_query=mysqli_query($con, $check_token);
            if(mysqli_num_rows($check_token_query)>0)
            {
                if($new_password==$confirm_password)
                {
                    $confirm_password=password_hash($confirm_password,PASSWORD_DEFAULT);
                    $update_password="update taikhoan set matkhau='$confirm_password' where matkhau='$token' limit 1";
                    $update_password_run=mysqli_query($con, $update_password);
                    if($update_password_run)
                    {
                       // echo "thành công";
                        $_SESSION['status']="Thành công";
                        header("Location:signin.php");
                        exit(0);
                    }
                    else
                    {
                       // echo "có lỗi ???";
                        $_SESSION['status']="Đã có lỗi xảy ra";
                        header("Location:password_change.php");
                        exit(0);
                    }
                }
                else
                {
                   // echo "mật khẩu không khớp";
                    $_SESSION['status']="Mật khẩu không khớp";
                    header("Location:password_change.php");
                    exit(0);
                }
            }
            else
            {
                $_SESSION['status']="Đã có lỗi xảy ra";
                header("Location:password_change.php");
                exit(0);
            }
        }
    }
    else
    {
        $_SESSION['status']="Vui lòng điền đầy đủ thông tin";
        header("Location:password_change.php");
        exit(0);
    }
}
?>
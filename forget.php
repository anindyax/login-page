<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
// $connection = new mysqli("localhost","root","","login_register_pure_coding");
include 'config.php';

if($_POST)
{
    $email = $_POST['email'];
    $selectquery = mysqli_query($conn ,"select * from users where email='{$email}'") or die(mysqli_error($conn));
    $count = mysqli_num_rows($selectquery);
    
    if ($count>0)
    {
        //echo $row['st_password'];

        //Lord composer's autoloader 
        require 'vendor/autoload.php';

        $mail = new PHPMailer(true);
        try {
             //server settings
             $mail->SMTPDebug = 0;
             $mail->isSMTP();
             $mail->Host = 'smtp.gmail.com';
             $mail->SMTPAuth = true;
             $mail->Username = 'spa.cambay@gmail.com';
             $mail->Password = 'abc@123456789';
             $mail->SMTPSecure = 'tls';
             $mail->Port = 587;

             //recipients
             $mail->setFrom('spa.cambay@gmail.com', 'Spa Demo');
             $mail->addAddress($email, $email);

             //content
             $mail->isHtml(true);
             $mail->Subject = 'Forget Password';
             $mail->Body    = "Hi $email your password is {$row['password']}";
             $mail->AltBody = "Hi $email your password is {$row['password']}";

             $mail->send();
             echo 'Your Password has been sent on your Email ID.';

        }  catch (Exception $e){
            echo 'Email could not be sent.';
            echo 'Mailker Error: ' . $mail->ErrorInfo;
        }

    }
    else
    {
        echo "<script>alert('Email Not Found');</script>";
    }
}

?>
<html>
    <body>
        <form method="POST">
            Email : <input type="email" name="email">
            <br/>
            <input type="submit">
        </form>
    </body>
</html>
<?php
 
    require ("class.phpmailer.php");

 
    if(isset($_POST['submit'])){
        $name=$_POST['name']; // Get Name value from HTML Form
        $mobile=$_POST['mobile'];  // Get Mobile No
        $email=$_POST['email'];  // Get Email Value
        $message=$_POST['message']; // Get Message Value

if (isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != "") {
			$file = "attachment/" . basename($_FILES['attachment']['name']);
			move_uploaded_file($_FILES['attachment']['tmp_name'], $file);
		} else
			$file = "";
        $mail = new PHPMailer();
         
        //$mail->IsSMTP();
        $mail->Host = "local host"; // Your Domain Name
         
        $mail->SMTPAuth = true;
        $mail->Port = 465;
        $mail->Username = "blackthuthu@gmail.com"; // Your Email ID
        $mail->Password = "7sepehAT"; // Password of your email id
         
        $mail->From = "info@web.com";
        $mail->FromName = "Lean Thicker";
        $mail->AddAddress ("info@web.com"); // On which email id you want to get the message
        $mail->AddCC ($email);
         $mail->addAttachment($file);
        $mail->IsHTML(true);
         
        $mail->Subject = "Lean submitted by $name"; // This is your subject
         
        // HTML Message Starts here
         
        $mail->Body = "
        <html>
            <body>
                <table style='width:600px;'>
                    <tbody>
                        <tr>
                            <td style='width:150px'><strong>Name: </strong></td>
                            <td style='width:400px'>$name</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Email ID: </strong></td>
                            <td style='width:400px'>$email</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Mobile No: </strong></td>
                            <td style='width:400px'>$mobile</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Message: </strong></td>
                            <td style='width:400px'>$message</td>
                        </tr>
                    </tbody>
                </table>
            </body>
        </html>
        ";
        // HTML Message Ends here
         
             
        
		if ($mail->send())
		    $msg = "Submitted successfully, thank you!";
		else
		    //$msg = "Please try again!";
            echo $mail-> ErrorInfo;
        
 
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> <!--320-->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
    <title>Contact Form</title>
<link rel="stylesheet" href="mystyle.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
  <div id="wrapper" style="width:360px;
    margin:20px auto;
    padding:20px;
    border-radius: 5px 5px 0 0;
    box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.3), 0 0 5px rgba(0, 0, 0, .3);
    border: 1px solid #6f212f;">
	<div class="container" style="margin-top: 50px">
		<div class="row justify-content-center">
			<div class="col-md-6 col-md-offset-3" align="center">
				<img src="images/magnalogo.jpeg" style="width:100px; height:100px; margin-top: -70px;"><br><br>

                <?php if ($msg != "") echo "<p style='color: #5cb85c; '>"."$msg<br><br>"; ?>

				<form  method="post" action="sendmail.php" enctype="multipart/form-data">
				<input class="form-control" name="name" placeholder="Subject..."><br>
				<input class="form-control" name="email" type="email" placeholder="Email..."><br>
				<input class="form-control" name="mobile" required="required" type="text" placeholder="Enter Mobile No"/><br>
				<textarea placeholder="Message..." class="form-control" name="message"></textarea><br>
				<input class="form-control" type="file" name="attachment"><br>
				<input class="btn btn-primary btn-lg btn-block" name="submit" type="submit" value="Submit">
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<head>
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Robotizia</title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
  <link href="../plugins/material/css/materialdesignicons.min.css" rel="stylesheet" />
  <link href="../plugins/simplebar/simplebar.css" rel="stylesheet" />

  <!-- PLUGINS CSS STYLE -->
  <link href="../plugins/nprogress/nprogress.css" rel="stylesheet" />
  
  <!-- Robotizia CSS -->
  <link id="main-css-href" rel="stylesheet" href="../css/style.css" />

  


  <!-- FAVICON -->
  <link href="../images/Logo_Robotizia.png" rel="shortcut icon" />

  <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="../plugins/nprogress/nprogress.js"></script>
</head>
<body class="bg-light-gray" id="body" style="background-image: url('../images/page.png'); height: 100%; background-position: center;
background-repeat: no-repeat; background-size: cover;">
          <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh">
          <div class="d-flex flex-column justify-content-between">
            <div class="row justify-content-center mt-5">
              <div class="col-md-10">
                <div class="card card-default">
                  <div class="card-header">
                    <div class="app-brand w-100 d-flex justify-content-center border-bottom-0">
                      <a class="w-auto pl-0" href="ressetpass.php">
                      <img src="../images/Logo_Robotizia.png" alt="Robotizia">
                        <span class="brand-name text-dark"></span>
                      </a>
                    </div>
                  </div>
                  <div class="card-body p-5">
                    <h4 class="text-dark mb-5">Reset Your Password</h4>
                    <form action="#" method="POST" name="recover_psw">
                      <div class="row">
                        <div class="form-group col-md-12 mb-4">
                          <input type="email" id="email_address" class="form-control input-lg" name="email" aria-describedby="nameHelp" placeholder="Email">
                        </div>

                        <div class="col-md-12">
                          <button type="submit" class="btn btn-primary btn-pill mb-4" value="Recover" name="recover">Submit</button>

                          <p>Already have an account?
                            <a class="text-blue" href="sign-in.php">Sign in</a>
                          </p>
                        </div>
                      </div>
                    </form>

                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

</body>
</html>

<?php 
    if(isset($_POST["recover"])){
        include('connect/connection1.php');
        $email = $_POST["email"];

        $sql = mysqli_query($connect, "SELECT * FROM login_user WHERE email='$email'");
        $query = mysqli_num_rows($sql);
  	    $fetch = mysqli_fetch_assoc($sql);

        if(mysqli_num_rows($sql) <= 0){
            ?>
            <script>
                alert("<?php  echo "Sorry, no emails exists "?>");
            </script>
            
           <?php
        }else{
            // generate token by binaryhexa 
            $token = bin2hex(random_bytes(50));

            session_start ();
            $_SESSION['token'] = $token;
            $_SESSION['email'] = $email;

            require "Mail/phpmailer/PHPMailerAutoload.php";
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->Port=587;
            $mail->SMTPAuth=true;
            $mail->SMTPSecure='tls';

            // h-hotel account
            $mail->Username='Contact.robotizia@gmail.com';
            $mail->Password='ooneajfravnsfsir';

            // send by h-hotel email
            $mail->setFrom('Contact.robotizia@gmail.com', 'Password Reset');
            // get email from input
            $mail->addAddress($_POST["email"]);
            //$mail->addReplyTo('lamkaizhe16@gmail.com');

            // HTML body
            $mail->isHTML(true);
            $mail->Subject="Recover your password";
            $mail->Body="<b>Dear User</b>
            <h3>We received a request to reset your password.</h3>
            <p>Kindly click the below link to reset your password</p>
            https://trobotizia.herokuapp.com/mono/reset/reset_psw.php
            <br><br>
            <p>With regrads,</p>
            <b>Robotizia Team</b>";

            if(!$mail->send()){
                ?>
                    <script>
                        alert("<?php echo " Invalid Email "?>");
                    </script>
                <?php
            }else{
                ?>
                    <script>
                        window.location.replace("notification.html");
                    </script>
                <?php
            }
        }
    }


?>

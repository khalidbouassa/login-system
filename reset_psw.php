<?php session_start() ;
include('connect/connection1.php');
?>
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
                  <h4 class="text-dark mb-5"><center>Reset Your Password </center></h4>
                    <div class="card-body">
                        <form action="#" method="POST" name="login">

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="password" required autofocus>
                                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                                </div>
                            </div>

                          
                                <button type="submit" class="btn btn-primary btn-pill mb-4" name="reset">Reset</button>
  </form>  
                    </div>
                    </div>
                </div>
              </div>
            </div>

          </div>
        </div>

</body>
</html>
<?php
    if(isset($_POST["reset"])){
        include('connect/connection1.php');
        $psw = $_POST["password"];

        $token = $_SESSION['token'];
        $Email = $_SESSION['email'];
        
        $options = ['cost' => 12, ];

        $hash = password_hash($psw,PASSWORD_BCRYPT, $options);

        $sql = mysqli_query($connect, "SELECT * FROM `login_user` WHERE email='$Email'");
        $query = mysqli_num_rows($sql);
  	    $fetch = mysqli_fetch_assoc($sql);

        if($Email){
            $new_pass = $hash;
            mysqli_query($connect, "UPDATE `login_user` SET user_password='$new_pass' WHERE email='$Email'");
            ?>
            <script>
                window.location.replace("../sign-in.php");
                alert("<?php echo "your password has been succesful reset"?>");
            </script>
            <?php
        }else{
            ?>
            <script>
                alert("<?php echo "Please try again"?>");
            </script>
            <?php
        }
    }

?>
<script>
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    toggle.addEventListener('click', function(){
        if(password.type === "password"){
            password.type = 'text';
        }else{
            password.type = 'password';
        }
        this.classList.toggle('bi-eye');
    });
</script>

<!DOCTYPE html>
<html lang="en">
<?php session_start();

include('conexao.php');

if(isset($_SESSION['username'])){
    header("Location: index.php");
}
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Progress Fit - Registar</title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/ionicons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/simple-line-icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/jquery.mCustomScrollbar.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet">
</head>

<body class="bg_darck">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
       
            <div class="login-content">
                <div class="logo">
                    <a href="#">
                        <strong class="logo_icon">
                            <img  src="assets/images/small-logo.png" alt="">
                        </strong>
                        <span class="logo-default">
                            <img src="assets/images/logo.png" alt="">
                        </span>
                    </a>
                </div>
                <div class="login-form">
                    <form method="POST" action="" name="frmregistar">
                    <?php include('cdregisto.php'); ?>
                        
                    <div class="form-group" >
                            <label>Nome</label>
                            <input type="text" class="form-control" placeholder="Nome" name="nome">
                        </div>
                        <div class="form-group" >
                            <label>Username</label>
                            <input type="text" class="form-control" placeholder="Username" name="username">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <div class="form-group">
                            <label>Confirmar Password</label>
                            <input type="password" class="form-control" placeholder="Confirmar Password" name="confirmapass">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="termos"> Concordo com os termos de política e privacidade
                            </label>
                        </div>
                        <button type="submit" class="btn btn-success btn-round m-b-30 m-t-30" name="submit" >Registar</button>
                        
                        <div class="register-link m-t-15 text-center">
                            <p>Já tem uma conta ?
                                <a href="login.php"> Fazer Login</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/custom.js" type="text/javascript"></script>
</body>

</html>

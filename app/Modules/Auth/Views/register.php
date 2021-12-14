<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $title; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="<?= base_url('public/template/auth'); ?>/images/icons/favico.png"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/template/auth'); ?>/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/template/auth'); ?>/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/template/auth'); ?>/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/template/auth'); ?>/vendor/animate/animate.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/template/auth'); ?>/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/template/auth'); ?>/vendor/select2/select2.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/template/auth'); ?>/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/template/auth'); ?>/css/main.css">
<!--===============================================================================================-->
</head>
<body>
    
    <div class="limiter">
        <div class="container-login100" style="background-image: url('<?= base_url('public/template/auth'); ?>/images/img-01.jpg');">
            <div class="wrap-login100 p-t-30 p-b-30">
                <form class="login100-form validate-form" method="post" action="<?= base_url('auth/save'); ?>">
                    <div class="login100-form-avatar">
                        <img src="<?= base_url('public/template/auth'); ?>/images/avatar.png" alt="AVATAR">
                    </div>

                    <span class="login100-form-title p-t-20 p-b-15">
                        Aplikasi E-Arsip
                    </span>

                    <div class="wrap-input100 validate-input m-b-10" data-validate = "nama lengkap belum diisi">
                        <input class="input100" type="text" name="nama_lengkap" placeholder="Nama Lengkap">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user-o" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-10" data-validate = "Username belum diisi">
                        <input class="input100" type="text" name="username" placeholder="Username">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user"></i>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-10" data-validate = "Email belum diisi">
                        <input class="input100" type="text" name="email" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-10" data-validate = "Ulangi password belum diisi">
                        <input class="input100" type="password" name="password2" placeholder="Ulangi password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn p-t-10">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>

                    <div class="text-center w-full p-t-25 p-b-10">
                        <!-- <a href="#" class="txt1">
                            Forgot Username / Password?
                        </a> -->
                    </div>

                    <div class="text-center w-full">
                        <a class="txt1" href="<?= base_url('auth'); ?>" title="register">
                            <i class="fa fa-long-arrow-left"></i>                      
                        </a>
                        <span class="txt1">Sudah punya akun ? </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    

    
<!--===============================================================================================-->  
    <script src="<?= base_url('public/template/auth'); ?>/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="<?= base_url('public/template/auth'); ?>/vendor/bootstrap/js/popper.js"></script>
    <script src="<?= base_url('public/template/auth'); ?>/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="<?= base_url('public/template/auth'); ?>/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="<?= base_url('public/template/auth'); ?>/js/main.js"></script>

</body>
</html>

<link href="<?= base_url('public/template/auth/css/bootstrap.min.css'); ?>" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="<?= base_url('public/library'); ?>/jquery-toast/jquery.toast.min.css">
<!-- <script src="<?= base_url('public/template/auth/js/bootstrap.min.js'); ?>"></script> -->
<script src="<?= base_url('public/template/auth/js/jquery.min.js'); ?>"></script>
<script src="<?= base_url('public/library'); ?>/jquery-toast/jquery.toast.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    body {
        background-image:url('<?= base_url('public/template/auth/img/o8dlfk93azs31.jpg'); ?>');
        background-position:center;
        background-size:cover;

        -webkit-font-smoothing: antialiased;
        font: normal 14px Roboto,arial,sans-serif;
        font-family: 'Dancing Script', cursive!important;
    }

    .container {
        padding: 110px;
    }
    ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
        color: #ffffff!important;
        opacity: 1; /* Firefox */
        font-size:18px!important;
    }
    .form-login {
        background-color: rgba(0,0,0,0.55);
        padding-top: 10px;
        padding-bottom: 20px;
        padding-left: 20px;
        padding-right: 20px;
        border-radius: 15px;
        border-color:#d2d2d2;
        border-width: 5px;
        color:white;
        box-shadow:0 1px 0 #cfcfcf;
    }
    .form-control{
        background:transparent!important;
        color:white!important;
        font-size: 20px!important;
    }
    h1{
        color:white!important;
    }
    h4 { 
        border:0 solid #fff; 
        border-bottom-width:1px;
        padding-bottom:10px;
        text-align: center;
    }

    .form-control {
        border-radius: 10px;
    }
    .text-white{
        color: white!important;
    }
    .wrapper {
        text-align: center;
    }
    .footer p{
        font-size: 18px;
    }
</style>

<!--author:starttemplate-->
<!--reference site : starttemplate.com-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="unique login form,leamug login form,boostrap login form,responsive login form,free css html login form,download login form">
    <meta name="author" content="leamug">
    <title><?= $title; ?></title>
    <!-- <link href="css/style.css" rel="stylesheet" id="style"> -->
    <!-- Bootstrap core Library -->
    <link href="<?= base_url('public/template/auth/css/bootstrapv3.2.0.min.css'); ?>" rel="stylesheet" id="bootstrap-css">
    <script src="<?= base_url('public/template/auth/js/bootstrapv3.2.0.min.js'); ?>"></script>
    <script src="<?= base_url('public/template/auth/js/jquery-1.11.1.min.js'); ?>"></script>
    <!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
    <!-- Google font -->
    <link href="<?= base_url('public/template/auth/css/font.css'); ?>" rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet"> -->
    <!-- Font Awesome-->
    <link href="<?= site_url('public/template');?>/sb_admin2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- <link href="<?= base_url('public/template/auth/css/font-awesome.min.css'); ?>" rel="stylesheet"> -->
    <!-- <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> -->
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-offset-4 col-md-4 text-center my-auto">
                  <div class="form-login"></br>
                    <h2 class="font-weight-bold"><?= $title; ?></h2>
                    </br>
                    <?php if(session()->getFlashdata('pesan') ) : ?>
                        <div class="alert alert-success alert-dismissible fade show mt-2 error" role="alert">
                            <strong>Success</strong> <?=session()->getFlashdata('pesan');?>
                        </div>
                    <?php elseif(session()->getFlashdata('error') ) : ?>
                        <div class="alert alert-danger alert-dismissible fade show mt-2 error" role="alert">
                            <strong>Error</strong> <?=session()->getFlashdata('error');?>
                        </div>
                    <?php endif; ?>
                    <?= form_open('auth/simpan_reset_password', ['class' => 'formReset']); ?>
                    <?= csrf_field(); ?>
                    <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="Email" value="<?= old('email'); ?>" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1)">
                        </br>
                        <input type="password" id="userPassword" name="password" class="form-control input-sm chat-input" placeholder="Password"/>
                        <br>
                        <input type="password" id="userPassword2" name="password2" class="form-control input-sm chat-input" placeholder="Ulangi Password"/>
                        <div class="wrapper mb-4 mt-4">
                            <span class="group-btn">
                                <button class="btn btn-danger btn-md" id="reset">Reset</button>
                            </span>
                        </div>
                    <?= form_close(); ?>
                    <a href="<?= base_url('auth'); ?>"><b>Login</b></a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    $(document).ready(function() {

        $('.formReset').submit(function() {
            $.ajax({
                url: $(this).attr('action'),
                type: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('#reset').html('<i class="fa fa-circle-notch fa-spin"></i>');
                },
                complete: function() {
                    $('#reset').text('Reset');
                },

                success: function( response ) {

                },
                error: function( xhr, ajaxOptions, thrownError ) {
                    alert( xhr.status + "\n" + xhr.responseText + "\n" + thrownError );
                }
            })
            return false;
        })

        window.setTimeout(function() {
            $('.session').fadeTo(500, 0).slideUp(500, function() {
                $(this).remove()
            })
            $('.error').fadeTo(500, 0 ).slideUp(500, function() {
                $(this).remove()
            })
            $('.invalid-feedback').fadeTo(500, 0).slideUp(500, function() {
                $('.form-control').removeClass('is-invalid');
                $('.form-check-input').removeClass('is-invalid');
            })
        }, 3000);
    })
</script>



<?php
include('lib/Session.php');

$session = new Session();

if ($session->get('is_login') === true) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelompok 1</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallb ack">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../adminlte/dist/css/adminlte.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">


    <style>
        body {
            background: url('img/BG.png') no-repeat center center fixed;
            background-size: cover;
        }

        /* Apply Google Font to all elements */
        * {
            font-family: 'Questrial', sans-serif;
        }
        
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">

            <div class="card-header text-center">
                <img src="img/JTI.png" alt="JTI Logo" style="max-width: 100px; margin-bottom: 15px;">
                <a href="/" class="h1"><b>JTI</b>MELAPOR</a>

            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <?php
                $status = $session->getFlash('status');

                if ($status === false) {
                    $message = $session->getFlash('message');
                    echo '<div class="alert alert-warning">' . $message .
                        '<button type="button" class="close" data-dismiss="alert" aria- label="Close"><span aria-hidden="true">&times;</span></div>';
                }
                ?>
                <form action="action/auth.php?act=login" method="post" id="form-login">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">Remember Me</label>
                            </div>
                        </div> -->
                    <!-- /.col -->
                    <div class="d-flex justify-content-between">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <div class="col-4">
                            <a href="http://localhost/PBL_KelomPok1_SEMESTER-3/" class="btn btn-danger btn-block">Back</a>
                        </div>
                    </div>

                    <!-- /.col -->
            </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../adminlte/dist/js/adminlte.min.js"></script>
    <script src="../adminlte/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="../adminlte/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="../adminlte/plugins/jquery-validation/localization/messages_id.min.js"></script>

    <script>
        // maksud nya adl ketika dokumen sudah siap (html telah d render oleh browser) maka jalankan fungsi berikut ini
        $(document).ready(function() {
            $('#form-login').validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 3,
                        maxlength: 20
                    },
                    password: {
                        required: true,
                        minlength: 5,
                        maxlength: 255
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
</body>

</html>
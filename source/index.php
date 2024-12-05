<?php
include('lib/Session.php');
$session = new Session();
if ($session->get('is_login') !== true) {
    header('Location: login.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>JTI MELAPOR</title>



    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../adminlte/plugins/fontawesome-free/css/all.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="../adminlte/plugins/datatablesbs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../adminlte/plugins/datatablesresponsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">




    <!-- Theme style -->
    <link rel="stylesheet" href="../adminlte/dist/css/adminlte.min.css">

    <!-- jQuery -->
    <script src="../adminlte/plugins/jquery/jquery.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <?php include('layouts/header.php'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../source/index.php" class="brand-link">
                <img src="../source/img/JTI.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">JTI MELAPOR</span>
            </a>

            <!-- Sidebar -->
            <?php include('layouts/sidebar.php'); ?>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <?php
            $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

            switch (strtolower($page)) {
                case 'dashboard':
                    include('pages/dashboard.php');
                    break;
                case 'admin':
                    include('pages/admin.php'); // Halaman untuk tabel dbo.tb_admin
                    break;
                case 'dosen':
                    include('pages/dosen.php'); // Halaman untuk tabel dbo.tb_dosen
                    break;
                case 'jenis_pelanggaran':
                    include('pages/jenis_pelanggaran.php'); // Halaman untuk tabel dbo.tb_jenis_pelanggaran
                    break;
                case 'lapor_pelanggaran_mahasiswa':
                    include('pages/lapor_pelanggaran_mahasiswa.php'); // Halaman untuk tabel dbo.tb_laporpelanggaranmahasiswa
                    break;
                case 'tingkat_pelanggaran':
                    include('pages/tingkat_pelanggaran.php'); // Halaman untuk tabel dbo.tb_tingkat_pelanggaran
                    break;
                case 'log':
                    include('pages/log.php'); // Halaman untuk tabel dbo.tb_log
                    break;
                case 'mahasiswa':
                    include('pages/mahasiswa.php'); // Halaman untuk tabel dbo.tb_mahasiswa
                    break;
                case 'notifikasi':
                    include('pages/notifikasi.php'); // Halaman untuk tabel dbo.tb_notifikasi
                    break;
                case 'prodi':
                    include('pages/prodi.php'); // Halaman untuk tabel dbo.tb_prodi
                    break;
                case 'users':
                    include('pages/users.php'); // Halaman untuk tabel dbo.tb_users
                    break;
                case 'kelas':
                    include('pages/kelas.php'); // Halaman untuk tabel dbo.tb_kelas
                    break;
                default:
                    include('pages/404.php'); // Halaman untuk error 404
                    break;
            }
            ?>

            <!-- Main content -->

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php include('layouts/footer.php'); ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- Bootstrap 4 -->
    <script src="../adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->

    <!-- jQuery Validation -->
    <script src="../adminlte/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="../adminlte/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="../adminlte/plugins/jquery-validation/localization/messages_id.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../adminlte/plugins/datatables-
responsive/js/dataTables.responsive.min.js"></script>
    <script src="../adminlte/plugins/datatables-
responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../adminlte/plugins/jszip/jszip.min.js"></script>
    <script src="../adminlte/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../adminlte/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


    <script src="../adminlte/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="../adminlte/dist/js/demo.js"></script> -->
</body>

</html>
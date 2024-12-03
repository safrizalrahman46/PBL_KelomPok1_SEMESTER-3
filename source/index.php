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
            <a href="../adminlte/index3.html" class="brand-link">
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
                    include('pages/admin.php'); // Halaman untuk tabel dbo.admin
                    break;
                case 'admin_task_log':
                    include('pages/AdminTaskLog.php'); // Halaman untuk tabel dbo.admin_task_log
                    break;
                case 'department':
                    include('pages/department.php'); // Halaman untuk tabel dbo.department
                    break;
                case 'dosen':
                    include('pages/Dosen.php'); // Halaman untuk tabel dbo.dosen
                    break;
                case 'dpa':
                    include('pages/dpa.php'); // Halaman untuk tabel dbo.dpa
                    break;
                case 'fakultas':
                    include('pages/fakultas.php'); // Halaman untuk tabel dbo.fakultas
                    break;
                case 'jurusan':
                    include('pages/jurusan.php'); // Halaman untuk tabel dbo.jurusan
                    break;
                case 'kelas':
                    include('pages/kelas.php'); // Halaman untuk tabel dbo.kelas
                    break;
                case 'komisi_discipline_decision':
                    include('pages/komisi_discipline_decision.php'); // Halaman untuk tabel dbo.komisi_discipline_decision
                    break;
                case 'komite_disiplin_mahasiswa':
                    include('pages/komite_disiplin_mahasiswa.php'); // Halaman untuk tabel dbo.komite_disiplin_mahasiswa
                    break;
                case 'kps':
                    include('pages/kps.php'); // Halaman untuk tabel dbo.kps
                    break;
                case 'mahasiswa':
                    include('pages/mahasiswa.php'); // Halaman untuk tabel dbo.mahasiswa
                    break;
                case 'notification':
                    include('pages/notification.php'); // Halaman untuk tabel dbo.notification
                    break;
                case 'pelanggaran_mahasiswa':
                    include('pages/pelanggaran_mahasiswa.php'); // Halaman untuk tabel dbo.pelanggaran_mahasiswa
                    break;
                case 'pelapor':
                    include('pages/pelapor.php'); // Halaman untuk tabel dbo.pelapor
                    break;
                case 'prodi':
                    include('pages/prodi.php'); // Halaman untuk tabel dbo.prodi
                    break;
                case 'reward_archive':
                    include('pages/reward_archive.php'); // Halaman untuk tabel dbo.reward_archive
                    break;
                case 'reward_points':
                    include('pages/reward_points.php'); // Halaman untuk tabel dbo.reward_points
                    break;
                case 'tenaga_kependidikan':
                    include('pages/tenaga_kependidikan.php'); // Halaman untuk tabel dbo.tenaga_kependidikan
                    break;
                case 'users':
                    include('pages/Users.php'); // Halaman untuk tabel dbo.users
                    break;
                case 'violation_level':
                    include('pages/violation_level.php'); // Halaman untuk tabel dbo.violation_level
                    break;
                case 'violation_report':
                    include('pages/violation_report.php'); // Halaman untuk tabel dbo.violation_report
                    break;
                case 'violation_type':
                    include('pages/violation_type.php'); // Halaman untuk tabel dbo.violation_type
                    break;
                // case 'users':
                //         include('pages/users.php'); // Halaman untuk tabel dbo.violation_type
                //         break;
                default:
                    include('pages/404.php'); // Halaman untuk error 404
                    break;
            }
            ?>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Title</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        Selamat Datang Administrator. Anda login sebagai admin.
                        <br>
                        Start creating your amazing application!
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        Footer
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->

            </section>
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
    <script src="../adminlte/dist/js/demo.js"></script>
</body>

</html>
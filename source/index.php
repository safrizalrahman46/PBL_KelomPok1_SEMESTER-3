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


    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <script src="../adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script> -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>





    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">


    <style>
        .questrial-regular {
            font-family: "Questrial", sans-serif;
            font-weight: 400;
            font-style: normal;
        }


        /* Apply Google Font to all elements */
        * {
            font-family: 'Questrial', sans-serif;
        }



        :root {

            --theadColor: #0984e3;

        }



        table.dataTable {

            box-shadow: #bbbbbb 0px 0px 5px 0px;

        }

        thead {

            background-color: var(--theadColor);



        }

        thead>tr,

        thead>tr>th {

            background-color: transparent;

            color: #fff;

            font-weight: normal;

            text-align: start;

        }

        table.dataTable thead th,

        table.dataTable thead td {

            border-bottom: 0px solid #111 !important;

        }

        .dataTables_wrapper>div {

            margin: 5px;

        }

        table.dataTable.display tbody tr.even>.sorting_1,

        table.dataTable.order-column.stripe tbody tr.even>.sorting_1 table.dataTable.display tbody tr.even,

        table.dataTable.display tbody tr.odd>.sorting_1,

        table.dataTable.order-column.stripe tbody tr.odd>.sorting_1,

        table.dataTable.display tbody tr.odd {

            background-color: #ffffff;

        }

        table.dataTable thead th {

            position: relative;

            background-image: none !important;

        }

        table.dataTable thead th.sorting:after,

        table.dataTable thead th.sorting_asc:after,

        table.dataTable thead th.sorting_desc:after {

            position: absolute;

            top: 12px;

            right: 8px;

            display: block;

            font-family: "Font Awesome\ 5 Free";

        }

        table.dataTable thead th.sorting:after {

            content: "\f0dc";

            color: #ddd;

            font-size: 0.8em;

            padding-top: 0.12em;

        }

        table.dataTable thead th.sorting_asc:after {

            content: "\f0de";

        }

        table.dataTable thead th.sorting_desc:after {

            content: "\f0dd";

        }

        table.dataTable.display tbody tr:hover>.sorting_1,

        table.dataTable.order-column.hover tbody tr:hover>.sorting_1 {

            background-color: #f2f2f2 !important;

            color: #000;

        }

        tbody tr:hover {

            background-color: #f2f2f2 !important;

            color: #000;

        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,

        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {

            background: none !important;

            border-radius: 50px;

            background-color: var(--theadColor) !important;

            color: #fff !important
        }

        .paginate_button.current:hover {

            background: none !important;

            border-radius: 50px;

            background-color: var(--theadColor) !important;

            color: #fff !important
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover,

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {

            border: 1px solid #979797;

            background: none !important;

            border-radius: 50px !important;

            background-color: #000 !important;

            color: #fff !important;

        }
    </style>

    <!-- jQuery -->
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
                    include('pages/jenispelanggaran.php'); // Halaman untuk tabel dbo.tb_jenis_pelanggaran
                    break;
                case 'lapor_pelanggaran_mahasiswa':
                    include('pages/lapor.php'); // Halaman untuk tabel dbo.tb_laporpelanggaranmahasiswa
                    break;
                case 'tingkat_pelanggaran':
                    include('pages/tingkatpelanggaran.php'); // Halaman untuk tabel dbo.tb_tingkat_pelanggaran
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
                case 'tipe_notifikasi':
                    include('pages/tipenotifikasi.php'); // Halaman untuk tabel dbo.tb_notifikasi
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
<?php


// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = ''; // Default value if not logged in
}
?>

<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!-- <div class="image">
            <img src="../adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                alt="User Image">
        </div> -->
        <div style="display: flex; justify-content: flex-start;">
    <a href="#" class="d-block">Login Sebagai : <?php echo htmlspecialchars($username); ?></a>
</div>
        
        <div class="info">
        </div>
    </div>
    <!-- SidebarSearch Form -->
    <div class="form-inline">
  
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="index.php" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>


            <?php
                if($_SESSION['level'] == 'admin') {
            ?>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Master Data
                        <i class="fas fa-angle-left right"></i>
                        <!-- <span class="badge badge-info right">6</span> -->
                    </p>
                </a>
                <ul class="nav nav-treeview">



                    <li class="nav-item">
                        <a href="index.php?page=prodi" class="nav-link">
                            <i class="nav-icon fas fa-graduation-cap"></i>
                            <p>Prodi</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="index.php?page=kelas" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Kelas</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="index.php?page=jenis_pelanggaran" class="nav-link">
                            <i class="nav-icon fas fa-exclamation-circle"></i>
                            <p>Jenis Pelanggaran</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?page=tingkat_pelanggaran" class="nav-link">
                            <i class="nav-icon fas fa-exclamation-circle"></i>
                            <p>Tingkat Pelanggaran</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="index.php?page=tipe_notifikasi" class="nav-link">
                            <i class="nav-icon fas fa-bell"></i>
                            <p>Tipe Notifikasi</p>
                        </a>
                    </li>

                    <!-- <li class="nav-item">
                        <a href="index.php?page=users" class="nav-link">
                            <i class="nav-icon fas fa-bell"></i>
                            <p>Users</p>
                        </a>
                    </li> -->


                    <!-- <li class="nav-item">
                        <a href="index.php?page=notifikasi" class="nav-link">
                            <i class="nav-icon fas fa-bell"></i>
                            <p>Notifikasi</p>
                        </a>
                    </li> -->

                    <li class="nav-item">
                <a href="index.php?page=lapor_pelanggaran_mahasiswa" class="nav-link">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>Lapor Pelanggaran </p>
                </a>
            </li>

                </ul>
            </li>


            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        Data Akun
                        <i class="fas fa-angle-left right"></i>
                        <!-- <span class="badge badge-info right">6</span> -->
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="index.php?page=admin" class="nav-link">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>Admin</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php?page=mahasiswa" class="nav-link">
                            <i class="nav-icon fas fa-user-graduate"></i>
                            <p>Mahasiswa</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php?page=dosen" class="nav-link">
                            <i class="nav-icon fas fa-chalkboard-teacher"></i>
                            <p>Dosen</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php?page=log" class="nav-link">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>Log</p>
                        </a>
                    </li>

                    <!-- <li class="nav-item">
                        <a href="index.php?page=users" class="nav-link">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>Users</p>
                        </a>
                    </li> -->
                </ul>
            </li>



            <?php 
                }
            ?>




            
            <?php
                if($_SESSION['level'] == 'dosen') {
            ?>


            <li class="nav-item">
                <a href="index.php?page=lapor_pelanggaran_mahasiswa" class="nav-link">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>Lapor Pelanggaran </p>
                </a>
            </li>

            <?php 
                }
            ?>


            <?php
                if($_SESSION['level'] == 'mahasiswa') {
            ?>


            <li class="nav-item">
                <a href="index.php?page=lapor_pelanggaran_mahasiswa" class="nav-link">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>Lapor Pelanggaran </p>
                </a>
            </li>

            <?php 
                }
            ?>





            <li class="nav-item">
                <a href="action/auth.php?act=logout" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
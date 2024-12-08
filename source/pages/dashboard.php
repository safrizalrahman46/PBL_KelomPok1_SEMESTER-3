<?php 

include_once(__DIR__ . '/../lib/Session.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}


include_once(__DIR__ . '/../model/GlobalModel.php');

$global = new GlobalModel();

$kelas = $global->getCountData('tb_kelas');
$prodi = $global->getCountData('tb_prodi');
$mahasiswa = $global->getCountData('tb_mahasiswa');
$lapor = $global->getCountData('tb_lapor');
?>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?= $kelas;  ?></h3>

                    <p>Kelas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?= $prodi;  ?></h3>

                    <p>Prodi</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?= $mahasiswa;  ?></h3>

                    <p>Mahasiswa</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?= $lapor;  ?></h3>

                    <p>Tingkat Pelanggaran</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
    </div>
</section>


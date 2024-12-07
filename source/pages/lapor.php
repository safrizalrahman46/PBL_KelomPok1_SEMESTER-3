<?php


// EROR
// include_once(__DIR__.'/../model/MahasiswaModel.php');

// $classData = new MahasiswaModel();
// $dataMah = $classData->getData();

// include_once(__DIR__.'/../model/JenisPelanggaranModel.php');

// $classData = new JenisPelanggaranModel();
// $dataPel = $classData->getData();

// include_once(__DIR__.'/../model/AdminModel.php');

// $classData = new AdminModel();
// $dataAdm = $classData->getData();

// include_once(__DIR__ . '/../model/DosenModel.php');

// $classData = new DosenModel();
// $dataDos = $classData->getData();

?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Lapor</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Lapor</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Lapor</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-md btn-primary" onclick="tambahData()">
                    Tambah
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-striped" id="table-data">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mahasiswa</th> <!-- 'id_mahasiswa' -->
                        <th>Jenis Pelanggaran</th> <!-- 'id_jenis_pelanggaran' -->
                        <th>Status</th> <!-- 'status' -->
                        <th>Komentar</th> <!-- 'komentar' -->
                        <th>Admin</th> <!-- 'id_admin' -->
                        <th>Dosen</th> <!-- 'id_dosen' -->
                        <th>Status Verifikasi Admin</th> <!-- 'status_verifikasi_admin' -->
                        <th>NIM</th> <!-- 'nim' -->
                        <th>Foto</th> <!-- 'foto' -->
                        <th>Tanggal Laporan</th> <!-- 'tanggal_laporan' -->
                        <th>Tempat Kejadian</th> <!-- 'tempat' -->
                        <th>Aksi</th> <!-- For actions (like edit, delete) -->
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</section>
<div class="modal fade" id="form-data" style="display: none;" aria-hidden="true">
    <form action="action/laporAction.php?act=save" method="post" id="form-tambah">
        <!--    Ukuran Modal  
                modal-sm : Modal ukuran kecil 
                modal-md : Modal ukuran sedang 
                modal-lg : Modal ukuran besar 
                modal-xl : Modal ukuran sangat besar 
            penerapan setelah class modal-dialog seperti di bawah 
    -->
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Admin</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Mahasiswa</label>
                        <select name="id_mahasiswa" id="id_mahasiswa" class="form-control">
                            <?php
                            foreach ($dataMahasiswa as $key => $value) {
                            ?>
                                <option value="<?= $value['NIM']; ?>"><?= $value['nama'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jenis Pelanggaran</label>
                        <select name="id_jenis_pelanggaran" id="id_jenis_pelanggaran" class="form-control">
                            <?php
                            foreach ($dataPelanggaran as $key => $value) {
                            ?>
                                <option value="<?= $value['id_pelanggaran']; ?>"><?= $value['deskripsi'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="pending">Pending</option>
                            <option value="sent">Sent</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Komentar</label>
                        <input type="text" class="form-control" name="komentar" id="komentar">
                    </div>
                    <div class="form-group">
                        <label>ID Admin</label>
                        <select name="id_admin" id="id_admin" class="form-control">
                            <?php
                            foreach ($dataAdm as $key => $value) {
                            ?>
                                <option value="<?= $value['id_admin']; ?>"><?= $value['nama'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>ID Dosen</label>
                        <select name="id_dosen" id="id_dosen" class="form-control">
                            <?php
                            foreach ($dataDos as $key => $value) {
                            ?>
                                <option value="<?= $value['nip']; ?>"><?= $value['nama'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status Verifikasi Admin</label>
                        <select name="status" id="status" class="form-control">
                            <option value="Valid">Valid</option>
                            <option value="Tidak Valid">Tidak Valid</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" class="form-control" name="nim" id="nim">
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" class="form-control" name="foto" id="foto">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Laporan</label>
                        <input type="date" class="form-control" name="tanggal_laporan" id="tanggal_laporan">
                    </div>
                    <div class="form-group">
                        <label>tempat</label>
                        <input type="text" class="form-control" name="tempat" id="tempat">
                    </div>


                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function tambahData() {
        $('#form-data').modal('show');
        $('#form-tambah').attr('action', 'action/laporAction.php?act=save');
        $('#id_mahasiswa').val('');
        $('#id_jenis_pelanggaran').val('');
        $('#status').val('');
        $('#id_admin').val('');
        $('#id_dosen').val('');
        $('#status_verifikasi_admin').val('');
        $('#nim').val('');
        $('#foto').val('');
        $('#tanggal_laporan').val('');
        $('#tempat').val('');
    }

    function editData(id) {
        $.ajax({
            url: 'action/laporAction.php?act=get&id=' + id,
            method: 'post',
            success: function(response) {
                var data = JSON.parse(response);
                $('#form-data').modal('show');
                $('#form-tambah').attr('action',
                    'action/laporAction.php?act=update&id=' + id);
                $('#id_mahasiswa').val(data.id_mahasiswa);
                $('#id_jenis_pelanggaran').val(data.id_jenis_pelanggaran);
                $('#status').val(data.status);
                $('#id_admin').val(data.id_admin);
                $('#id_dosen').val(data.id_dosen);
                $('#status_verifikasi_admin').val(data.status_verifikasi_admin);
                $('#nim').val(data.nim);
                $('#foto').val(data.foto);
                $('#tanggal_laporan').val(data.tanggal_laporan);
                $('#tempat').val(data.tempat);

            }
        });
    }

    function deleteData(id) {
        if (confirm('Apakah anda yakin?')) {
            $.ajax({
                url: 'action/laporAction.php?act=delete&id=' + id,
                method: 'post',
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.status) {
                        tabelData.ajax.reload();
                    } else {
                        alert(result.message);
                    }
                }
            });
        }
    }

    var tabelData;
    $(document).ready(function() {



        tabelData = $('#table-data').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: 'action/laporAction.php?act=load',
                type: 'POST',
            },
            columns: [{
                    data: 'no'
                },
                {
                    data: 'id_mahasiswa'
                },
                {
                    data: 'id_jenis_pelanggaran'
                },
               
                {
                    data: 'status'
                },
                {
                    data: 'komentar'
                },
                {
                    data: 'id_admin'
                },
                {
                    data: 'id_dosen'
                },
                {
                    data: 'status_verifikasi_admin'
                },
                {
                    data: 'nim'
                },
                {
                    data: 'foto',
                    render: function(data) {
                        return `<img src="${data}" alt="Foto" class="img-thumbnail" style="width: 50px; height: 50px;">`;
                    }
                },
                {
                    data: 'tanggal_laporan'
                },
                {
                    data: 'tempat'
                },
              
                {
                    data: 'aksi'
                },
                
            ],
        });


        $('#form-tambah').validate({
            rules: {
                id_mahasiswa: {
                    required: true,

                },
                id_jenis_pelanggaran: {
                    required: true,

                },
                status: {
                    required: true,

                },

                status_verifikasi_admin: {
                    required: true,

                },
                nim: {
                    required: true,

                },
                tempat: {
                    required: true,

                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                $.ajax({
                    url: $(form).attr('action'),
                    method: 'post',
                    data: $(form).serialize(),
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.status) {
                            $('#form-data').modal('hide');
                            tabelData.ajax.reload(); // reload data tabel 
                        } else {
                            alert(result.message);
                        }
                    }
                });
            }
        });
    });
</script>
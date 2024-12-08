<?php


// EROR
// include_once(__DIR__.'/../model/MahasiswaModel.php');

// $classData = new MahasiswaModel();
// $dataMahasiswa = $classData->getData();

include_once(__DIR__.'/../model/JenisPelanggaranModel.php');

$classData = new JenisPelanggaranModel();
$dataPelanggaran = $classData->getData();

include_once(__DIR__.'/../model/ProdiModel.php');

$classData = new ProdiModel();
$dataProdi = $classData->getData();

include_once(__DIR__ . '/../model/KelasModel.php');

$classData = new KelasModel();
$dataKelas = $classData->getData();

// include_once(__DIR__ . '/../model/UserModel.php');

// $classData = new UserModel();
// $dataUser = $classData->getData();

?>


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Mahasiswa </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data Mahasiswa </li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Mahasiswa </h3>
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
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Semester</th>
                        <th>Tingkat</th>
                        <th>Username</th>
                        <th>Foto</th>
                        <!-- <th>Status</th> -->
                        <!-- <th>Prodi</th> -->
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</section>
<div class="modal fade" id="form-data" style="display: none;" aria-hidden="true">
    <form action="action/mahasiswaAction.php?act=save" method="post" id="form-tambah" enctype="multipart/form-data">
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
                    <h4 class="modal-title">Tambah Kelas</h4>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label>Semester</label>
                            <input type="number" class="form-control" name="semester" id="semester" required>
                        </div>
                        <div class="form-group">
                            <label>Tingkat</label>
                            <input type="number" class="form-control" name="tingkat" id="tingkat" required>
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="text" class="form-control" name="foto" id="foto" required>

                            <!-- <input type="file" class="form-control" name="foto" id="foto" value="Upload Image"> -->
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value="Aktif">Aktif</option>
                                <option value="Lulus">Lulus</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Prodi</label>
                            <select name="id_prodi" id="id_prodi" class="form-control">
                                <?php
                                foreach ($dataProdi as $key => $value) {
                                ?>
                                    <option value="<?= $value['id_prodi']; ?>"><?= $value['nama_prodi'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jenis Pelanggaran</label>
                            <select name="id_pelanggaran" id="id_pelanggaran" class="form-control">
                                <?php
                                foreach ($dataPelanggaran as $key => $value) {
                                ?>
                                    <option value="<?= $value['id_jenis_pelanggaran']; ?>"><?= $value['deskripsi'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="id_kelas" id="id_kelas" class="form-control">
                                <?php
                                foreach ($dataKelas as $key => $value) {
                                ?>
                                    <option value="<?= $value['id_kelas']; ?>"><?= $value['nama_kelas'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                        <label>Username </label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
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
        $('#form-tambah').attr('action', 'action/mahasiswaAction.php?act=save');
        $('#name').val('');
        $('#email').val('');
        $('#jurusan').val('');
        $('#username').val('');
        $('#password').val('');
        $('#status').val('');
        $('#semester').val('');
        $('#tingkat').val('');
        $('#foto').val('');
        $('#nama').val('');
    }

    function editData(id) {
        $.ajax({
            url: 'action/mahasiswaAction.php?act=get&id=' + id,
            method: 'post',
            success: function(response) {
                var data = JSON.parse(response);
                $('#form-data').modal('show');
                $('#form-tambah').attr('action',
                    'action/mahasiswaAction.php?act=update&id=' + id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#jurusan').val(data.jurusan);
                $('#username').val(data.username);
                $('#password').val(data.password);
                $('#status').val(data.status);
                $('#semester').val(data.semester);
                $('#tingkat').val(data.tingkat);
                $('#foto').val(data.foto);
                $('#nama').val(data.nama);
            }
        });
    }

    function deleteData(id) {
        if (confirm('Apakah anda yakin?')) {
            $.ajax({
                url: 'action/mahasiswaAction.php?act=delete&id=' + id,
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
                url: 'action/mahasiswaAction.php?act=load',
                type: 'POST',
            },
            columns: [{
                    data: "no"
                },

                {
                    data: "nama"
                },

                {
                    data: "email"
                },
                {
                    data: "semester"
                },
                {
                    data: "tingkat"
                },

                {
                    data: "username"
                },
                {
                    data: "foto",
                    // render: function(data) {
                    //     return `<image src="${data}" alt="Foto" class="img-thumbnail" style="width: 50px; height: 50px;">`;
                    // }
                },
             
                {
                    data: "aksi"
                }
            ],
            dom: 'Bfrtip', // Controls position of buttons
            buttons: [{
                extend: 'excelHtml5',
                text: 'Export to Excel',
                title: "Data Kelas", // Title of the sheet (header)
                filename: function() {
                    var currentDate = new Date();
                    var day = String(currentDate.getDate()).padStart(2, '0'); // Add leading zero if necessary
                    var month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Add leading zero
                    var year = currentDate.getFullYear();
                    var hours = String(currentDate.getHours()).padStart(2, '0');
                    var minutes = String(currentDate.getMinutes()).padStart(2, '0');
                    var seconds = String(currentDate.getSeconds()).padStart(2, '0');

                    // Format as DD-MM-YYYY_HH:MM:SS for the filename
                    var dateString = day + '-' + month + '-' + year + '_' + hours + ':' + minutes + ':' + seconds;
                    return "Export_Data_Kelas_" + dateString; // This will set the file name
                },
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10] // Only export visible columns
                }
            }],
            customize: function(xlsx) {
                var sheet = xlsx.xl.worksheets['sheet1.xml'];

                // Change the first row (header) to "Data Kelas"
                var headerRow = sheet.getElementsByTagName('row')[0]; // First row (header row)
                headerRow.firstChild.textContent = "Data Kelas"; // Set the header text to "Data Prodi"

                // Make the header bold and centered (optional)
                var styles = xlsx.xl.styles;
                var cellStyle = styles.addStyle({
                    font: {
                        bold: true
                    },
                    alignment: {
                        horizontal: 'center'
                    }
                });
                headerRow.firstChild.setAttribute('s', cellStyle);
            }
        });

        $('#form-tambah').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },

                email: {
                    required: true,
                },

                prodi: {
                    required: true,
                },


                status: {
                    required: true
                },
                semester: {
                    required: true,
                },
                tingkat: {
                    required: true,
                }
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
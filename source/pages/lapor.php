<?php


// EROR
include_once(__DIR__ . '/../model/MahasiswaModel.php');
include_once(__DIR__ . '/../model/JenisPelanggaranModel.php');
include_once(__DIR__ . '/../model/DosenModel.php');

$classData = new MahasiswaModel();
$dataMah = $classData->getData();


$classData = new JenisPelanggaranModel();
$dataPel = $classData->getData();


$classData = new DosenModel();
$dataDos = $classData->getData();

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

                <?php
                if ($_SESSION['level'] == 'dosen') {
                ?>
                    <button type="button" class="btn btn-md btn-primary" onclick="tambahData()">
                        Tambah
                    </button>

                <?php
                }
                ?>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-striped" id="table-data">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Dosen</th> <!-- 'id_dosen' -->
                        <th>Mahasiswa</th> <!-- 'id_mahasiswa' -->
                        <th>Jenis Pelanggaran</th> <!-- 'id_jenis_pelanggaran' -->
                        <th>Tanggal Laporan</th> <!-- 'tanggal_laporan' -->
                        <th>Tempat Kejadian</th> <!-- 'tempat' -->
                        <th>Status Verifikasi Admin</th> <!-- 'tempat' -->

                        <?php 
                            if($_SESSION['level']  =='dosen' || $_SESSION['level'] == 'admin') {
                        ?>
                        <th>Aksi</th> <!-- For actions (like edit, delete) -->
                        <?php 
                            }
                        ?>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h4 class="modal-title">Form Lapor</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Mahasiswa</label>
                        <select name="id_mahasiswa" id="id_mahasiswa" class="form-control">

                            <option value="">Pilih Mahasiswa</option>
                            <?php
                            foreach ($dataMah as $key => $value) {
                            ?>
                                <option value="<?= $value['nim']; ?>"><?= $value['nama'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jenis Pelanggaran</label>
                        <select name="id_jenis_pelanggaran" id="id_jenis_pelanggaran" class="form-control">

                            <option value="">Pilih Jenis Pelanggaran</option>

                            <?php
                            foreach ($dataPel as $key => $value) {
                            ?>
                                <option value="<?= $value['id_jenis_pelanggaran']; ?>"><?= $value['deskripsi'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Pelanggaran</label>

                        <textarea name="komentar" id="komentar" class="form-control"></textarea>
                        <!-- <input type="text" class="form-control" name="komentar" id="komentar"> -->
                    </div>

                    <!-- <div class="form-group">
                        <label>Status Verifikasi Admin</label>
                        <select name="status" id="status" class="form-control">
                            <option value="Valid">Valid</option>
                            <option value="Tidak Valid">Tidak Valid</option>
                        </select>
                    </div> -->

                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" class="form-control" name="foto" id="foto">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Laporan</label>
                        <input type="date" class="form-control" name="tanggal_laporan" id="tanggal_laporan">
                    </div>
                    <div class="form-group">
                        <label>Tempat Kejadian</label>
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
        $('#id_admin').val('');
        $('#id_dosen').val('');
        $('#status_verifikasi_admin').val('');


        $('#komentar').summernote({
            height: 300, // Set editor height
            minHeight: null, // Set minimum height
            maxHeight: null, // Set maximum height
            focus: true // Focus the editor when loaded
        });


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
                    data: 'dosen_nama'
                },
                {
                    data: 'mahasiswa_nama'
                }, // Adjusted to match the alias in the SQL query
                {
                    data: 'pelanggaran_deskripsi'
                },
                {
                    data: 'tanggal_laporan'
                },
                
               
                
                <?php 
                        if($_SESSION['level']  =='dosen' || $_SESSION['level'] == 'admin') {
                ?>
                {
                    data: 'tempat'
                },
                {
                    data: 'status_verifikasi_admin'
                },
                {
                    data: 'aksi'
                }

                <?php 
                            }
                ?>


                <?php 
                        if($_SESSION['level']  =='mahasiswa') {
                ?>
                {
                    data: 'tempat'
                },
                {
                    data: 'status_verifikasi_admin'
                }
                <?php 
                            }
                ?>
            ],
            dom: 'Bfrtip', // Controls position of buttons
            buttons: [{
                extend: 'excelHtml5',
                text: 'Export to Excel',
                title: "Data Laporan", // Title of the sheet (header)
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
                    return "Export_Data_Laporan_" + dateString; // This will set the file name
                },
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10] // Only export visible columns
                }
            }],
            customize: function(xlsx) {
                var sheet = xlsx.xl.worksheets['sheet1.xml'];

                // Change the first row (header) to "Data Kelas"
                var headerRow = sheet.getElementsByTagName('row')[0]; // First row (header row)
                headerRow.firstChild.textContent = "Data Laporan"; // Set the header text to "Data Prodi"

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
                var formData = new FormData(form); // Create FormData object


                $.confirm({
                    title: 'Apakah anda sudah yakin ?',
                    content: 'Data yang sudah di submit atau terkirim, akan diproses oleh admin dan tidak bisa di rubah',
                    buttons: {
                        confirm: function() {
                            // $.alert('Confirmed!');

                            $.ajax({
                                url: $(form).attr('action'),
                                method: 'POST',
                                data: formData,
                                contentType: false, // Required for file upload
                                processData: false,
                                // data: $(form).serialize(),
                                success: function(response) {
                                    var result = JSON.parse(response);
                                    if (result.status) {
                                        $('#form-data').modal('hide');
                                        tabelData.ajax.reload();
                                        $.notify('Laporan anda berhasil di ajukan oleh, mohon tunggu approval admin', "success");
                                        l // reload data tabel 
                                    } else {
                                        alert(result.message);
                                    }
                                }
                            });
                        },
                        cancel: function() {
                            $.alert('Canceled!');
                        }
                    }
                });



            }
        });
    });
</script>
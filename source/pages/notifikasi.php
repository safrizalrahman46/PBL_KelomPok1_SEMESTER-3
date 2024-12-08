<?php


// EROR
// include_once(__DIR__.'/../model/MahasiswaModel.php');

// $classData = new MahasiswaModel();
// $dataMahasiswa = $classData->getData();

// include_once(__DIR__.'/../model/JenisPelanggaranModel.php');

// $classData = new JenisPelanggaranModel();
// $dataPelanggaran = $classData->getData();

// include_once(__DIR__.'/../model/ProdiModel.php');

// $classData = new ProdiModel();
// $dataProdi = $classData->getData();

// include_once(__DIR__ . '/../model/TipeNotikasiModel.php');

// $classData = new TipeNotikasiModel();
// $dataNotifikasis = $classData->getData();

include_once(__DIR__ . '/../model/JenisPelanggaranModel.php');

$classData = new JenisPelanggaranModel();
$dataLanggars = $classData->getData();

// include_once(__DIR__ . '/../model/.php');

// $classData = new ();
// $dataLanggars = $classData->getData();

?>


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data notifikasi </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data notifikasi </li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar notifikasi </h3>
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
                        <th>Penerima</th>
                        <th>Pesan</th>
                        <th>Tanggal Kirim</th>
                        <th>Pelanggaran</th>
                        <th>Notifikasi</th>
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
    <form action="action/notifikasiAction.php?act=save" method="post" id="form-tambah">
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
                    <h4 class="modal-title">Form notifikasi</h4>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Penerima</label>
                            <input type="text" class="form-control" name="id_penerima" id="id_penerima" required>
                        </div>
                        <div class="form-group">
                            <label>Pesan</label>
                            <input type="text" class="form-control" name="pesan" id="pesan" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal kirim</label>
                            <input type="date" class="form-control" name="tanggal_kirim" id="tanggal_kirim" required>
                        </div>
                        <div class="form-group">
                            <label>Tipe Notifikasi</label>

                            <select name="id_pelanggaran" id="id_pelanggaran" class="form-control">
                                <?php
                                foreach ($dataLanggars as $key => $value) {
                                ?>
                                    <option value="<?= $value['id_jenis_pelanggaran']; ?>"><?= $value['deskripsi'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <!-- <input type="number" class="form-control" name="id_kelas" id="id_kelas"> -->
                        </div>


                        <div class="form-group">
                            <label>Tipe Notifikasi</label>

                            <select name="id_tipe_notifikasi" id="id_tipe_notifikasi" class="form-control">
                                <?php
                                foreach ($dataNotifikasis as $key => $value) {
                                ?>
                                    <option value="<?= $value['id_tipe_notifikasi']; ?>"><?= $value['notif_template'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <!-- <input type="number" class="form-control" name="id_kelas" id="id_kelas"> -->
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
        $('#form-tambah').attr('action', 'action/notifikasiAction.php?act=save');
        $('#id_penerima').val('');
        $('#pesan').val('');
        $('#tanggal_kirim').val('');
        $('#id_pelanggaran').val('');
        $('#id_tipe_notifikasi').val('');
    }

    function editData(id) {
        $.ajax({
            url: 'action/notifikasiAction.php?act=get&id=' + id,
            method: 'post',
            success: function(response) {
                var data = JSON.parse(response);
                $('#form-data').modal('show');
                $('#form-tambah').attr('action',
                    'action/notifikasiAction.php?act=update&id=' + id);
                $('#id_penerima').val(data.id_penerima);
                $('#pesan').val(data.pesan);
                $('#tanggal_kirim').val(data.tanggal_kirim);
                $('#id_pelanggaran').val(data.id_pelanggaran);
                $('#username').val(data.username);
                $('#id_tipe_notifikasi').val(data.id_tipe_notifikasi);
            }
        });
    }

    function deleteData(id) {
        if (confirm('Apakah anda yakin?')) {
            $.ajax({
                url: 'action/notifikasiAction.php?act=delete&id=' + id,
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
                url: 'action/notifikasiAction.php?act=load',
                type: 'POST',
            },
            columns: [{
                    data: "no"
                },
                {
                    data: "id_penerima"
                },
                {
                    data: "pesan"
                },
                {
                    data: "tanggal_kirim"
                },
                {
                    data: "id_pelanggaran"
                },
                {
                    data: "id_tipe_notifikasi"
                }, // Tambahkan kolom untuk Password Admin
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
                    columns: [0, 1, 2, 3, 4, 5] // Only export visible columns
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

                pesan: {
                    required: true,
                    minlength: 5
                },


                tanggal_kirim: {
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
<?php
require_once('model/KelasModel.php');


$classData = new KelasModel();
$dataKelas = $classData->getData();

// print_r($data);

?>





<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Kelas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Kelas</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Kelas</h3>
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
                        <th>Nama Kelas</th>
                        <th>Nama Dpa</th>
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
    <form action="action/kelasAction.php?act=save" method="post" id="form-tambah">
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
                    <h4 class="modal-title" id="ModalTitle">Tambah Data Kelas</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kelas</label>
                        <input type="text" class="form-control" name="nama_kelas" id="nama_kelas">
                    </div>
                    <div class="form-group">
                        <label>Nama DPA</label>
                        <input type="text" class="form-control" name="nama_dpa" id="nama_dpa">
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
    $(document).ready(function() {

        tabelData = $('#table-data').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: 'action/kelasAction.php?act=load',
                type: 'POST',
            },
            columns: [{
                    data: 'no'
                },
                {
                    data: 'nama_kelas'
                },
                {
                    data: 'nama_dpa'
                },
                {
                    data: 'aksi'
                },
                // Add nama_kelas
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
                    columns: [0, 1, 2] // Only export visible columns
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
                nama_kelas: {
                    required: true,
                    minlength: 3
                },
                nama_dpa: {
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
                            tabelData.ajax.reload();
$.notify(result.message, "success");l // reload data tabel 
                        } else {
                            alert(result.message);
                        }
                    }
                });
            }
        });
    });

    function tambahData() {
        $("#ModalTitle").html('Tambah Data Kelas');

        $('#form-data').modal('show');
        $('#form-tambah').attr('action', 'action/kelasAction.php?act=save');
        $('#nama_kelas').val('');
        $('#nama_dpa').val('');

    }

    function editData(id) {

        console.log(id);
        $("#ModalTitle").html('Edit Data Kelas');
        $.ajax({
            url: 'action/kelasAction.php?act=get&id=' + id,
            method: 'post',
            success: function(response) {
                var data = JSON.parse(response);
                $('#form-data').modal('show');
                $('#form-tambah').attr('action',
                    'action/kelasAction.php?act=update&id=' + id);
                $('#nama_kelas').val(data.nama_kelas);
                $('#nama_dpa').val(data.nama_dpa);

            }
        });
    }

    function deleteData(id) {
        if (confirm('Apakah anda yakin?')) {
            $.ajax({
                url: 'action/kelasAction.php?act=delete&id=' + id,
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
</script>
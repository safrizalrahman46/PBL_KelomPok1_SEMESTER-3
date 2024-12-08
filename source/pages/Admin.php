<?php
include_once(__DIR__ . '/../model/UserModel.php');


$classData = new UserModel();
$dataUser = $classData->getData();

?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Admin</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Admin</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Admin</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-md btn-primary" onclick="tambahData()">
                    Tambah
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped" id="table-data">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Email Admin</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="form-data" style="display: none;" aria-hidden="true">
    <form action="action/adminAction.php?act=save" method="post" id="form-tambah">
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
                    <h4 class="modal-title">Form Admin</h4>
                </div>
                <div class="modal-body">


                    <div class="alert alert-danger" role="alert" id="formAlert" style="display:none" ;>

                    </div>
                    <input type="hidden" class="form-control" name="id" id="id">


                    <div class="form-group">
                        <label>Email Admin</label>
                        <input type="email" class="form-control" name="email_admin" id="email_admin">
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama">
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
        $('#form-tambah').attr('action', 'action/adminAction.php?act=save');
        $('#nama_admin').val('');
        $('#email_admin').val('');
        $('#ussrname').val('');
        $('#passwor').val('');
    }

    function editData(id) {
        $.ajax({
            url: 'action/adminAction.php?act=get&id=' + id,
            method: 'post',
            success: function(response) {
                var data = JSON.parse(response);
                $('#form-data').modal('show');
                $('#form-tambah').attr('action',
                    'action/adminAction.php?act=update&id=' + id);
                $('#id').val(data.id);
                $('#nama_admin').val(data.nama_admin);
                $('#email_admin').val(data.email_admin);
                $('#password_admin').val(data.password_admin);
                $('#nama').val(data.nama);
            }
        });
    }

    function deleteData(id) {
        if (confirm('Apakah anda yakin?')) {
            $.ajax({
                url: 'action/adminAction.php?act=delete&id=' + id,
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
                url: 'action/adminAction.php?act=load',
                type: 'POST',
            },
            columns: [{
                    data: 'no'
                },
                {
                    data: 'email_admin'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'username'
                },
                {
                    data: 'aksi'
                },
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
                    columns: [0, 1, 2, 3] // Only export visible columns
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

                email_admin: {
                    required: true,
                    email: true
                },

                nama: {
                    required: true,
                },

                username: {
                    required: true,
                },
                password: {
                    required: function(element) {
                        // Require password only if the id field is empty (add action)
                        return $('#id').val() === ''; 
                    }
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

                        console.log(result.message);
                        if (result.message != 'Username sudah digunakan oleh akun lainnya' && result.meessage != 'failed') {
                            $('#form-data').modal('hide');
                            tabelData.ajax.reload(); // reload data tabel 
                        } else {
                            $("#formAlert").show();
                            $("#formAlert").html(result.message);

                            // alert(result.message);
                        }
                    }
                });
            }
        });
    });
</script>
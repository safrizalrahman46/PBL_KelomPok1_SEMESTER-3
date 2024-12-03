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
                        <th>NIM</th>
                        <th>Email</th>
                        <th>Jurusan</th>
                        <th>Prodi</th>
                        <th>Username</th>
                        <th>Total Pelanggaran</th>
                        <th>Total Reward</th>
                        <th>Semester</th>
                        <th>Tingkat</th>
                        <th>Status</th>
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
    <form action="action/mahasiswaAction.php?act=save" method="post" id="form-tambah">
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
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" class="form-control" name="NIM" id="NIM">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label>Jurusan</label>
                        <input type="text" class="form-control" name="jurusan" id="jurusan">
                    </div>
                    <div class="form-group">
                        <label>Prodi</label>
                        <input type="text" class="form-control" name="prodi" id="prodi">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password " id="password">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" class="form-control" name="status" id="status">
                    </div>
                    <div class="form-group">
                        <label>Semester</label>
                        <input type="number" class="form-control" name="semester" id="semester">
                    </div>
                    <div class="form-group">
                        <label>Tingkat</label>
                        <input type="number" class="form-control" name="tingkat" id="tingkat">
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="text" class="form-control" name="foto" id="foto">
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
        $('#NIM').val('');
        $('#email').val('');
        $('#jurusan').val('');
        $('#prodi').val('');
        $('#username').val('');
        $('#password').val('');
        $('#status').val('');
        $('#semester').val('');
        $('#tingkat').val('');
        $('#foto').val('');
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
                $('#NIM').val(data.NIM);
                $('#email').val(data.email);
                $('#jurusan').val(data.jurusan);
                $('#prodi').val(data.prodi);
                $('#username').val(data.username);
                $('#password').val(data.password);
                $('#status').val(data.status);
                $('#semester').val(data.semester);
                $('#tingkat').val(data.tingkat);
                $('#foto').val(data.foto);
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
            ajax: 'action/mahasiswaAction.php?act=load',
    //         columns: [
    //     { title: "No" },
    //     { title: "Nama Admin" },
    //     { title: "Email Admin" },
    //     { title: "Password Admin" }, // Tambahkan kolom untuk Password Admin
    //     { title: "Aksi" }
    // ]
        });

        $('#form-tambah').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                NIM: {
                    required: true,
                    minlength: 5
                },
                email: {
                    required: true,
                    email: true
                },
                jurusan: {
                    required: true,
                    minlength: 3
                },
                prodi: {
                    required: true,
                    minlength: 3
                },
                username: {
                    required: true,
                    minlength: 3
                },
                password: {
                    required: true,
                    minlength: 6
                },
                status: {
                    required: true
                },
                semester: {
                    required: true,
                    digits: true
                },
                tingkat: {
                    required: true,
                    digits: true
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

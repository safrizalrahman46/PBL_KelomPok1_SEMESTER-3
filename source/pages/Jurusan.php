<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Jurusan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Jurusan</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Jurusan</h3>
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
                        <th>Nama Jurusan</th>
                        <th>Department ID</th>
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
    <form action="action/jurusanAction.php?act=save" method="post" id="form-tambah">
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
                    <h4 class="modal-title">Tambah Jurusan</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Jurusan</label>
                        <input type="text" class="form-control" name="nama_jurusan" id="nama_jurusan">
                    </div>
                    <div class="form-group">
                        <label>Department ID</label>
                        <input type="number" class="form-control" name="department_id" id="department_id">
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
        $('#form-tambah').attr('action', 'action/jurusanAction.php?act=save');
        $('#nama_jurusan').val('');
        $('#department_id').val('');
    }

    
    function editData(id) {
        $.ajax({
            url: 'action/jurusanAction.php?act=get&id=' + id,
            method: 'post',
            success: function(response) {
                var data = JSON.parse(response);
                $('#form-data').modal('show');
                $('#form-tambah').attr('action',
                    'action/jurusanAction.php?act=update&id=' + id);
                    $('#nama_jurusan').val(data.nama_jurusan);
                    $('#department_id').val(data.department_id);
            }
            
        });
    }

    function deleteData(id) {
        if (confirm('Apakah anda yakin?')) {
            $.ajax({
                url: 'action/jurusanAction.php?act=delete&id=' + id,
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
            ajax: 'action/jurusanAction.php?act=load',
            columns: [
            { title: "No" },
            { title: "Nama Jurusan" },
            { title: "Department ID" },
            { title: "Aksi" }
        ]
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
                nama_jurusan: {
                    required: true,
                    minlength: 3
                },
                department_id: {
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

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Daftar Buku</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Buku</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Buku</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-md btn-primary" onclick="tambahBuku()">
                    Tambah Buku
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-striped" id="table-buku">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Kode Buku</th>
                        <th>Nama Buku</th>
                        <th>Jumlah</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</section>

<div class="modal fade" id="form-buku" style="display: none;" aria-hidden="true">
<!-- <form action="action/bukuAction.php?act=save" method="post" id="form-tambah-buku" enctype="multipart/form-data"> -->

    <form action="action/bukuAction.php?act=save" method="post" id="form-tambah-buku">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Buku</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select class="form-control" name="kategori_id" id="kategori_id" required>
                        <option value="" disabled selected>Pilih Kategori Buku</option>
                                    <option value="1">Fiksi</option>
                                    <option value="2">Novel</option>
                                    <option value="3">Ilmiah</option>
                                    <option value="4">Misteri</option>
                                    <option value="5">Sosial</option>
                                    <option value="6">LKK</option>
                                
                    </select>
                    </div>
                    <div class="form-group">
                        <label>Kode Buku</label>
                        <input type="text" class="form-control" name="buku_kode" id="buku_kode">
                    </div>
                    <div class="form-group">
                        <label>Nama Buku</label>
                        <input type="text" class="form-control" name="buku_nama" id="buku_nama">
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" id="jumlah">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="text" class="form-control" name="gambar" id="gambar">
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
    function tambahBuku() {
        $('#form-buku').modal('show');
        $('#form-tambah-buku').attr('action', 'action/bukuAction.php?act=save');
        $('#kategori_id').val('');
        $('#buku_kode').val('');
        $('#buku_nama').val('');
        $('#jumlah').val('');
        $('#deskripsi').val('');
        $('#gambar').val('');
    }

    function editBuku(id) {
        $.ajax({
            url: 'action/bukuAction.php?act=get&id=' + id,
            method: 'post',
            success: function(response) {
                var data = JSON.parse(response);
                $('#form-buku').modal('show');
                $('#form-tambah-buku').attr('action', 'action/bukuAction.php?act=update&id=' + id);
                $('#kategori_id').val(data.kategori_id);
                $('#buku_kode').val(data.buku_kode);
                $('#buku_nama').val(data.buku_nama);
                $('#jumlah').val(data.jumlah);
                $('#deskripsi').val(data.deskripsi);
                $('#gambar').val(''); // Reset file input for security
            }
        });
    }

    function deleteBuku(id) {
        if (confirm('Apakah anda yakin?')) {
            $.ajax({
                url: 'action/bukuAction.php?act=delete&id=' + id,
                method: 'post',
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.status) {
                        tabelBuku.ajax.reload();
                    } else {
                        alert(result.message);
                    }
                }
            });
        }
    }

    function editBuku(id) {
    $.ajax({
        url: 'action/bukuAction.php?act=get&id=' + id,
        method: 'post',
        success: function(response) {
            var data = JSON.parse(response);
            $('#form-buku').modal('show');
            $('#form-tambah-buku').attr('action', 'action/bukuAction.php?act=update&id=' + id);
            $('#kategori_id').val(data.kategori_id);
            $('#buku_kode').val(data.buku_kode);
            $('#buku_nama').val(data.buku_nama);
            $('#jumlah').val(data.jumlah);
            $('#deskripsi').val(data.deskripsi);
            $('#gambar').val(''); // Reset file input for security
        }
    });
}

function deleteBuku(id) {
    if (confirm('Apakah anda yakin?')) {
        $.ajax({
            url: 'action/bukuAction.php?act=delete&id=' + id,
            method: 'post',
            success: function(response) {
                var result = JSON.parse(response);
                if (result.status) {
                    tabelBuku.ajax.reload();
                } else {
                    alert(result.message);
                }
            }
        });
    }
}

    var tabelBuku;
    $(document).ready(function() {
        tabelBuku = $('#table-buku').DataTable({
            ajax: 'action/bukuAction.php?act=load',
        });

        // Load categories for the dropdown
        $.ajax({
            url: 'action/kategoriAction.php?act=loadCategories',
            method: 'get',
            success: function(response) {
                var categories = JSON.parse(response);
                categories.forEach(function(category) {
                    $('#kategori_id').append(
                        `<option value="${category.kategori_id}">${category.kategori_nama}</option>`
                    );
                });
            }
        });

        $('#form-tambah-buku').validate({
            rules: {
                kategori_id: { required: true },
                buku_kode: { required: true, minlength: 3 },
                buku_nama: { required: true, minlength: 2 },
                jumlah: { required: true, min: 1 },
                deskripsi: { required: true, minlength: 2 }
                
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                $.ajax({
                    url: $(form).attr('action'),
                    method: 'post',
                    data: new FormData(form),
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.status) {
                            $('#form-buku').modal('hide');
                            tabelBuku.ajax.reload();
                        } else {
                            alert(result.message);
                        }
                    }
                });
            }
        });
    });
</script>

<?php 
// require_once('model/JenisPelanggaranModel.php');


// $classData = new JenisPelanggaranModel();
// $dataKelas = $classData->getData();

include_once(__DIR__.'/../model/tingkatpelanggaranModel.php');


$classData = new tingkatpelanggaranModel();
$dataTingkat = $classData->getData();
// print_r($data);

?>





<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Jenis Pelanggaran</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Jenis Pelanggaran</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Jenis Pelanggaran</h3>
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
                        <th>Deskripsi</th>
                        <th>Tingkat</th>
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
    <form action="action/jenispelanggaranAction.php?act=save" method="post" id="form-tambah">
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
                        <label>Deskripsi</label>
                        <input type="text" class="form-control" name="deskkripsi" id="deskkripsi">
                    </div>
                    <div class="form-group">
                        <label>ID Tingkat</label>

                        <select name="id_tingkat" id="id_tingkat" class="form-control">
                            <?php 
                                foreach ($dataTingkat as $key => $value) {
                            ?>  
                                <option value="<?= $value['id_tingkat_pelanggaran']; ?>"><?= $value['deskripsi'] ?></option>
                            <?php 
                                }
                            ?>
                        </select>
                        <!-- <input type="number" class="form-control" name="id_kelas" id="id_kelas"> -->
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
        $('#form-tambah').attr('action', 'action/jenispelanggaranAction.php?act=save');
        $('#deskkripsi').val('');
        $('#id_tingkat').val('');

    }

    function editData(id) {
        $.ajax({
            url: 'action/jenispelanggaranAction.php?act=get&id=' + id,
            method: 'post',
            success: function(response) {
                var data = JSON.parse(response);
                $('#form-data').modal('show');
                $('#form-tambah').attr('action',
                    'action/jenispelanggaranAction.php?act=update&id=' + id);
                $('#deskkripsi').val(data.deskkripsi);
                $('#id_tingkat').val(data.id_tingkat);
     
            }
        });
    }

    function deleteData(id) {
        if (confirm('Apakah anda yakin?')) {
            $.ajax({
                url: 'action/jenispelanggaranAction.php?act=delete&id=' + id,
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
                url: 'action/jenispelanggaranAction.php?act=load',
                type: 'POST',
            },
            columns: [
                { data: 'no' },
                { data: 'deskripsi' },
                { data: 'id_tingkat' },
                { data: 'aksi' },
                 // Add deskkripsi
            ],
        });


        $('#form-tambah').validate({
            rules: {
                deskkripsi: {
                    required: true,
                    minlength: 3
                },
                id_tingkat: {
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
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

// include_once(__DIR__ . '/../model/KelasModel.php');

// $classData = new KelasModel();
// $dataKelas = $classData->getData();

// include_once(__DIR__ . '/../model/JenisPelanggaranModel.php');

// $classData = new JenisPelanggaranModel();
// $dataLanggar = $classData->getData();

// include_once(__DIR__ . '/../model/.php');

// $classData = new ();
// $dataLanggar = $classData->getData();

?>


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Tipe notifikasi </h1>
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
                        <th>Notif Template</th>
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
    <form action="action/tipenotifikasiAction.php?act=save" method="post" id="form-tambah">
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
                    <h4 class="modal-title">Tambah notifikasi</h4>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>template</label>
                            <input type="text" class="form-control" name="notif_template" id="notif_template" required>
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
        $('#form-tambah').attr('action', 'action/tipenotifikasiAction.php?act=save');
        $('#notif_template').val('');
 
    }

    function editData(id) {
        $.ajax({
            url: 'action/tipenotifikasiAction.php?act=get&id=' + id,
            method: 'post',
            success: function(response) {
                var data = JSON.parse(response);
                $('#form-data').modal('show');
                $('#form-tambah').attr('action',
                    'action/tipenotifikasiAction.php?act=update&id=' + id);
                $('#notif_template').val(data.notif_template);
   
            }
        });
    }

    function deleteData(id) {
        if (confirm('Apakah anda yakin?')) {
            $.ajax({
                url: 'action/tipenotifikasiAction.php?act=delete&id=' + id,
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
                url: 'action/tipenotifikasiAction.php?act=load',
                type: 'POST',
            },
                    columns: [
                { data: "no" },
                { data: "notif_template" },
                { data: "aksi" }
            ]
        });

        $('#form-tambah').validate({
            rules: {
              
                notif_template: {
                    required: true,
                    minlength: 5
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
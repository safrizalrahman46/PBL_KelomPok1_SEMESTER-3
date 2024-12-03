<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Notifikasi </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data Notifikasi </li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Notifikasi </h3>
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
                        <th>ID Penerima</th>
                        <th>Pesan</th>
                        <th>Tanggal Dikirim</th>
                        <th>Diterima</th>
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
    <form action="action/notificationAction.php?act=save" method="post" id="form-tambah">
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
                        <label>ID Penerima</label>
                        <input type="number" class="form-control" name="recipient_id" id="recipient_id">
                    </div>
                    <div class="form-group">
                        <label>Pesan</label>
                        <input type="text" class="form-control" name="message" id="message">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Dikirim</label>
                        <input type="datetime-local" class="form-control" name="date_sent" id="date_sent">
                    </div>
                    <div class="form-group">
                        <label>Diterima</label>
                        <select class="form-control" name="acknowledged" id="acknowledged">
                            <option value="0">Belum Diterima</option>
                            <option value="1">Diterima</option>
                        </select>
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
        $('#form-tambah').attr('action', 'action/notificationAction.php?act=save');
        $('#recipient_id').val('');
        $('#message').val('');
        $('#date_sent').val('');
        $('#acknowledged').val('0');
    }

    function editData(id) {
        $.ajax({
            url: 'action/notificationAction.php?act=get&id=' + id,
            method: 'post',
            success: function(response) {
                var data = JSON.parse(response);
                $('#form-data').modal('show');
                $('#form-tambah').attr('action',
                    'action/notificationAction.php?act=update&id=' + id);
                    $('#recipient_id').val(data.recipient_id);
                $('#message').val(data.message);
                $('#date_sent').val(data.date_sent);
                $('#acknowledged').val(data.acknowledged);
            }
        });
    }

    function deleteData(id) {
        if (confirm('Apakah anda yakin?')) {
            $.ajax({
                url: 'action/notificationAction.php?act=delete&id=' + id,
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
            ajax: 'action/notificationAction.php?act=load',
            // data: response.data, // Ensure this is the correct path to your data
            columns: [
                { title: "No" },
                { title: "ID Penerima" },
                { title: "Pesan" },
                { title: "Tanggal Dikirim" },
                { title: "Diterima" },
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
                recipient_id: {
                    required: true,
                    digits: true
                },
                message: {
                    required: true,
                    minlength: 5
                },
                date_sent: {
                    required: true
                },
                acknowledged: {
                    required: true
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

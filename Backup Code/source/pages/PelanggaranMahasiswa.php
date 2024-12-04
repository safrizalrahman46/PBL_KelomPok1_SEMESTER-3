<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pelanggaran Mahasiswa</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Pelanggaran Mahasiswa</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Pelanggaran Mahasiswa</h3>
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
                        <th>Mahasiswa ID</th>
                        <th>Violation Type ID</th>
                        <th>Reported By</th>
                        <th>Report Date</th>
                        <th>Sanction Status</th>
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
    <form action="action/pelanggaranMahasiswaAction.php?act=save" method="post" id="form-tambah">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Pelanggaran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="mahasiswa_id">Mahasiswa ID</label>
                        <input type="number" class="form-control" name="mahasiswa_id" id="mahasiswa_id" required>
                    </div>
                    <div class="form-group">
                        <label for="violation_type_id">Violation Type ID</label>
                        <input type="number" class="form-control" name="violation_type_id" id="violation_type_id" required>
                    </div>
                    <div class="form-group">
                        <label for="reported_by">Reported By</label>
                        <input type="number" class="form-control" name="reported_by" id="reported_by" required>
                    </div>
                    <div class="form-group">
                        <label for="report_date">Report Date</label>
                        <input type="datetime-local" class="form-control" name="report_date" id="report_date" required>
                    </div>
                    <div class="form-group">
                        <label for="sanction_status">Sanction Status</label>
                        <input type="text" class="form-control" name="sanction_status" id="sanction_status" required minlength="3">
                    </div>
                    <div class="form-group">
                        <label for="comments">Comments</label>
                        <textarea class="form-control" name="comments" id="comments"></textarea>
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
        $('#form-tambah').attr('action', 'action/pelanggaranMahasiswaAction.php?act=save');
        $('#mahasiswa_id').val('');
        $('#violation _type_id').val('');
        $('#reported_by').val('');
        $('#report_date').val('');
        $('#sanction_status').val('');
        $('#comments').val('');
    }

    function editData(id) {
        $.ajax({
            url: 'action/pelanggaranMahasiswaAction.php?act=get&id=' + id,
            method: 'post',
            success: function(response) {
                var data = JSON.parse(response);
                $('#form-data').modal('show');
                $('#form-tambah').attr('action',
                    'action/pelanggaranMahasiswaAction.php?act=update&id=' + id);
                    $('#mahasiswa_id').val(data.mahasiswa_id);
                $('#violation_type_id').val(data.violation_type_id);
                $('#reported_by').val(data.reported_by);
                $('#report_date').val(data.report_date);
                $('#sanction_status').val(data.sanction_status);
                $('#comments').val(data.comments);
            }
        });
    }

    function deleteData(id) {
        if (confirm('Apakah anda yakin?')) {
            $.ajax({
                url: 'action/pelanggaranMahasiswaAction.php?act=delete&id=' + id,
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
            ajax: 'action/pelanggaranMahasiswaAction.php?act=load',
            columns: [
                { title: "No", data: null, render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1; // Display row number
                }},
                { data: 'mahasiswa_id' },
                { data: 'violation_type_id' },
                { data: 'reported_by' },
                { data: 'report_date' },
                { data: 'sanction_status' },
                { data: null, render: function(data, type, row) {
                    return '<button class="btn btn-sm btn-warning" onclick="editData(' + row.id_pelanggaran + ')"><i class="fa fa-edit"></i></button> ' +
                           '<button class="btn btn-sm btn-danger" onclick="deleteData(' + row.id_pelanggaran + ')"><i class="fa fa-trash"></i></button>';
                }}
            ]
        });
    // var tabelData;
    // $(document).ready(function() {
    //     tabelData = $('#table-data').DataTable({
    //         ajax: 'action/pelanggaranMahasiswaAction.php?act=load',
    
    //     });

        $('#form-tambah').validate({
            rules: {
                mahasiswa_id: {
                    required: true,
                    digits: true
                },
                violation_type_id: {
                    required: true,
                    digits: true
                },
                reported_by: {
                    required: true,
                    digits: true
                },
                report_date: {
                    required: true
                },
                sanction_status: {
                    required: true,
                    minlength: 3
                },
                comments: {
                    required: false
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

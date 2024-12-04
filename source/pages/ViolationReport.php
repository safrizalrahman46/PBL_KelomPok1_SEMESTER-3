<section class="content-header">
    <div class ="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pelaporan Pelanggaran</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Pelaporan</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Pelaporan Pelanggaran</h3>
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
                        <th>Submitted By</th>
                        <th>Violation Type</th>
                        <th>Report Date</th>
                        <th>Status</th>
                        <th>Reviewed By</th>
                        <th>Resolution Date</th>
                        <th>Comments</th>
                        <th>DPA Verification Status</th>
                        <th>Faculty Involved ID</th>
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
    <form action="action/violationReportAction.php?act=save" method="post" id="form-tambah">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Pelaporan</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Submitted By</label>
                        <input type="text" class="form-control" name="submitted_by" id="submitted_by">
                    </div>
                    <div class="form-group">
                        <label>Violation Type</label>
                        <input type="text" class="form-control" name="violation_type" id="violation_type">
                    </div>
                    <div class="form-group">
                        <label>Report Date</label>
                        <input type="datetime-local" class="form-control" name="report_date" id="report_date">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" class="form-control" name="status" id="status">
                    </div>
                    <div class="form-group">
                        <label>Reviewed By</label>
                        <input type="text" class="form-control" name="reviewed_by" id="reviewed_by">
                    </div>
                    <div class="form-group">
                        <label>Resolution Date</label>
                        <input type="datetime-local" class="form-control" name="resolution_date" id="resolution_date">
                    </div>
                    <div class="form-group">
                        <label>Comments</label>
                        <input type="text" class="form-control" name="comments" id="comments">
                    </div>
                    <div class="form-group">
                        <label>DPA Verification Status</label>
                        <select class="form-control" name="dpa_verification_status" id="dpa_verification_status">
                            <option value="1">Verified</option>
                            <option value="0">Not Verified</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Faculty Involved ID</label>
                        <input type="text" class="form-control" name="faculty_involved_id" id="faculty_involved_id">
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
        $('#form-tambah').attr('action', 'action/violationReportAction.php? act=save');
        $('#submitted_by').val('');
        $('#violation_type').val('');
        $('#report_date').val('');
        $('#status').val('');
        $('#reviewed_by').val('');
        $('#resolution_date').val('');
        $('#comments').val('');
        $('#dpa_verification_status').val('1');
        $('#faculty_involved_id').val('');
    }

    function editData(id) {
        $.ajax({
            url: 'action/violationReportAction.php?act=get&id=' + id,
            method: 'post',
            success: function(response) {
                var data = JSON.parse(response);
                $('#form-data').modal('show');
                $('#form-tambah').attr('action', 'action/violationReportAction.php?act=update&id=' + id);
                $('#submitted_by').val(data.submitted_by);
                $('#violation_type').val(data.violation_type);
                $('#report_date').val(data.report_date);
                $('#status').val(data.status);
                $('#reviewed_by').val(data.reviewed_by);
                $('#resolution_date').val(data.resolution_date);
                $('#comments').val(data.comments);
                $('#dpa_verification_status').val(data.dpa_verification_status);
                $('#faculty_involved_id').val(data.faculty_involved_id);
            }
        });
    }

    function deleteData(id) {
        if (confirm('Apakah anda yakin?')) {
            $.ajax({
                url: 'action/violationReportAction.php?act=delete&id=' + id,
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
            ajax: 'action/violationReportAction.php?act=load',
            columns: [
                { title: "No", data: null, render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1; // Display row number
                }},
                { data: 'submitted_by' },
                { data: 'violation_type' },
                { data: 'report_date' },
                { data: 'status' },
                { data: 'reviewed_by' },
                { data: 'resolution_date' },
                { data: 'comments' },
                { data: 'dpa_verification_status' },
                { data: 'faculty_involved_id' },
                { data: 'action' }
            ]
        });
    });
</script>
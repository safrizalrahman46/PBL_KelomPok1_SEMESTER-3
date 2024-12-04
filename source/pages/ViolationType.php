<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Violation Types</h1> <!-- Updated title -->
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Violation Types</li> <!-- Updated breadcrumb -->
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List of Violation Types</h3> <!-- Updated title -->
            <div class="card-tools <button type="button" class="btn btn-md btn-primary" onclick="tambahData()">
                    Add
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-striped" id="table-data">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Description</th>
                        <th>Level ID</th>
                        <th>Punishment Points</th>
                        <th>Sanction</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</section>

<div class="modal fade" id="form-data" style="display: none;" aria-hidden="true">
    <form action="action/violationTypeAction.php?act=save" method="post" id="form-tambah">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Violation Type</h4> <!-- Updated title -->
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" id="description">
                    </div>
                    <div class="form-group">
                        <label>Level ID</label>
                        <input type="number" class="form-control" name="level_id" id="level_id">
                    </div>
                    <div class="form-group">
                        <label>Punishment Points</label>
                        <input type="number" class="form-control" name="penalty_points" id="penalty_points">
                    </div>
                    <div class="form-group">
                        <label>Sanction</label>
                        <textarea class="form-control" name="sanction" id="sanction"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    function tambahData() {
        $('#form-data').modal('show');
        $('#form-tambah').attr('action', 'action/violationTypeAction.php?act=save');
        $('#description').val('');
        $('#level_id').val('');
        $('#penalty_points').val('');
        $('#sanction').val('');
    }

    function editData(id) {
        $.ajax({
            url: 'action/violationTypeAction.php?act=get&id=' + id,
            method: 'post',
            success: function(response) {
                var data = JSON.parse(response);
                $('#form-data').modal('show');
                $('#form-tambah').attr('action', 'action/violationTypeAction.php?act=update&id=' + id);
                $('#description').val(data.description);
                $('#level_id').val(data.level_id);
                $('#penalty_points').val(data.penalty_points);
                $('#sanction').val(data.sanction);
            }
        });
    }

    function deleteData(id) {
        if (confirm('Are you sure?')) {
            $.ajax({
                url: 'action/violationTypeAction.php?act=delete&id=' + id,
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
            ajax: 'action/violationTypeAction.php?act=load',
        });

        $('#form-tambah').validate({
            rules: {
                description: {
                    required: true,
                    minlength: 3
                },
                level_id: {
                    required: true,
                    digits: true
                },
                penalty_points: {
                    required: true,
                    digits: true
                },
                sanction: {
                    required: true,
                    minlength: 5
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
                $(element).removeClass('is-invalid'); // Corrected syntax
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
                            tabelData.ajax.reload(); // reload data table
                        } else {
                            alert(result.message);
                        }
                    }
                });
            }
        });
    });
</script>
<!-- <script>
    function tambahData() {
        $('#form-data').modal('show');
        $('#form-tambah').attr('action', 'action/violationTypeAction.php?act=save');
        $('#description').val('');
        $('#level_id').val('');
        $('#penalty_points').val('');
        $('#sanction').val('');
    }

    function editData(id) {
        $.ajax({
            url: 'action/violationTypeAction.php?act=get&id=' + id,
            method: 'post',
            success: function(response) {
                var data = JSON.parse(response);
                $('#form-data').modal('show');
                $('#form-tambah').attr('action', 'action/violationTypeAction.php?act=update&id=' + id);
                $('#description').val(data.description);
                $('#level_id').val(data.level_id);
                $('#penalty_points').val(data.penalty_points);
                $('#sanction').val(data.sanction);
            }
        });
    }

    function deleteData(id) {
        if (confirm('Are you sure?')) {
            $.ajax({
                url: 'action/violationTypeAction.php?act=delete&id=' + id,
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
            ajax: 'action/violationTypeAction.php?act=load',
        });

        $('#form-tambah').validate({
            rules: {
                description: {
                    required: true,
                    minlength: 3
                },
                level_id: {
                    required: true,
                    digits: true
                },
                penalty_points: {
                    required: true,
                    digits: true
                },
                sanction: {
                    required: true,
                    minlength: 5
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
            unhighlight: function(element, errorClass, validClass) $(element).removeClass('is-invalid');
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
                            tabelData.ajax.reload(); // reload data table 
                        } else {
                            alert(result.message);
                        }
                    }
                });
            }
        });
    });
</script> -->
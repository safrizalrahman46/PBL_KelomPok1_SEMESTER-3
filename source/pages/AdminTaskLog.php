<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Admin Task Log</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Admin Task Log</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Admin Task Log</h3>
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
                    <th>Admin ID</th>
                        <th>Deskripsi Tugas</th>
                        <th>Tanggal Tugas</th>
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
    <form action="action/adminTaskLogAction.php?act=save" method="post" id="form-tambah">
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
                    <h4 class="modal-title">Form Admin Task Log</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Admin ID</label>
                        <select class="form-control" name="admin_id" id="admin_id" required>
                        <option value="" disabled selected>Pilih ADMIN</option>
                        <?php
                            // Sample data
                            $admins = [
                                1 => "Danin, S.AP.",
                                2 => "Gian Nurafifa Cessari, A.Md.",
                                3 => "Lailatul Qodriayah, S.Sos.",
                                4 => "Mariska Dwitya Adilasari, A.Md.",
                                5 => "Mulyo Prasetyo, SE.",
                                6 => "Roszyhana Hadi Untari, S.Pd",
                                7 => "Sri Whariyanti, S.S.",
                                8 => "Titis Octary Satrio, S.ST.",
                                9 => "Widya Novy Nuraeny, A.Md.",
                                10 => "safrizalsssatt",
                                11 => "XZXZ"
                                
                            ];

                            // Create a new array with sequential IDs
                            $sequentialAdmins = [];
                            foreach ($admins as $id => $name) {
                                $sequentialAdmins[] = [
                                    'id' => count($sequentialAdmins) + 1, // Sequential ID starting from 1
                                    'name' => $name
                                ];
                            }

                            // Generate options
                            foreach ($sequentialAdmins as $admin): ?>
                                <option value="<?php echo $admin['id']; ?>"><?php echo $admin['name']; ?></option>
                            <?php endforeach; ?>
                                
                    </select>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Tugas</label>
                        <input type="text" class="form-control" name="task_description" id="task_description">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Tugas</label>
                        <input type="datetime-local" class="form-control" name="task_date" id="task_date"  ">
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
        $('#form-tambah').attr('action', 'action/adminTaskLogAction.php?act=save');
        $('#admin_id').val('');
        $('#task_description').val('');
        $('#task_date').val('');
    }

    function editData(id) {
        $.ajax({
            url: 'action/adminTaskLogAction.php?act=get&id=' + id,
            method: 'post',
            success: function(response) {
                var data = JSON.parse(response);
                $('#form-data').modal('show');
                $('#form-tambah').attr('action',
                    'action/adminTaskLogAction.php?act=update&id=' + id);
                    $('#admin_id').val(data.admin_id);
                $('#task_description').val(data.task_description);
                $('#task_date').val(data.task_date);
            }
        });
    }

    function deleteData(id) {
        if (confirm('Apakah anda yakin?')) {
            $.ajax({
                url: 'action/adminTaskLogAction.php?act=delete&id=' + id,
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
            ajax: 'action/adminTaskLogAction.php?act=load',
            
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
                admin_id: {
                    required: true,
                    digits: true,
                    minlength: 1
                },
                task_description: {
                    required: true,
                    minlength: 6
                },
                task_date: {
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

    //    // Inisialisasi DataTables
    //    $(document).ready(function() {
    //     tabelData = $('#table-data').DataTable({
    //         processing: true,
    //         serverSide: true,
    //         ajax: {
    //             url: 'action/adminTaskLogAction.php?act=load',
    //             type: 'GET',
    //             dataSrc: 'data'
    //         },
    //         columns: [
    //             { title: "No", data: null, defaultContent: "" },
    //             { title: "Admin ID", data: 1 },
    //             { title: "Deskripsi Tugas", data: 2 },
    //             { title: "Tanggal Tugas", data: 3 },
    //             { title: "Aksi", data: 4 }
    //         ]
    //     });
    // });
    
</script>

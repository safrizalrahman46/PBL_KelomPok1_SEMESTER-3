<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Audit Log</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Audit Log</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Audit Log</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped" id="table-auditlog">
                    <thead>
                        <tr>
                            <!-- <th>Log ID</th> -->
                            <th>Action</th>
                            <th>ID Pelanggaran</th>
                            <th>Nama Mahasiswa</th>
                            <th>Komentar</th>
                            <th>Tanggal Laporan</th>
                            <th>Tempat</th>
                            <th>Log Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#table-auditlog').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: 'action/auditLogAction.php?act=load',
                type: 'POST',
                // "dataSrc": ""
                "dataSrc": "data"

            },
            columns: [
                {
                    data: "Action"
                },
                { 
                    data: "ID_Pelanggaran" 
                },
                { 
                    data: "NamaMahasiswa" 
                },
                
                // {
                //     data: "deskripsi"
                // },
                {
                    data: "Komentar"
                },
                {
                    data: "Tanggal_Laporan"
                },
                {
                    data: "Tempat"
                },
                {
                    data: "LogDate"
                }
            ]
        });
    });

    
</script>


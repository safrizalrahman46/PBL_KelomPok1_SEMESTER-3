<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Student Violations</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Student Violations</li>
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
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped" id="table-student-violations">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>ID Pelanggaran</th>
                            <th>Komentar</th>
                            <th>Status Verifikasi Admin</th>
                            <th>Jenis Pelanggaran</th>
                            <th>Tanggal Laporan</th>
                            <th>Tempat</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#table-student-violations').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: 'action/StudentViolationsAction.php?act=load',
                type: 'POST',
                "dataSrc": "data"
            },
            columns: [
                { data: "nim" },
                { data: "nama" },
                { data: "email" },
                { data: "id_pelanggaran" },
                { data: "komentar" },
                {
                    data: "status_verifikasi_admin",
                    render: function(data, type, row) {
                        if (data === "Setuju" || data === "Disetujui") {
                            return '<span class="badge badge-success">Disetujui</span>';
                        } else if (data === "Tidak Setuju" || data === "Tidak Disetujui") {
                            return '<span class="badge badge-danger">Tidak Disetujui</span>';
                        }
                        return '<span class="badge badge-secondary">Belom Diverifikasi</span>'; // Fallback untuk nilai lain
                    }
                },
                { data: "jenis_pelanggaran" },
                { data: "tanggal_laporan" },
                { data: "tempat" }
            ]
        });
    });
</script>

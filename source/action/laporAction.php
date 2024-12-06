<?php
include('../lib/Session.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

include_once('../model/laporModel.php');
include_once('../lib/Secure.php');

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'load') {
    $admin = new laporModel();
    $data = $admin->getDataForDataTables($_POST);

    // Prepare the response for DataTables
    $result = [
        "draw" => intval($_POST['draw']),
        "recordsTotal" => $data['recordsTotal'], // Total number of records
        "recordsFiltered" => $data['recordsFiltered'], // Total filtered records
        "data" => []
    ];

    foreach ($data['data'] as $row) {
        $result['data'][] = [
            'no' => ($row+1),
            'id_pelanggaran' => htmlspecialchars($row['id_pelanggaran']),
            'mahasiswa_id' => htmlspecialchars($row['mahasiswa_id']),
            'id_jenis_pelanggaran' => htmlspecialchars($row['id_jenis_pelanggaran']),
            'tanggal_laporan' => htmlspecialchars($row['tanggal_laporan']),
            'status' => htmlspecialchars($row['status']),
            'id_admin' => htmlspecialchars($row['id_admin']),
            'id_dosen' => htmlspecialchars($row['id_dosen']),
            'status_verifikasi_admin' => htmlspecialchars($row['status_verifikasi_admin']),
            'nim' => htmlspecialchars($row['nim']),
            'foto' => htmlspecialchars($row['foto']),
            'aksi' => '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id_pelanggaran'] . ')"><i class="fa fa-edit"></i></button>
                       <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id_pelanggaran'] . ')"><i class="fa fa-trash"></i></button>'
        ];
    }

    echo json_encode($result);
}

if ($act == 'get') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $admin = new laporModel();
    $data = $admin->getDataById($id);
    echo json_encode($data);
}

if ($act == 'save') {
    $data = [
        'mahasiswa_id' => antiSqlInjection($_POST['mahasiswa_id']),
        'id_jenis_pelanggaran' => antiSqlInjection($_POST['id_jenis_pelanggaran']),
        'laporan_oleh' => antiSqlInjection($_POST['laporan_oleh']),
        'tanggal_laporan' => antiSqlInjection($_POST['tanggal_laporan']),
        'status' => antiSqlInjection($_POST['status']),
        'komentar' => antiSqlInjection($_POST['komentar']),
        'id_admin' => antiSqlInjection($_POST['id_admin']),
        'id_dosen' => antiSqlInjection($_POST['id_dosen']),
        'status_verifikasi_admin' => antiSqlInjection($_POST['status_verifikasi_admin']),
        'nim' => antiSqlInjection($_POST['nim']),
        'foto' => antiSqlInjection($_POST['foto']),
    ];

    $admin = new laporModel();
    $admin->insertData($data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil disimpan.'
    ]);
}

if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $data = [
        'mahasiswa_id' => antiSqlInjection($_POST['mahasiswa_id']),
        'id_jenis_pelanggaran' => antiSqlInjection($_POST['id_jenis_pelanggaran']),
        'laporan_oleh' => antiSqlInjection($_POST['laporan_oleh']),
        'tanggal_laporan' => antiSqlInjection($_POST['tanggal_laporan']),
        'status' => antiSqlInjection($_POST['status']),
        'komentar' => antiSqlInjection($_POST['komentar']),
        'id_admin' => antiSqlInjection($_POST['id_admin']),
        'id_dosen' => antiSqlInjection($_POST['id_dosen']),
        'status_verifikasi_admin' => antiSqlInjection($_POST['status_verifikasi_admin']),
        'nim' => antiSqlInjection($_POST['nim']),
        'foto' => antiSqlInjection($_POST['foto']),
    ];

    $admin = new laporModel();
    $admin->updateData($id, $data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil diupdate.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $admin = new laporModel();
    $admin->deleteData($id);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil dihapus.'
    ]);
}

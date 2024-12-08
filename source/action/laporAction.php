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
    $langgar = new laporModel();
    $data = $langgar->getDataForDataTables($_POST);

    // Prepare the response for DataTables
    $result = [
        "draw" => intval($_POST['draw']),
        "recordsTotal" => $data['recordsTotal'], // Total number of records
        "recordsFiltered" => $data['recordsFiltered'], // Total filtered records
        "data" => []
    ];

    foreach ($data['data'] as $key => $row) {
        $result['data'][] = [
            'no' => ($key + 1), // Correctly calculate the index
            'id_mahasiswa' => isset($row['id_mahasiswa']) ? htmlspecialchars(string: $row['id_mahasiswa']) : '',
            'mahasiswa_nama' => isset($row['mahasiswa_nama']) ? htmlspecialchars(string: $row['mahasiswa_nama']) : '',
            'id_jenis_pelanggaran' => isset($row['id_jenis_pelanggaran']) ? htmlspecialchars(string: $row['id_jenis_pelanggaran']) : '',
            'deskripsi' => isset($row['deskripsi']) ? htmlspecialchars(string: $row['deskripsi']) : '',
            'komentar' => htmlspecialchars($row['komentar']),
            'id_admin' => isset($row['id_admin']) ? htmlspecialchars(string: $row['id_admin']) : '',
            'admin_nama' => isset($row['admin_nama']) ? htmlspecialchars(string: $row['admin_nama']) : '',
            'id_dosen' => isset($row['id_dosen']) ? htmlspecialchars(string: $row['id_dosen']) : '',
            'dosen_nama' => isset($row['dosen_nama']) ? htmlspecialchars(string: $row['dosen_nama']) : '',
            'status_verifikasi_admin' => htmlspecialchars($row['status_verifikasi_admin']),
            'nim' => htmlspecialchars($row['nim']),
            'foto' => htmlspecialchars($row['foto']),
            'tanggal_laporan' => ($row['tanggal_laporan']->format('Y-m-d')),
            'tempat' => htmlspecialchars($row['tempat']),
            'aksi' => '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id_pelanggaran'] . ')"><i class="fa fa-edit"></i></button>
                       <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id_pelanggaran'] . ')"><i class="fa fa-trash"></i></button>'
        ];
    }

    echo json_encode($result);
}

if ($act == 'get') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $langgar = new laporModel();
    $data = $langgar->getDataById($id);
    echo json_encode($data);
}

if ($act == 'save') {
    $data = [
        'id_mahasiswa' => isset($_POST['id_mahasiswa']) ? antiSqlInjection($_POST['id_mahasiswa']) : null, // Check if 'id_users' exists
        'id_jenis_pelanggaran' => isset($_POST['id_jenis_pelanggaran']) ? antiSqlInjection($_POST['id_jenis_pelanggaran']) : null, // Check if 'id_users' exists
        'laporan_oleh' => antiSqlInjection($_POST['laporan_oleh']),
        'tanggal_laporan' => antiSqlInjection($_POST['tanggal_laporan']),
        'komentar' => antiSqlInjection($_POST['komentar']),
        'id_admin' => isset($_POST['id_admin']) ? antiSqlInjection($_POST['id_admin']) : null, // Check if 'id_users' exists
        'id_dosen' => isset($_POST['id_dosen']) ? antiSqlInjection($_POST['id_dosen']) : null, // Check if 'id_users' exists
        'status_verifikasi_admin' => antiSqlInjection($_POST['status_verifikasi_admin']),
        'nim' => antiSqlInjection($_POST['nim']),
        'foto' => antiSqlInjection($_POST['foto']),
        'tempat' => htmlspecialchars($row['tempat']),

    ];

    $langgar = new laporModel();
    $langgar->insertData($data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil disimpan.'
    ]);
}

if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $data = [
   'id_mahasiswa' => isset($_POST['id_mahasiswa']) ? antiSqlInjection($_POST['id_mahasiswa']) : null, // Check if 'id_users' exists
        'id_jenis_pelanggaran' => isset($_POST['id_jenis_pelanggaran']) ? antiSqlInjection($_POST['id_jenis_pelanggaran']) : null, // Check if 'id_users' exists
        'laporan_oleh' => antiSqlInjection($_POST['laporan_oleh']),
        'tanggal_laporan' => antiSqlInjection($_POST['tanggal_laporan']),
        'komentar' => antiSqlInjection($_POST['komentar']),
        'id_admin' => isset($_POST['id_admin']) ? antiSqlInjection($_POST['id_admin']) : null, // Check if 'id_users' exists
        'id_dosen' => isset($_POST['id_dosen']) ? antiSqlInjection($_POST['id_dosen']) : null, // Check if 'id_users' exists
        'status_verifikasi_admin' => antiSqlInjection($_POST['status_verifikasi_admin']),
        'nim' => antiSqlInjection($_POST['nim']),
        'foto' => antiSqlInjection($_POST['foto']),
        'tempat' => htmlspecialchars($row['tempat']),

    ];

    $langgar = new laporModel();
    $langgar->updateData($id, $data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil diupdate.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $langgar = new laporModel();
    $langgar->deleteData($id);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil dihapus.'
    ]);
}

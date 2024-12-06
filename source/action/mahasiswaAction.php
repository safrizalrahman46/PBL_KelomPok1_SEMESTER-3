<?php
include('../lib/Session.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

include_once('../model/MahasiswaModel.php');
include_once('../lib/Secure.php');

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'load') {
    $admin = new MahasiswaModel();
    $data = $admin->getDataForDataTables($_POST);

    // Prepare the response for DataTables
    $result = [
        "draw" => intval($_POST['draw']),
        "recordsTotal" => $data['recordsTotal'], // Total number of records
        "recordsFiltered" => $data['recordsFiltered'], // Total filtered records
        "data" => []
    ];

    foreach ($data['data'] as $index => $row) {
        $result['data'][] = [
            'no' => ($index + 1), // Use $index instead of $row
            'email' => htmlspecialchars($row['email']),
            'semester' => htmlspecialchars($row['semester']),
            'tingkat' => htmlspecialchars($row['tingkat']),
            'foto' => htmlspecialchars($row['foto']),
            'status' => htmlspecialchars($row['status']),
            'id_pelanggaran' => htmlspecialchars($row['id_pelanggaran'] ?? ''),
            'id_prodi' => htmlspecialchars($row['id_prodi'] ?? ''),
            'id_kelas' => htmlspecialchars($row['id_kelas'] ?? ''),
            'id_users' => htmlspecialchars($row['id_users'] ?? ''),
            'nama' => htmlspecialchars($row['nama']),
            'aksi' => '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['NIM'] . ')"><i class="fa fa-edit"></i></button>
                       <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['NIM'] . ')"><i class="fa fa-trash"></i></button>'
        ];
    }


    echo json_encode($result);
}


if ($act == 'get') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $admin = new MahasiswaModel();
    $data = $admin->getDataById($id);
    echo json_encode($data);
}

if ($act == 'save') {
    $data = [
        'email' => antiSqlInjection($_POST['email']),
        'semester' => antiSqlInjection($_POST['semester']),
        'tingkat' => antiSqlInjection($_POST['tingkat']),
        'foto' => antiSqlInjection($_POST['foto']),
        'status' => antiSqlInjection($_POST['status']),
        'prodi' => antiSqlInjection($_POST['prodi']),
        'id_pelanggaran' => antiSqlInjection($_POST['id_pelanggaran']),
        'id_prodi' => antiSqlInjection($_POST['id_prodi']),
        'id_kelas' => antiSqlInjection($_POST['id_kelas']),
        'id_users' => antiSqlInjection($_POST['id_users']),
        'nama' => antiSqlInjection($_POST['nama']),

    ];
    $admin = new MahasiswaModel();
    $admin->insertData($data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil disimpan.'
    ]);
}

if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $data = [
        'email' => antiSqlInjection($_POST['email']),
        'semester' => antiSqlInjection($_POST['semester']),
        'tingkat' => antiSqlInjection($_POST['tingkat']),
        'foto' => antiSqlInjection($_POST['foto']),
        'status' => antiSqlInjection($_POST['status']),
        'prodi' => antiSqlInjection($_POST['prodi']),
        'id_pelanggaran' => antiSqlInjection($_POST['id_pelanggaran']),
        'id_prodi' => antiSqlInjection($_POST['id_prodi']),
        'id_kelas' => antiSqlInjection($_POST['id_kelas']),
        'id_users' => antiSqlInjection($_POST['id_users']),
        'nama' => antiSqlInjection($_POST['nama']),

    ];

    $admin = new MahasiswaModel();
    $admin->updateData($id, $data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil diupdate.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $admin = new MahasiswaModel();
    $admin->deleteData($id);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil dihapus.'
    ]);
}

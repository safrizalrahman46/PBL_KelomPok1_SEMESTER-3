<?php
include('../lib/Session.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

include_once('../model/KelasModel.php');
include_once('../lib/Secure.php');

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'load') {
    $admin = new KelasModel();
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
            'nama_kelas' => htmlspecialchars($row['nama_kelas']),
            'nama_dpa' => htmlspecialchars($row['nama_dpa']),
            'aksi' => '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id_kelas'] . ')"><i class="fa fa-edit"></i></button>
                       <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id_kelas'] . ')"><i class="fa fa-trash"></i></button>'
        ];
    }

    echo json_encode($result);
}


if ($act == 'get') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $admin = new KelasModel();
    $data = $admin->getDataById($id);
    echo json_encode($data);
}

if ($act == 'save') {
    $data = [
        'nama_kelas' => antiSqlInjection($_POST['nama_kelas']),
        'nama_dpa' => antiSqlInjection($_POST['nama_dpa']),
        'password_admin' => antiSqlInjection($_POST['password_admin']),
        // 'id_kelas' => antiSqlInjection($_POST['id_kelas'])
    ];
    $admin = new KelasModel();
    $admin->insertData($data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil disimpan.'
    ]);
}

if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $data = [
        'nama_kelas' => antiSqlInjection($_POST['nama_kelas']),
        'nama_dpa' => antiSqlInjection($_POST['nama_dpa']),
        'password_admin' => antiSqlInjection($_POST['password_admin']),
        // 'id_kelas' => antiSqlInjection($_POST['id_kelas'])
    ];

    $admin = new KelasModel();
    $admin->updateData($id, $data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil diupdate.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $admin = new KelasModel();
    $admin->deleteData($id);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil dihapus.'
    ]);
}

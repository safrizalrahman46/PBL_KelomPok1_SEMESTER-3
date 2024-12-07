<?php
include('../lib/Session.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

include_once('../model/DosenModel.php');
include_once('../lib/Secure.php');

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'load') {
    $admin = new DosenModel();
    $data = $admin->getDataForDataTables($_POST);

    // Prepare the response for DataTables
    $result = [
        "draw" => isset($_POST['draw']) ? intval($_POST['draw']) : 0, // Check if 'draw' is set
        "recordsTotal" => $data['recordsTotal'], // Total number of records
        "recordsFiltered" => $data['recordsFiltered'], // Total filtered records
        "data" => []
    ];

    foreach ($data['data'] as $key => $row) {
        $result['data'][] = [
            'no' => ($key + 1), // Use $index instead of $row
            'email' => htmlspecialchars($row['email']),
            'id_users' => htmlspecialchars($row['id_users']),
            'nama' => htmlspecialchars($row['nama']),
            'alamat' => htmlspecialchars($row['alamat']),
            'no_telepon' => htmlspecialchars($row['no_telepon']),
            'aksi' => '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['nip'] . ')"><i class="fa fa-edit"></i></button>
                       <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['nip'] . ')"><i class="fa fa-trash"></i></button>'
        ];
    }

    echo json_encode($result);
}


if ($act == 'get') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $admin = new DosenModel();
    $data = $admin->getDataById($id);
    echo json_encode($data);
}

if ($act == 'save') {
    $data = [

        'email' => antiSqlInjection($_POST['email']),
        'id_users' => isset($_POST['id_users']) ? antiSqlInjection($_POST['id_users']) : null, // Check if 'id_users' exists
        'nama' => antiSqlInjection($_POST['nama']),
        'alamat' => antiSqlInjection($_POST['alamat']),
        'no_telepon' => antiSqlInjection($_POST['no_telepon']),

    ];
    $admin = new DosenModel();
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
        'id_users' => isset($_POST['id_users']) ? antiSqlInjection($_POST['id_users']) : null, // Check if 'id_users' exists
        'nama' => antiSqlInjection($_POST['nama']),
        'alamat' => antiSqlInjection($_POST['alamat']),
        'no_telepon' => antiSqlInjection($_POST['no_telepon']),
    ];

    $admin = new DosenModel();
    $admin->updateData($id, $data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil diupdate.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $admin = new DosenModel();
    $admin->deleteData($id);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil dihapus.'
    ]);
}

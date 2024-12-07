<?php
include('../lib/Session.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

include_once('../model/AdminModel.php');
include_once('../lib/Secure.php');

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'load') {
    $admin = new AdminModel();
    $data = $admin->getDataForDataTables($_POST);

    // Prepare the response for DataTables
    $result = [
        "draw" => intval($_POST['draw']),
        "recordsTotal" => $data['recordsTotal'], // Total number of records
        "recordsFiltered" => $data['recordsFiltered'], // Total filtered records
        "data" => []
    ];

    foreach ($data['data'] as $key => $row) {
        // Check if keys exist before using them
        $result['data'][] = [
            'no' => ($key + 1),
            'email_admin' => isset($row['email_admin']) ? htmlspecialchars($row['email_admin']) : '',
            'id_users' => isset($row['id_users']) ? htmlspecialchars($row['id_users']) : '',
            'nama' => isset($row['nama']) ? htmlspecialchars(string: $row['nama']) : '',
            'username' => isset($row['username']) ? htmlspecialchars($row['username']) : '',
            'aksi' => isset($row['id_admin']) ?
                '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id_admin'] . ')"><i class="fa fa-edit"></i></button>
                <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id_admin'] . ')"><i class="fa fa-trash"></i></button>'
                : ''
        ];
    }


    echo json_encode($result);
}


if ($act == 'get') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $admin = new AdminModel();
    $data = $admin->getDataById($id);
    echo json_encode($data);
}

if ($act == 'save') {
    $data = [

        'email_admin' => antiSqlInjection($_POST['email_admin']),
        'id_users' => antiSqlInjection($_POST['id_users']),
        'nama' => antiSqlInjection($_POST['nama']),
    ];
    $admin = new AdminModel();
    $admin->insertData($data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil disimpan.'
    ]);
}

if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $data = [

        'email_admin' => antiSqlInjection($_POST['email_admin']),
        'id_users' => antiSqlInjection($_POST['id_users']),
        'nama' => antiSqlInjection($_POST['nama']),

    ];

    $admin = new AdminModel();
    $admin->updateData($id, $data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil diupdate.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $admin = new AdminModel();
    $admin->deleteData($id);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil dihapus.'
    ]);
}

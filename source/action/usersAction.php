<?php
include('../lib/Session.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

include_once('../model/UsersModel.php');
include_once('../lib/Secure.php');

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'load') {
    $admin = new UsersModel();
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
            'username' => htmlspecialchars(string: $row['username']),
            'password' => htmlspecialchars(string: $row['password']),

            'level' => htmlspecialchars(string: $row['level']),

            'aksi' => '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id_users'] . ')"><i class="fa fa-edit"></i></button>
                       <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id_users'] . ')"><i class="fa fa-trash"></i></button>'
        ];
    }


    echo json_encode($result);
}


if ($act == 'get') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $admin = new UsersModel();
    $data = $admin->getDataById($id);
    echo json_encode($data);
}

if ($act == 'save') {


    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $data = [
        'username' => antiSqlInjection($_POST['username']),
        'password' => antiSqlInjection($_POST['password']),
        'level' => antiSqlInjection($_POST['level']),
    ];
    $admin = new UsersModel();
    $admin->insertData($data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil disimpan.'
    ]);
}

if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    $data = [
        'username' => antiSqlInjection($_POST['username']),
        'password' => antiSqlInjection($_POST['password']),
        'level' => antiSqlInjection($_POST['level']),

    ];

    $admin = new UsersModel();
    $admin->updateData($id, $data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil diupdate.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $admin = new UsersModel();
    $admin->deleteData($id);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil dihapus.'
    ]);
}

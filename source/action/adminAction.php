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
    $data = $admin->getData();
    $result = [];
    $i = 1;
    foreach ($data as $row) {
        $result['data'][] = [
            $i,
            $row['nama_admin'],
            $row['email_admin'],
            '******', 
            '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id_admin'] . ')"><i class="fa fa-edit"></i></button>  
             <button class="btn btn-sm btn-danger" 
onclick="deleteData(' . $row['id_admin'] . ')"><i class="fa fa-trash"></i></button>'
        ];
        $i++;
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
        'nama_admin' => antiSqlInjection($_POST['nama_admin']),
        'email_admin' => antiSqlInjection($_POST['email_admin']),
        'password_admin' => antiSqlInjection($_POST['password_admin']),
        'id_kelas' => antiSqlInjection($_POST['id_kelas'])
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
     'nama_admin' => antiSqlInjection($_POST['nama_admin']),
        'email_admin' => antiSqlInjection($_POST['email_admin']),
        'password_admin' => antiSqlInjection($_POST['password_admin']),
        'id_kelas' => antiSqlInjection($_POST['id_kelas'])
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

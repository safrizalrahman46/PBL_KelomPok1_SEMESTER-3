<?php
include('../lib/Session.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

include_once('../model/AdminModel.php');
include_once('../model/UsersModel.php');
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

    $user = new UsersModel();

    $dataUser = [
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'level' => 'admin',
    ];

    $insert = $user->insertData($dataUser);


    if ($insert == 'Username sudah digunakan oleh akun lainnya') {
        echo json_encode([
            'status' => true,
            'message' => $insert
        ]);
    } else {

        $data = [
            'email_admin' => antiSqlInjection($_POST['email_admin']),
            'nama' => antiSqlInjection($_POST['nama']),
            'id_users' => $insert
        ];
        $admin = new AdminModel();
        $admin->insertData($data);

        echo json_encode([
            'status' => true,
            'message' => 'Data berhasil disimpan.'
        ]);
    }
}

if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    
    $admin = new AdminModel();
    
    $getData = $admin->getDataById($id);


    if(!empty($getData)) {


        $idUsers = $getData['id_users'];
        $data = [
            'email_admin' => antiSqlInjection($_POST['email_admin']),
            'id_users' => $idUsers,
            'nama' => antiSqlInjection($_POST['nama']),
        ];
    
        $admin->updateData($id, $data);
        $user = new UsersModel();


        $dataUser['username'] = $_POST['username'];

        if(!empty($password)) {
            $dataUser['password'] = $_POST['password'];
        }


        $user->updateData($idUsers, $dataUser);
        
    
        echo json_encode([
            'status' => true,
            'message' => 'Data berhasil diupdate.'
        ]);
    } else {
        echo json_encode([
            'status' => true,
            'message' => 'Data tidak ditemukan.'
        ]);
    }
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

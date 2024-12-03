<?php
include('../lib/Session.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

include_once('../model/ViolationLevelModel.php');
include_once('../lib/Secure.php');

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'load') {
    $violationLevel = new ViolationLevelModel();
    $data = $violationLevel->getData();
    $result = [];
    $i = 1;
    foreach ($data as $row) {
        $result['data'][] = [
            'id' => $row['id'], // Pastikan 'id' ada
            'level_name' => $row['level_name'], // Pastikan 'level_name' ada
            'description' => $row['description'], // Pastikan 'description' ada
            'action' => '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id'] . ')"><i class="fa fa-edit"></i></button> ' .
                        '<button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id'] . ')"><i class="fa fa-trash"></i></button>'
        ];
        $i++;
    }
    echo json_encode($result);
}
// if ($act == 'load') {
//     $violationLevel = new ViolationLevelModel();
//     $data = $violationLevel->getData();
//     $result = [];
//     $i = 1;
//     foreach ($data as $row) {
//         $result['data'][] = [
//             $i,
//             $row['level_name'],
//             $row['description'],
//             '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id'] . ')"><i class="fa fa-edit"></i></button> ' .
//             '<button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id'] . ')"><i class="fa fa-trash"></i></button>'
//         ];
//         $i++;
//     }
//     echo json_encode($result);
// }

if ($act == 'get') {
    $id = (isset($_GET ['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $violationLevel = new ViolationLevelModel();
    $data = $violationLevel->getDataById($id);
    echo json_encode($data);
}

if ($act == 'save') {
    $data = [
        'level_name' => antiSqlInjection($_POST['level_name']),
        'description' => antiSqlInjection($_POST['description'])
    ];
    $violationLevel = new ViolationLevelModel();
    $violationLevel->insertData($data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil disimpan.'
    ]);
}

if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $data = [
        'level_name' => antiSqlInjection($_POST['level_name']),
        'description' => antiSqlInjection($_POST['description'])
    ];

    $violationLevel = new ViolationLevelModel();
    $violationLevel->updateData($id, $data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil diupdate.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $violationLevel = new ViolationLevelModel();
    $violationLevel->deleteData($id);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil dihapus.'
    ]);
}
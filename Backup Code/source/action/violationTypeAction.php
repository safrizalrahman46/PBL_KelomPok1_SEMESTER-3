<?php
include('../lib/Session.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

include_once('../model/ViolationTypeModel.php');
include_once('../lib/Secure.php');

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'load') {
    $violationType = new ViolationTypeModel();
    $data = $violationType->getData();
    $result = [];
    $i = 1;
    foreach ($data as $row) {
        $result['data'][] = [
            $i,
            $row['description'],
            $row['level_id'],
            $row['penalty_points'],
            $row['sanction'],
            '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id'] . ')"><i class="fa fa-edit"></i></button>  
             <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id'] . ')"><i class="fa fa-trash"></i></button>'
        ];
        $i++;
    }
    echo json_encode($result);
}

if ($act == 'get') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $violationType = new ViolationTypeModel();
    $data = $violationType->getDataById($id);
    echo json_encode($data);
}

if ($act == 'save') {
    $data = [
        'description' => antiSqlInjection($_POST['description']),
        'level_id' => antiSqlInjection($_POST['level_id']),
        'penalty_points' => antiSqlInjection($_POST['penalty_points']),
        'sanction' => antiSqlInjection($_POST['sanction'])
    ];
    $violationType = new ViolationTypeModel();
    $violationType->insertData($data);

    echo json_encode([
        'status' => true,
        'message' => 'Data successfully saved.'
    ]);
}

if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $data = [
        'description' => antiSqlInjection($_POST['description']),
        'level_id' => antiSqlInjection($_POST['level_id']),
        'penalty_points' => antiSqlInjection($_POST['penalty_points']),
        'sanction' => antiSqlInjection($_POST['sanction'])
    ];

    $violationType = new ViolationTypeModel();
    $violationType->updateData($id, $data);

    echo json_encode([
        'status' => true,
        'message' => 'Data successfully updated.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $violationType = new ViolationTypeModel();
    $violationType->deleteData($id);

    echo json_encode([
        'status' => true,
        'message' => 'Data successfully deleted.'
    ]);
}
<?php
include('../lib/Session.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

include_once('../model/ViolationReportModel.php');
include_once('../lib/Secure.php');

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'load') {
    $violationReport = new ViolationReportModel();
    $data = $violationReport->getData();
    $result = ['data' => []]; // Initialize result with a data array
    foreach ($data as $row) {
        $result['data'][] = [
            'id' => $row['id'], // Ensure you have an ID field for actions
            'submitted_by' => $row['submitted_by'],
            'violation_type' => $row['violation_type'],
            'report_date' => $row['report_date'],
            'status' => $row['status'],
            'reviewed_by' => $row['reviewed_by'],
            'resolution_date' => $row['resolution_date'],
            'comments' => $row['comments'],
            'dpa_verification_status' => $row['dpa_verification_status'],
            'faculty_involved_id' => $row['faculty_involved_id'],
            'action' => '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id'] . ')"><i class="fa fa-edit"></i></button> <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id'] . ')"><i class="fa fa-trash"></i></button>'
        ];
    }
    echo json_encode($result);
}
// if ($act == 'load') {
//     $violationReport = new ViolationReportModel();
//     $data = $violationReport->getData();
//     $result = [];
//     $i = 1;
//     foreach ($data as $row) {
//         $result['data'][] = [
//             $i,
//             $row['submitted_by'],
//             $row['violation_type'],
//             $row['report_date'],
//             $row['status'],
//             $row['reviewed_by'],
//             $row['resolution_date'],
//             $row['comments'],
//             $row['dpa_verification_status'],
//             $row['faculty_involved_id'],
//             '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id'] . ')"><i class="fa fa-edit"></i></button> <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id'] . ')"><i class="fa fa-trash"></i></button>'
//         ];
//         $i++;
//     }
//     echo json_encode($result);
// }

if ($act == 'get') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $violationReport = new ViolationReportModel();
    $data = $violationReport->getDataById($id);
    echo json_encode($data);
}

if ($act == 'save') {
    $data = [
        'submitted_by' => antiSqlInjection($_POST['submitted_by']),
        'violation_type' => antiSqlInjection($_POST['violation_type']),
        'report_date' => antiSqlInjection($_POST['report_date']),
        'status' => antiSqlInjection($_POST['status']),
        'reviewed_by' => antiSqlInjection($_POST['reviewed_by']),
        'resolution_date' => antiSqlInjection($_POST['resolution_date']),
        'comments' => antiSqlInjection($_POST['comments']),
        'dpa_verification_status' => antiSqlInjection($_POST['dpa_verification_status']),
        'faculty_involved_id' => antiSqlInjection($_POST['faculty_involved_id'])
    ];
    $violationReport = new ViolationReportModel();
    $violationReport->insertData($data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil disimpan.'
    ]);
}

if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $data = [
        'submitted_by' => antiSqlInjection($_POST['submitted_by']),
        'violation_type' => antiSqlInjection($_POST['violation_type']),
        'report_date' => antiSqlInjection($_POST['report_date']),
        'status' => antiSqlInjection($_POST['status']),
        'reviewed_by' => antiSqlInjection($_POST['reviewed_by']),
        'resolution_date' => antiSqlInjection($_POST['resolution_date']),
        'comments' => antiSqlInjection($_POST['comments']),
        'dpa_verification_status' => antiSqlInjection($_POST['dpa_verification_status']),
        'faculty_involved_id' => antiSqlInjection($_POST['faculty_involved_id'])
    ];

    $violationReport = new ViolationReportModel();
    $violationReport->updateData($id, $data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil diupdate.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $violationReport = new ViolationReportModel();
    $violationReport->deleteData($id);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil dihapus.'
    ]);
}
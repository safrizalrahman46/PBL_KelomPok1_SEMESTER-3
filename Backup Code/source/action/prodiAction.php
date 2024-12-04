<?php
include('../lib/Session.php');

$session = new Session();
if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

include_once('../model/ProdiModel.php');
include_once('../lib/Secure.php');

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';


// if ($act == 'load') {
//     $prodi = new ProdiModel();
//     $data = $prodi->getData();
//     $result = ['data' => []]; // Initialize result with a data array
//     foreach ($data as $row) {
//         $result['data'][] = [
//             'id_prodi' => $row['id_prodi'], // Ensure this matches your DataTable column definitions
//             'nama_prodi' => $row['nama_prodi'],
//             'actions' => '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id_prodi'] . ')"><i class="fa fa-edit"></i></button> 
//                           <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id_prodi'] . ')"><i class="fa fa-trash"></i></button>'
//         ];
//     }
//     echo json_encode($result);
// }
// if ($act == 'load') {
//     $prodi = new ProdiModel();
//     $data = $prodi->getData();
//     $result = ['data' => []]; // Initialize result with a data array
//     $i = 1;
//     foreach ($data as $row) {
//         $result['data'][] = [
//             'id_prodi' => $row['id_prodi'], // Include id_prodi for reference
//             'nama_prodi' => $row['nama_prodi'],
//             'actions' => '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id_prodi'] . ')"><i class="fa fa-edit"></i></button> 
//                           <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id_prodi'] . ')"><i class="fa fa-trash"></i></button>'
//         ];
//         $i++;
//     }
//     echo json_encode($result);
// }
if ($act == 'load') {
    $prodi = new ProdiModel();
    $data = $prodi->getData();
    $result = [];
    $i = 1;
    foreach ($data as $row) {
        $result['data'][] = [
            $i,
            $row['nama_prodi'],
            // $row['jurusan_id'],
            '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id_prodi'] . ')"><i class="fa fa-edit"></i></button> 
             <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id_prodi'] . ')"><i class="fa fa-trash"></i></button>'
        ];
        $i++;
    }
    echo json_encode($result);
}

if ($act == 'get') {
    $id = isset($_GET['id']) && ctype_digit($_GET['id']) ? $_GET['id'] : 0;

    $prodi = new ProdiModel();
    $data = $prodi->getDataById($id);
    echo json_encode($data);
}

if ($act == 'save') {
    $data = [
        'nama_prodi' => antiSqlInjection($_POST['nama_prodi']),
        // 'jurusan_id' => antiSqlInjection($_POST['jurusan_id'])
    ];
    $prodi = new ProdiModel();
    $prodi->insertData($data);

    echo json_encode(['status' => true, 'message' => 'Data berhasil disimpan.']);
}

if ($act == 'update') {
    $id = isset($_GET['id']) && ctype_digit($_GET['id']) ? $_GET['id'] : 0;
    $data = [
        'nama_prodi' => antiSqlInjection($_POST['nama_prodi']),
        // 'jurusan_id' => antiSqlInjection($_POST['jurusan_id'])
    ];

    $prodi = new ProdiModel();
    $prodi->updateData($id, $data);

    echo json_encode(['status' => true, 'message' => 'Data berhasil diupdate.']);
}

if ($act == 'delete') {
    $id = isset($_GET['id']) && ctype_digit($_GET['id']) ? $_GET['id'] : 0;

    $prodi = new ProdiModel();
    $prodi->deleteData($id);

    echo json_encode(['status' => true, 'message' => 'Data berhasil dihapus.']);
}

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
    // Read DataTables parameters
    $draw = isset($_GET['draw']) ? intval($_GET['draw']) : 1;
    $start = isset($_GET['start']) ? intval($_GET['start']) : 0;
    $length = isset($_GET['length']) ? intval($_GET['length']) : 10;
    $searchValue = isset($_GET['search']['value']) ? $_GET['search']['value'] : '';
    
    $users = new UsersModel();

    // Fetch total records
    $totalRecords = $users->getTotalRecords();

    // Fetch filtered records
    $filteredRecords = $users->getFilteredRecords($start, $length, $searchValue);

    $data = [];
    $i = $start + 1;
    foreach ($filteredRecords as $row) {
        $data[] = [
            $i,
            htmlspecialchars($row['nama']),
            htmlspecialchars($row['username']),
            htmlspecialchars($row['level']),
            htmlspecialchars($row['password']),
            '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['user_id'] . ')"><i class="fa fa-edit"></i></button>  
             <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['user_id'] . ')"><i class="fa fa-trash"></i></button>'
        ];
        $i++;
    }

    // Return response in DataTables format
    echo json_encode([
        'draw' => $draw,
        'recordsTotal' => $totalRecords,
        'recordsFiltered' => $totalRecords, // Change if filtering logic is applied
        'data' => $data
    ]);
}
// if ($act == 'load') {
//     $users = new UsersModel();
//     $data = $users->getData();
//     $result = [];
//     $i = 1;
//     foreach ($data as $row) {
//         $result['data'][] = [
//             $i,
//             $row['nama'],
//             $row['username'],
//             $row['level'],
//             $row['password'],
//             '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['user_id'] . ')"><i class="fa fa-edit"></i></button>  
//              <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['user_id'] . ')"><i class="fa fa-trash"></i></button>'
//         ];
//         $i++;
//     }
//     echo json_encode($result);
// }


// if ($act == 'load') {
//     $users = new UsersModel();
//     $data = $users->getData();
//     $result = ['data' => []];
//     $i = 1;
//     foreach ($data as $row) {
//         $result['data'][] = [
//             $i,
//             $row['admin_id'],
//             $row['task_description'],
//             $row['task_date'],
//             '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id'] . ')"><i class="fa fa-edit"></i></button>  
//              <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id'] . ')"><i class="fa fa-trash"></i></button>'
//         ];
//         $i++;
//     }
//     echo json_encode($result);
// }


if ($act == 'get') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $users = new UsersModel();
    $data = $users->getDataById($id);
    echo json_encode($data);
}

if ($act == 'save') {
    $data = [
        'nama' => antiSqlInjection($_POST['nama']),
        'username' => antiSqlInjection($_POST['username']),
        'password' => antiSqlInjection($_POST['password']),
        'level' => antiSqlInjection($_POST['level'])
    ];
    $users = new UsersModel();
    $users->insertData($data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil disimpan.'
    ]);
}

if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $data = [
        'nama' => antiSqlInjection($_POST['nama']),
        'username' => antiSqlInjection($_POST['username']),
        'password' => antiSqlInjection($_POST['password']),
        'level' => antiSqlInjection($_POST['level'])
    ];

    $users = new UsersModel();
    $users->updateData($id, $data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil diupdate.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $users = new UsersModel();
    $users->deleteData($id);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil dihapus.'
    ]);

    // if ($_GET['act'] === 'load') {
    //     // Query untuk mengambil data
    //     $sql = "
    //         SELECT 
    //             task_log.id_task,
    //             admin.nama_admin,
    //             task_log.deskripsi_tugas,
    //             task_log.tanggal_tugas
    //         FROM 
    //             task_log
    //         JOIN 
    //             admin ON task_log.id_admin = admin.id_admin
    //     ";
    
    //     // Eksekusi query
    //     $result = $db->query($sql);
    //     $data = [];
    
    //     while ($row = $result->fetch_assoc()) {
    //         $data[] = $row;
    //     }
    
    //     // Kirim hasil sebagai JSON
    //     echo json_encode(['data' => $data]);
    //     exit;
    // }
    
}

<?php
include('../lib/Session.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

include_once('../model/JurusanModel.php');
include_once('../lib/Secure.php');

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';


if ($act == 'load') {
    $jurusan = new JurusanModel();
    $data = $jurusan->getData();
    $result = [];
    $i = 1;
    foreach ($data as $row) {
        $result[] = [
            $i,
            $row['nama_jurusan'],
            $row['department_id'],
            '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id_jurusan'] . ')"><i class="fa fa-edit"></i></button>  
             <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id_jurusan'] . ')"><i class="fa fa-trash"></i></button>'
        ];
        $i++;
    }
    // echo json_encode($result);
    echo json_encode(['data' => $result]); // Wrap the result in a 'data' key
}
// if ($act == 'load') {
//     $jurusan = new JurusanModel();
//     $data = $jurusan->getData();
//     $result = [];
//     $i = 1;
//     foreach ($data as $row) {
//         $result['data'][] = [
//             $i,
//             $row['name'],
//             '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id_jurusan'] . ')"><i class="fa fa-edit"></i></button>  
//              <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id_jurusan'] . ')"><i class="fa fa-trash"></i></button>'
//         ];
//         $i++;
//     }
//     echo json_encode($result);
// }
// if ($act == 'load') {
//     $jurusan = new JurusanModel();
//     $data = $jurusan->getData();
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

    $jurusan = new JurusanModel();
    $data = $jurusan->getDataById($id);
    echo json_encode($data);
}

if ($act == 'save') {
    $data = [
        'nama_jurusan' => antiSqlInjection($_POST['nama_jurusan']),
        'department_id' => antiSqlInjection($_POST['department_id'])
    ];
    $jurusan = new JurusanModel();
    $jurusan->insertData($data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil disimpan.'
    ]);
}

if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $data = [
        'nama_jurusan' => antiSqlInjection($_POST['nama_jurusan']),
        'department_id' => antiSqlInjection($_POST['department_id'])
    ];

    $jurusan = new JurusanModel();
    $jurusan->updateData($id, $data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil diupdate.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $jurusan = new JurusanModel();
    $jurusan->deleteData($id);

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

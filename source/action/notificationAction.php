<?php
include('../lib/Session.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

include_once('../model/NotificationModel.php');
include_once('../lib/Secure.php');

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'load') {
    $notification = new NotificationModel();
    $data = $notification->getData();
    $result = ['data' => []]; // Initialize result with a data array
    $i = 1;
    foreach ($data as $row) {
        $result['data'][] = [
            $i,
            $row['recipient_id'],
            $row['message'],
            $row['date_sent'],
            $row['acknowledged'] ,
            // ? 'Diterima' : 'Belum Diterima',
            '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id'] . ')"><i class="fa fa-edit"></i></button>  
             <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id'] . ')"><i class="fa fa-trash"></i></button>'
        ];
        $i++;
    }
    echo json_encode($result); // Return the result
    exit; // Ensure to exit after sending the response
}
// if ($act == 'load') {
//     $notification = new NotificationModel();
//     $data = $notification->getData();
//     $result = [];
//     $i = 1;
//     foreach ($data as $row) {
//         // $statusBadge = $row['status'] === 'Aktif'
//         // ? '<span class="badge badge-pill badge-success">Aktif</span>'
//         // : '<span class="badge badge-pill badge-secondary">Lulus</span>';

//         $result['data'][] = [
//             $i,
//             $row['recipient_id'],
//             $row['message'],
//             $row['date_sent'],
//             $row['acknowledged'] ? 'Diterima' : 'Belum Diterima',
//             // $row['status'],
//             '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id'] . ')"><i class="fa fa-edit"></i></button>  
//              <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id'] . ')"><i class="fa fa-trash"></i></button>'
//         ];
//         $i++;
//     }
//     echo json_encode($result);
// }

// if ($act == 'load') {
//     $notification = new NotificationModel();
//     $data = $notification->getData();
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

    $notification = new NotificationModel();
    $data = $notification->getDataById($id);
    echo json_encode($data);
}

if ($act == 'save') {
    $data = [
        'recipient_id' => antiSqlInjection($_POST['recipient_id']),
        'message' => antiSqlInjection($_POST['message']),
        'date_sent' => antiSqlInjection($_POST['date_sent']),
        'acknowledged' => antiSqlInjection($_POST['acknowledged'])
    ];
    $notification = new NotificationModel();
    $notification->insertData($data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil disimpan.'
    ]);
}

if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $data = [
        'recipient_id' => antiSqlInjection($_POST['recipient_id']),
        'message' => antiSqlInjection($_POST['message']),
        'date_sent' => antiSqlInjection($_POST['date_sent']),
        'acknowledged' => antiSqlInjection($_POST['acknowledged'])
    ];

    $notification = new NotificationModel();
    $notification->updateData($id, $data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil diupdate.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $notification = new NotificationModel();
    $notification->deleteData($id);

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

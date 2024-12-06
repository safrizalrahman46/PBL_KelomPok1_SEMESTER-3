<?php
include('../lib/Session.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

include_once('../model/LogModel.php');
include_once('../lib/Secure.php');

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'load') {
    $admin = new LogModel();
    $data = $admin->getDataForDataTables($_POST);

    // Prepare the response for DataTables
    $result = [
        "draw" => intval($_POST['draw']),
        "recordsTotal" => $data['recordsTotal'], // Total number of records
        "recordsFiltered" => $data['recordsFiltered'], // Total filtered records
        "data" => []
    ];

    foreach ($data['data'] as $key => $row) { // Gunakan $key sebagai nomor urut
        $result['data'][] = [
            'no' => ($key + 1), // Gunakan $key + 1 untuk nomor urut
            'admin_id' => htmlspecialchars($row['admin_id']),
            'deskripsi_tugas' => htmlspecialchars($row['deskripsi_tugas']),
            'tanggal_tugas' => ($row['tanggal_tugas']->format('Y-m-d')),
            'aksi' => '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id_log'] . ')"><i class="fa fa-edit"></i></button>
                       <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id_log'] . ')"><i class="fa fa-trash"></i></button>'
        ];
    }


    echo json_encode($result);
}


if ($act == 'get') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $admin = new LogModel();
    $data = $admin->getDataById($id);
    echo json_encode($data);
}

if ($act == 'save') {
    $data = [

        'admin_id' => antiSqlInjection($_POST['admin_id']),
        'deskripsi_tugas' => antiSqlInjection($_POST['deskripsi_tugas']),
        'tanggal_tugas' => antiSqlInjection($_POST['tanggal_tugas'])

    ];
    $admin = new LogModel();
    $admin->insertData($data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil disimpan.'
    ]);
}

if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $data = [

        'admin_id' => antiSqlInjection($_POST['admin_id']),
        'deskripsi_tugas' => antiSqlInjection($_POST['deskripsi_tugas']),
        'tanggal_tugas' => antiSqlInjection($_POST['tanggal_tugas'])
    ];

    $admin = new LogModel();
    $admin->updateData($id, $data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil diupdate.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $admin = new LogModel();
    $admin->deleteData($id);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil dihapus.'
    ]);
}

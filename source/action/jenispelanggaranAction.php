<?php
include('../lib/Session.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

include_once('../model/JenisPelanggaranModel.php');
include_once('../lib/Secure.php');

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'load') {
    $admin = new JenisPelanggaranModel();
    $data = $admin->getDataForDataTables($_POST);

    // Prepare the response for DataTables
    $result = [
        "draw" => intval($_POST['draw']),
        "recordsTotal" => $data['recordsTotal'], // Total number of records
        "recordsFiltered" => $data['recordsFiltered'], // Total filtered records
        "data" => []
    ];

    foreach ($data['data'] as $index => $row) {
        $result['data'][] = [
            'no' => ($index + 1), // Use $index instead of $row
            'deskripsi' => htmlspecialchars($row['deskripsi']),
            'id_tingkat' => htmlspecialchars($row['id_tingkat']),
            'aksi' => '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id_tingkat_pelanggaran'] . ')"><i class="fa fa-edit"></i></button>
                       <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id_tingkat_pelanggaran'] . ')"><i class="fa fa-trash"></i></button>'
        ];
    }
    // foreach ($data['data'] as $row) {
    //     $result['data'][] = [
    //         'no' => ($row+1),
    //         'deskripsi' => htmlspecialchars($row['deskripsi']),
    //         'id_tingkat' => htmlspecialchars($row['id_tingkat']),
    //         'aksi' => '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id_kelas'] . ')"><i class="fa fa-edit"></i></button>
    //                    <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id_kelas'] . ')"><i class="fa fa-trash"></i></button>'
    //     ];
    // }

    echo json_encode($result);
}


if ($act == 'get') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $admin = new JenisPelanggaranModel();
    $data = $admin->getDataById($id);
    echo json_encode($data);
}

if ($act == 'save') {
    $data = [
        'deskripsi' => antiSqlInjection($_POST['deskripsi']),
        'id_tingkat' => antiSqlInjection($_POST['id_tingkat']),
        'password_admin' => antiSqlInjection($_POST['password_admin']),
        // 'id_kelas' => antiSqlInjection($_POST['id_kelas'])
    ];
    $admin = new JenisPelanggaranModel();
    $admin->insertData($data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil disimpan.'
    ]);
}

if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $data = [
        'deskripsi' => antiSqlInjection($_POST['deskripsi']),
        'id_tingkat' => antiSqlInjection($_POST['id_tingkat']),
        'password_admin' => antiSqlInjection($_POST['password_admin']),
        // 'id_kelas' => antiSqlInjection($_POST['id_kelas'])
    ];

    $admin = new JenisPelanggaranModel();
    $admin->updateData($id, $data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil diupdate.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $admin = new JenisPelanggaranModel();
    $admin->deleteData($id);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil dihapus.'
    ]);
}

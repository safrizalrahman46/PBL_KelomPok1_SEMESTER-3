<?php
include('../lib/Session.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

include_once('../model/NotifikasiModel.php');
include_once('../lib/Secure.php');

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'load') {
    $admin = new NotifikasiModel();
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
            'id_penerima' => htmlspecialchars($row['id_penerima'] ?? ''),
            'pesan' => htmlspecialchars($row['pesan']),
            'tanggal_kirim' => htmlspecialchars($row['tanggal_kirim'] instanceof DateTime ? $row['tanggal_kirim']->format('Y-m-d') : $row['tanggal_kirim'] ?? ''),
            'id_pelanggaran' => htmlspecialchars($row['id_pelanggaran']),
            'id_tipe_notifikasi' => htmlspecialchars($row['id_tipe_notifikasi']),
            'aksi' => '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id'] . ')"><i class="fa fa-edit"></i></button>
                       <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id'] . ')"><i class="fa fa-trash"></i></button>'
        ];
    }


    echo json_encode($result);
}


if ($act == 'get') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $admin = new NotifikasiModel();
    $data = $admin->getDataById($id);
    echo json_encode($data);
}

if ($act == 'save') {
    $data = [
        'id_penerima' => antiSqlInjection($_POST['id_penerima']),
        'pesan' => antiSqlInjection($_POST['pesan']),
        'tanggal_kirim' => antiSqlInjection($_POST['tanggal_kirim']),
        'id_pelanggaran' => antiSqlInjection($_POST['id_pelanggaran']),
        'id_tipe_notifikasi' => antiSqlInjection($_POST['id_tipe_notifikasi']),


    ];
    $admin = new NotifikasiModel();
    $admin->insertData($data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil disimpan.'
    ]);
}

if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $data = [
        'id_penerima' => antiSqlInjection($_POST['id_penerima']),
        'pesan' => antiSqlInjection($_POST['pesan']),
        'tanggal_kirim' => antiSqlInjection($_POST['tanggal_kirim']),
        'id_pelanggaran' => antiSqlInjection($_POST['id_pelanggaran']),
        'id_tipe_notifikasi' => antiSqlInjection($_POST['id_tipe_notifikasi']),

    ];

    $admin = new NotifikasiModel();
    $admin->updateData($id, $data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil diupdate.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $admin = new NotifikasiModel();
    $admin->deleteData($id);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil dihapus.'
    ]);
}

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
    $jenis = new JenisPelanggaranModel();
    $data = $jenis->getDataForDataTables($_POST);

    // Prepare the response for DataTables
    $result = [
        "draw" => intval($_POST['draw']),
        "recordsTotal" => $data['recordsTotal'], // Total number of records
        "recordsFiltered" => $data['recordsFiltered'], // Total filtered records
        "data" => []
    ];

    foreach ($data['data'] as $key => $row) {
        $result['data'][] = [
            'no' => ($key + 1), // Use $index instead of $row
            'deskripsi' => htmlspecialchars($row['deskripsi']),
            // 'id_tingkat' => htmlspecialchars($row['id_tingkat']),
            'id_tingkat' => isset($row['id_tingkat']) ? htmlspecialchars(string: $row['id_tingkat']) : '',

            // 'nama_tingkat' => htmlspecialchars($row['nama_tingkat']),
            'nama_tingkat' => isset($row['nama_tingkat']) ? htmlspecialchars(string: $row['nama_tingkat']) : '',

            'aksi' => '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id_jenis_pelanggaran'] . ')"><i class="fa fa-edit"></i></button>
                       <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id_jenis_pelanggaran'] . ')"><i class="fa fa-trash"></i></button>'
        ];
    }


    echo json_encode($result);
}


if ($act == 'get') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $jenis = new JenisPelanggaranModel();
    $data = $jenis->getDataById($id);
    echo json_encode($data);
}

if ($act == 'save') {
    $data = [
        'deskripsi' => antiSqlInjection($_POST['deskripsi']),
        'id_tingkat' => antiSqlInjection($_POST['id_tingkat']),
        // 'password_jenis' => antiSqlInjection($_POST['password_jenis']),
        // 'id_jenis_pelanggaran' => antiSqlInjection($_POST['id_jenis_pelanggaran'])
    ];
    $jenis = new JenisPelanggaranModel();
    $jenis->insertData($data);

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
    ];

    $jenis = new JenisPelanggaranModel();
    $jenis->updateData($id, $data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil diupdate.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $jenis = new JenisPelanggaranModel();
    $jenis->deleteData($id);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil dihapus.'
    ]);
}

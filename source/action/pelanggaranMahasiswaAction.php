<?php
include('../lib/Session.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

include_once('../model/PelanggaranMahasiswaModel.php');
include_once('../lib/Secure.php');

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'load') {
    $pelanggaran = new PelanggaranMahasiswaModel();
    $data = $pelanggaran->getData();
    $result = [];
    $i = 1;
    foreach ($data as $row) {
        $result['data'][] = [
            $i,
            $row ['mahasiswa_id'],
            $row['violation_type_id'],
            $row['reported_by'],
            $row['report_date'],
            $row['sanction_status'],
            '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id_pelanggaran'] . ')"><i class="fa fa-edit"></i></button>  
             <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id_pelanggaran'] . ')"><i class="fa fa-trash"></i></button>'
        ];
        $i++;
    }
    echo json_encode($result);
}
// if ($act == 'load') {
//     $pelanggaran = new PelanggaranMahasiswaModel();
//     $data = $pelanggaran->getData();
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

    $pelanggaran = new PelanggaranMahasiswaModel();
    $data = $pelanggaran->getDataById($id);
    echo json_encode($data);
}

if ($act == 'save') {
    $data = [
      'mahasiswa_id' => antiSqlInjection($_POST['mahasiswa_id']),
        'violation_type_id' => antiSqlInjection($_POST['violation_type_id']),
        'reported_by' => antiSqlInjection($_POST['reported_by']),
        'dpa_verification_status' => isset($_POST['dpa_verification_status']) ? 1 : 0, // Assuming checkbox or similar
        'report_date' => antiSqlInjection($_POST['report_date']),
        'sanction_status' => antiSqlInjection($_POST['sanction_status']),
        'sanction_start_date' => antiSqlInjection($_POST['sanction_start_date']),
        'sanction_end_date' => antiSqlInjection($_POST['sanction_end_date']),
        'comments' => antiSqlInjection($_POST['comments'])
    ];
    $pelanggaran = new PelanggaranMahasiswaModel();
    $pelanggaran->insertData($data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil disimpan.'
    ]);
}

if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $data = [
      'mahasiswa_id' => antiSqlInjection($_POST['mahasiswa_id']),
        'violation_type_id' => antiSqlInjection($_POST['violation_type_id']),
        'reported_by' => antiSqlInjection($_POST['reported_by']),
        'dpa_verification_status' => isset($_POST['dpa_verification_status']) ? 1 : 0, // Assuming checkbox or similar
        'report_date' => antiSqlInjection($_POST['report_date']),
        'sanction_status' => antiSqlInjection($_POST['sanction_status']),
        'sanction_start_date' => antiSqlInjection($_POST['sanction_start_date']),
        'sanction_end_date' => antiSqlInjection($_POST['sanction_end_date']),
        'comments' => antiSqlInjection($_POST['comments'])
    ];

    $pelanggaran = new PelanggaranMahasiswaModel();
    $pelanggaran->updateData($id, $data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil diupdate.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $pelanggaran = new PelanggaranMahasiswaModel();
    $pelanggaran->deleteData($id);

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

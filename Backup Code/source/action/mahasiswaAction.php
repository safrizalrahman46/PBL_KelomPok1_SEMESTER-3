<?php
include('../lib/Session.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

include_once('../model/MahasiswaModel.php');
include_once('../lib/Secure.php');

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'load') {
    $kelas = new MahasiswaModel();
    $data = $kelas->getData();
    $result = [];
    $i = 1;
    foreach ($data as $row) {
        $statusBadge = $row['status'] === 'Aktif'
        ? '<span class="badge badge-pill badge-success">Aktif</span>'
        : '<span class="badge badge-pill badge-secondary">Lulus</span>';

        $result['data'][] = [
            $i,
            $row['name'],
            $row['NIM'],
            $row['email'],
            $row['jurusan'],
            $row['prodi'],
            $row['username'],
            $row['total_violation_points'],
            $row['total_reward_points'],
            $row['semester'],
            $row['tingkat'],
            $statusBadge,
            // $row['status'],
            '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['id'] . ')"><i class="fa fa-edit"></i></button>  
             <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['id'] . ')"><i class="fa fa-trash"></i></button>'
        ];
        $i++;
    }
    echo json_encode($result);
}
// if ($act == 'load') {
//     $kelas = new MahasiswaModel();
//     $data = $kelas->getData();
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

    $kelas = new MahasiswaModel();
    $data = $kelas->getDataById($id);
    echo json_encode($data);
}

if ($act == 'save') {
    $data = [
       'name' => antiSqlInjection($_POST['name']),
        'department_id' => antiSqlInjection($_POST['department_id']),
        'email' => antiSqlInjection($_POST['email']),
        'NIM' => antiSqlInjection($_POST['NIM']),
        'username' => antiSqlInjection($_POST['username']),
        'password' => antiSqlInjection($_POST['password']),
        'total_violation_points' => 0, // Default value
        'total_reward_points' => 0, // Default value
        'semester' => antiSqlInjection($_POST['semester']),
        'tingkat' => antiSqlInjection($_POST['tingkat']),
        'foto' => antiSqlInjection($_POST['foto']),
        'status' => antiSqlInjection($_POST['status']),
        'jurusan' => antiSqlInjection($_POST['jurusan']),
        'prodi' => antiSqlInjection($_POST['prodi'])
    ];
    $kelas = new MahasiswaModel();
    $kelas->insertData($data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil disimpan.'
    ]);
}

if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $data = [
       'name' => antiSqlInjection($_POST['name']),
        'department_id' => antiSqlInjection($_POST['department_id']),
        'email' => antiSqlInjection($_POST['email']),
        'NIM' => antiSqlInjection($_POST['NIM']),
        'username' => antiSqlInjection($_POST['username']),
        'password' => antiSqlInjection($_POST['password']),
        'total_violation_points' => 0, // Default value
        'total_reward_points' => 0, // Default value
        'semester' => antiSqlInjection($_POST['semester']),
        'tingkat' => antiSqlInjection($_POST['tingkat']),
        'foto' => antiSqlInjection($_POST['foto']),
        'status' => antiSqlInjection($_POST['status']),
        'jurusan' => antiSqlInjection($_POST['jurusan']),
        'prodi' => antiSqlInjection($_POST['prodi'])
    ];

    $kelas = new MahasiswaModel();
    $kelas->updateData($id, $data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil diupdate.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $kelas = new MahasiswaModel();
    $kelas->deleteData($id);

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

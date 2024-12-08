<?php
include('../lib/Session.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

include_once('../model/MahasiswaModel.php');
include_once('../model/UsersModel.php');
include_once('../lib/Secure.php');

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'load') {
    $admin = new MahasiswaModel();
    $data = $admin->getDataForDataTables($_POST);

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
            'NIM' => htmlspecialchars($row['nim']),
            'email' => htmlspecialchars($row['email']),
            'semester' => htmlspecialchars($row['semester']),
            'tingkat' => htmlspecialchars($row['tingkat']),
            'foto' => '',
            'status' => htmlspecialchars($row['status']),
            'id_pelanggaran' => htmlspecialchars($row['id_pelanggaran'] ?? ''),
            'id_prodi' => htmlspecialchars($row['id_prodi'] ?? ''),
            'id_kelas' => htmlspecialchars($row['id_kelas'] ?? ''),
            'id_users' => htmlspecialchars($row['id_users'] ?? ''),
            'username' => htmlspecialchars($row['username'] ?? ''),
            'nama' => htmlspecialchars($row['nama']),
            'aksi' => '<button class="btn btn-sm btn-warning" onclick="editData(' . $row['nim'] . ')"><i class="fa fa-edit"></i></button>
                       <button class="btn btn-sm btn-danger" onclick="deleteData(' . $row['nim'] . ')"><i class="fa fa-trash"></i></button>'
        ];
    }


    echo json_encode($result);
}


if ($act == 'get') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $admin = new MahasiswaModel();
    $data = $admin->getDataById($id);
    echo json_encode($data);
}


if ($act == 'save') {


    $foto = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $uploadDir = "../uploads/";

        // Validate file type
        if (!in_array($_FILES['foto']['type'], $allowedTypes)) {
            $response['message'] = 'Invalid file type. Allowed types are JPEG, PNG, GIF.';
            echo json_encode($response);
            exit;
        }

        // Generate unique file name
        $fileName = time() . "_" . basename($_FILES['foto']['name']);
        $uploadFile = $uploadDir . $fileName;

        // Move the file
        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $uploadFile)) {
            $response['message'] = 'Failed to upload the file.';
            echo json_encode($response);
            exit;
        }

        $foto = $fileName;
    } 



    $user = new UsersModel();

    $dataUser = [
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'level' => 'mahasiswa',
    ];

    $insert = $user->insertData($dataUser);


    if ($insert == 'Username sudah digunakan oleh akun lainnya') {
        echo json_encode([
            'status' => true,
            'message' => $insert
        ]);
    } else {

        
        

    
        $data = [
            'email' => antiSqlInjection($_POST['email']),
            'semester' => antiSqlInjection($_POST['semester']),
            'tingkat' => antiSqlInjection($_POST['tingkat']),
            'foto' => $foto,
            'status' => antiSqlInjection($_POST['status']),
            // 'prodi' => antiSqlInjection($_POST['prodi'] ?? ''),
            // 'id_pelanggaran' => antiSqlInjection($_POST['id_pelanggaran']),
            'id_prodi' => antiSqlInjection($_POST['id_prodi']),
            'id_kelas' => antiSqlInjection($_POST['id_kelas']),
            'nama' => antiSqlInjection($_POST['nama']),
            'id_users' => $insert
        ];
        $mahasiswa = new MahasiswaModel();
        $mahasiswa->insertData($data);

        echo json_encode([
            'status' => true,
            'message' => 'Data berhasil disimpan.'
        ]);
    }
}
if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;


    $foto = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $uploadDir = "../uploads/";

        // Validate file type
        if (!in_array($_FILES['foto']['type'], $allowedTypes)) {
            $response['message'] = 'Invalid file type. Allowed types are JPEG, PNG, GIF.';
            echo json_encode($response);
            exit;
        }

        // Generate unique file name
        $fileName = time() . "_" . basename($_FILES['foto']['name']);
        $uploadFile = $uploadDir . $fileName;

        // Move the file
        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $uploadFile)) {
            $response['message'] = 'Failed to upload the file.';
            echo json_encode($response);
            exit;
        }

        $foto = $fileName;
    } 



    $admin = new MahasiswaModel();
    
    $getData = $admin->getDataById($id);


    if(!empty($getData)) {


        $idUsers = $getData['id_users'];

        $data = [
            'email' => antiSqlInjection($_POST['email']),
            'semester' => antiSqlInjection($_POST['semester']),
            'tingkat' => antiSqlInjection($_POST['tingkat']),
            'status' => antiSqlInjection($_POST['status']),
            // 'id_pelanggaran' => antiSqlInjection($_POST['id_pelanggaran']),
            'id_prodi' => antiSqlInjection($_POST['id_prodi']),
            'id_kelas' => antiSqlInjection($_POST['id_kelas']),
            'nama' => antiSqlInjection($_POST['nama']),
        ];

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            // unset($data['foto']);
            $data['foto'] = $foto;
        }


        $admin->updateData($id, $data);


        $user = new UsersModel();


        $dataUser['username'] = $_POST['username'];

        if(!empty($password)) {
            $dataUser['password'] = $_POST['password'];
        }


        $user->updateData($idUsers, $dataUser);
        
    
        echo json_encode([
            'status' => true,
            'message' => 'Data berhasil diupdate.'
        ]);
    } else {
        echo json_encode([
            'status' => true,
            'message' => 'Data tidak ditemukan.'
        ]);
    }

 
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $admin = new MahasiswaModel();
    $admin->deleteData($id);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil dihapus.'
    ]);
}

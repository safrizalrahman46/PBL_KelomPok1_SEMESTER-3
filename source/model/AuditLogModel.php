<?php
// include_once('Model.php');
include_once('Database.php');

class AuditLogModel
{
    protected $db;
    protected $table = 'AuditLog';

    public function __construct()
    {
        $database = Database::getInstance();
        $this->db = $database->getConnection();
    }
    public function getDataForDataTables($request)
    {
        // Columns available for ordering and searching
        $columns = ['Action', 'ID_Pelanggaran','NamaMahasiswa', 'deskripsi', 'Komentar', 'Tempat', 'LogDate'];

        // Extract search and pagination parameters
        $searchValue = isset($request['search']['value']) ? $request['search']['value'] : '';
        $searchTerm = "%{$searchValue}%";

        $orderColumnIndex = isset($request['order'][0]['column']) ? (int)$request['order'][0]['column'] : 0;
        $orderDir = isset($request['order'][0]['dir']) && in_array(strtolower($request['order'][0]['dir']), ['asc', 'desc'])
            ? $request['order'][0]['dir']
            : 'asc';

        $start = isset($request['start']) ? (int)$request['start'] : 0;
        $length = isset($request['length']) ? (int)$request['length'] : 10;

        // Ensure column index is valid
        $orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'LogID';

        // SQL query for fetching data with search and pagination
        // $query = "SELECT al.*, jp.deskripsi
        // FROM {$this->table} al
        // LEFT JOIN tb_jenis_pelanggaran jp ON al.ID_Pelanggaran = jp.id_jenis_pelanggaran
        //  LEFT JOIN tb_mahasiswa m ON l.id_mahasiswa = m.nim
        //    LEFT JOIN tb_jenis_pelanggaran jp ON l.id_jenis_pelanggaran = jp.id_jenis_pelanggaran
        // WHERE 1=1";

        $query = "
        SELECT al.*, jp.deskripsi, m.nama AS NamaMahasiswa
        FROM {$this->table} al
        LEFT JOIN tb_lapor l ON al.ID_Pelanggaran = l.id_pelanggaran
        LEFT JOIN tb_mahasiswa m ON l.id_mahasiswa = m.nim
        LEFT JOIN tb_jenis_pelanggaran jp ON l.id_jenis_pelanggaran = jp.id_jenis_pelanggaran
        WHERE 1=1
        ";
        

        $queryParams = [];

        if (!empty($searchValue)) {
            $query .= " AND (a.Action LIKE ? OR a.ID_Pelanggaran LIKE ? OR j.deskripsi LIKE ? OR a.Komentar LIKE ? OR a.Tempat LIKE ?)";
            $queryParams[] = $searchTerm;
            $queryParams[] = $searchTerm;
            $queryParams[] = $searchTerm;
            $queryParams[] = $searchTerm;
            $queryParams[] = $searchTerm;
        }

        $query .= " ORDER BY {$orderColumn} {$orderDir} OFFSET ? ROWS FETCH NEXT ? ROWS ONLY";
        $queryParams[] = $start;
        $queryParams[] = $length;

        // Execute the query
        $stmt = sqlsrv_query($this->db, $query, $queryParams);
        $data = [];
        if ($stmt) {
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $data[] = $row;
            }
        }

        // Count total filtered records
        $queryFiltered = "
        SELECT COUNT(*) as count 
        FROM {$this->table} AS a
        LEFT JOIN tb_jenis_pelanggaran AS j ON a.ID_Pelanggaran = j.id_jenis_pelanggaran
        WHERE 1=1
    ";
        if (!empty($searchValue)) {
            $queryFiltered .= " AND (a.Action LIKE ? OR a.ID_Pelanggaran LIKE ? OR j.deskripsi LIKE ? OR a.Komentar LIKE ? OR a.Tempat LIKE ?)";
            $filteredParams = [$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm];
        }

        $stmtFiltered = sqlsrv_query($this->db, $queryFiltered, $filteredParams ?? []);
        $totalFiltered = 0;
        if ($stmtFiltered) {
            $rowFiltered = sqlsrv_fetch_array($stmtFiltered, SQLSRV_FETCH_ASSOC);
            $totalFiltered = $rowFiltered ? $rowFiltered['count'] : 0;
        }

        // Count total records
        $queryTotal = "SELECT COUNT(*) as count FROM {$this->table}";
        $stmtTotal = sqlsrv_query($this->db, $queryTotal);
        $totalRecords = 0;
        if ($stmtTotal) {
            $rowTotal = sqlsrv_fetch_array($stmtTotal, SQLSRV_FETCH_ASSOC);
            $totalRecords = $rowTotal ? $rowTotal['count'] : 0;
        }

        // Return data in DataTables format
        return [
            "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalFiltered,
            "data" => $data
        ];
    }

    // public function getDataForDataTables($request)
    // {
    //     // Columns available for ordering and searching
    //     $columns = ['Action', 'ID_Pelanggaran', 'Komentar', 'Tanggal_Laporan', 'Tempat', 'LogDate'];

    //     // Extract search and pagination parameters
    //     $searchValue = isset($request['search']['value']) ? $request['search']['value'] : '';
    //     $searchTerm = "%{$searchValue}%";

    //     $orderColumnIndex = isset($request['order'][0]['column']) ? (int)$request['order'][0]['column'] : 0;
    //     $orderDir = isset($request['order'][0]['dir']) && in_array(strtolower($request['order'][0]['dir']), ['asc', 'desc'])
    //         ? $request['order'][0]['dir']
    //         : 'asc';

    //     $start = isset($request['start']) ? (int)$request['start'] : 0;
    //     $length = isset($request['length']) ? (int)$request['length'] : 10;

    //     // Ensure column index is valid
    //     $orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'LogID';

    //     // SQL query for fetching data with search and pagination
    //     $query = "SELECT * FROM {$this->table} WHERE 1=1";
    //     $queryParams = [];

    //     if (!empty($searchValue)) {
    //         $query .= " AND (Action LIKE ? OR ID_Pelanggaran LIKE ? OR Komentar LIKE ? OR Tempat LIKE ?)";
    //         $queryParams[] = $searchTerm;
    //         $queryParams[] = $searchTerm;
    //         $queryParams[] = $searchTerm;
    //         $queryParams[] = $searchTerm;
    //     }

    //     $query .= " ORDER BY {$orderColumn} {$orderDir} OFFSET ? ROWS FETCH NEXT ? ROWS ONLY";
    //     $queryParams[] = $start;
    //     $queryParams[] = $length;

    //     // Log the query and parameters
    //     error_log("Query: " . $query);
    //     error_log("Params: " . json_encode($queryParams));

    //     // Execute the query
    //     $stmt = sqlsrv_query($this->db, $query, $queryParams);
    //     if ($stmt === false) {
    //         die(print_r(sqlsrv_errors(), true)); // Output error if the query fails
    //     }

    //     $data = [];
    //     while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    //         $data[] = $row;
    //     }

    //     // Log the fetched data
    //     error_log("Fetched Data: " . json_encode($data));

    //     // Count total filtered records
    //     $queryFiltered = "SELECT COUNT(*) as count FROM {$this->table} WHERE 1=1";
    //     if (!empty($searchValue)) {
    //         $queryFiltered .= " AND (Action LIKE ? OR ID_Pelanggaran LIKE ? OR Komentar LIKE ? OR Tempat LIKE ?)";
    //         $filteredParams = [$searchTerm, $searchTerm, $searchTerm, $searchTerm];
    //     }

    //     $stmtFiltered = sqlsrv_query($this->db, $queryFiltered, $filteredParams ?? []);
    //     $totalFiltered = 0;
    //     if ($stmtFiltered) {
    //         $rowFiltered = sqlsrv_fetch_array($stmtFiltered, SQLSRV_FETCH_ASSOC);
    //         $totalFiltered = $rowFiltered ? $rowFiltered['count'] : 0;
    //     }

    //     // Count total records
    //     $queryTotal = "SELECT COUNT(*) as count FROM {$this->table}";
    //     $stmtTotal = sqlsrv_query($this->db, $queryTotal);
    //     $totalRecords = 0;
    //     if ($stmtTotal) {
    //         $rowTotal = sqlsrv_fetch_array($stmtTotal, SQLSRV_FETCH_ASSOC);
    //         $totalRecords = $rowTotal ? $rowTotal['count'] : 0;
    //     }

    //     // Return data in DataTables format
    //     return [
    //         "draw" => isset($request['draw']) ? intval($request['draw']) : 0,
    //         "recordsTotal" => $totalRecords,
    //         "recordsFiltered" => $totalFiltered,
    //         "data" => $data
    //     ];
    // }

}

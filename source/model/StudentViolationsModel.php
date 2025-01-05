<?php
include_once('Database.php');

class StudentViolationsModel
{
    protected $db;
    protected $view = 'vw_StudentViolations';

    public function __construct()
    {
        $database = Database::getInstance();
        $this->db = $database->getConnection();
    }

    public function getDataForDataTables($request)
    {
        // Columns available for ordering and searching
        $columns = ['nim', 'nama', 'email', 'id_pelanggaran', 'komentar', 'status_verifikasi_admin', 'jenis_pelanggaran', 'tanggal_laporan', 'tempat'];

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
        $orderColumn = isset($columns[$orderColumnIndex]) ? $columns[$orderColumnIndex] : 'nim';

        // SQL query for fetching data with search and pagination
        $query = "SELECT * FROM {$this->view} WHERE 1=1";
        $queryParams = [];

        if (!empty($searchValue)) {
            $query .= " AND (nim LIKE ? OR nama LIKE ? OR email LIKE ? OR id_pelanggaran LIKE ? OR komentar LIKE ? OR status_verifikasi_admin LIKE ? OR jenis_pelanggaran LIKE ? OR tanggal_laporan LIKE ? OR tempat LIKE ?)";
            $queryParams = array_fill(0, 9, $searchTerm);
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
        $queryFiltered = "SELECT COUNT(*) as count FROM {$this->view} WHERE 1=1";
        if (!empty($searchValue)) {
            $queryFiltered .= " AND (nim LIKE ? OR nama LIKE ? OR email LIKE ? OR id_pelanggaran LIKE ? OR komentar LIKE ? OR status_verifikasi_admin LIKE ? OR jenis_pelanggaran LIKE ? OR tanggal_laporan LIKE ? OR tempat LIKE ?)";
            $filteredParams = array_fill(0, 9, $searchTerm);
        }

        $stmtFiltered = sqlsrv_query($this->db, $queryFiltered, $filteredParams ?? []);
        $totalFiltered = 0;
        if ($stmtFiltered) {
            $rowFiltered = sqlsrv_fetch_array($stmtFiltered, SQLSRV_FETCH_ASSOC);
            $totalFiltered = $rowFiltered ? $rowFiltered['count'] : 0;
        }

        // Count total records
        $queryTotal = "SELECT COUNT(*) as count FROM {$this->view}";
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
}

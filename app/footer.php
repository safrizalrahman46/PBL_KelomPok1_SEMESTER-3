  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<!-- <script src="plugins/sparklines/sparkline.js"></script> -->
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard.js"></script> -->

<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>


<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });


//   $('.view-data').click(function(){
//     console.log(10);
// })


    // $('.view-data').click(function() {
    //     var nim = $(this).attr('data-nim');
    //     document.getElementById('NIM').innerHTML = nim;

    //     console.log(nim);
    // });

//     $('.view-data').click(function() {
//     var nim = $(this).attr('data-nim');
//     document.getElementById('NIM').innerHTML = nim;
//     console.log(nim);
// });

    $('.view-data').click(function () {
    // Ambil data dari atribut
    var id = $(this).attr('data-id');
    var name = $(this).attr('data-name');
    var department_id = $(this).attr('data-department_id');
    var email = $(this).attr('data-email');
    var nim = $(this).attr('data-nim');
    var username = $(this).attr('data-username');
    var password = $(this).attr('data-password');
    var totalViolationPoints = $(this).attr('data-total-violation-points');
    var totalRewardPoints = $(this).attr('data-total-reward-points');
    var semester = $(this).attr('data-semester');
    var tingkat = $(this).attr('data-tingkat');
    var foto = $(this).attr('data-foto');


        // Log data untuk debugging
    //     console.log(`ID: ${id}`);
    // console.log(`Name: ${name}`);
    // console.log(`Department ID: ${department_id}`);
    // console.log(`Email: ${email}`);
    console.log(`NIM: ${nim}`);
    // console.log(`Username: ${username}`);
    // console.log(`Password: ${password}`);
    // console.log(`Total Violation Points: ${totalViolationPoints}`);
    // console.log(`Total Reward Points: ${totalRewardPoints}`);
    // console.log(`Semester: ${semester}`);
    // console.log(`Tingkat: ${tingkat}`);
    // console.log(`Foto: ${foto}`);


    // Masukkan data ke dalam elemen dengan ID masing-masing
    document.getElementById('id').innerHTML = id;
    document.getElementById('name').innerHTML = name;
    document.getElementById('department_id').innerHTML = department_id;
    document.getElementById('email').innerHTML = email;
    document.getElementById('NIM').innerHTML = nim;
    document.getElementById('username').innerHTML = username;
    document.getElementById('Password').innerHTML = password;
    document.getElementById('total_violation_points').innerHTML = totalViolationPoints;
    document.getElementById('total_reward_points').innerHTML = totalRewardPoints;
    document.getElementById('semester').innerHTML = semester;
    document.getElementById('tingkat').innerHTML = tingkat;
    document.getElementById('foto').innerHTML = foto;

    // $('#modal-view').modal('show');

});



</script>
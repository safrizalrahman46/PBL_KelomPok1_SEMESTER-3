@extends('admin.layouts.app')

@section('content')
<style>
    .select2-dropdown.select2-dropdown--below {
        width: 420px !important;
    }

    .select2-container--default .select2-selection--single {
        padding: 6px;
        height: 37px;
        width: 420px;
        font-size: 1.2em;
        position: relative;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        background-image: -khtml-gradient(linear, left top, left bottom, from(#424242), to(#030303));
        background-image: -moz-linear-gradient(top, #424242, #030303);
        background-image: -ms-linear-gradient(top, #424242, #030303);
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #424242), color-stop(100%, #030303));
        background-image: -webkit-linear-gradient(top, #424242, #030303);
        background-image: -o-linear-gradient(top, #424242, #030303);
        background-image: linear-gradient(#424242, #030303);
        width: 40px;
        color: #fff;
        font-size: 1.3em;
        padding: 4px 12px;
        height: 36px;
        position: absolute;
        top: 0px;
        right: 0px;
        width: 20px;
    }
</style>
<section class="section">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Manage Booking</h4>


                    <div class="col-md-12">
                        <a href="javascript:void(0)" id="createNewPost"
                            class="btn btn-sm btn-pill btn-primary float-right">Create data </a>


                        {{-- <a href="{{ route('Export.MasterjenisTransaksi') }}" type="button"
                            class="btn btn-info">Export Excel</a>
                        <a href="{{ route('Export.MasterjenisTransaksiPDF') }}" type="button"
                            class="btn btn-success">Export PDF</a> --}}


                    </div>


                    @if (session('success'))
                    <div class="alert alert-icon alert-success alert-dismissible" role="alert">
                        <i class="fe fe-check mr-2" aria-hidden="true"></i>
                        <button type="button" class="close" data-dismiss="alert"></button>
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="form-group col-4">


                        </div>
                    </div>

                    {{-- , 'remember_token', 'email_verified_at' --}}
                    <div class="table-responsive" style="margin-top:30px;">
                        <table class="table table-striped data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Booking</th>
                                    <th>Notes</th>
                                    <th>Processed at</th>
                                    <th>Status</th>
                                    <th width="80px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>





</section>


<div class="modal fade" id="ajaxModelexa" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>


            <div class="modal-body">

                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>


                <form id="postForm" name="postForm" class="form-horizontal">
                    <input type="hidden" name="id" id="id">


                    {{-- <div class="form-group">

                        <label for="code_booking" class="col-sm-12">code_booking</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="code_booking" name="code_booking"
                                placeholder="Enter Pickup" value="" required>
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="booking_id">Booking</label>
                            <select id="booking_id" name="booking_id" class="form-control">
                                @foreach ($Booking as $Bookingitem)
                                <option value="{{ $Bookingitem->id }}">{{ $Bookingitem->code_booking }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{--
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="status">status </label>
                            <select id="status" name="status" class="form-control">
                                @foreach ($booking as $bookingitem)
                                <option value="{{ $bookingitem->id }}">{{ $bookingitem->status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <label for="status" class="col-sm-12">Status</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="status" name="status" required>
                                <option value="" disabled selected>Select Status</option>
                                <option value="confirmed">Confirmed</option>
                                <option value="completed">Completed</option>
                                <option value="canceled">Canceled</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">

                        <label for="notes" class="col-sm-12">Notes</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="notes" name="notes" placeholder="Enter Pickup"
                                value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="processed_at" class="col-sm-12">Processed at</label>
                        <div class="col-sm-12">
                            <input type="datetime-local" class="form-control" id="processed_at" name="processed_at"
                                placeholder="Enter DropOff" value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="simpandata" value="create">Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#jenis").change(function() {
                var el = $(this).val();
                if (el == 'Jangka') {
                    $("#divTenor").show();
                } else {
                    $("#divTenor").hide();
                }
            });

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('admin.Manage-Booking.index') }}',
                    data: function(data) {
                        var event = $('#filter_event_id').val();
                    }
                },
                dom: 'lBfrtip',
                buttons: [
                    'excel', 'csv', 'pdf', 'copy'
                ],
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'booking.code_booking',
                        name: 'booking.code_booking'
                    }, // Use car_name here

                    {
                        data: 'notes',
                        name: 'notes'
                    },
                    {
                        data: 'processed_at',
                        name: 'processed_at'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data) {
                            if (data === 'completed') {
                                return '<span class="badge badge-success">Completed</span>';
                            } else if (data === 'confirmed') {
                                return '<span class="badge badge-warning">Confirmed</span>';
                            } else if (data === 'canceled') {
                                return '<span class="badge badge-danger">Canceled</span>';
                            }
                            return '<span class="badge badge-secondary">Unknown</span>';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            // {{-- , 'remember_token', 'email_verified_at' --}}
            $('#createNewPost').click(function() {
                $('#simpandata').val("create-post");
                $('#id').val('');
                $('#postForm').trigger("reset");
                $('#modelHeading').html("Add Data Manage Booking");
                $('#ajaxModelexa').modal('show');
            });

            $('body').on('click', '.editPost', function() {
                var id = $(this).data('id');
                $.get("{{ route('admin.Manage-Booking.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeading').html("Edit User");
                    $('#simpandata').val("edit-user");
                    $('#ajaxModelexa').modal('show');
                    $('#id').val(data.id);
                    $('#booking_id ').val(data.booking_id);
                    $('#status ').val(data.status);
                    $('#notes ').val(data.notes);
                    $('#processed_at ').val(data.processed_at);


                })
            });

            $('#simpandata').click(function(e) {
                e.preventDefault();

                $.ajax({
                    data: $('#postForm').serialize(),
                    url: "{{ route('admin.Manage-Booking.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            $('#postForm').trigger("reset");
                            $('#ajaxModelexa').modal('hide');

                            $.getScript('{{ asset('/public/notify.min.js') }}', function() {
                                $.notify("Data has been added", "success");
                            });

                            table.draw();
                        } else {
                            printErrorMsg(data.error);
                        }
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#simpandata').html('Save Changes');
                    }
                });
            });

            $('body').on('click', '.deletePost', function() {

                var id = $(this).data("id");
                if (confirm("Apakah anda yakin ingin menghapus data ini ? ")) {

                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('admin.Manage-Booking.store') }}" + '/' + id,
                        success: function(data) {


                            $.getScript('{{ asset('/public/notify.min.js') }}', function() {
                                $.notify("Data has been deleted", "info");
                            });

                            table.draw();
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });

                }
            });




            function printErrorMsg(msg) {


                $(".print-error-msg").find("ul").html('');

                $(".print-error-msg").css('display', 'block');

                $.each(msg, function(key, value) {

                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');

                });

            }


        });
</script>
@endsection
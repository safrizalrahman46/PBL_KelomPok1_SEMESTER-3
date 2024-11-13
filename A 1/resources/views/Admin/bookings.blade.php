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

                    <h4 class="card-title">Booking</h4>


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
                                    <th>User</th>
                                    <th>Car</th>
                                    <th>Pickup Location</th>
                                    <th>Dropoff Location</th>
                                    <th>Start Datetime</th>
                                    <th>End Datetime</th>
                                    <th>Code Booking </th>
                                    <th>Status</th>
                                    <th>Booking Group</th>
                                    <th>Booking Duration</th>
                                    <th>Total Price</th>
                                    <th>Total Deposit</th>
                                    <th>Total Payment</th>
                                    <th>Total Additional Price</th>
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


                    <div class="form-group">

                        <label for="code_booking" class="col-sm-12">Code Booking</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="code_booking" name="code_booking"
                                placeholder="Enter Pickup" value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="user_id">User</label>
                            <select id="user_id" name="user_id" class="form-control">
                                @foreach ($User as $Useritem)
                                <option value="{{ $Useritem->id }}">{{ $Useritem->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="car_id">Car</label>
                            <select id="car_id" name="car_id" class="form-control">
                                @foreach ($cars as $carsitem)
                                <option value="{{ $carsitem->id }}">{{ $carsitem->car }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">

                        <label for="pickup_location" class="col-sm-12">Pickup Location</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="pickup_location" name="pickup_location"
                                placeholder="Enter Pickup" value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="dropoff_location" class="col-sm-12">Dropoff Location</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="dropoff_location" name="dropoff_location"
                                placeholder="Enter DropOff" value="" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="start_datetime" class="col-sm-12">Start Datetime</label>
                        <div class="col-sm-12">
                            <input type="datetime-local" class="form-control" id="start_datetime" name="start_datetime"
                                placeholder="Enter End Datetime" value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="end_datetime" class="col-sm-12">End Datetime</label>
                        <div class="col-sm-12">
                            <input type="datetime-local" class="form-control" id="end_datetime" name="end_datetime"
                                placeholder="Enter End Datetime" value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status" class="col-sm-12">Status</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="status" name="status" required>
                                <option value="" disabled selected>Select Status</option>
                                <option value="booked">Booked</option>
                                <option value="completed">Completed</option>
                                <option value="canceled">Canceled</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="booking_group_id" class="col-sm-12">Booking Group</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="booking_group_id" name="booking_group_id"
                                placeholder="Enter booking_group_id" value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="booking_duration" class="col-sm-12">Booking Duration</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="booking_duration" name="booking_duration"
                                placeholder="Enter booking_duration" value="" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="total_price" class="col-sm-12">Total Price</label>
                        <div class="col-sm-12">
                            <input type="number" step="0.01" class="form-control" id="total_price" name="total_price"
                                placeholder="Enter Total Price" value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="total_deposit" class="col-sm-12">Total Deposit</label>
                        <div class="col-sm-12">
                            <input type="number" step="0.01" class="form-control" id="total_deposit"
                                name="total_deposit" placeholder="Enter Total Deposit" value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="total_payment" class="col-sm-12">Total Payment</label>
                        <div class="col-sm-12">
                            <input type="number" step="0.01" class="form-control" id="total_payment"
                                name="total_payment" placeholder="Enter Total Payment" value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="total_additional_price" class="col-sm-12">Total Additional Price</label>
                        <div class="col-sm-12">
                            <input type="number" step="0.01" class="form-control" id="total_additional_price"
                                name="total_additional_price" placeholder="Enter Total Additional Price" value=""
                                required>
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
                    url: '{{ route('admin.Bookings.index') }}',
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
                        data: 'User.name',
                        name: 'User.name'
                    }, // Use car_name here
                    {
                        data: 'car.car',
                        name: 'car.car'
                    }, // Use car_name here
                    {
                        data: 'pickup_location',
                        name: 'pickup_location'
                    },
                    {
                        data: 'dropoff_location',
                        name: 'dropoff_location'
                    },
                    {
                        data: 'start_datetime',
                        name: 'start_datetime'
                    },
                    {
                        data: 'end_datetime',
                        name: 'end_datetime'
                    },
                    {
                        data: 'code_booking',
                        name: 'code_booking'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data) {
                            if (data === 'completed') {
                                return '<span class="badge badge-success">Completed</span>';
                            } else if (data === 'booked') {
                                return '<span class="badge badge-warning">Booked</span>';
                            } else if (data === 'canceled') {
                                return '<span class="badge badge-danger">Canceled</span>';
                            }
                            return '<span class="badge badge-secondary">Unknown</span>';
                        }
                    },

                    {
                        data: 'booking_group_id',
                        name: 'booking_group_id'
                    },

                    {
                        data: 'booking_duration',
                        name: 'booking_duration'
                    },
                    {
                        data: 'total_price',
                        name: 'total_price'
                    },
                    {
                        data: 'total_deposit',
                        name: 'total_deposit'
                    },
                    {
                        data: 'total_payment',
                        name: 'total_payment'
                    },
                    {
                        data: 'total_additional_price',
                        name: 'total_additional_price'
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
                $('#modelHeading').html("Add Data Booking");
                $('#ajaxModelexa').modal('show');
            });

            $('body').on('click', '.editPost', function() {
                var id = $(this).data('id');
                $.get("{{ route('admin.Bookings.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeading').html("Edit User");
                    $('#simpandata').val("edit-user");
                    $('#ajaxModelexa').modal('show');
                    $('#id').val(data.id);
                    $('#car_id').val(data.car_id);
                    $('#user_id').val(data.user_id);
                    $('#pickup_location').val(data.pickup_location);
                    $('#dropoff_location').val(data.dropoff_location);
                    $('#start_datetime').val(data.start_datetime);
                    $('#end_datetime').val(data.end_datetime);
                    $('#status').val(data.status);
                    $('#code_booking').val(data.code_booking);
                    $('#booking_group_id').val(data.booking_group_id);
                    $('#booking_duration').val(data.booking_duration);
                    $('#total_price').val(data.total_price);
                    $('#total_deposit').val(data.total_deposit);
                    $('#total_payment').val(data.total_payment);
                    $('#total_additional_price').val(data.total_additional_price);

                })
            });

            $('#simpandata').click(function(e) {
                e.preventDefault();

                $.ajax({
                    data: $('#postForm').serialize(),
                    url: "{{ route('admin.Bookings.store') }}",
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
                        url: "{{ route('admin.Bookings.store') }}" + '/' + id,
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
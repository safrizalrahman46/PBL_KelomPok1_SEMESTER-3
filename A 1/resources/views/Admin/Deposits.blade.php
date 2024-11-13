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

                    <h4 class="card-title">Deposit</h4>


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
                                    <th>Booking ID</th>
                                    <th>Deposit Amount</th>
                                    <th>Status</th>
                                    <th>Payment Method</th>
                                    <th>Paid At</th>
                                    <th>Refunded At</th>

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
                        <label for="booking_id" class="col-sm-12">Booking ID</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="booking_id" name="booking_id"
                                placeholder="Enter Booking ID" value="" required>
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

                    <div class="form-group">
                        <label for="deposit_amount" class="col-sm-12">Deposit Amount</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="deposit_amount" name="deposit_amount"
                                placeholder="Enter Deposit Amount" value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status" class="col-sm-12">Status</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="status" name="status" required>
                                <option value="" disabled selected>Select Status</option>
                                <option value="available">Available</option>
                                <option value="booked">Booked</option>
                                <option value="refunded">Refunded</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="payment_method" class="col-sm-12">Payment Method</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="payment_method" name="payment_method" required>
                                <option value="" disabled selected>Select Payment Method</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="cash">Cash</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="paid_at" class="col-sm-12">Paid At</label>
                        <div class="col-sm-12">
                            <input type="datetime-local" class="form-control" id="paid_at" name="paid_at" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="refunded_at" class="col-sm-12">Refunded At</label>
                        <div class="col-sm-12">
                            <input type="datetime-local" class="form-control" id="refunded_at" name="refunded_at"
                                value="">
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
                    url: '{{ route('admin.Deposit.index') }}',
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

                    {{--  { data: 'booking', name: 'booking' },  --}}
                    { data: 'booking.code_booking', name: 'booking.code_booking' },
                    { data: 'deposit_amount', name: 'deposit_amount' },
                    { data: 'status', name: 'status' },
                    { data: 'payment_method', name: 'payment_method' },
                    { data: 'paid_at', name: 'paid_at' },
                    { data: 'refunded_at', name: 'refunded_at' },

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
                $('#modelHeading').html("Add Data Deposit");
                $('#ajaxModelexa').modal('show');
            });

            $('body').on('click', '.editPost', function() {
                var id = $(this).data('id');
                $.get("{{ route('admin.Deposit.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeading').html("Edit User");
                    $('#simpandata').val("edit-user");
                    $('#ajaxModelexa').modal('show');
                    $('#id').val(data.id);
                    $('#booking_id').val(data.booking_id);
                    $('#deposit_amount').val(data.deposit_amount);
                    $('#status').val(data.status);
                    $('#payment_method').val(data.payment_method);
                    $('#paid_at').val(data.paid_at);
                    $('#refunded_at').val(data.refunded_at);

                })
            });

            $('#simpandata').click(function(e) {
                e.preventDefault();

                $.ajax({
                    data: $('#postForm').serialize(),
                    url: "{{ route('admin.Deposit.store') }}",
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
                        url: "{{ route('admin.Deposit.store') }}" + '/' + id,
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
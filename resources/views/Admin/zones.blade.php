@extends('admin.layouts.app')

@section('content')

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
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

                    <h4 class="card-title">Zone</h4>


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
                                    <th>Zone Name</th>
                                    <th>Rate</th>
                                    <th>Province</th>
                                    <th>Regency City</th>
                                    <th>District</th>
                                    <th>Village</th>
                                    <th>Domicile Address</th>
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

                        <label for="zone_name" class="col-sm-12">Zone Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="zone_name" name="zone_name"
                                placeholder="Enter service name" value="" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="rate" class="col-sm-12">Rate</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" id="rate" name="rate" placeholder="Enter rate" rows="4"
                                required></textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="province">Province</label>
                        <div class="col-sm-12">
                            <select name="province" id="province" class="form-control">
                                @foreach ($IndonesiaProvinces as $province)
                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="regency_city">City</label>
                        <div class="col-sm-12">
                            <select name="regency_city" id="regency_city" class="form-control">
                                @foreach ($IndonesiaCity as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="district">District</label>
                        <div class="col-sm-12">
                            <select name="district" id="district" class="form-control">
                                @foreach ($IndonesiaDistrict as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="village">Village</label>
                        <div class="col-sm-12">
                            <select name="village" id="village" class="form-control">
                                @foreach ($IndonesiaVillage as $village)
                                <option value="{{ $village->id }}">{{ $village->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="domicile_address" class="col-sm-12">Domicile Address</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="domicile_address" name="domicile_address"
                                placeholder="Enter domicile_address" value="" required>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                    url: '{{ route('admin.Zones.index') }}',
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
                        data: 'zone_name',
                        name: 'zone_name'
                    },
                    {
                        data: 'rate',
                        name: 'rate'
                    },
                    {
                        data: 'province',
                        name: 'province'
                    },
                    {
                        data: 'regency_city',
                        name: 'regency_city'
                    },
                    {
                        data: 'district',
                        name: 'district'
                    },
                    {
                        data: 'village',
                        name: 'village'
                    },
                    {
                        data: 'domicile_address',
                        name: 'domicile_address'
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
                $('#modelHeading').html("Create User");
                $('#ajaxModelexa').modal('show');
            });

            $('body').on('click', '.editPost', function() {
                var id = $(this).data('id');
                $.get("{{ route('admin.Zones.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeading').html("Edit User");
                    $('#simpandata').val("edit-user");
                    $('#ajaxModelexa').modal('show');
                    $('#id').val(data.id);
                    $('#zone_name').val(data.zone_name);
                    $('#rate').val(data.rate);
                    $('#province').val(data.province);
                    $('#regency_city').val(data.regency_city);
                    $('#district').val(data.district);
                    $('#village').val(data.village);
                    $('#domicile_address').val(data.domicile_address);

                })
            });

            $('#simpandata').click(function(e) {
                e.preventDefault();

                $.ajax({
                    data: $('#postForm').serialize(),
                    url: "{{ route('admin.Zones.store') }}",
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
                        url: "{{ route('admin.Zones.store') }}" + '/' + id,
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

            function onChangeSelect(url, id, name) {
            // send ajax request to get the cities of the selected province and append to the select tag
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    id: id
                },
                success: function (data) {
                    $('#' + name).empty();
                    $('#' + name).append('<option>==Pilih Salah Satu==</option>');

                    $.each(data, function (key, value) {
                        $('#' + name).append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }
        $(function () {
            $('#provinsi').on('change', function () {
                onChangeSelect('{{ route("cities") }}', $(this).val(), 'kota');
            });
            $('#kota').on('change', function () {
                onChangeSelect('{{ route("districts") }}', $(this).val(), 'kecamatan');
            })
            $('#kecamatan').on('change', function () {
                onChangeSelect('{{ route("villages") }}', $(this).val(), 'desa');
            })
        });
        });


        $(document).ready(function() {
    $('#province').change(function() {
        var provinceId = $(this).val();

        // Fetch cities
        $.ajax({
            url: "{{ route('cities') }}", // Adjust the route to match your setup
            type: "GET",
            data: { id: provinceId },
            success: function(data) {
                $('#regency_city').empty();
                $.each(data, function(key, value) {
                    $('#regency_city').append('<option value="' + key + '">' + value + '</option>');
                });
                $('#district').empty(); // Clear districts and villages when province changes
                $('#village').empty();
            }
        });
    });

    $('#regency_city').change(function() {
        var cityId = $(this).val();

        // Fetch districts
        $.ajax({
            url: "{{ route('districts') }}", // Adjust the route to match your setup
            type: "GET",
            data: { id: cityId },
            success: function(data) {
                $('#district').empty();
                $.each(data, function(key, value) {
                    $('#district').append('<option value="' + key + '">' + value + '</option>');
                });
                $('#village').empty(); // Clear villages when city changes
            }
        });
    });

    $('#district').change(function() {
        var districtId = $(this).val();

        // Fetch villages
        $.ajax({
            url: "{{ route('villages') }}", // Adjust the route to match your setup
            type: "GET",
            data: { id: districtId },
            success: function(data) {
                $('#village').empty();
                $.each(data, function(key, value) {
                    $('#village').append('<option value="' + key + '">' + value + '</option>');
                });
            }
        });
    });
});
</script>

</body>

</html>

@endsection
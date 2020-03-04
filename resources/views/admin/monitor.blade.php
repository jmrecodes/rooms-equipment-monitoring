@extends('admin.main')

@section('title', 'Admin page - Rooms Equipment Monitoring System')

@section('style')
<!-- Custom styles for this page -->
<link href="{{ URL::to('/') }}/theme/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<style>
    section {
        padding-top: 20px;
    }

    h6 span {
        font-size: 12px;
    }

    span a {
        text-decoration: underline;
    }

    .modal-body {
        padding: 20px;
    }

    #dataTable2_wrapper {
        width: 100%;
    }

    .btn_equipment {
        color: #fff !important;
        cursor: pointer;
    }

</style>

@endsection

@section('content')
<section class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Monitor and Manage</h1>
    <p class="mb-4">Monitor the tools and equipment of a room, or manage them by assigning new ones, updating current
        tool/equipment
        assignments or removing/returning them.</p>

    <!-- Content Row -->
    <div class="row">

        <div class="col">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Room {{ $room_ID }} <span><a href="#"
                                data-toggle="modal" data-target="#rooms_modal">Change
                                room</a></span></h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tool</th>
                                <th>Quantity</th>
                                <th>Brand/Model</th>
                                <th>Borrower</th>
                                <th>Admin</th>
                                <th>Date Borrowed</th>
                                <th>Date To Return</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Tool</th>
                                <th>Quantity</th>
                                <th>Brand/Model</th>
                                <th>Borrower</th>
                                <th>Admin</th>
                                <th>Date Borrowed</th>
                                <th>Date To Return</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($equipment_room as $eqrm)

                            <tr>
                                <td>{{ $eqrm->equ_name }}</td>
                                <td>{{ $eqrm->eqrm_quantity }}</td>
                                <td>{{ $eqrm->equ_brand_model }}</td>
                                <td>{{ $eqrm->eqrm_borrower_fname . ' ' . $eqrm->eqrm_borrower_mname.substr(0, 1) . ' ' . $eqrm->eqrm_borrower_lname }}
                                </td>
                                <td>{{ $eqrm->adm_fname . ' ' . $eqrm->adm_mname.substr(0, 1) . ' ' . $eqrm->adm_lname }}</td>
                                <td>{{ $eqrm->eqrm_start_date }}</td>
                                <td>{{ $eqrm->eqrm_end_date }}</td>
                                <td class="text-center">
                                    <div class="dropdown no-arrow">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fa fa-bars"></i>
                                        </button>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                            x-placement="bottom-start"
                                            style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                            <a class="dropdown-item" href="#">Update</a>
                                            <a class="dropdown-item" href="#">Remove</a>
                                            <a class="dropdown-item" href="{{ route('equipment_room_return', ['eqrm_ID' => $eqrm->eqrm_ID]) }}">Return</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>

                    <br>
                    <div class="text-center">
                        <a href="#" class="btn btn-primary text-center" data-toggle="modal"
                            data-target="#equipment_modal">
                            Assign new tool / equipment
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>

</section>

<div class="modal fade" id="rooms_modal" tabindex="-1" role="dialog" aria-labelledby="rooms_modalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rooms_modalLabel">Find the room you want to monitor/manage</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id='resproc' class="row">
                    <table class="table table-bordered table-striped" id="dataTable2" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Room</th>
                                <th>Location</th>
                                <th>Size</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Room</th>
                                <th>Location</th>
                                <th>Size</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($rooms as $room)

                            <tr>
                                <td>{{ $room->room_ID }}</td>
                                <td>{{ $room->room_location }}</td>
                                <td>{{ $room->room_size }}</td>
                                <td>{{ $room->room_description }}</td>
                                <td class="text-center">
                                    <a class="btn btn-secondary" type="a"
                                        href="{{ route('monitor', ['room_ID' => $room->room_ID]) }}">
                                        <i class="fa fa-check"></i>
                                    </a>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="equipment_modal" tabindex="-1" role="dialog" aria-labelledby="equipment_modalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="equipment" action="{{ route('equipment_room_insert', ['room_ID' => $room_ID]) }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="equipment_modalLabel">Assigning a new tool /equipment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id='resproc' class="row">
                        <table class="table table-bordered table-striped" id="dataTable3" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tool / Equipment</th>
                                    <th>Brand / Model</th>
                                    <th>Availability</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Tool / Equipment</th>
                                    <th>Brand / Model</th>
                                    <th>Availability</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $i = 0 ?>
                                @foreach ($equipments as $equipment)
                                <tr>
                                    <td>{{ $equipment->equ_name }}</td>
                                    <td>{{ $equipment->equ_brand_model }}</td>
                                    <td>{{ $status[$i] }}</td>
                                    <td class="text-center">
                                        <a class="btn_equipment btn btn-secondary 
                                        @if ($status[$i] == 'Not available')
                                            {{ 'disabled' }}
                                        @endif" type="a" data-val="{{ $equipment->equ_ID }}"
                                            data-max="{{ $equipment->equ_quantity }}">
                                            <i class="fa fa-check"></i>
                                        </a>
                                    </td>
                                </tr>

                                <?php $i++ ?>
                                @endforeach
                            </tbody>

                        </table>

                        <div class="col" style="padding: 5px 20px;">
                            <input type="text" class="form-control" id="id" name="id" style="display: none;">
                            <div class="form-group">
                                <input type="text" class="form-control" id="equ_ID_FK" name="equ_ID_FK"
                                    placeholder="Equipment ID" readonly required>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" id="eqrm_quantity" name="eqrm_quantity"
                                    placeholder="Quantity" min=1 required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control mb-1" id="middle_name" name="eqrm_borrower_fname"
                                    placeholder="Borrower's First Name">

                                <input type="text" class="form-control mb-1" id="middle_name" name="eqrm_borrower_mname"
                                    placeholder="Borrower's Middle Name">

                                <input type="text" class="form-control mb-1" id="middle_name" name="eqrm_borrower_lname"
                                    placeholder="Borrower's Last Name">
                            </div>
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="date" class="form-control" id="middle_name" name="eqrm_start_date"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>End Date</label>
                                <input type="date" class="form-control" id="middle_name" name="eqrm_end_date">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button id="submit" type="submit" class="btn btn-primary">Confirm</button>
                </div>

                @csrf
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; monitor.ing 2020</span>
        </div>
    </div>
</footer>
@endsection

@section('script')
<!-- Page level plugins -->
<script src="{{ URL::to('/') }}/theme/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ URL::to('/') }}/theme/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();

        $('#dataTable2').DataTable();

        $('#dataTable3').DataTable();

        $('.btn_equipment').click(function () {
            $('#equ_ID_FK').val($(this).data('val'));
            $('#eqrm_quantity').attr('max', $(this).data('max'));
        });
    });

</script>
@endsection

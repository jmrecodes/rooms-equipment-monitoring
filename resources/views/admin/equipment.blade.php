@extends('admin.main')

@section('title', 'Admin page - Rooms Equipment Monitoring System')

@section('style')
<!-- Custom styles for this page -->
<link href="{{ URL::to('/') }}/theme/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<style>
    section {
        padding-top: 20px;
    }

</style>

@endsection

@section('content')
<section class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tools and Equipment</h1>
    <p class="mb-4">Manage all the tools and equipment available by adding new ones, updating their info, or removing
        them.</p>

    <!-- Content Row -->
    <div class="row">

        <div class="col">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of tools / equipments</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tool / Equipment</th>
                                <th>Quantity</th>
                                <th>Brand / Model</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Tool / Equipment</th>
                                <th>Quantity</th>
                                <th>Brand / Model</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $i = 0 ?>
                            @foreach ($equipments as $equipment)

                            <tr>
                                <td>{{ $equipment->equ_name }}</td>
                                <td>{{ $equipment->equ_quantity }}</td>
                                <td>{{ $equipment->equ_brand_model }}</td>
                                <td>{{ $equipment->equ_description }}</td>
                                <td>{{ $status[$i] }}</td>
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
                                            <a class="dropdown-item" href="#">View details</a>
                                            <a class="dropdown-item" href="#">Update</a>
                                            <a class="dropdown-item" href="#">Remove</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <?php $i++ ?>
                            @endforeach
                        </tbody>
                    </table>

                    <br>
                    <div class="text-center">
                        <a href="#" class="btn btn-primary text-center" data-toggle="modal" data-target="#addeditmodal">
                            Add new tool / equipment
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>

</section>

<div class="modal fade" id="addeditmodal" tabindex="-1" role="dialog" aria-labelledby="addeditmodalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addedit_equipment" action="{{ route('equipment_insert') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addeditmodalLabel">New tool/equipment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id='resproc' class="row">
                        <div class="col" style="padding: 5px 20px;">
                            <input type="text" class="form-control" id="id" name="id" style="display: none;">
                            <div class="form-group">
                                <input type="text" class="form-control" id="first_name" name="equ_name"
                                    placeholder="Tool/Equipment" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="middle_name" name="equ_description"
                                    placeholder="Description" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="middle_name" name="equ_class_of_asset"
                                    placeholder="Class of Asset" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="middle_name" name="equ_brand_model"
                                    placeholder="Brand/Model" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="middle_name" name="equ_unit_cost"
                                    placeholder="Unit cost" required>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" id="last_name" name="equ_quantity"
                                    placeholder="Quantity" required>
                            </div>
                            <div class="form-group">
                                <label>Date Acquired</label>
                                <input type="date" class="form-control" id="middle_name" name="equ_date_acquired"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Date for End of Warranty</label>
                                <input type="date" class="form-control" id="middle_name" name="equ_warranty" required>
                            </div>
                            <div class="form-group">
                                <label>Date for Estimated Life</label>
                                <input type="date" class="form-control" id="middle_name" name="equ_estimated_life"
                                    required>
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
    });

</script>
@endsection

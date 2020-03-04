@extends('admin.main')

@section('title', 'Admin page - Rooms Equipment Monitoring System')

@section('style')
<!-- Custom styles for this page -->
<link href="{{ URL::to('/') }}/theme/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<style>
    section {
        padding-top: 20px;
    }

    span {
        font-size: 12px;
    }

    span a {
        text-decoration: underline;
    }

</style>

@endsection

@section('content')
<section class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Monitor and Manage</h1>
    <p class="mb-4">Monitor the tools and equipment of a room, or manage them by adding, updating current tool/equipment assignment or removing/returning them.</p>

    <!-- Content Row -->
    <div class="row">

        <div class="col">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Room not found. Please add the room first.</h6>
                </div>
                <div class="card-body">
                </div>
            </div>

        </div>

    </div>

</section>

<div class="modal fade" id="addeditmodal" tabindex="-1" role="dialog" aria-labelledby="addeditmodalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form id="addedit_user" action="{{ route('equipment_insert') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addeditmodalLabel">New tool/equipment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div id='resproc' class="row">
                        <div class="col" id="edit_client_profile" style="padding: 5px 20px;">
                            <input type="text" class="form-control" id="id" name="id" style="display: none;">
                            <div class="form-group">
                                <input type="text" class="form-control" id="first_name" name="equ_name" placeholder="Tool/Equipment" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="middle_name" name="equ_description" placeholder="Description" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="middle_name" name="equ_class_of_asset" placeholder="Class of Asset" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="middle_name" name="equ_brand_model" placeholder="Brand/Model" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="middle_name" name="equ_unit_cost" placeholder="Unit cost" required>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" id="last_name" name="equ_quantity" placeholder="Quantity" required>
                            </div>
                            <div class="form-group">
                                <label>Date Acquired</label>
                                <input type="date" class="form-control" id="middle_name" name="equ_date_acquired" required>
                            </div>
                            <div class="form-group">
                                <label>Date for End of Warranty</label>
                                <input type="date" class="form-control" id="middle_name" name="equ_warranty" required>
                            </div>
                            <div class="form-group">
                                <label>Date for Estimated Life</label>
                                <input type="date" class="form-control" id="middle_name" name="equ_estimated_life" required>
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

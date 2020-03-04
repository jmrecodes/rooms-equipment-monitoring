@extends('admin.main')

@section('title', 'Admin page - Rooms Equipment Monitoring System')

@section('style')
<!-- Custom styles for this page -->
<link href="{{ URL::to('/') }}/theme/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<style>
    section {
        padding-top: 20px;
    }

    table td {
        color: white;
    }
</style>

@endsection

@section('content')
<section class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Wecome admin {{ $admin->adm_fname }}.</h1>
    <p class="mb-4">Below are the latest tools and equipment assignings.</p>

    <!-- Content Row -->
    <div class="row">

        <div class="col">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Latest assigning</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Admin</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Action</th>
                                <th>Admin</th>
                                <th>Date</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($equipment_room_assign as $eqrm1)

                            <tr class="bg-gradient-info">
                                <td><strong>Assigned</strong> ({{ $eqrm1->equ_quantity }}) {{ $eqrm1->equ_name }}/s to Room {{ $eqrm1->room_ID }}</td>
                                <td>{{ $eqrm1->adm_fname . ' ' . $eqrm1->adm_mname.substr(0, 1) . ' ' . $eqrm1->adm_lname }}</td>
                                <td>{{ $eqrm1->eqrm_start_date }}</td>
                            </tr>
                            @endforeach

                            @foreach ($equipment_room_return as $eqrm2)

                            <tr class="bg-gradient-danger">
                            <td><strong>Returned</strong> ({{ $eqrm2->equ_quantity }}) {{ $eqrm2->equ_name }}/s from Room {{ $eqrm2->room_ID }}</td>
                                <td>{{ $eqrm2->adm_fname . ' ' . $eqrm2->adm_mname.substr(0, 1) . ' ' . $eqrm2->adm_lname }}</td>
                                <td>{{ $eqrm2->eqrm_date_returned }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

</section>
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
        $(document).ready(function() {
            $('#dataTable').DataTable( {
                "order": [[ 2, "desc" ]]
            } );
        });
    </script>
@endsection

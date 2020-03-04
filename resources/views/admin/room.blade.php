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
    <h1 class="h3 mb-2 text-gray-800">Rooms</h1>
    <p class="mb-4">Manage all the rooms available by adding new ones, updating their info, or removing
        them.</p>

    <!-- Content Row -->
    <div class="row">

        <div class="col">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of rooms</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
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
                                <div class="dropdown no-arrow">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fa fa-bars"></i>
                                        </button>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                            x-placement="bottom-start"
                                            style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                            <a class="dropdown-item" href="#">View room</a>
                                            <a class="dropdown-item" href="#">Update</a>
                                            <a class="dropdown-item" href="#">Remove</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
    
                            @endforeach
                        </tbody>

                    </table>
                    <br>
                    <div class="text-center">
                        <a href="#" class="btn btn-primary text-center" data-toggle="modal" data-target="#addeditmodal">
                            Add new room
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
            <form id="addedit_room" action="{{ route('room_insert') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addeditmodalLabel">New room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id='resproc' class="row">
                        <div class="col" style="padding: 5px 20px;">
                            <input type="text" class="form-control" id="id" name="id" style="display: none;">
                            <div class="form-group">
                                <input type="text" class="form-control" id="first_name" name="room_name"
                                    placeholder="Room" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="middle_name" name="room_location"
                                    placeholder="Location" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="middle_name" name="room_description"
                                    placeholder="Description" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="middle_name" name="room_size"
                                    placeholder="Size" required>
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

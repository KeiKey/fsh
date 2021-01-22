@extends('layouts.application')

@section('title', 'All Files')

@section('content')
    <div class="card">
        <div class="card-header border-0">
            <div class="card-tools">
                <a href="javascript:location.reload()" class="btn btn-tool btn-sm">
                    <i class="fas fa-sync"></i>
                </a>

            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle files-datatable">
                <thead>
                <tr>
                    <th>File</th>
                    <th>File Size</th>
                    <th>Uploaded</th>
                    <th>More</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet"
          href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('/vendor/datatables/buttons.server-side.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(function () {

            var table = $('.files-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('files.index') }}",
                columns: [
                    {data: 'name', name: 'id'},
                    {data: 'size', name: 'size'},
                    {data: 'created_at', name: 'uploaded'},
                    {data: 'actions', name: 'actions', orderable: true, searchable: true},
                ]
            });

        });

        function size(size) {
            return parseInt(size) / 1024 / 1024;
        }

    </script>

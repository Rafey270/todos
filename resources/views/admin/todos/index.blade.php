
@extends('admin.layouts.admin')

@section('content')
    <div class="pageheader">
        <div class="media">
            <div class="pageicon pull-left">
                <i class="fa fa-home"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="#"><i class="glyphicon glyphicon-home"></i></a></li>
                    <li>ToDos</li>
                    <a href="{{ url('todos/create') }}"><button style="float: right;" class="btn btn-primary">Create</button></a>
                </ul>
                <h4>ToDos</h4>

            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel">
        <div class="table-responsive">
            <table  class="table table-striped table-bordered" style="margin-top: 30px;" cellspacing="0" width="100%" id="tblTodos" >
                <thead>
                <tr>
                    <th>ID</th>
                    <th>TITLE</th>
                    <th>DESCRIPTION</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div><!-- contentpanel -->

    {{-- Delete Form Starts --}}
    {!! Form::open(['method' => 'delete', 'id' => 'deleteForm']) !!}
    {!! Form::hidden('id', null , ['id' => 'deleteID']) !!}
    {!! Form::close() !!}
    {{-- Delete Form Ends --}}

@endsection

@section('scripts')
    <script type="text/javascript">

        var token = '{{ \Illuminate\Support\Facades\Cookie::get('bearerToken') }}';
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
                "Authorization": "Bearer "+token,
            }
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            // Hide alerts and errors of datatable
            $.fn.dataTable.ext.errMode = 'none';
            var api_route = '{{ url('api/todos') }}';
            var length = 25;
            var datatable = $('#tblTodos').DataTable({
                scrollX: true,
                responsive: true,
                columnDefs: [{
                    width: '900px',
                    searchable: true
                }],
                processing: true,
                serverSide: true,
                order: [[0, "desc"]],
                pageLength: length,
                ajax: {
                    url: api_route,
                    type: 'GET',
                },
                columns: [
                    {data: 'id'},
                    {data: 'title'},
                    {data: 'description'},
                    {
                        data: null,
                        responsivePriority: 100,
                        render: function ( data, type, row ) {
                            var editUrl = "{{ url('todos/') }}"+"/"+data.id+"/edit";
                            return ''
                                 + ' <a href="'+editUrl+'" class="fa fa-edit"></a>'
                                + ' <a href="javascript:void(0);" class="fa fa-trash-alt" data-id="'+data.id+'" id="deleteData"></a>'
                                ;
                        },
                        orderable: false,
                        searchable: false,
                    }
                ]
            });

            $('#generalSearch').on( 'keyup', function () {
                datatable.search($('#generalSearch').val()).draw();
            });

            $(document).on('click','#deleteData',function(){
                let response = confirm("Are you sure you want to delete!");
                if (response == true) {
                    var currentID = $(this).attr('data-id');
                    $('#deleteID').val(currentID);
                    var delete_url = '{{url('todos/:id')}}';
                    delete_url = delete_url.replace(':id', currentID);
                    $('#deleteForm').attr('action', delete_url);
                    $('#deleteForm')[0].submit();
                }
            });
        });

    </script>
@endsection

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
                    <li>Todo</li>
                </ul>
                <h4>Create Todo</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel">


        <div class="panel panel-default">
            <div class="panel-heading p10 clearfix">
                <h4 class="panel-title pull-left">Create Todo</h4>
                <a href="{{ url('todos') }}" class="btn btn-success btn-sm pull-right clearfix">Back to Todos</a>
            </div>
            <div class="panel-body ">
                <form method="POST" action="{{ url('todos') }}">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                        <label for="name" class="control-label">Title*</label>
                        <input type="text" id="name" name="title" class="form-control" value="{{ old('title') }}" required >
                        @if($errors->has('title'))
                            <label class="error">{{ $errors->first('title') }}</label>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                        <label for="email" class="control-label">Description*</label>
                        <textarea class="form-control" name="description" id="" cols="30" rows="10"></textarea>
                        @if($errors->has('description'))
                            <label class="error">{{ $errors->first('description') }}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger">Save</button>
                    </div>
                </form>
            </div>
        </div>


    </div><!-- contentpanel -->

@endsection

@section('scripts')

    <script>
        jQuery("#permissions").select2();
    </script>

@endsection

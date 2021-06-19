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
                    <li>Hotles</li>
                </ul>
                <h4>Edit Hotel</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel">
        <div class="panel panel-default">
            <div class="panel-heading p10 clearfix">
                <h4 class="panel-title pull-left">Edit Hotel</h4>
                <a href="{{ route('admin.hotels.index') }}" class="btn btn-success btn-sm pull-right clearfix">Back to Hotels</a>
            </div>
            <div class="panel-body ">
                <form method="POST" action="{{ route('admin.customers.update', $customer->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">
                        <label for="contact" class="control-label" >Name</label>
                        <input type="text" id="contact" name="name" class="form-control" value="{{ $customer->name }}">
                        @if($errors->has('name'))
                                <label class="error">{{ $errors->first('name') }}</label>
                        @endif
                        <label for="contact" class="control-label" >Email</label>
                        <input type="text" id="contact" name="email" class="form-control" value="{{ $customer->email }}">
                        @if($errors->has('email'))
                            <label class="error">{{ $errors->first('email') }}</label>
                        @endif
                        <label for="contact" class="control-label" >Password</label>
                        <input type="text" id="contact" name="password" class="form-control" value="">
                        @if($errors->has('password'))
                            <label class="error">{{ $errors->first('password') }}</label>
                        @endif
                    </div>
                    <div class="form-group mt20">
                        <button type="submit" class="btn btn-danger">Save</button>
                    </div>
                </form>
            </div>
        </div>


    </div><!-- contentpanel -->

@endsection

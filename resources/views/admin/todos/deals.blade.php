
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
                    <li>Users</li>
                </ul>
                <h4>Users</h4>
            </div>
        </div><!-- media -->
    </div><!-- pageheader -->

    <div class="contentpanel">

        <div class="table-responsive">
            <table class="table table-bordered  table-striped mb30">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Country</th>
                        <th>City</th>
                        <th>website</th>
                        <th>type</th>
                        <th>amount</th>
                        <th>amount type</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($deals as  $deal)
                    <tr>
                        <td>{{ $deal->id }}</td>
                        <td>{{ $deal->name }}</td>
                        <td>{{ $deal->country }}</td>
                        <td>{{ $deal->city }}</td>
                        <td>{{ $deal->website }}</td>
                        <td>{{ $deal->type }}</td>
                        <td>{{ $deal->amount }}</td>
                        <td>{{ $deal->amount_type }}</td>
                        <td>
                            <form action="{{ route('admin.customers.deal.destroy', $deal->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        
    </div><!-- contentpanel -->

@endsection
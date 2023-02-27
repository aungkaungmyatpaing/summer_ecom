@extends('layouts.admin')

@section('title', 'Admin Color')

@section('content')

<div class="row">
        <div class="col-md-12">

        @if(session('message'))
            <div class="alert alert-success">{{ session('message')}}</div>
        @endif

            <div class="card">
                <div class="card-header">
                    <h3>
                        Colors List
                        <a href="{{url('admin/color/create')}}" class="btn btn-primary btn-sm float-end">Add Color</a>
                    </h3>
                </div>

                <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Color Name</th>
                                    <th>Color Code</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($colors as $color)
                                <tr>
                                    <td>{{ $color->id }}</td>
                                    <td>{{ $color->name }}</td>
                                    <td>{{ $color->code }}</td>
                                    <td>{{ $color->status ? 'Hidden':'Visible' }}</td>
                                    <td>
                                        <form action="{{url('admin/color/'.$color->id)}}" method="POST">
                                            @csrf 
                                            @method('DELETE')
                                            <div class="form-row">
                                                <a href="{{ url('admin/color/'.$color->id.'/edit') }}" class="btn btn-sm btn-success">Edit</a>
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this color?');">Remove</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
</div>

@endsection
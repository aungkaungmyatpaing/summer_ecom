@extends('layouts.admin')

@section('content')

<div class="row">
        <div class="col-md-12">

        @if(session('message'))
            <div class="alert alert-success">{{ session('message')}}</div>
        @endif

            <div class="card">
                <div class="card-header">
                    <h3>
                        Slider List
                        <a href="{{url('admin/slider/create')}}" class="btn btn-primary btn-sm float-end">Add Slider</a>
                    </h3>
                </div>

                <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>                                
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sliders as $slider)
                                <tr>
                                    <td>{{ $slider->id }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ substr($slider->description, 0, 50) . (strlen($slider->description) > 50 ? '...' : '') }}</td>
                                    <td>
                                        <img src="{{ asset("$slider->image ") }}" style="width: 70px;height:70px" alt="Slider">
                                    </td>
                                    <td>{{ $slider->status == '0' ? 'Visible':'Hidden' }}</td>
                                    <td>
                                        <form action="{{url('admin/slider/'.$slider->id)}}" method="POST">
                                            @csrf 
                                            @method('DELETE')
                                            <div class="form-row">
                                                <a href="{{ url('admin/slider/'.$slider->id.'/edit') }}" class="btn btn-success btn-sm">Edit</a>
                                                <button type="submit" class="btn  btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this slider?');">Delete</button>
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
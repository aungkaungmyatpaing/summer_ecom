@extends('layouts.admin')

@section('title', 'Admin Brand')

@section('content')

<div>

    <div class="row">
            <div class="col-md-12">

            @if(session('message'))
                <div class="alert alert-success">{{ session('message')}}</div>
            @endif

                <div class="card">
                    <div class="card-header">
                        <h4>
                            Brands List
                            <a href="{{url('admin/brand/create')}}" class="btn btn-primary btn-sm float-end">Add Brands</a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <table id="brands" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @forelse($brands as $brand)
                                    <tr>
                                        <td>{{$brand->id}}</td>
                                        <td>{{$brand->name}}</td>
                                        <td>
                                            @if($brand->category)
                                                {{$brand->category->name}}
                                            @else
                                                No Category
                                            @endif
                                        </td>
                                        <td>{{$brand->slug}}</td>
                                        <td>{{$brand->status == '1' ? 'Hidden' : 'Visible'}}</td>
                                        <td>
                                            <form action="{{url('admin/brand/'.$brand->id)}}" method="POST">
                                                @csrf 
                                                @method('DELETE')
                                                <div class="form-row">
                                                    <a href="{{url('admin/brand/'.$brand->id.'/edit')}}" class="btn btn-sm btn-success">Edit</a>
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this brand?');">Delete</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5">No Brands Found</td>
                                    </tr>
                                    @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
</div>

@endsection






@extends('layouts.admin')

@section('content')
<div class="row">
        <div class="col-md-12">

        @if(session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif    
            <div class="card">
                <div class="card-header">
                    <h3>
                        Edit Slider
                        <a href="{{url('admin/slider')}}" class="btn btn-secondary btn-sm text-white float-end">BACK</a>
                    </h3>
                </div>

                <div class="card-body">
                    <form action="{{ url('admin/slider/'.$slider->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3">
                                <label class="fw-normal fs-6">Title</label>
                                <input type="text" name="title" value="{{ $slider->title }}" class="form-control"/>
                            </div>
                            <div class="mb-3">
                                <label class="fw-normal fs-6">Description</label>
                                <textarea name="description" class="form-control" rows="3">{{ $slider->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="fw-normal fs-6">Image</label>
                                <input type="file" name="image" class="form-control"/>
                                <img src="{{ asset("$slider->image") }}" style="width: 50px;height: 50px" alt="Slider">
                            </div>
                            <div class="mb-3">
                                <label class="fw-normal fs-6">Status</label><br>
                                <input type="checkbox" name="status"  {{ $slider->status == '1' ? 'checked':'' }} style="width: 30px;height: 30px;"/><span class="fw-normal fs-6 text-muted"> Check will hidden </span>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>


@endsection
@extends('layouts.admin')

@section('title', 'Brand Create')

@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Add Brands
                    </h3>
                </div>

                <div class="card-body">
                    <form action="{{url('admin/brand')}}" method="POST">
                        @csrf 
                        <div class="row">
                            <div class="mb-3">
                                <label for="">Select Category</label>
                                <select name="category_id" required class="form-control">
                                    <option value="">--Select Category--</option>
                                    @foreach($categories as $cateItem)
                                    <option value="{{ $cateItem->id }}">{{ $cateItem->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <small class="text-danger">{{$message}}</small>  @enderror
                            </div>
                            <div class="mb-3">
                                <label class="fw-normal fs-6" for="">Brand Name</label>
                                <input type="text" name="name" class="form-control">
                                @error('name') <small class="text-danger">{{$message}}</small>  @enderror
                            </div>
                            <div class="mb-3">
                                <label class="fw-normal fs-6" for="">Slug</label>
                                <input type="text" name="slug" class="form-control">
                                @error('slug') <small class="text-danger">{{$message}}</small>  @enderror
                            </div>
                            <div class="mb-3">
                                <label class="fw-normal fs-6" for="">Status</label><br>
                                <input type="checkbox" name="status"> <span class="fw-normal fs-6 text-muted">Check will hidden</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <a href="{{url('admin/brand')}}" class="btn btn-secondary">BACK</a>
                            <button type="submit" data-backdrop="static" class="btn btn-primary" >Upload</button>
                        </div>
                    </form>
                                                                                    
                </div>
            </div>
        </div>
</div>

@endsection
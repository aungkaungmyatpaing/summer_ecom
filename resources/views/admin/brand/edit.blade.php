@extends('layouts.admin')

@section('title', 'Brand Edit')

@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Edit Brands
                    </h3>
                </div>

                <div class="card-body">
                    <form action="{{url('admin/brand/'.$brand->id)}}" method="POST">
                        @csrf 
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3">
                                <label for="">Select Category</label>
                                <select name="category_id" required class="form-control">
                                    @foreach($categories as $cateItem)
                                    <option value="{{ $cateItem->id }}" {{$cateItem->id == $brand->category_id ? 'selected':''}}>
                                        {{ $cateItem->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('category_id') <small class="text-danger">{{$message}}</small>  @enderror
                            </div>
                            <div class="mb-3">
                                <label class="fw-normal fs-6" for="">Brand Name</label>
                                <input type="text" name="name"  value="{{ $brand->name }}" class="form-control">
                                @error('name') <small class="text-danger">{{$message}}</small>  @enderror
                            </div>
                            <div class="mb-3"> 
                                <label class="fw-normal fs-6" for="">Slug</label>
                                <input type="text" name="slug" value="{{ $brand->slug }}" class="form-control">
                                @error('slug') <small class="text-danger">{{$message}}</small>  @enderror
                            </div>
                            <div class="mb-3">
                                <label class="fw-normal fs-6" for="">Status</label><br>
                                <input type="checkbox" name="status" {{ $brand->status == '1' ? 'checked' : ''}}> <span class="fw-normal fs-6 text-muted">Check will hidden</span>
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
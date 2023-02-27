@extends('layouts.admin')

@section('title', 'Color Create')

@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Create Colors
                        <a href="{{url('admin/color')}}" class="btn btn-secondary btn-sm text-white float-end">BACK</a>
                    </h3>
                </div>

                <div class="card-body">
                    <form action="{{ url('admin/color') }}" method="POST">
                        @csrf 
                        <div class="row">
                            <div class="mb-3">
                                <label class="fw-normal fs-6">Color Name</label>
                                <input type="text" name="name" class="form-control"/>
                            </div>
                            <div class="mb-3">
                                <label class="fw-normal fs-6">Color Code</label>
                                <input type="text" name="code" class="form-control"/>
                            </div>
                            <div class="mb-3">
                                <label class="fw-normal fs-6">Status</label><br>
                                <input type="checkbox" name="status" style="width: 30px;height: 30px;"/><span class="fw-normal fs-6 text-muted"> Check will hidden </span>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>


@endsection
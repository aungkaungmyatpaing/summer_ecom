@extends('layouts.app')

@section('title','Thank You for Shopping')

@section('content')

<div class="py-3 pyt-md-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
            @if(session('message'))
                <h5 class="alert">{{ session('message')}}</h5>
            @endif
                <div class="p-4 shadow bg-white">
                    <h2>
                        <span style="color: #f77a36;">Summer</span>
                        <span style="color: #3D4251;">Ecom</span>
                    </h2>
                    <h5>Thank You for Shopping with Summer Ecommerce</h4>
                    <a href="{{ url('/collections') }}" class="btn btn-default" style="background-color: #f77a36; color: white;">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
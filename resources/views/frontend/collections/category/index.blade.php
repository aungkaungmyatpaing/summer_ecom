@extends('layouts.app')

@section('title','All Categories')

@section('content')


<div class="py-3 py-md-5 ">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                    <h4 class="mb-4">Our Categories</h4>
            </div>
            @forelse($categories as $categoryItem)
            <div class="col-6 col-md-3">
                <div class="category-card" style="border-radius: 100%;">
                    <a href="{{ url('/collections/'.$categoryItem->slug) }}">
                        <div class="category-card-img" style="border-radius: 100%;" >
                            <img src="{{ asset("$categoryItem->image") }}" class="w-100" style="border-radius: 100%;" alt="{{ $categoryItem->name }}">
                        </div>
                        <div class="category-card-body">
                            <h5>{{ $categoryItem->name }}</h5>
                        </div>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-md-12">
                <h5>No Categories Available</h5>
            </div>
            @endforelse
        </div>
    </div>
</div>

@endsection

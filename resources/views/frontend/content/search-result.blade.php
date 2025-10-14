@extends('frontend.layout.master')

@section('content')
        <div class="row" style="margin: 150px 0 150px 0">

            @forelse($categories as $category )

            <div class="col-3 mb-3">
                <a href="{{ route('categoryDetails',$category->slug) }}">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $category->name ?? '' }}</h5>
                    </div>
                </div>
                </a>
            </div>
            @empty
                <span> No Result</span>
            @endforelse




        </div>

@endsection

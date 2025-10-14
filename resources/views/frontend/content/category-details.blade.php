@extends('frontend.layout.master')



@section('content')
    <div class="row" style="margin: 150px 0 150px 0">

            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $details->name ?? '' }}</h5>
                    </div>
                    <div class="card-body">
                        {!! $details->long_desc ?? '' !!}
                    </div>
                </div>
            </div>






    </div>

@endsection

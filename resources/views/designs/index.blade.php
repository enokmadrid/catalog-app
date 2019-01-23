@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="action-bar">
                    <a class="float-lg-right btn btn-success" href="{{ url('designs/create') }}">+ Create a design</a>
                </div>
                <h1>All the designs</h1>

                <!-- will be used to show any messages -->
                @if (Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif

                <div class="row">
                    @foreach($designs as $key => $design)
                    <div class="col-md-3">
                        {{--<div >--}}
                            <a class="card card-link" href="{{ URL::to('designs/' . $design->id) }}">

                                <img class="card-img-top" src="{{ Storage::disk('s3')->url($design->image) }}" alt="">

                                <div class="card-body">
                                    <h5 class="card-title">{{ $design->name }}</h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        Folder: {{ $design->number }} <span class="float-lg-right">${{ number_format($design->price, 2, ',', '.') }}</span>
                                    </li>
                                </ul>
                            </a>
                        {{--</div>--}}
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection

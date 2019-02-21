@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <h1 class="text-center">Showing {{ $design->name }}</h1>

                <div class="jumbotron text-center">
                    <h2>{{ $design->name }}</h2>
                    <p>
                        <strong>Number:</strong> {{ $design->number }}<br>
                        <strong>Price:</strong> {{ $design->price }}
                    </p>

                    <img src="{{ Storage::disk('s3')->url($design->image) }}" alt="image">

                    <ul>
                            @foreach($design->categories as $key => $categories)
                            <li>{{ $categories->title }}</li>
                            @endforeach
                    </ul>
                </div>

                <div class="action-bar">

                    <a href="{{ url('designs') }}" class="float-lg-left btn btn-small btn-info"><-- Back to designs</a>
                    <!-- Delete this design -->
                    {!! Form::open(['method' => 'DELETE','route' => ['designs.destroy', $design->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'float-lg-right btn btn-danger']) !!}
                    {!! Form::close() !!}

                    <!-- edit this design (uses the edit method found at GET /designs/{id}/edit -->
                    <a class="float-lg-right btn btn-small btn-success" href="{{ URL::to('designs/' . $design->id . '/edit') }}">Edit this design</a>

                </div>
            </div>
        </div>
    </div>
@endsection

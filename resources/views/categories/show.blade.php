@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center">{{ $category->title }}</h1>                
            </div>

            <div class="action-bar">

                    <a href="{{ url('designs') }}" class="float-lg-left btn btn-small btn-info"><-- Back to Categories</a>
                    <!-- Delete this design -->
                    {!! Form::open(['method' => 'DELETE','route' => ['categories.destroy', $category->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'float-lg-right btn btn-danger']) !!}
                    {!! Form::close() !!}

                    <!-- edit this design (uses the edit method found at GET /designs/{id}/edit -->
                    <a class="float-lg-right btn btn-small btn-success" href="{{ URL::to('categories/' . $category->id . '/edit') }}">Edit this category</a>

                </div>
        </div>
    </div>
@endsection

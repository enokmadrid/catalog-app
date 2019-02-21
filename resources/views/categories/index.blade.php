@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="action-bar">
                    <a class="float-lg-right btn btn-success" href="{{ url('categories/create') }}">+ Create a category</a>
                </div>
                <h1>All the categories</h1>

                <!-- will be used to show any messages -->
                @if (Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif

                <div class="row">
                        <ul>
                        @foreach($categories as $key => $category)
                            <li>
                                <a class="card card-link" href="{{ URL::to('categories/' . $category->id) }}">
                                    {{ $category->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection

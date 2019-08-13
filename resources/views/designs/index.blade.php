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
                        <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th> </th>
                                        <th>Thumbnail</th>
                                        <th>Design Name</th>
                                        <th>Folder #</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>Published</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($designs as $key => $design)

                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td><img src="{{ Storage::disk('s3')->url('images/thumbnail/'.$design->image) }}" alt="" height="64" width="64"></td>
                                            <td><a href="{{ URL::to('designs/' . $design->id) }}">{{ $design->name }}</a></td>
                                            <td>{{ $design->number }}</td>
                                            <td>${{ number_format($design->price, 2, '.', '.') }}</td>
                                            <td>
                                                    @if ($design->categories->count() > 0)
                                                    <ul>
                                                        @foreach($design->categories as $key => $category)
                                                        <li>{{ $category->title }}</li>
                                                        @endforeach
                                                    </ul>
                                                    @endif
                                            </td>
                                            <td>
                                              @if ($design->is_published)
                                              Yes
                                              @else
                                                No
                                              @endif

                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                        </table>
                </div>

                {{-- <div class="row">
                    @foreach($designs as $key => $design)
                    <div class="col-md-3">

                            <a class="card card-link" href="{{ URL::to('designs/' . $design->id) }}">

                                <img class="card-img-top" src="{{ Storage::disk('s3')->url('images/'.$design->image) }}" alt="">

                                <div class="card-body">
                                    <h5 class="card-title">{{ $design->name }}</h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        Folder: {{ $design->number }} <span class="float-lg-right">${{ number_format($design->price, 2, '.', '.') }}</span>
                                    </li>
                                </ul>
                            </a>

                    </div>
                    @endforeach
                </div> --}}

            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>All the categories</h1>

                <!-- will be used to show any messages -->
                @if (Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif

                <div class="row">
                        

                    <table class="col-md-8 table table-striped">
                        <thead>
                            <tr>
                                <th>ID#</th>
                                <th>Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $key => $category)
                            <tr>
                                <th>{{ $category->id }}</th>
                                <td>
                                    <a href="{{ URL::to('categories/' . $category->id) }}"> {{ $category->title }} </a>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                    <div class="col-md-4 card">
                        <div class="card-body bg-light">
                            <!-- if there are creation errors, they will show here -->
                            {{ Html::ul($errors->all()) }}

                            <form method="POST" action="/categories" accept-charset="UTF-8" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input name="title" type="text" id="title" class="form-control">
                                </div>
            
                                <button type="submit" class="btn btn-primary">Create the category!</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

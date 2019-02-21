@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

              <h1>Edit {{ $category->title }}</h1>
              <!-- if there are creation errors, they will show here -->
              {{ Html::ul($errors->all()) }}

                <form method="POST" action="/categories/{{ $category->id }}" accept-charset="UTF-8" enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input name="title" type="text" id="title" class="form-control" value="{{ $category->title }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes!</button>
                </form>


            </div>
        </div>
    </div>
@endsection

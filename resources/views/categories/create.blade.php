@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
@endsection
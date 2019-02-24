@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

              <h1>Edit {{ $design->name }}</h1>
              <!-- if there are creation errors, they will show here -->
              {{ Html::ul($errors->all()) }}

                <form method="POST" action="/designs/{{ $design->id }}" accept-charset="UTF-8" enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" id="name" class="form-control" value="{{ $design->name }}">
                    </div>

                    <div class="form-group">
                        <label for="number">Number</label>
                        <input name="number" type="text" id="number" class="form-control" value="{{ $design->number }}">
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input name="price" type="text" id="price" class="form-control" value="{{ $design->price }}">
                    </div>

                    {{-- <div class="form-group">
                        <label for="categories">Select Categories</label>
                        <select class="form-control" name="categories[]" multiple="multiple">
                            @foreach($categories as $key => $category)    
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file border" name="image" id="image" enctype="multipart/form-data">
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes!</button>
                </form>


            </div>
        </div>
    </div>
@endsection

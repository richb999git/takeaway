@extends('layouts.app')

@section('content')
@include('partials.admin.heading', [$heading = "Add Menu Item"])
<br>
@include('partials.admin.errors')
@include('partials.admin.errorMessage')

<div class="container">
    <form action="/addMenuItem" method="post" >
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input name="title" type="text" class="form-control" id="title" placeholder="Enter dish" value="{{ old('title') }}" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input name="price" type="number" step="0.01" class="form-control" id="price" placeholder="Enter price" value="{{ old('price') }}" required>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select name="category" class="form-control" id="category" >
                @foreach ($menuCategories as $menuCategory)
                    <option class="float-left" {{ $menuCategory->category == old('category') ? 'selected' : '' }} value="{{ $menuCategory->id }}">{{ $menuCategory->category }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description" rows="2" placeholder="Enter long description (optional)" >{{ old('description') }}</textarea>
        </div>

        <input name="addMeniItem" class="btn btn-outline-primary my-2 my-sm-0" type="submit" value="Add">

    </form>
</div>

@endsection('content')
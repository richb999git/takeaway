@extends('layouts.app')

@section('content')
@include('partials.admin.heading', [$heading = "Edit Menu Item"])
<br>
@include('partials.admin.errors')
@include('partials.admin.errorMessage')

<div class="container">
    <form action="{{ url('updateMenuItem', ['id' => $menuItem->id]) }}" method="post" >
        @csrf
        {{ method_field('PATCH') }}

        <div class="form-group">
            <label for="title">Title</label>
            <input name="title" type="text" class="form-control" id="title" placeholder="Enter dish" value="{{ $menuItem->title }}" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input name="price" type="number" class="form-control" id="price" placeholder="Enter price" value="{{ $menuItem->price }}" required>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select name="category" class="form-control" id="category" >
                @foreach ($menuCategories as $menuCategory)
                    <option {{ $menuCategory->id == $menuItem->menuCategoryId ? 'selected' : '' }} value={{$menuCategory->id}}>{{ $menuCategory->category }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description" rows="2" placeholder="Enter long description (optional)" >{{ $menuItem->description }}</textarea>
        </div>

        <input name="editMeniItem" class="btn btn-outline-primary my-2 my-sm-0" type="submit" value="Update">

    </form>
</div>

@endsection('content')
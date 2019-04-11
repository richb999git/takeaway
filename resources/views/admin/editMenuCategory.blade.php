@extends('layouts.app')

@section('content')
@include('partials.admin.heading', [$heading = "Edit Menu Category"])
<br>
@include('partials.admin.errors')
@include('partials.admin.errorMessage')

<div class="container">
    <form action="{{ route('menuCategories.update', ['id' => $menuCategory->id]) }}" method="post" >
        @csrf
        {{ method_field('PATCH') }}

        <div class="form-group">
            <label for="category">Category</label>
            <input name="category" type="text" class="form-control" id="title" placeholder="Enter category" value="{{ $menuCategory->category }}" required>
        </div>

        <input name="editCategory" class="btn btn-outline-primary my-2 my-sm-0" type="submit" value="Update">

    </form>
</div>

@endsection('content')
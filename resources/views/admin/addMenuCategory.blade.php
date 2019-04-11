@extends('layouts.app')

@section('content')
@include('partials.admin.heading', [$heading = "Add Menu Category"])
<br>
@include('partials.admin.errors')
@include('partials.admin.errorMessage')

<div class="container">
    <form action="{{ route('menuCategories.store') }}" method="post" >
        @csrf

        <div class="form-group">
            <label for="category">Category</label>
            <input name="category" type="text" class="form-control" id="title" placeholder="Enter category" value="{{ old('category') }}" required>
        </div>

        <input name="addCategory" class="btn btn-outline-primary my-2 my-sm-0" type="submit" value="Add">

    </form>
</div>

@endsection('content')
@extends('layouts.app')

@section('content')
@include('partials.admin.heading', [$heading = "Upload Menu"])
@include('partials.admin.errorMessage')
@include('partials.admin.errors')
<br>
<div class="container text-center">
    <br><br>
    <form method="post" enctype="multipart/form-data"  action="{{ route('uploadMenu') }}">
        @csrf
        <div class="form-group">
            <div class="input-group mb-3 container" id="menuCSVInput">
                <div class="input-group-prepend">
                    <button class="btn btn-primary" id="inputGroupFileAddon01">Upload</button>
                </div>
                <div class="custom-file">
                    <input accept=".csv" name="menuFile" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange='uploadFile(this)'>
                    <label id="fileName" class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
            </div>
    </form>

    <div>
        <br>
        <p>Upload file must be a csv file</p>
        <p>The column headings must include: title, price, menuCategoryId and optionally description</p>
        <p>The menu categories ids (menuCategoriesId) have to be integers based on the ids (not the actual descriptions)</p>
        <p>Price figures must be numerical, menuCategoryId must be an integer and equal to one of the categories like the downloads</p>
        <p>Note: if ANY part of line is different from the current menu it will be added. If it exactly the same it will be ignored</p>
    </div>

</div>



@endsection('content')

@section('scripts')
    <script src="{{ asset('js/uploadMenu.js')}}"></script> 
@endsection('scripts')
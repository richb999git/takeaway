@extends('layouts.app')

@section('content')
@include('partials.admin.heading', [$heading = "Menu Categories"])>
@include('partials.admin.errorMessage')
@include('partials.admin.errors')

<div class="form-inline justify-content-center">
    <a href="{{ route('menuCategories.create') }}" class="btn btn-outline-primary my-2 my-sm-0" >Add Category</a>
</div>

<br>
<div class="container">            
    <p class="list-group-item list-group-item-action active">Menu Categories</p>                                 
        <div class="list-group">
            @foreach ($menuCategories as $menuCategory) 
                <div class="list-group-item list-group-item-action">
                    <span class="align-middle">&nbsp;&nbsp; ID: {{ $menuCategory->id }} - {{ $menuCategory->category }}</span>
                    <div class="float-left" >
                        <form class="float-left mr-2" action="{{ route('menuCategories.destroy', ['id' => $menuCategory->id]) }}" method="post" >
                            @csrf
                            {{ method_field('DELETE') }}
                            <input name="delete" class="btn btn-primary" type="submit" value="Delete">
                        </form>
                        <a class="btn btn-primary" href="{{ route('menuCategories.edit', ['id' => $menuCategory->id]) }}" >Edit</a>
                    </div>
                </div>                                                       
            @endforeach                                     
        </div>  
        <br>                       
</div>


@endsection('content')
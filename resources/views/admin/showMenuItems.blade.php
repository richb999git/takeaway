@extends('layouts.app')

@section('content')
@include('partials.admin.heading', [$heading = "Menu"])

@include('partials.admin.errorMessage')
@include('partials.admin.errors')

<br>

<div class="form-inline justify-content-center">
    <a href="/enterMenuItem" class="btn btn-outline-primary my-2 my-sm-0" >Add menu item</a>
</div>

<br>
<div class="container">            
       
        @foreach ($menuCategories as $menuCategory)                         
            <div class="list-group">
                <p class="list-group-item list-group-item-action active">{{ $menuCategory->category }}</p>
                @foreach ($menu as $menuItem)
                    @if ($menuItem->menuCategoryId == $menuCategory->id)
                        <div class="list-group-item list-group-item-action">
                            <p>{{$menuItem->title}} £{{$menuItem->price}}</p>
                            <p>{{$menuItem->description}}</p>
                            <form class="float-left mr-2" action="{{ url('deleteMenuItem', ['id' => $menuItem->id]) }}" method="post" >
                                @csrf
                                {{ method_field('DELETE') }}
                                <input name="delete" class="btn btn-primary" type="submit" value="Delete">
                            </form>
                            <a class="btn btn-primary" href="{{ url('editMenuItem', ['id' => $menuItem->id]) }}" >Edit</a>
                        </div>                                   
                    @endif
                @endforeach                                    
            </div>  
            <br>                       
        @endforeach

</div>


@endsection('content')
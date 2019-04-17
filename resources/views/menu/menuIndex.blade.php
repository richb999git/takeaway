@extends('layouts.master')

@section('title')
    Bengal Tiger - Menu
@endsection('title')

@section('content')
    <div id="menu1" >
        <div>
            <h1 class="center-align teal-text" id="top">&nbsp;</h1>
            <h1 class="center-align teal-text" id="top">&nbsp;</h1>
        </div>
    </div>

    <div class="row">

        <div class="col s12 m2 l3 hide-on-med-and-down">
            <div class="collection">
            @foreach ($menuCategories as $menuCategory)
                <a href="#cat{{ $loop->iteration }}" class="collection-item">{{ $menuCategory->category }}</a>
            @endforeach
            </div>
        </div>

        
        <div class="col s12 m7 l6">
            
            <div class="collection">
                <ul class="collapsible">
                @foreach ($menuCategories as $menuCategory)               
                    <li class="active" id="cat{{ $loop->iteration}}">
                        <div class=" teal lighten-2 valign-wrapper" id="menuHeader">
                            &nbsp;&nbsp;&nbsp;
                            <i class="material-icons">local_dining</i>
                            <span><b>&nbsp;&nbsp;&nbsp;{{ $menuCategory->category }}</b></span>
                            <span id="upArrowRight"><a href="#top" >
                                <b><i class="material-icons white-text">arrow_upward</i>&nbsp;&nbsp;</b></a>
                            </span>
                        </div>
                        
                        @foreach ($menu as $menuItem)
                            @if ($menuItem->menuCategoryId == $menuCategory->id)
                            <div class="collapsible-body">
                                <span><b>{{$menuItem->title}}</b>
                                <span class="right"><a href="{{ route('addCartItem', ['id' => $menuItem->id]) }}" class="waves-effect waves-light btn">Add</a></span>
                                <span class="right">£{{$menuItem->price}}&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <br/>
                                <span>{{$menuItem->description}}</span>
                            </div>            
                            @endif
                        @endforeach      
                        
                    </li>
                @endforeach
                <ul>
            </div>
        </div>

        <div class="col s12 m5 l3">
            
            @include('partials.cart', ['orderURL' => 'placeOrder', 'btnText' => "Place Order..."])

        </div>

    </div>

@endsection('content')


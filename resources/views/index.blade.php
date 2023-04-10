@extends('layouts.master')

@section('title')
    Bengal Tiger - Home
@endsection('title')

@section('content')

    <div class="container-fluid">

        <div class="slider">
            <ul class="slides">
            <li>
                <img src="{{ asset('indian-cuisine-1.jpg')}}">
                <div class="caption center-align">
                    <div class="titlesBackground1">
                        <div class="card transparent">
                            <h3>Authentic dishes from Bengal Tiger</h3>
                            <h5 class="light grey-text text-lighten-3">Delivery within 5 miles</h5>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <img src="{{ asset('images/apapa.jpeg')}}">
                <div class="caption center-align">
                    <div class="titlesBackground">
                        <div class="card transparent">
                            <h4>Quality is key</h4>
                            <h5 class="light grey-text text-lighten-3">Fresh spices & herbs</h5>
                        </div>
                    </div>                   
                </div>
            </li>
            <li>
                <img src="{{ asset('images/overhead1.jpeg')}}">
                <div class="caption center-align">
                    <div class="titlesBackground">
                        <div class="card transparent">
                            <h4>Vibrant dishes</h4>
                            <h5 class="light grey-text text-lighten-3">Our Chef’s have an obsession for cooking</h5>
                        </div>
                    </div>                   
                </div>
            </li>
        </div>

        <div class="container center">             
            <h3 class="center">Indian Cuisine From the Heart Of MadeUp Town</h3>
            <p>Bengal Tiger Takeaway in the heart of Exeter, is the longest established Indian takeaway and noticeably the most sophisticated for the true excellence of our food.</p>
            <p>Our range of menus and the unique style of authentic dishes offer you the widest choice in fine Indian Cuisine in the region demonstrating our passion for food. All dishes are freshly prepared using only the finest ingredients, producing a superb combination of vibrant and mouth watering dishes. Our customers think its the Best Indian food in MadeUp Town.</p>
            <p>Bengal Tiger Takeaway offers you a great indian takeaway food service with an optional delivery service.</p>       
        </div>
        <div class="container center"> 
            <div class="row">
                <div class="col l4 m4 s12">
                    <img class="responsive-img" src="{{ asset('images/indian3.jpeg')}}" alt="">
                </div>

                <div class="col l4 m4 s12">
                    <img class="responsive-img" src="{{ asset('images/fire.jpeg')}}" alt="">
                </div>

                <div class="col l4 m4 s12">
                    <img class="responsive-img" src="{{ asset('images/starters.jpeg')}}" alt="">
                </div>
            </div>
        </div>
    </div>       

@endsection('content')
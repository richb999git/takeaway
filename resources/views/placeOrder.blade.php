@extends('layouts.master')

@section('content')


<div class="row">

    @if (session('errorMessage')) 
        <div class="row">
            <div class="col s12 l6 offset-l3">
            <div class="card-panel red">
                <span class="white-text">{{ session('errorMessage') }}</span>
            </div>
            </div>
        </div>
    @endif

    @if (session('message')) 

        @php $total = 0; @endphp
        <div class="row">
            <div class="col s12 l6 offset-l3">
                <div class="card blue-grey">
                    <div class="card-content white-text"> 
                        <span class="white-text">{{ session('message') }} {{ session('message2') }} </span>
                        <br><br>
                        <span class="card-title">You Ordered:</span>
                        @foreach ( session('cartOrdered') as $cartLine)       
                            @php $total += $cartLine['price']; @endphp                                           
                            <span>{{ ($cartLine['title']) }}</span>
                            <span> £{{ number_format($cartLine['price'], 2) }}</span>
                            <br> 
                        @endforeach
                
                        </div>
                        <div class="card-action white-text ">
                            <span class="">Total £{{ number_format($total, 2) }} &nbsp;&nbsp;&nbsp;&nbsp;</span>
                            
                        </div>
                </div>
            </div>
        </div> 
        <br>



    @else
        <div class="col s12 m12 l12">
            <div class="row">
                <form class="col s12 l6 offset-l3">
                @include('partials.cart', ['orderURL' => 'acceptOrder', 'btnText' => "Confirm Order"])
                </form>
            </div>  
        </div>
    @endif

    @if(Session::has('cart2') && session('cart2') != [])
    <div class="col s12 m12 l12">

        <div class="row">
            <form method="POST" action="/acceptOrder" class="col s12 l6 offset-l3">
            @csrf
                <h5>Please enter your details:</h5>

                
                @if ($errors->any())
                    <div class="card-panel red">
                    @foreach ($errors->all() as $error) 
                        <p class="white-text">{{ $error }}</p>     
                    @endforeach
                    </div>
                @endif

                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input name="first_name" id="first_name" type="text" class="validate" value="{{ old('first_name')}}" required>
                        <label for="first_name">First Name</label>
                    </div>
                    <div class="input-field col s6">                        
                        <input name="last_name" id="last_name" type="tel" class="validate" value="{{ old('last_name')}}" required>
                        <label for="last_name">Last Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">email</i>
                        <input name="email" id="email" type="email" class="validate" value="{{ old('email')}}">
                        <label for="email">Email</label>
                        <span class="helper-text" data-error="please enter a valid email" data-success=""></span>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">phone</i>
                        <input name="phone" id="icon_telephone" type="tel" class="validate" pattern="[0-9]{6,}" value="{{ old('phone')}}" required>
                        <label for="icon_telephone">Telephone</label>
                        <span class="helper-text" data-error="please enter a valid phone number (min 6 digits and no spaces)" data-success="">Format: Numerical</span>               
                    </div>
                </div>
                
                <div class="row">

                    <div class="input-field col s6">
                        <label>
                        @if (old('delivery') != "Y") {{-- default to collection --}}
                            <input id="collect" class="with-gap" name="delivery" type="radio" value="N" onchange="hideDelivery()" checked="true" />
                        @else
                            <input id="collect" class="with-gap" name="delivery" type="radio" value="N" onchange="hideDelivery()" />
                        @endif    
                            <span>Collection</span>
                        </label>
                    </div>    
                    <div class="input-field col s6">
                        <label>
                        @if (old('delivery') != "Y")
                            <input id="delivery" class="with-gap" name="delivery" type="radio" value="Y" onchange="showDelivery()"  />
                        @else
                            <input id="delivery" class="with-gap" name="delivery" type="radio" value="Y" onchange="showDelivery()" checked="true" />
                        @endif
                            <span>Delivery</span>
                        </label>
                    </div>
                </div>
                <br><br>

                <div id="deliveryDetails" >
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">local_shipping</i>
                            <input name="address_1" id="address_1" type="text" class="validate" value="{{ old('address_1')}}">
                            <label for="address_1">Address 1</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">local_shipping</i>
                            <input name="address_2" id="address_2" type="text" class="validate" value="{{ old('address_2')}}">
                            <label for="address_2">Address 2</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">local_shipping</i>
                            <input name="address_3" id="address_3" type="text" class="validate" value="{{ old('address_3')}}">
                            <label for="address_3">Address 3</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">local_shipping</i>
                            <input name="address_4" id="address_4" type="text" class="validate" value="{{ old('address_4')}}">
                            <label for="address_4">Address 4</label>
                        </div>
                    </div>
                </div>

                <button class="btn waves-effect waves-light" type="submit" name="action">Confirm Order
                    <i class="material-icons right">send</i>
                </button>

            </form>
        <div>
    </div>
    @endif
    

</div>

@section('scripts')
    <script src="{{ asset('js/orderScreen.js')}}"></script> 
@endsection('scripts')

@endsection('content')
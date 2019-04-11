@if(Session::has('cart2') && session('cart2') != [])
    @php $total = 0; @endphp
        <div id="cartDisplay" class="row">
            <div class="col s12 m12">
                <div class="card blue-grey">
                    <div class="card-content white-text">   
                        <span class="card-title">Your Order:</span><br>
    @foreach ( session('cart2') as $cartLine)
        
                @php $total += $cartLine['price']; @endphp
                                            
                        <span>
                            <a href="{{ route('deleteCartItem', ['id' => $loop->index]) }}" >
                                <sub><i class="material-icons teal-text text-lighten-2">delete_forever</i></sub>
                            </a>
                        </span>
                        <span>{{ ($cartLine['title']) }}</span>
                        <span> £{{ number_format($cartLine['price'], 2) }}</span>
                        <br> 
    @endforeach
                @php Session::put('cartTotal', $total);  @endphp
                    </div>
                    <div class="card-action white-text ">
                        <span class="">Total £{{ number_format($total, 2) }} &nbsp;&nbsp;&nbsp;&nbsp;</span>
                        @if($btnText != "Confirm Order")
                        <span><a href="{{ route($orderURL) }}" class="btn">{{ $btnText }}</a></span>
                        @endif
                    </div>
                </div>
            </div>
        </div> 
        <br>
@else
        <div class="row">
            <div class="col s12 m12">
                <div class="card blue-grey">
                    <div class="card-content white-text">   
                        <span class="card-title">Your Order:</span>
                        <p>Your basket is empty</p>
                    </div>
                </div>
            </div>
        </div> 
@endif
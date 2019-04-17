@component('mail::message')
# Takeaway Order

Hello {{ $order->first_name }}<br>

Thank you for your order. We will start preparing it now.

@if(Session::has('cart2') && session('cart2') != [])
@php $total = 0; @endphp                     
**Your Order ({{ $order->id }}):**
@foreach ( session('cart2') as $cartLine)       
    @php $total += $cartLine['price']; @endphp                                            
**&nbsp;&nbsp;{{ ($cartLine['title']) }} £{{ number_format($cartLine['price'], 2) }}** <br>                      
@endforeach
    @php Session::put('cartTotal', $total);  @endphp                                  
**Total £{{ number_format($total, 2) }}**
@endif

<br>
{{ $order->delivery == "N" ? "It will be ready to collect in 15 minutes." : "It should be delivered to you within one hour." }}
<br>

@if ($order->delivery == "Y")

To: {{ $order->first_name }} {{ $order->last_name }} <br>
{{ $order->address1 }} <br>
{{ $order->address2 }} <br>
{{ $order->address3 }} <br>
{{ $order->address4 }} <br>
@endif

@component('mail::button', ['url' => $url])
Bengal Tiger menu
@endcomponent

Thanks,<br>
Bengal Tiger
@endcomponent

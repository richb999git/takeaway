<b><span>{{ $order->first_name }} {{ $order->last_name }}</span></b>
<span class="float-right"> Order no. <b>{{ ($order->id) }}</b> rec'd: {{ ($order->receivedDateTime) }}</span><br>
<span class="float-right">Order status: {{ ($order->status) }}</span><br>
<span class="float-right">{{ $order->paid == "Y" ? "Paid for" : "Awaiting payment" }}</span><br>
@php $total = 0; @endphp
@if ($order->p_order !== "null")
    @foreach ( json_decode($order->p_order) as $orderLine)
        <span>{{ ($orderLine->title) }}</span>
        <span>£{{ number_format($orderLine->price, 2) }}</span><br>
        @php $total += $orderLine->price @endphp
    @endforeach
@endif
<span><b>Total £{{ number_format($total, 2) }}</b></span>

<br><br>
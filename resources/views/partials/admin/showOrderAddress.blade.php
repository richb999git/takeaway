<div class="col-lg-6 px-1">
    <div class="card {{ $loop->iteration  % 2 == 0 ? 'border-dark' : 'border-primary'}}">
    <div class="card-body {{ $loop->iteration  % 2 == 0 ? '' : 'text-primary'}}">
        <div class="table-responsive">
        <b><span>{{ $order->first_name }} {{ $order->last_name }}</span></b>
        <span class="float-right"> Order no. <b>{{ ($order->id) }}</b> to: {{ $order->delivery == "Y" ? "DELIVER" : "COLLECT" }}</span><br>
        <span>{{ ($order->address1) }}</span><br>
        <span>{{ ($order->address2) }}</span><br>
        <span>{{ ($order->address3) }}</span><br>
        <span>{{ ($order->address4) }}</span><br>
        <span>Phone: {{ ($order->phone) }}</span><br>
        <span>Email: {{ ($order->email) }}</span>
        </div>
    </div>
    </div>
</div>
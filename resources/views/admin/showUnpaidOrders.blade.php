@extends('layouts.app')

@section('content')
@include('partials.admin.heading', [$heading = "Unpaid Orders"])
@include('partials.admin.errorMessage')
@include('partials.admin.errors')
<br>
<div class="container">
  <form action="/showUnpaidOrders" method="post" class="form-inline justify-content-center">
      @csrf
      <input name="name" class="form-control mr-sm-2" type="search" placeholder="Find first of last name" aria-label="Search">
      <input class="btn btn-outline-primary my-2 my-sm-0" type="submit" value="Search">
  </form>
</div>

<br>
<div class="container-fluid">
@foreach ( $orders as $order)
  <div class="row" id="order{{ $order->id }}">

      <div class="col-lg-6 px-1">

        <div class="card {{ $loop->iteration  % 2 == 0 ? 'border-secondary' : 'border-primary'}}">
          <div class="card-body {{ $loop->iteration  % 2 == 0 ? '' : 'text-primary'}}">
            <div class="table-responsive">

              @include('partials.admin.showOrderDetails')
            
              <span class="dropright">
                <button class="btn {{ $loop->iteration  % 2 == 0 ? 'btn-secondary' : 'btn-primary'}} dropdown-toggle" type="button" id="OrderStatus-{{$order->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Order Status
                </button>
                <div class="dropdown-menu" aria-labelledby="OrderStatus-{{$order->id}}">
                  <a class="dropdown-item" href="{{ url('/changeOrderStatusToCollected', ['id' => $order->id]) }}">Collected</a>
                  <a class="dropdown-item" href="{{ route('changeOrderStatusToDelivered', ['id' => $order->id]) }}">Delivered</a>
                  <a class="dropdown-item" href="{{ route('changeOrderStatusToCancelled', ['id' => $order->id]) }}">Cancelled</a>
                </div>
              </span>
            

            <div class="float-right">
              <div class="dropleft">
                <button class="btn {{ $loop->iteration  % 2 == 0 ? 'btn-secondary' : 'btn-primary'}} dropdown-toggle" type="button" id="PaidStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Payment Status
                </button>
                <div class="dropdown-menu" aria-labelledby="PaidStatus">
                  <a class="dropdown-item" href="{{ route('changePaymentStatusToUnpaid', ['id' => $order->id]) }}">Awaiting payment</a>
                  <a class="dropdown-item" href="{{ route('changePaymentStatusToPaid', ['id' => $order->id]) }}">Payment received</a>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    @include('partials.admin.showOrderAddress')

  </div>

<br><br>

@endforeach
</div>

@endsection
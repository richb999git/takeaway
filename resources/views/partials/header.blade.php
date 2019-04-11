<div class="navbar-fixed">
    <nav class="teal">
        <div class="nav-wrapper teal container">
            <a href="/" class="brand-logo">Bengal</a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li>
                
                <a href="{{ route('placeOrder') }}">
                    <span class="left">Shopping Cart</span>
                    <span class="right">£{{ number_format(session('cartTotal'), 2) }}</span>
                    <i class="material-icons right ">shopping_cart</i>
                </a>
            </li>
            <li><a href="{{ route('menu') }}">Menu</a></li>
            <li><a href="#footer">Find Us</a></li>
            </ul>
        </div>

    </nav>
</div>


  <ul class="sidenav" id="mobile-demo">
    <li><a href="{{ route('placeOrder') }}">Cart</a></li>
    <li><a href="{{ route('menu') }}">Menu</a></li>
    <li><a href="{{ route('find_us') }}">Find Us</a></li>
  </ul>
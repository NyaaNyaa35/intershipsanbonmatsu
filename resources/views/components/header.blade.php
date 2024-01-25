<div class="header-navigation" style="">
    <div class="row">
        {{-- Company Logo Navigation --}}
        <div class="col-sm-12 col-md-2 col-lg-2 image-section">
            <a href="{{ url('/') }}" class="home-link">
                <img src={{ asset("images/logo.png") }} alt="" class="logo-navbar">
            </a>
        </div>
        {{-- Feature Link Navigation --}}
        <div class="col-sm-12 col-md-10 col-lg-10 feature-container">
            <a href="{{ url('https://www.nikko-monkeys.beer/') }}" class="icon-link p-t-16">
                About us
            </a>
            <a href="{{ url('/') }}" class="icon-link p-t-16">
                Beer
            </a>
            <a href="{{ url('#') }}" class="icon-link p-t-16">
                FAQs
            </a>
            <a href="{{ url('#') }}" class="icon-link p-t-16">
                Contact us
            </a>
            {{-- Search Bar Section --}}
            <div class="search-section p-t-12">
                <form id="searchForm" action="{{ url('/Product') }}" class="form-searchbar" method="get" autocomplete="off" accept-charset="UTF-8">
                    @csrf
                    <span class="search-icon" onclick="openModal()"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input class="searchbar-navbar input-no-border" type="search" id="search-input" placeholder='Search' name="keyword" value="">
                    <button type="submit" style="display: none;"></button>
                </form>
            </div>
            <a href="{{ url('#') }}" class="icon-link p-t-16">
                <i class="fa-solid fa-user"></i>
                Sign in
            </a>
            <div class="cart-container p-t-16 icon-link">
                <a href="{{ url('/cart') }}" class="">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="cart-count">{{ $cartCounter }}</span>
                    Cart
                </a>
            </div>
        </div>
    </div>
</div>

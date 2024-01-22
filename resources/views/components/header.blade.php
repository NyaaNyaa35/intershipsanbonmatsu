<div class="header-navigation" style="">
    <div class="row">
        {{-- Company Logo Navigation --}}
        <div class="col-sm-12 col-md-2 image-section">
            <a href="{{ url('/') }}" class="home-link">
                <img src={{ asset("images/logo.png") }} alt="" class="logo-navbar">
            </a>
        </div>
        {{-- Feature Link Navigation --}}
        <div class="col-sm-12 col-md-10 feature-container">
            <a href="{{ url('#') }}" class="icon-link p-t-16">
                About us
            </a>
            <a href="{{ url('#') }}" class="icon-link p-t-16">
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
                    <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input class="searchbar-navbar" type="search" id="search-input" placeholder='Search' name="searchbar" value="">
                    <button type="submit" style="display: none;"></button>
                </form>
            </div>
            <a href="{{ url('#') }}" class="icon-link p-t-16">
                <i class="fa-solid fa-user"></i>
                Sign in
            </a>
            <a href="{{ url('#') }}" class="icon-link p-t-16">
                <i class="fa-solid fa-cart-shopping"></i>
                Cart
            </a>
        </div>
    </div>
</div>

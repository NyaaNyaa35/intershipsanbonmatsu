<!DOCTYPE html>
<html>
    {{-- Library Import Section --}}
    @include('components.library')
<body>
    {{-- Header Section --}}
<section class="header">
    @include('components.header')
    @include('components.modal.searchModal')
</section>
{{-- End of Header Section --}}

{{-- Main Page Section --}}
<section id="main-section">
    <div class="container m-t-20">
        <span class="navigation-text">Nikko Brewing > <a href="{{ url("/") }}" class=""><b class="">Beer</b></a></span>
        <div class="product-container">
            <div class="row">
                @for ($i = 0 ; $i < count($product) ; $i++)
                    <a href="{{ url($product[$i]->category, $product[$i]->product_name) }}" class="col-md-3">
                        <div class="product-spacer" id="image{{$product[$i]->id}}">
                            <div class="product-box">
                                <div class="product-image-container">
                                    <img class="product-image" src="{{url("images/products/". md5(md5($product[$i]->id)) ."/". md5(md5($product[$i]->id)) . ".png")}}">
                                </div>
                                <div class="product-info-container">
                                    <div class="product-name"><b>{{ $product[$i]->category }}</b><br><b>{{ $product[$i]->product_name }}</b></div>
                                    <div class="product-price-container">
                                        <div class="product-price"> ¥{{ $product[$i]->price }} </div>
                                        <div class="product-size"> (税込)/{{ $product[$i]->size }}ml </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endfor
            </div>
        </div>
    </div>
</section>
{{-- End of Main Page Section --}}

{{-- Footer Section --}}
<section id="footer">
    {{-- @include('components.footer') --}}
</section>
{{-- End of Footer Section --}}
</body>
</html>

<!DOCTYPE html>
<html>
    {{-- Library Import Section --}}
    @include('components.library')
<body>
    {{-- Header Section --}}
<section class="header">
    @include('components.header')
    @include('components.modal.buyNowModal')
</section>
{{-- End of Header Section --}}

{{-- Main Page Section --}}
<section id="main-section">
    <div class="container m-t-20">
        <span class="navigation-text">Nikko Brewing >
            <a href="{{ url("/") }}" class="">Beer</a> >
            <a href="{{ url("Product/search?=". $product->category) }}" class="">{{ $product->category }}</a> >
            <a href="{{ url($product->category."/". $product->product_name) }}" class=""><b class="">{{ $product->product_name }}</b></a>
        </span>
        <div class="row product-container m-t-20">
            {{-- Main Product Pic --}}
            <div class="col-md-4 col-12 main-pic border-yellow">
                <img src="{{url("images/products/". md5(md5($product->id)) ."/". md5(md5($product->id)) . ".png")}}" alt="" class="">
            </div>
            <div class="col-md-2 col-12">
                {{-- Product Side Pic --}}
                <div class="side-pic-container">
                    <div class="side-pic border-yellow">
                        <img src="{{url("images/white-box.png")}}" alt="" class="side-pic-image">
                    </div>
                    <div class="side-pic border-yellow">
                        <img src="{{url("images/white-box.png")}}" alt="" class="side-pic-image">
                    </div>
                    <div class="side-pic border-yellow">
                        <img src="{{url("images/white-box.png")}}" alt="" class="side-pic-image">
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                {{-- Product Information & Cart Action --}}
                <div class="information-container" id="productName" data-product-name="{{ $product->product_name }}">
                    <h3 class="fs-30">
                        <b class="">
                            {{ $product->category }} <br>
                            {{ $product->product_name }}
                        </b>
                    </h3>
                    <p class="m-t-13 m-b-13 fs-16">
                        <b class="">
                            {!! $product->description !!}
                        </b>
                    </p>
                    <p class="m-t-5 m-b-1 fs-12 text-gray">
                        {!! $product->ingredients !!}
                    </p>
                    <p class="m-t-1 m-b-1 flex-m">
                        <b class="fs-30">
                            ¥{{ number_format($product->price) }}
                        </b>
                        <span class="m-l-5 fs-16">
                            (税込)/{{ $product->size }}ml
                        </span>
                    </p>
                    <div class="m-t-5 m-b-5 quantity-container">
                        <div class="p-t-3 fs-12 m-r-15 text-gray">
                            Quantity
                        </div>
                        <div class="stock-container">
                            <div class="quantity-container">
                                <button class="fs-16 m-r-20 box-cream bgwhite2" onclick="decreaseQuantity()" >
                                    -
                                </button>
                                <span id="displayQuantity" class="fs-16">
                                    0
                                </span>
                                <button class="fs-16 m-l-20 box-cream bgwhite2" onclick="increaseQuantity()" >
                                    +
                                </button>
                            </div>
                            <div class="text-red fs-12 m-t-5" id="productStockDisplay" data-product-stock="{{ $product->stock }}">
                                Stock <span id="displayStock">{{ $product->stock }}</span>
                            </div>
                        </div>
                    </div>
                    <form id="buyNowForm" action="{{ url('/cart/add') }}" method="post" class="m-t-5 m-b-5 button-container">
                        @csrf
                        <input type="hidden" name="productName" value="{{ $product->product_name }}">
                        <input id="quantity" type="hidden" name="quantity" value="0" min="1">

                        <button id="buyNowButton"
                            class="red-button fs-13 m-r-20"
                            type="button"
                            onclick="openBuyNowModal()">
                            Buy Now
                        </button>
                        <button id="addCartButton"
                            class="green-button fs-13 m-r-20">
                            Add to Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
        {{-- Related Product --}}
        <div class="related-container">
            <div class="text-center m-t-50 m-b-20 fs-24">
                <b class="">Related Products</b>
            </div>
            <div class="row">
                @for ($i = 0 ; $i < count($related_product) ; $i++)
                <a href="{{ url("Beer/".$related_product[$i]->category."/". $related_product[$i]->product_name) }}" class="col-md-3">
                    <div class="product-spacer" id="image{{$related_product[$i]->id}}">
                        <div class="product-box">
                            <div class="product-image-container">
                                <img class="product-image" src="{{url("images/products/". md5(md5($related_product[$i]->id)) ."/". md5(md5($related_product[$i]->id)) . ".png")}}">
                            </div>
                            <div class="product-info-container">
                                <div class="product-name"><b>{{ $related_product[$i]->category }}</b><br><b>{{ $related_product[$i]->product_name }}</b></div>
                                <div class="product-price-container">
                                    <div class="product-price"> ¥{{ number_format($related_product[$i]->price) }} </div>
                                    <div class="product-size"> (税込)/{{ $related_product[$i]->size }}ml </div>
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
<script>
    document.getElementById('buyNowButton').addEventListener('click', function() {
        openBuyNowModal();
    });
    function openBuyNowModal() {
        document.getElementById('buyNowModal').style.display = 'block';
    }
    function closeBuyNowModal(){
        document.getElementById('buyNowModal').style.display = 'none';
    }
    function submitBuyNowForm() {
        document.getElementById('buyNowForm').submit();
    }

    var $product = @json($product);

    function decreaseQuantity(){
        if($product.quantity > 0){
            $product.quantity--;
            let displayElement = document.getElementById('displayQuantity');
            displayElement.innerHTML = parseInt(displayElement.innerHTML) - 1;
            let displayStockElement = document.getElementById('displayStock');
            displayStockElement.innerHTML = parseInt(displayStockElement.innerHTML) + 1;
            document.getElementById('quantity').value = $product.quantity;
            checkButtonStatus();
        }
    }
    function increaseQuantity(){
        if($product.quantity < $product.stock){
            $product.quantity++;
            let displayElement = document.getElementById('displayQuantity');
            displayElement.innerHTML = parseInt(displayElement.innerHTML) + 1;
            let displayStockElement = document.getElementById('displayStock');
            displayStockElement.innerHTML = parseInt(displayStockElement.innerHTML) - 1;
            document.getElementById('quantity').value = $product.quantity;
            checkButtonStatus();
        }
    }
    checkButtonStatus();
    function checkButtonStatus() {
        var isQuantityZero = parseInt(document.getElementById('quantity').value) === 0;

        document.getElementById('buyNowButton').disabled = isQuantityZero;
        document.getElementById('addCartButton').disabled = isQuantityZero;
    }
    if (performance.navigation.type == 2) {
            location.reload(true);
    }
</script>
{{-- Footer Section --}}
<section id="footer">
    @include('components.footer')
</section>
{{-- End of Footer Section --}}
</body>
</html>

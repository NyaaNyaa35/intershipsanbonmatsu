<!DOCTYPE html>
<html>
    {{-- Library Import Section --}}
    @include('components.library')
<body>
    {{-- Header Section --}}
<section class="header">
    @include('components.header')
    @include('components.modal.searchModal')
    @include('components.modal.buyNowModal')
</section>
{{-- End of Header Section --}}

{{-- Main Page Section --}}
<section id="main-section">
    <div class="container m-t-20">
        <div id="toast"></div>
        <span class="navigation-text">Nikko Brewing >
            <a href="{{ url("/") }}" class="">Beer</a> >
            {{ $product->category }} >
            <a href="{{ url("Beer/". $product->category."/". $product->product_name) }}" class=""><b class="">{{ $product->product_name }}</b></a>
        </span>
        <div class="row product-container m-t-20">
            {{-- Main Product Pic --}}
            <div class="col-md-4 col-12 main-pic border-yellow">
                <img src="{{url("images/products/". md5(md5($product->id)) ."/". md5(md5($product->id)) . ".png")}}" alt="" class="">
            </div>
            <div class="col-md-2 col-12 side-pic-container">
                {{-- Product Side Pic --}}
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
                            class="green-button fs-13 m-r-20"
                            onclick="addToCart('{{ $product->product_name }}', event)">
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
    function openBuyNowModal() {
        document.getElementById('buyNowModal').style.display = 'block';
    }
    function closeBuyNowModal(){
        document.getElementById('buyNowModal').style.display = 'none';
    }

    $('#search-input').keypress(function(e) {
        if (e.which === 13) {
            e.preventDefault();
            $('#searchForm').submit();
        }
    });

    function openModal() {
        document.getElementById('myModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('myModal').style.display = 'none';
    }

    window.onclick = function(event) {
        var modal = document.getElementById('myModal');
        if (event.target == modal) {
            closeModal();
        }
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

    var blurred = false;
    window.onblur = function() { blurred = true; };
    window.onfocus = function() { blurred && (location.reload()); };

    function toast(content){
        $("#toast").append('<div class="alert alert-success" style="border-radius:1em;background:green;color:white;">'+content+'</div>');
        setTimeout(function(){
            $("#toast div").fadeOut();
        },3000);
    }

    function loadingShow(){
        $("body").append("<div id='loading-div' style='position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.8);color:white;z-index:10000' align='center'><br><br><br><h1>Processing...</h1></div>");
    }

    function loadingHide(){
        $("#loading-div").remove();
    }

    function submitBuyNowForm() {
        document.getElementById('buyNowModal').style.display = 'none';
        loadingShow();

        var quantityElement = document.getElementById('displayQuantity');
        var quantity = quantityElement ? parseInt(quantityElement.innerText) : 1;
        var data = {
            productName: '{{ $product->product_name }}',
            quantity: quantity
        };

        fetch('{{ url("/cart/add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            loadingHide();
            if (data.status === 1) {
                toast(data.message);
                window.location.href = '{{ url("/cart") }}';
            }
        })
        .catch(error => {
            loadingHide();
            console.error('Error:', error);
            toast("Failed to add product to cart");
        });
    }

    function addToCart(productName, event) {
        event.preventDefault();
        loadingShow();

        var quantityElement = document.getElementById('displayQuantity');
        var quantity = quantityElement ? parseInt(quantityElement.innerText) : 1;
        var data = {
            productName: productName,
            quantity: quantity
        };

        fetch('{{ url("/cart/add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            loadingHide();
            if (data.status === 1) {
                toast(data.message);
                location.reload();
            }
        })
        .catch(error => {
            loadingHide();
            console.error('Error:', error);
            toast("Failed to add product to cart");
        });
    }
</script>
{{-- Footer Section --}}
<section id="footer">
    @include('components.footer')
</section>
{{-- End of Footer Section --}}
</body>
</html>

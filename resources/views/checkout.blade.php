<!DOCTYPE html>
<html>
    {{-- Library Import Section --}}
    @include('components.library')
<body>
    {{-- Header Section --}}
<section class="header">
    @include('components.header-transaction')
</section>
{{-- End of Header Section --}}

{{-- Main Page Section --}}
<section id="main-section">
    <div class="container m-t-20 m-b-40">
        @if (empty($cart))
            <div class="empty-message">
                <div class="fs-40 font-bold text-center">There's No Item to Checkout</div>
                <div class="flex-c-m m-t-10">
                    <a href="{{ url("/") }}" class=""><i class="fa-solid fa-arrow-left m-r-10 fs-12" style="align-items:center"></i><span style="text-decoration: underline;">Continue Shopping</span></a>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-8 bgwhite2 p-all-25">
                    <h1>Checkout</h1>
                    @for ($i = 0 ; $i < count($cart) ; $i++)
                        <hr class="m-t-20">
                        <div class="flex-row">
                            <div class="flex-row m-l-10" style="align-items:center;">
                                <div class="white-box">
                                    <img
                                        src="{{ url("images/products/". md5(md5($cart[$i]['id'])) ."/". md5(md5($cart[$i]['id'])) . ".png") }}" alt="" class="">
                                </div>
                            </div>
                            <div class="flex-col m-l-25 w-full">
                                <div class="top-section font-bold">
                                    {{ $cart[$i]['category'] }} <br>
                                    {{ $cart[$i]['product_name'] }}
                                </div>
                                <div class="mid-section m-t-10">
                                    {{ $cart[$i]['size'] }}ml
                                </div>
                                <div class="m-t-5 m-b-5 quantity-container">
                                    <div class="p-t-3 fs-12 m-r-15 text-gray">
                                        Quantity
                                    </div>
                                    <div class="p-t-3 fs-12 m-r-15 text-gray">
                                        x {{ $cart[$i]['quantity'] }}
                                    </div>
                                </div>
                            </div>
                            <div class="flex-row w-full" style="align-items: center;">
                                <div class="flex-col price-tag">
                                    <span class="fs-24 font-bold" data-price="{{ $cart[$i]['price'] * $cart[$i]['quantity'] }}">¥{{ number_format($cart[$i]['price'] * $cart[$i]['quantity']) }}</span>
                                    (税込)
                                </div>
                                <div class="flex-col trash-can" style="justify-content : flex-end;" onclick="deleteCart({{ $cart[$i]['id'] }})">
                                    <form id="deleteCartForm{{ $cart[$i]['id'] }}" action="{{ url('/cart/checkout/delete/' . $cart[$i]['product_name'] ) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <img src="{{ url('images/trash-can.png') }}" alt="" class="">
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
                <div class="col-md-4 p-all-30">
                    <h1>Total</h1>
                    <hr>
                    <form id="formCheckout" action="{{ url('/cart/checkout/add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="productCheckout" value="" id="productCheckout">
                        <input id="total" type="hidden" name="total" value="0" min="0">
                        <div class="row font-bold">
                            <div class="col-md-6">
                                Subtotal
                            </div>
                            <div id="subtotalPrice" class="col-md-6">
                                {{ number_format(0) }}
                            </div>
                        </div>
                        <div class="row font-bold">
                            <div class="col-md-6">
                                Shipping
                            </div>
                            <div id="shippingPrice" class="col-md-6">
                                {{ number_format(0) }}
                            </div>
                        </div>
                        <hr>
                        <div class="row m-t-15 font-bold">
                            <div class="col-md-6">
                                Total
                            </div>
                            <div id="totalPrice" class="col-md-6">
                                {{ number_format(0) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                Discount Code
                            </div>
                            <div class="col-md-6 flex-row flex-m">
                                <i class="fa-solid fa-arrow-right"></i><input class="input-no-border" type="text" id="discount-code" placeholder='' name="discount_code" maxlength="10" value="" style="text-transform:uppercase">
                            </div>
                        </div>
                        <hr style="height:2px;">
                        <div class="flex-c-m m-t-10 p-all-20">
                            <button id="checkoutButton" type="submit" class="button-checkout bgwhite" onclick="preparePaymentData()">
                                PAYMENT
                            </button>
                        </div>
                        <div class="flex-c-m m-t-10">
                            <a href="{{ url("/cart") }}" class=""><i class="fa-solid fa-arrow-left m-r-10 fs-12" style="align-items:center"></i><span style="text-decoration: underline;">Back to cart</span></a>
                        </div>
                        <div class="flex-c-m m-t-10">
                            <a href="{{ url("/") }}" class=""><i class="fa-solid fa-arrow-left m-r-10 fs-12" style="align-items:center"></i><span style="text-decoration: underline;">Continue Shopping</span></a>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    <button id="goToTopBtn" class="bgwhite2" onclick="goToTop()"><i class="fa-solid fa-chevron-up"></i></button>
    </div>
</section>
{{-- End of Main Page Section --}}
<script>
    var $cart = @json($cart);

    function number_format(value) {
        return new Intl.NumberFormat('ja-JP', { style: 'currency', currency: 'JPY' }).format(value);
    }
    function calculateSubtotal() {
        var subtotal = 0;

        for (var i = 0; i < $cart.length; i++) {
            subtotal += $cart[i]['price'] * $cart[i]['quantity'];
        }

        return subtotal;
    }

    function updateTotal() {
        var subtotal = calculateSubtotal();
        var shipping = 0;
        var discount = 0;

        var total = subtotal + shipping - discount;

        document.getElementById('subtotalPrice').innerText = number_format(subtotal);
        document.getElementById('shippingPrice').innerText = number_format(shipping);
        document.getElementById('totalPrice').innerText = number_format(total);

        document.getElementById('total').value = total;
    }

    function number_format(value) {
        return new Intl.NumberFormat('ja-JP', { style: 'currency', currency: 'JPY' }).format(value);
    }

    updateTotal();

    function deleteCart(idForm){
        var selectedForm = document.getElementById('deleteCartForm'+idForm);
        selectedForm.submit();
    }

    if (performance.navigation.type == 2) {
            location.reload(true);
    }

    function preparePaymentData() {
        var products = @json($cart);
        var total = document.getElementById('total').value;

        var discount_code = document.getElementById('discount-code').value;
        var shippingCost = 0;

        var paymentData = {
            products: products,
            total: total,
            shippingCost: shippingCost,
            discount_code: discount_code,
        };

        document.getElementById('productCheckout').value = JSON.stringify(paymentData);

        var checkoutForm = document.getElementById("formCheckout");
        checkoutForm.submit();
    }

    var blurred = false;
    window.onblur = function() { blurred = true; };
    window.onfocus = function() { blurred && (location.href = "{{ url('/cart') }}"); };

    function toast(content){
        $("#toast").append('<div class="alert alert-success" style="border-radius:1em;background:rgba(0,0,0,0.5)">'+content+'</div>');
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

    document.addEventListener('DOMContentLoaded', function() {
        var goToTopBtn = document.getElementById('goToTopBtn');

        window.onscroll = function() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                goToTopBtn.style.display = 'block';
            } else {
                goToTopBtn.style.display = 'none';
            }
        };
    });

    function goToTop() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

</script>
{{-- Footer Section --}}
<section id="footer">
    @include('components.footer')
</section>
{{-- End of Footer Section --}}
</body>
</html>

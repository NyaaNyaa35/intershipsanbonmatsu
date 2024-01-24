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
        @if ($cart->isEmpty())
            <div class="empty-message">
                <div class="fs-40 font-bold text-center">Your cart is empty<br>try adding items to your cart</div>
                <div class="flex-c-m m-t-10">
                    <a href="{{ url("/") }}" class=""><i class="fa-solid fa-arrow-left m-r-10 fs-12" style="align-items:center"></i><span style="text-decoration: underline;">Continue Shopping</span></a>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-8 bgwhite2 p-all-25">
                    <h1>Shopping Cart</h1>
                    @for ($i = 0 ; $i < count($cart) ; $i++)
                        <hr class="m-t-20">
                        <div class="flex-row">
                            <div class="flex-row m-l-10" style="align-items:center;">
                                <input type="checkbox" id="option-{{ $i }}" name="options[]" value="option-{{ $i }}">
                                <div class="m-l-25 white-box">
                                    <img
                                        src="{{ url("images/products/". md5(md5($cart[$i]->id)) ."/". md5(md5($cart[$i]->id)) . ".png") }}" alt="" class="">
                                </div>
                            </div>
                            <div class="flex-col m-l-25">
                                <div class="top-section font-bold">
                                    {{ $cart[$i]->category }} <br>
                                    {{ $cart[$i]->product_name }}
                                </div>
                                <div class="mid-section m-t-10">
                                    {{ $cart[$i]->size }}ml
                                </div>
                                <div class="m-t-5 m-b-5 quantity-container">
                                    <div class="p-t-3 fs-12 m-r-15 text-gray">
                                        Quantity
                                    </div>
                                    <div class="quantity-container bg-white p-all-3 p-r-3">
                                        <button onclick="decreaseCartQuantity({{ $i }})" class="fs-10 m-r-20 box-cream bgwhite2 box-shadow-2">
                                            -
                                        </button>
                                        <span id="displayCartQuantity{{ $i }}" data-cart-quantity="{{ $cart[$i]->quantity }}" class="fs-12">
                                            {{ $cart[$i]->quantity }}
                                        </span>
                                        <button onclick="increaseCartQuantity({{ $i }})" class="fs-10 m-l-20 m-r-3 box-cream bgwhite2 box-shadow-1">
                                            +
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-row w-full" style="align-items: center;">
                                <div class="flex-col price-tag">
                                    <span class="fs-24 font-bold" data-price="{{ $cart[$i]->price }}">¥{{ number_format($cart[$i]->price) }}</span>
                                    (税込)
                                </div>
                                <div class="flex-col trash-can" style="justify-content : flex-end;" onclick="deleteCart({{ $cart[$i]->id }})">
                                    <form id="deleteCartForm{{ $cart[$i]->id }}" action="{{ url('/cart/delete/' . $cart[$i]->product_name ) }}" method="POST">
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
                    <form action="{{ url('/cart/checkout') }}" method="POST" onsubmit="prepareCheckoutData()">
                        @csrf
                        <input type="hidden" name="selectedProduct" value="">
                        <input id="total" type="hidden" name="total" value="0" min="0">
                        <div class="row font-bold">
                            <div class="col-md-6">
                                Total
                            </div>
                            <div id="totalPrice" class="col-md-6">
                                ¥ {{ number_format(0) }}
                            </div>
                        </div>
                        <div class="row m-t-15">
                            <div class="col-md-6">
                                Discount Code
                            </div>
                            <div class="col-md-6 flex-row flex-m">
                                <i class="fa-solid fa-arrow-right"></i><input class="input-no-border" type="search" id="discount-code" placeholder='' name="discount" maxlength="10" value="" style="text-transform:uppercase">
                            </div>
                        </div>
                        <hr style="height:2px;">
                        <div class="flex-c-m m-t-10 p-all-20">
                            <button id="checkoutButton" type="submit" class="button-checkout bgwhite">
                                CHECKOUT NOW
                            </button>
                        </div>
                        <div class="flex-c-m m-t-10">
                            <a href="{{ url("/") }}" class=""><i class="fa-solid fa-arrow-left m-r-10 fs-12" style="align-items:center"></i><span style="text-decoration: underline;">Continue Shopping</span></a>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
    <button id="goToTopBtn" class="bgwhite2" onclick="goToTop()"><i class="fa-solid fa-chevron-up"></i></button>
</section>
{{-- End of Main Page Section --}}
<script>
    var $cart = @json($cart);
    var selectedProducts = [];

    function decreaseCartQuantity(index) {
        if($cart[index].quantity > 1){
            $cart[index].quantity--;
            let displayElement = document.getElementById('displayCartQuantity' + index);
            displayElement.innerHTML = parseInt(displayElement.innerHTML) - 1;
            console.log($cart[index].quantity)
            updateSelectedProductQuantity(index)
            updateTotal();
        }
    }

    function increaseCartQuantity(index) {
        if($cart[index].quantity < $cart[index].stock){
            $cart[index].quantity++;
            console.log($cart[index].quantity)
            let displayElement = document.getElementById('displayCartQuantity' + index);
            displayElement.innerHTML = parseInt(displayElement.innerHTML) + 1;
            updateSelectedProductQuantity(index)
            updateTotal();
        }
    }
    function updateSelectedProductQuantity(index) {
        var selectedProductIndex = selectedProducts.findIndex(item => item.id === $cart[index].id);

        if (selectedProductIndex !== -1) {
            selectedProducts[selectedProductIndex].quantity = $cart[index].quantity;
            updateHiddenInput();
        }
    }

    function number_format(value) {
        return new Intl.NumberFormat('ja-JP', { style: 'currency', currency: 'JPY' }).format(value);
    }
    function updateTotal() {
        var total = 0;

        selectedProducts.forEach(function (product) {
            if (product && product.price && product.quantity) {
                total += product.price * product.quantity;
            }
        });

        document.getElementById('totalPrice').innerText = number_format(total);
        checkButtonStatus();
    }
    document.addEventListener('DOMContentLoaded', function () {
        var checkboxes = document.querySelectorAll('input[name="options[]"]');
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                var index = parseInt(checkbox.value.replace('option-', ''));
                if (checkbox.checked) {
                    selectedProducts.push($cart[index]);
                } else {
                    selectedProducts = selectedProducts.filter(item => item !== $cart[index]);
                }
                updateTotal();
                checkButtonStatus();
                updateHiddenInput();
            });
        });
    });

    function updateHiddenInput() {
        document.getElementsByName('selectedProduct')[0].value = JSON.stringify(selectedProducts);
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

    function deleteCart(idForm){
        var selectedForm = document.getElementById('deleteCartForm'+idForm);
        selectedForm.submit();
    }

    checkButtonStatus();

    function checkButtonStatus() {
        var isNoCheckboxChecked = document.querySelectorAll('input[name="options[]"]:checked').length === 0;

        var checkoutButton = document.getElementById('checkoutButton');
        checkoutButton.disabled = isNoCheckboxChecked;
    }

    if (performance.navigation.type == 2) {
            location.reload(true);
    }

    function prepareCheckoutData() {

        document.getElementById('total').value = calculateTotal();

        return true;
    }

    function calculateTotal() {
        var total = 0;

        for (var i = 0; i < $cart.length; i++) {
            total += $cart[i].price * $cart[i].quantity;
        }

        return total;
    }

</script>
{{-- Footer Section --}}
<section id="footer">
    @include('components.footer')
</section>
{{-- End of Footer Section --}}
</body>
</html>

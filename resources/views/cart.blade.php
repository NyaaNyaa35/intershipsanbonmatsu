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
                                <span class="fs-24 font-bold" data-price="{{ $cart[$i]->price }}">¥{{ $cart[$i]->price }}</span>
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
                <form action="{{ url('') }}" method="post">
                    @csrf
                    <input type="hidden" name="product" value="{{ $cart }}">
                    <input id="total" type="hidden" name="total" value="0" min="0">
                    <div class="row font-bold">
                        <div class="col-md-6">
                            Total
                        </div>
                        <div id="totalPrice" class="col-md-6">
                            0 ¥
                        </div>
                    </div>
                    <div class="row m-t-15">
                        <div class="col-md-6">
                            Discount Code
                        </div>
                        <div class="col-md-6 flex-row flex-m">
                            <i class="fa-solid fa-arrow-right"></i><input class="input-no-border" type="search" id="discount-code" placeholder='' name="discount" maxlength="10" value="">
                        </div>
                    </div>
                    <hr style="height:2px;">
                    <div class="flex-c-m m-t-10 p-all-20">
                        <button type="submit" class="button-checkout bgwhite">
                            CHECKOUT NOW
                        </button>
                    </div>
                    <div class="flex-c-m m-t-10">
                        <a href="{{ url("/") }}" class=""><i class="fa-solid fa-arrow-left m-r-10 fs-12" style="align-items:center"></i><span style="text-decoration: underline;">Continue Shopping</span></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <button id="goToTopBtn" class="bgwhite2" onclick="goToTop()"><i class="fa-solid fa-chevron-up"></i></button>
</section>
{{-- End of Main Page Section --}}
<script>
    var $cart = @json($cart);

    function decreaseCartQuantity(index) {
        if($cart[index].quantity > 1){
            $cart[index].quantity--;
            let displayElement = document.getElementById('displayCartQuantity' + index);
            displayElement.innerHTML = parseInt(displayElement.innerHTML) - 1;
            console.log($cart[index].quantity)
            updateTotal();
        }
    }

    function increaseCartQuantity(index) {
        if($cart[index].quantity < $cart[index].stock){
            $cart[index].quantity++;
            console.log($cart[index].quantity)
            let displayElement = document.getElementById('displayCartQuantity' + index);
            displayElement.innerHTML = parseInt(displayElement.innerHTML) + 1;
            updateTotal();
        }
    }
    function updateTotal() {
        var total = 0;

        var checkedCheckboxes = document.querySelectorAll('input[name="options[]"]:checked');

        checkedCheckboxes.forEach(function (checkbox) {
            var index = checkbox.value.replace('option-', '');

            total += $cart[index].price * $cart[index].quantity;
        });

        document.getElementById('totalPrice').innerText = total + ' ¥';
        checkButtonStatus();
    }

    document.addEventListener('DOMContentLoaded', function () {
        var checkboxes = document.querySelectorAll('input[name="options[]"]');
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', updateTotal);
        });
    });
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
        var isQuantityZero = parseInt(document.getElementById('quantity').value) === 0;

        document.getElementById('buyNowButton').disabled = isQuantityZero;
        document.getElementById('addCartButton').disabled = isQuantityZero;
    }

</script>
{{-- Footer Section --}}
<section id="footer">
    @include('components.footer')
</section>
{{-- End of Footer Section --}}
</body>
</html>

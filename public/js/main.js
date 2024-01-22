$(document).ready(function() {
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
    function openBuyNowModal() {
        document.getElementById('buyNowModal').style.display = 'block';
    }

    function closeBuyNowModal(){
        document.getElementById('buyNowModal').style.display = 'none';
    }

    function submitBuyNowForm() {
        document.getElementById('buyNowForm').submit();
    }

    window.onclick = function(event) {
        var modal = document.getElementById('myModal');
        if (event.target == modal) {
            closeModal();
        }
    }
    window.onclick = function(event) {
        var buyNowModal = document.getElementById('buyNowModal');
        if (event.target == buyNowModal) {
            closeBuyNowModal();
        }
    }
    let quantity = $('#displayQuantity').data('product-quantity');

    let productStock = $('#productStockDisplay').data('product-stock');

    function updateProductStockDisplay() {
        $('#productStockDisplay').text('Stock ' + productStock);
    }

    function updateQuantityDisplay() {
        $('#quantity').val(quantity);
        $('#displayQuantity').text(quantity);
    }

    $('#decreaseQuantity').on('click', function () {
        if (quantity > 1) {
            quantity--;
            productStock++;
            updateQuantityDisplay();
            updateProductStockDisplay();
        }
    });

    $('#increaseQuantity').on('click', function () {
        if (quantity < productStock) {
            quantity++;
            productStock--;
            updateQuantityDisplay();
            updateProductStockDisplay();
        }
    });

    $('#button-buynow').on('click', function () {
        let productName = $('#productName').data('product-name');

        $.ajax({
            url: "/insertCart",
            method: 'POST',
            data: {
                productName: productName,
                quantity: quantity
            },
            success: function (response) {
                if(response.status==1){
                    window.location.href = "/cart";
                }
            },
            error: function (error) {
                console.error(error);
            }
        });
    });
});

$(document).ready(function() {
    function moneyFormat(amount) {
        const formatter = new Intl.NumberFormat('ja-JP', {
            style: 'currency',
            currency: 'JPY'
        });

        return formatter.format(amount);
    }
});

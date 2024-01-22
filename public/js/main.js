$(document).ready(function() {
    $('#search-input').keypress(function(e) {
        if (e.which === 13) {
            e.preventDefault();
            $('#searchForm').submit();
        }
    });
});

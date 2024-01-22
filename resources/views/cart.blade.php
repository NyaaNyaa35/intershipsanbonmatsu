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
    <div class="container m-t-20">
        {{ $cart }}
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

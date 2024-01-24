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
    <div class="container m-t-20 m-b-40 flex-col-c-m">
       <div class="fs-30 font-bold m-t-40">Failed</div>
       <div class="fs-30 font-bold m-b-40">There's something error at our system :(</div>
       <div class="flex-c-m m-t-10">
           <a href="{{ url("/") }}" class=""><i class="fa-solid fa-arrow-left m-r-10 fs-12" style="align-items:center"></i><span style="text-decoration: underline;">Continue Shopping</span></a>
       </div>
    </div>
</section>
{{-- End of Main Page Section --}}
<script>

</script>
{{-- Footer Section --}}
<section id="footer">
    @include('components.footer')
</section>
{{-- End of Footer Section --}}
</body>
</html>

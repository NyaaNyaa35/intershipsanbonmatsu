<div id="myModal" class="modal">
    <div class="modal-content w-50">
        <span class="close fs-20 text-right" onclick="closeModal()">&times;</span>
        <p><b class="m-l-40 ">Search By</b></p>
        <form id="searchForm" action="{{ url('/Product') }}" class="" method="get" autocomplete="off" accept-charset="UTF-8">
            @csrf
            <div class="m-l-25 row">
                <div class="m-b-10 col-4">
                    Category
                </div>
                <div class="m-b-10 col-8">
                    : <select
                    class="m-l-10 category-selection border-bottom"
                    name="category_name"
                    id="category_name"
                    >
                        <option selected="selected" value="">All</option>
                        @for($i = 0; $i < count($category) ; $i++)
                            <option value="{{ $category[$i]->category_name }}">{{ $category[$i]->category_name }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="m-l-25 row">
                <div class="m-b-10 col-4">
                    Minimum Stock
                </div>
                <div class="m-b-10 col-8">
                    : <input
                    type="number"
                    class="input-no-border m-l-10  border-bottom"
                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                    maxlength="3"
                    min="1"
                    id="input-stock"
                    name="input-stock"
                    >
                </div>
            </div>
            <div class="m-l-25 row">
                <div class="m-b-10 col-4">
                    Keyword
                </div>
                <div class="m-b-10 col-8">
                    : <input
                        type="text"
                        class="input-no-border m-l-10 border-bottom"
                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        maxlength="30"
                        min="1"
                        id="keyword"
                        name="keyword"
                        >
                </div>
            </div>
            <div class="m-l-25 m-t-20">
                <div class="m-b-10">
                    <button class="button-search">Search</button>
                </div>
            </div>
        </form>
        <div class="m-l-25">
            <div class="m-b-10">
                <button class="button-featured m-r-25" onclick="seeFeaturedProduct()">See Featured Products</button>
            </div>
        </div>
    </div>
</div>
<script>
    function seeFeaturedProduct(){
        window.location.href = '{{ url("/Product/Featured") }}';
    }
</script>

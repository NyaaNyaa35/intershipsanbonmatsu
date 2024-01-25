<div id="myModal" class="modal">
    <div class="modal-content">
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
            <div class="m-l-25 m-t-20 row button-search-container">
                <div class="m-b-10 col-6">
                    <button class="button-search">Search</button>
                </div>
            </form>
                <div class="m-b-10 col-6 button-featured-container ">
                    <button class="button-featured m-r-25 ">Featured Products</button>
                </div>
            </div>
    </div>
</div>

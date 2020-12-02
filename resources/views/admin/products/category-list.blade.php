@if(isset($category_list))

    <div class="form-group">
        {{--<label><a href="javascript:void(0)">Категории</a></label>--}}

            <select name="category_list[]" class="select2 m-b-10 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Choose">
                @foreach($category_list as $key => $item)

                    <?php
                    $selected = '';

                    if (isset($row)) {
                        $product_category_count = \App\Models\ProductCategory::where('products_id', '=', $row->products_id)->where('category_id', '=', $item->category_id)->count();

                        if ($product_category_count > 0) {
                            $selected = ' selected ';
                        }
                    }
                    ?>

                    <option {{ $selected }} value="{{ $item->category_id }}">{{ $item->category_name_ru }}</option>
                @endforeach

        </select>

    </div>

@endif

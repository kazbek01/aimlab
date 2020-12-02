@if(isset($image) && $image != null)
    @foreach($image as $key => $val)

        <div class="col-md-4" style="margin-bottom: 40px">
            <div class="image-item" style="width: auto; margin: 0px">
                <input type="hidden" value="{{$val['image_url']}}" name="image_list[]">
                <a href="javascript:void(0)" onclick="confirmDeleteImage(this)">
                    <i class="fa fa-times"
                       style="font-size: 20px; margin-left: 10px; color: red; position: absolute; margin-left: -30px"></i>
                </a>
                <div class="left-float" style="width: 100%;">
                    <a href="{{ $val['image_url'] }}" class="fancybox">
                        <img src="{{ $val['image_url'] }}">
                    </a>
                </div>
                <div class="clear-float"></div>
                <h4>Отобразить на главной</h4>
                <div class="image-item-check">
                    <select name="is_main[]">
                        <option value="1" @if($val->is_main == 1) selected @endif>Да</option>
                        <option value="0" @if($val->is_main == 0) selected @endif>Нет</option>
                    </select>
                </div>
            </div>


        </div>

    @endforeach

@endif

@if(isset($is_ajax))
    <script type="text/javascript">
        $('a.fancybox').fancybox({
            padding: 10
        });
    </script>
@endif
@extends('index.layout.layout')

@section('meta-tags')

{{--    <title>{{$menu['menu_meta_title_'.$lang]}}</title>--}}
{{--    <meta name="description" content="{{$menu['menu_meta_description_'.$lang]}}"/>--}}
{{--    <meta name="keywords" content="{{$menu['menu_meta_keywords_'.$lang]}}"/>--}}

@endsection


@section('content')

    <section class="catalog">
        <div class="container">
            <h1 class="title-lg">
                <span>{{ $category->category_name_ru }}</span>
                @if(!empty($category->category_image))
                    <img src="{{ $category->category_image }}" alt="">
                @else
                    {!! $category->category_icon !!}
                @endif
            </h1>

            <div class="row row-eq-height">
                @foreach($category_products as $item)
                    <div class="col-lg-4 col-md-6 col-height">
                        <a href="/products/{{ $item->products_id }}">
                            <div class="productItem">
                                <div class="productItem-img">
                                    <img src="{{ $item->products_image }}" alt="">
                                </div>
                                <div class="productItem-caption">
                                    <h3>{{ $item->products_name }}</h3>
                                    <span class="span-block">
                                        {{ $item->products_short_desc }}
                                    </span>
                                    <div class="price-cover">
                                        <p>от {{ $item->products_price }} тенге</p>
                                        <p class="throwLine">{{ $item->products_price_old }} тенге</p>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection


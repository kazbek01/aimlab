@extends('index.layout.layout')

{{--@section('meta-tags')--}}

{{--    <title>{{$menu['menu_meta_title_'.$lang]}}</title>--}}
{{--    <meta name="description" content="{{$menu['menu_meta_description_'.$lang]}}"/>--}}
{{--    <meta name="keywords" content="{{$menu['menu_meta_keywords_'.$lang]}}"/>--}}

{{--@endsection--}}


@section('content')

    <section class="cart">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item"><a href="/category/{{ $products->category_id }}">{{ $products->category_name_ru }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $products->products_name }}</li>
                </ol>
            </nav>
            <div class="cartItem">
                <div class="cartItem-img">
                    <img src="{{ $products->products_image }}" alt="">
                </div>
                <div class="cartItem-caption">
                    <h3>{{ $products->products_name }}</h3>
                    {!! $products->products_desc !!}
                    <div class="notice">
                        <p>При заказе от 300 000 тенге. Действуют <a href="#">индивидуальные объемные и отраслевые скидки.</a></p>
                    </div>
                    <ul class="control-list">
                        <li>
                            <div class="control-item">
                                <p>{{ $products->products_price }} тенге</p>
                                <span>до 100 000 тенге</span>
                            </div>
                        </li>
                        <li>
                            <div class="control-item">
                                <p>1700 тенге</p>
                                <span>до 1 500 000 тенге</span>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="btn-green-light">Купить</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

@endsection


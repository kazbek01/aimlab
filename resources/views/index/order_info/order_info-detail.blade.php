@extends('index.layout.layout')

@section('meta-tags')

{{--    <title>{{$menu['menu_meta_title_'.$lang]}}</title>--}}
{{--    <meta name="description" content="{{$menu['menu_meta_description_'.$lang]}}"/>--}}
{{--    <meta name="keywords" content="{{$menu['menu_meta_keywords_'.$lang]}}"/>--}}

@endsection


@section('content')

    <section class="cart order_info">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">О компании</li>
                </ol>
            </nav>
{{--            {{ dd($order_info) }}--}}
            <article class="article-white">
                <h1>{{ $order_info[0]->order_info_title }}</h1>
                <h3>{{ $order_info[0]->order_info_desc }}</h3>
                <img src="{{ $order_info[0]->order_info_image }}" alt="">
               {!! $order_info[0]->order_info_text !!}
            </article>
        </div>
    </section>

@endsection


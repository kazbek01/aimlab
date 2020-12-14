@extends('index.layout.layout')

@section('meta-tags')

{{--    <title>{{$menu['menu_meta_title_'.$lang]}}</title>--}}
{{--    <meta name="description" content="{{$menu['menu_meta_description_'.$lang]}}"/>--}}
{{--    <meta name="keywords" content="{{$menu['menu_meta_keywords_'.$lang]}}"/>--}}

@endsection


@section('content')

    <section class="cart delivery">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Условия доставки</li>
                </ol>
            </nav>
{{--            {{ dd($delivery) }}--}}
            <article class="article-white">
                <h1>{{ $delivery[0]->delivery_title }}</h1>
                <h3>{{ $delivery[0]->delivery_desc }}</h3>
                <img src="{{ $delivery[0]->delivery_image }}" alt="">
               {!! $delivery[0]->delivery_text !!}
            </article>
        </div>
    </section>

@endsection


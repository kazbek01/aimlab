@extends('index.layout.layout')

@section('meta-tags')

{{--    <title>{{$menu['menu_meta_title_'.$lang]}}</title>--}}
{{--    <meta name="description" content="{{$menu['menu_meta_description_'.$lang]}}"/>--}}
{{--    <meta name="keywords" content="{{$menu['menu_meta_keywords_'.$lang]}}"/>--}}

@endsection


@section('content')

    <section class="cart partner">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item"><a href="/partner">Партнеры</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $partner->partner_title }}</li>
                </ol>
            </nav>
            <article class="article-white">
                <h1>{{ $partner->partner_title }}</h1>
                <h3>{{ $partner->partner_desc }}</h3>
                <img src="{{ $partner->partner_image }}" alt="">
               {!! $partner->partner_text !!}
            </article>
        </div>
    </section>

@endsection


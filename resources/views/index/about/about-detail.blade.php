@extends('index.layout.layout')

@section('meta-tags')

{{--    <title>{{$menu['menu_meta_title_'.$lang]}}</title>--}}
{{--    <meta name="description" content="{{$menu['menu_meta_description_'.$lang]}}"/>--}}
{{--    <meta name="keywords" content="{{$menu['menu_meta_keywords_'.$lang]}}"/>--}}

@endsection


@section('content')

    <section class="cart about">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">О компании</li>
                </ol>
            </nav>
{{--            {{ dd($about) }}--}}
            <article class="article-white">
                <h1>{{ $about[0]->about_title }}</h1>
                <h3>{{ $about[0]->about_desc }}</h3>
                <img src="{{ $about[0]->about_image }}" alt="">
               {!! $about[0]->about_text !!}
            </article>
        </div>
    </section>

@endsection


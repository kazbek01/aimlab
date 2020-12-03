@extends('index.layout.layout')

@section('meta-tags')

{{--    <title>{{$menu['menu_meta_title_'.$lang]}}</title>--}}
{{--    <meta name="description" content="{{$menu['menu_meta_description_'.$lang]}}"/>--}}
{{--    <meta name="keywords" content="{{$menu['menu_meta_keywords_'.$lang]}}"/>--}}

@endsection


@section('content')

    <section class="cart news">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Услуги</li>
                </ol>
            </nav>
            <article class="article-white">
                <h1>{{ $service->service_name }}</h1>
                <p>
                    {{ $service->service_desc }}
                </p>
                <img src="{{ $service->service_image }}" alt="">
                {!! $service->service_text  !!}

            </article>
        </div>
    </section>

@endsection


@extends('index.layout.layout')

@section('meta-tags')

{{--    <title>{{$menu['menu_meta_title_'.$lang]}}</title>--}}
{{--    <meta name="description" content="{{$menu['menu_meta_description_'.$lang]}}"/>--}}
{{--    <meta name="keywords" content="{{$menu['menu_meta_keywords_'.$lang]}}"/>--}}

@endsection


@section('content')

    <section class="cart payment">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Способы оплаты</li>
                </ol>
            </nav>
{{--            {{ dd($payment) }}--}}
            <article class="article-white">
                <h1>{{ $payment[0]->payment_title }}</h1>
                <h3>{{ $payment[0]->payment_desc }}</h3>
                <img src="{{ $payment[0]->payment_image }}" alt="">
               {!! $payment[0]->payment_text !!}
            </article>
        </div>
    </section>

@endsection


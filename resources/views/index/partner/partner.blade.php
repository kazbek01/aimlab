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
                    <li class="breadcrumb-item active" aria-current="page">Партнеры</li>
                </ol>
            </nav>
            <div class="row row-eq-height">
                @foreach($partner as $item)
                    <div class="col-lg-4 col-md-6 col-height">
                        <a href="/partner/{{ $item->partner_id }}">
                            <div class="newsItem">
                                <div class="newsItem-img">
                                    <img src="{{ $item->partner_image }}" alt="">
                                </div>
                                <div class="newsItem-caption">
                                    <h3>{{ $item->partner_title }}</h3>
                                    <p>
                                        {{ $item->partner_desc }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
{{ $partner->links() }}
@endsection


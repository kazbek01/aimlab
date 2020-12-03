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
                    <li class="breadcrumb-item active" aria-current="page">Новости</li>
                </ol>
            </nav>
            <div class="row row-eq-height">
                @foreach($news as $item)
                    <div class="col-lg-4 col-md-6 col-height">
                        <a href="/news/{{ $item->news_id }}">
                            <div class="newsItem">
                                <div class="newsItem-img">
                                    <img src="{{ $item->news_image }}" alt="">
                                </div>
                                <div class="newsItem-caption">
                                    <h3>{{ $item->news_title }}</h3>
                                    <p>
                                        {{ $item->news_desc }}
                                    </p>
                                    <ul class="news-info">
                                        <li>
                                            <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.11775 8.467C0.96075 8.176 0.96075 7.823 1.11775 7.532C3.00975 4.033 6.50475 1 9.99975 1C13.4948 1 16.9898 4.033 18.8818 7.533C19.0388 7.824 19.0388 8.177 18.8818 8.468C16.9898 11.967 13.4948 15 9.99975 15C6.50475 15 3.00975 11.967 1.11775 8.467Z" stroke="#777777" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M12.121 5.87868C13.2926 7.05025 13.2926 8.94975 12.121 10.1213C10.9495 11.2929 9.04998 11.2929 7.87841 10.1213C6.70684 8.94975 6.70684 7.05025 7.87841 5.87868C9.04998 4.70711 10.9495 4.70711 12.121 5.87868Z" stroke="#777777" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>{{ $item->view_count }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
{{ $news->links() }}
@endsection


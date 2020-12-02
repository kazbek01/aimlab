@extends('index.layout.layout')

@section('meta-tags')

    <title>{{$menu['menu_meta_title_'.$lang]}}</title>
    <meta name="description" content="{{$menu['menu_meta_description_'.$lang]}}"/>
    <meta name="keywords" content="{{$menu['menu_meta_keywords_'.$lang]}}"/>

@endsection


@section('content')

    <section class="cart">
        <div class="container">
            <div class="whiteBlog">
                <h1>Результаты поиска: <strong>{{ $row['search_query'] }}</strong></h1>
                <ul class="product-info">
                    @foreach($row['products'] as $item)
                        <li>
                            <a href="/products/{{ $item->products_id }}">
                                <h3>{{ $item->products_name }}</h3>
                                <p>{{ $item->products_short_desc }}</p>
                            </a>
                        </li>
                    @endforeach

                    @foreach($row['project'] as $item)
                        <li>
                            <a href="/project/{{ $item->project_id }}">
                                <h3>{{ $item->project_name }}</h3>
                                <p>{{ $item->project_desc }}</p>
                            </a>
                        </li>
                    @endforeach

                    @foreach($row['service'] as $item)
                        <li>
                            <a href="/service/{{ $item->service_id }}">
                                <h3>{{ $item->service_name }}</h3>
                                <p>{{ $item->service_desc }}</p>
                            </a>
                        </li>
                    @endforeach

                    @foreach($row['news'] as $item)
                        <li>
                            <a href="/news/{{ $item->news_id }}">
                                <h3>{{ $item->news_title }}</h3>
                                <p>{{ $item->news_desc }}</p>
                            </a>
                        </li>
                    @endforeach

                    @foreach($row['category'] as $item)
                        <li>
                            <a href="/category/{{ $item->category_id }}">
                                <h3>{{ $item->category_name_ru }}</h3>
                            </a>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </section>

@endsection


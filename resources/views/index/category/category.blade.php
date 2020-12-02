@extends('index.layout.layout')

@section('meta-tags')

    <title>{{$menu['menu_meta_title_'.$lang]}}</title>
    <meta name="description" content="{{$menu['menu_meta_description_'.$lang]}}"/>
    <meta name="keywords" content="{{$menu['menu_meta_keywords_'.$lang]}}"/>

@endsection


@section('content')

    <section class="catalog">
        <div class="container">
            <h1 class="title-lg">
                <span>Ящики</span>
                <svg width="42" height="38" viewBox="0 0 42 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 17H27M38.334 9V33C38.334 35.21 36.544 37 34.334 37H7.666C5.456 37 3.666 35.21 3.666 33V9M39 9H3C1.896 9 1 8.104 1 7V3C1 1.896 1.896 1 3 1H39C40.104 1 41 1.896 41 3V7C41 8.104 40.104 9 39 9Z" stroke="#777777" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </h1>

            <div class="row row-eq-height">
                @foreach($category_products as $item)
                    <div class="col-lg-4 col-md-6 col-height">
                        <a href="/products/{{ $item->products_id }}">
                            <div class="productItem">
                                <div class="productItem-img">
                                    <img src="{{ $item->products_image }}" alt="">
                                </div>
                                <div class="productItem-caption">
                                    <h3>{{ $item->products_name }}</h3>
                                    <ul>
                                        <li>600 x 400 x 152 мм</li>
                                        <li>27 л</li>
                                    </ul>
                                    <p>от 250 тенге</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection


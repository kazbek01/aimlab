@extends('index.layout.layout')

@section('meta-tags')

{{--    <title>{{$menu['menu_meta_title_'.$lang]}}</title>--}}
{{--    <meta name="description" content="{{$menu['menu_meta_description_'.$lang]}}"/>--}}
{{--    <meta name="keywords" content="{{$menu['menu_meta_keywords_'.$lang]}}"/>--}}

@endsection


@section('content')

    <section class="services services-only">
        <div class="container">
            <div class="whiteBlog">
                <div class="title-head">
                    <h2 class="title">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 23.5556V6.44444C4 5.09389 5.15824 4 6.58824 4H23.4118C24.8418 4 26 5.09389 26 6.44444V18.6667C26 20.0172 24.8418 21.1111 23.4118 21.1111H6.58824C5.15824 21.1111 4 22.205 4 23.5556ZM4 23.5556C4 24.9061 5.15824 26 6.58824 26H23.4118C24.8418 26 26 24.9061 26 23.5556V17.4444M20.8235 9.69189H9.17647M20.8235 15H9.17647"
                                  stroke="#777777" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Услуги</span>
                    </h2>
                </div>
                <div class="row row-eq-height">
                    @foreach($service as $item)
                        <div class="col-xl-4 col-lg-4 col-md-6 col-height">
                            <a href="/service/{{ $item->service_id }}">
                                <div class="serviceItem">
                                    <div class="serviceItem-img">
                                        <img src="{{ $item->service_image }}" alt="{{ $item->service_name }}">
                                    </div>
                                    <div class="serviceItem-caption">
                                        <p>
                                            {{ $item->service_desc }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{ $service->links() }}

@endsection


@extends('index.layout.layout')

@section('meta-tags')

{{--    <title>{{$menu['menu_meta_title_'.$lang]}}</title>--}}
{{--    <meta name="description" content="{{$menu['menu_meta_description_'.$lang]}}"/>--}}
{{--    <meta name="keywords" content="{{$menu['menu_meta_keywords_'.$lang]}}"/>--}}

@endsection

@section('css')
    <link rel="stylesheet" href="/index/css/slick-theme.css">
    <link rel="stylesheet" href="/index/css/slick.css">
@endsection

@section('content')

    <section class="main-slider">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <ul class="dropdown-menu dropdown-menu-static" role="menu" aria-labelledby="dLabel">
                        @foreach($categories as $item)
                            @if(count($subcategories[$item->category_id]) == 0)
                                <li>
                                    <a class="dropdown-item" href="/category/{{ $item->category_id }}">
                                        @if(!empty($item->category_image))
                                            <img src="{{ $item->category_image }}" alt="">
                                        @else
                                            {!! $item->category_icon !!}
                                        @endif
                                        <span>{{ $item->category_name_ru }}</span>
                                    </a>

                                </li>
                            @else
                                <li class="dropdown-submenu dropright">
                                    <a tabindex="-1" class="dropdown-item dropdown-toggle" data-toggle="dropdown">
                                        @if(!empty($item->category_image))
                                            <img src="{{ $item->category_image }}" alt="">
                                        @else
                                            {!! $item->category_icon !!}
                                        @endif
                                        <span>{{ $item->category_name_ru }}</span>
                                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none"
                                             xmlns="http://www.w3.org/2000/svg"
                                             class="arrow-right">
                                            <path d="M1 1L7 7L1 13" stroke="#777777"/>
                                        </svg>
                                    </a>
                                    <ul class="dropdown-menu">
                                        @foreach($subcategories[$item->category_id] as $subItem)
                                            <li>
                                                <a class="dropdown-item"
                                                   href="/category/{{ $subItem->category_id }}">{{ $subItem->category_name_ru }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endforeach


                    </ul>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="sl-main">
                        @foreach($banner as $item)
                            <a href="{{ $item->banner_website }}">
                                <img src="{{ $item->banner_image }}" alt="{{ $item->banner_name_ru }}">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="projects">
        <div class="container">
            <div class="whiteBlog">
                <div class="title-head">
                    <h2 class="title">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.40703 4.37311H7.60428C5.61369 4.37311 4 5.9868 4 7.97739V9.78014C4 11.7707 5.61369 13.3844 7.60428 13.3844H9.40703C11.3976 13.3844 13.0113 11.7707 13.0113 9.78014V7.97739C13.0113 5.9868 11.3976 4.37311 9.40703 4.37311Z"
                                  stroke="#777777" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.40703 16.9887H7.60428C5.61369 16.9887 4 18.6024 4 20.593V22.3957C4 24.3863 5.61369 26 7.60428 26H9.40703C11.3976 26 13.0113 24.3863 13.0113 22.3957V20.593C13.0113 18.6024 11.3976 16.9887 9.40703 16.9887Z"
                                  stroke="#777777" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M18.5727 5.05567L17.298 6.33041C15.8904 7.73796 15.8904 10.0201 17.298 11.4276L18.5727 12.7024C19.9803 14.1099 22.2624 14.1099 23.6699 12.7024L24.9447 11.4276C26.3522 10.0201 26.3522 7.73796 24.9447 6.33041L23.6699 5.05567C22.2624 3.64811 19.9803 3.64811 18.5727 5.05567Z"
                                  stroke="#777777" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M22.0226 16.9887H20.2199C18.2293 16.9887 16.6156 18.6024 16.6156 20.593V22.3957C16.6156 24.3863 18.2293 26 20.2199 26H22.0226C24.0132 26 25.6269 24.3863 25.6269 22.3957V20.593C25.6269 18.6024 24.0132 16.9887 22.0226 16.9887Z"
                                  stroke="#777777" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Проекты</span>
                    </h2>
                    <a href="/project">
                        <span>Показать все</span>
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L6 6L1 11" stroke="#777777"/>
                        </svg>
                    </a>
                </div>
                <div class="row row-eq-height">
                    @foreach($project as $item)
                        <div class="col-xl-4 col-lg-4 col-md-6 col-height">
                            <a href="/project/{{ $item->project_id }}">
                                <div class="projectItem">
                                    <div class="projectItem-img">
                                        <img src="{{ $item->project_image }}" alt="{{ $item->project_name }}">
                                    </div>
                                    <div class="projectItem-caption">
                                        <p>
                                            {{ $item->project_desc }}
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
    <section class="services">
        <div class="container">
            <div class="title-head">
                <h2 class="title">
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 23.5556V6.44444C4 5.09389 5.15824 4 6.58824 4H23.4118C24.8418 4 26 5.09389 26 6.44444V18.6667C26 20.0172 24.8418 21.1111 23.4118 21.1111H6.58824C5.15824 21.1111 4 22.205 4 23.5556ZM4 23.5556C4 24.9061 5.15824 26 6.58824 26H23.4118C24.8418 26 26 24.9061 26 23.5556V17.4444M20.8235 9.69189H9.17647M20.8235 15H9.17647"
                              stroke="#777777" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Услуги</span>
                </h2>
                <a href="/service">
                    <span>Показать все</span>
                    <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L6 6L1 11" stroke="#777777"/>
                    </svg>
                </a>
            </div>
            <div class="row row-eq-height">
                @foreach($service as $key => $item)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-height">
                        <a href="/service/{{ $item->service_id }}">
                            <div class="serviceItem">
                                <div class="serviceItem-img">
                                    <img src="{{ $item->service_image }}" alt="{{ $item->service_name }}">
                                </div>
                                <div class="serviceItem-caption">
                                    <h3>{{ $key + 1 }}</h3>
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
    </section>
    <section class="offers">
        <div class="container">
            <div class="whiteBlog">
                <div class="title-head">
                    <h2 class="title">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.71498 17.1153L4.44104 19.3744L4.8137 22.1866C5.02025 23.7466 6.24655 24.9743 7.80651 25.1823L10.626 25.5593L12.8836 27.2839C14.133 28.2387 15.8648 28.2387 17.1142 27.2839L19.3733 25.5579H19.3704L22.1841 25.1852C23.7441 24.9787 24.9718 23.7524 25.1798 22.1924L25.5553 19.3729C25.5553 19.3729 26.4278 18.2319 27.2814 17.1153C28.2362 15.8659 28.2347 14.1341 27.2814 12.8847L25.5582 10.6242L25.1856 7.81192C24.979 6.25197 23.7527 5.02422 22.1928 4.81623L19.3719 4.44068L17.1142 2.71606C15.8648 1.76131 14.133 1.76131 12.8836 2.71606L10.6245 4.44068H10.6274L7.81373 4.81478C6.25377 5.02133 5.02603 6.24763 4.81803 7.80759L4.44104 10.6271C4.44104 10.6271 3.56862 11.7681 2.71498 12.8847C1.76167 14.1326 1.76167 15.8659 2.71498 17.1153Z"
                                  stroke="#6FB818" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.2678 19.9233L14.4667 19.2935C14.8003 19.1187 15.199 19.1187 15.5326 19.2935L16.7315 19.9233C17.1186 20.1269 17.5851 20.0922 17.9376 19.8351L18.3853 19.5102C18.7378 19.2545 18.914 18.8197 18.8418 18.3907L18.6121 17.0561C18.5485 16.6849 18.6713 16.305 18.9414 16.0421L19.9106 15.0975C20.2226 14.7927 20.3353 14.3377 20.2009 13.9232L20.0305 13.3974C19.8962 12.9829 19.538 12.681 19.1061 12.6175L17.7657 12.4225C17.393 12.369 17.0709 12.1336 16.9034 11.7956L16.3039 10.5808C16.1104 10.1909 15.7117 9.94386 15.2755 9.94386H14.7223C14.2861 9.94386 13.8874 10.1909 13.6953 10.5823L13.0959 11.797C12.9284 12.135 12.6063 12.3705 12.2336 12.4239L10.8932 12.6189C10.4613 12.6825 10.1031 12.9843 9.96878 13.3989L9.79834 13.9246C9.66401 14.3392 9.77523 14.7942 10.0887 15.0989L11.0579 16.0436C11.328 16.3065 11.4507 16.6863 11.3872 17.0576L11.1575 18.3922C11.0839 18.8226 11.2615 19.2559 11.614 19.5116L12.0617 19.8366C12.4142 20.0908 12.8821 20.1255 13.2678 19.9233Z"
                                  stroke="#6FB818" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="green-colored">Специальные предложения</span>
                    </h2>
                    <a href="/offers">
                        <span>Показать все</span>
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L6 6L1 11" stroke="#777777"/>
                        </svg>
                    </a>
                </div>
                <div class="row row-eq-height">
                    @foreach($products as  $item)
                        <div class="col-xl-3 col-lg-3 col-md-4 col-6 col-height">
                            <a href="/products/{{ $item->products_id }}">
                                <div class="offerItem">
                                    <div class="offerItem-img">
                                        <img src="{{ $item->products_image }}" alt="">
                                    </div>
                                    <div class="offerItem-caption">
                                        <h3>{{ $item->products_price }} тенге</h3>
                                        <p>
                                            {{ $item->products_short_desc }}
                                        </p>
                                        <button class="btn-plain btn-green">Купить</button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script type="text/javascript" src="/index/js/slick.min.js"></script>
    <script>
        $('.sl-main').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            dots: false,
            autoplay: true,
            autoplaySpeed: 2000
        });

        $('.show-more').click(function (e) {
            e.preventDefault();
            $('.modal-plain').addClass('modal-show');
            $('.overlay').addClass('overlay-showed');
            $('body').addClass('scroll-locked');
        });
        $('.close-modal').click(function () {
            $('.modal-plain').removeClass('modal-show');
            $('.overlay').removeClass('overlay-showed');
            $('body').removeClass('scroll-locked');
        })
    </script>
@endsection

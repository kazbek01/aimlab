@extends('index.layout.layout')

@section('meta-tags')

{{--    <title>{{$menu['menu_meta_title_'.$lang]}}</title>--}}
{{--    <meta name="description" content="{{$menu['menu_meta_description_'.$lang]}}"/>--}}
{{--    <meta name="keywords" content="{{$menu['menu_meta_keywords_'.$lang]}}"/>--}}

@endsection


@section('content')

    <section class="catalog">
        <div class="container">
            <h1 class="title-lg title-offer">
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.71498 17.1153L4.44104 19.3744L4.8137 22.1866C5.02025 23.7466 6.24655 24.9743 7.80651 25.1823L10.626 25.5593L12.8836 27.2839C14.133 28.2387 15.8648 28.2387 17.1142 27.2839L19.3733 25.5579H19.3704L22.1841 25.1852C23.7441 24.9787 24.9718 23.7524 25.1798 22.1924L25.5553 19.3729C25.5553 19.3729 26.4278 18.2319 27.2814 17.1153C28.2362 15.8659 28.2347 14.1341 27.2814 12.8847L25.5582 10.6242L25.1856 7.81192C24.979 6.25197 23.7527 5.02422 22.1928 4.81623L19.3719 4.44068L17.1142 2.71606C15.8648 1.76131 14.133 1.76131 12.8836 2.71606L10.6245 4.44068H10.6274L7.81373 4.81478C6.25377 5.02133 5.02603 6.24763 4.81803 7.80759L4.44104 10.6271C4.44104 10.6271 3.56862 11.7681 2.71498 12.8847C1.76167 14.1326 1.76167 15.8659 2.71498 17.1153Z"
                          stroke="#6FB818" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M13.2678 19.9233L14.4667 19.2935C14.8003 19.1187 15.199 19.1187 15.5326 19.2935L16.7315 19.9233C17.1186 20.1269 17.5851 20.0922 17.9376 19.8351L18.3853 19.5102C18.7378 19.2545 18.914 18.8197 18.8418 18.3907L18.6121 17.0561C18.5485 16.6849 18.6713 16.305 18.9414 16.0421L19.9106 15.0975C20.2226 14.7927 20.3353 14.3377 20.2009 13.9232L20.0305 13.3974C19.8962 12.9829 19.538 12.681 19.1061 12.6175L17.7657 12.4225C17.393 12.369 17.0709 12.1336 16.9034 11.7956L16.3039 10.5808C16.1104 10.1909 15.7117 9.94386 15.2755 9.94386H14.7223C14.2861 9.94386 13.8874 10.1909 13.6953 10.5823L13.0959 11.797C12.9284 12.135 12.6063 12.3705 12.2336 12.4239L10.8932 12.6189C10.4613 12.6825 10.1031 12.9843 9.96878 13.3989L9.79834 13.9246C9.66401 14.3392 9.77523 14.7942 10.0887 15.0989L11.0579 16.0436C11.328 16.3065 11.4507 16.6863 11.3872 17.0576L11.1575 18.3922C11.0839 18.8226 11.2615 19.2559 11.614 19.5116L12.0617 19.8366C12.4142 20.0908 12.8821 20.1255 13.2678 19.9233Z"
                          stroke="#6FB818" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="green-colored">Специальные предложения</span>
            </h1>

            <div class="row row-eq-height">
                @foreach($products as $item)
                    <div class="col-lg-4 col-md-6 col-height">
                        <a href="/products/{{ $item->products_id }}">
                            <div class="productItem">
                                <div class="productItem-img">
                                    <img src="{{ $item->products_image }}" alt="">
                                </div>
                                <div class="productItem-caption">
                                    <h3>{{ $item->products_name }}</h3>
                                    <span class="span-block">
                                        {{ $item->products_short_desc }}
                                    </span>
                                    <p>от {{ $item->products_price }} тенге</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection


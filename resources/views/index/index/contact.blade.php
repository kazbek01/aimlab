@extends('index.layout.layout')

@section('meta-tags')

    <title>{{$menu['menu_meta_title_'.$lang]}}</title>
    <meta name="description" content="{{$menu['menu_meta_description_'.$lang]}}"/>
    <meta name="keywords" content="{{$menu['menu_meta_keywords_'.$lang]}}"/>

@endsection

@section('content')

    <section class="contacts">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Контакты</li>
                </ol>
            </nav>
            <div class="white-blog">
                <h1>Контакты</h1>
                <ul class="contact-nav">
                    <li>
                        <a href="tel:8 (727) 292 86 49">
                            <svg width="22" height="20" viewBox="0 0 22 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.667 19L11 17.667M11 17.667L9.667 16.334M11 17.667C5.477 17.667 1 15.926 1 13.778C1 13.138 1.408 12.538 2.111 12.006M19.889 12.006C20.592 12.538 21 13.138 21 13.778C21 15.414 18.4 16.811 14.722 17.386M8.6 1V3.16C8.6 3.557 8.869 3.88 9.2 3.88H12.8C13.131 3.88 13.4 3.557 13.4 3.16V1M5 13V3.4C5 2.074 6.074 1 7.4 1H14.6C15.926 1 17 2.074 17 3.4V13"
                                      stroke="#777777" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>8 (727) 292 86 49</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <svg width="20" height="18" viewBox="0 0 20 18" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 1V10M10 10L7 7M10 10L13 7M7 3H5.386C4.552 3 3.806 3.517 3.513 4.298L1.127 10.66C1.043 10.885 1 11.123 1 11.363V15C1 16.105 1.895 17 3 17H17C18.105 17 19 16.105 19 15V11.363C19 11.123 18.957 10.885 18.873 10.661L16.487 4.298C16.194 3.517 15.448 3 14.614 3H13M1.034 11H5.382C5.761 11 6.107 11.214 6.276 11.553L6.723 12.447C6.893 12.786 7.239 13 7.618 13H12.382C12.761 13 13.107 12.786 13.276 12.447L13.723 11.553C13.893 11.214 14.239 11 14.618 11H18.966"
                                      stroke="#777777" stroke-miterlimit="10" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                            <div>
                                <span>8 (727) 292 37 31</span>
                                <p>факс, рабочий</p>
                            </div>

                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.82748 12.1611C9.84735 14.1733 12.4059 15.4547 13.9282 13.946L14.2972 13.5786C14.7896 13.0894 14.7207 12.2788 14.1492 11.8837C13.7894 11.634 13.4029 11.3658 12.9753 11.067C12.5333 10.7579 11.9268 10.806 11.5434 11.1847L11.1261 11.5971C10.609 11.2707 10.0971 10.852 9.62224 10.3792L9.62018 10.3772C9.14528 9.9043 8.72486 9.39461 8.39695 8.8798L8.81121 8.46426C9.19257 8.0825 9.23985 7.47865 8.92942 7.03855C8.62823 6.61278 8.35892 6.22795 8.10913 5.86973C7.71235 5.3017 6.89824 5.23313 6.40689 5.72235L6.03786 6.08978C4.5227 7.60556 5.80966 10.152 7.82954 12.1642M16.3778 3.61602C14.6858 1.93035 12.4357 1.00102 10.0385 1C5.09731 1 1.07709 5.0008 1.07607 9.91863C1.07401 11.4835 1.48621 13.0218 2.27154 14.378L1 19L5.75107 17.7595C7.06579 18.4719 8.53778 18.8455 10.0344 18.8455H10.0385C14.9777 18.8455 18.9979 14.8436 19 9.9258C19.001 7.54313 18.0697 5.30272 16.3778 3.61602Z"
                                      stroke="#777777" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div>
                                <span>8 (707) 522 44 88</span>
                                <p>whatsapp и звонки</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <svg width="20" height="16" viewBox="0 0 20 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.119 2.03674L8.813 7.57574C9.508 8.07599 10.442 8.077 11.138 7.57775L18.876 2.02265M2.636 1H17.363C18.267 1 19 1.7378 19 2.64771V13.3533C19 14.2632 18.267 15 17.364 15H2.636C1.733 15.001 1 14.2632 1 13.3533V2.64771C1 1.7378 1.733 1 2.636 1Z"
                                      stroke="#777777" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>aimlabkz@gmail.com </span>
                        </a>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div>
                            {{ csrf_field() }}
                            <div class="order-form">
                                <h2>Оставьте заявку</h2>
                                <label class="form-label">
                                    <span>Имя</span>
                                    <input type="text" name="user_name" id="user_name">
                                </label>
                                <label class="form-label">
                                    <span>E-mail</span>
                                    <input type="text" name="user_email" id="user_email">
                                </label>
                                <label class="form-label">
                                    <span>Сообщение</span>
                                    <textarea name="order_text" id="order_text"></textarea>
                                </label>
                                <div class="btn-box tar">
                                    <button class="btn-plain btn-green" id="send_order">Отправить</button>
                                </div>
                            </div>
                        </div>
                        <div id="error">

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="map-box">
                            <h2>Мы на карте</h2>
                            <div id="map" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

@section('js')
    <script src="https://api-maps.yandex.ru/2.1/?apikey=<ваш API-ключ>&lang=ru_RU" type="text/javascript"></script>
    <script type="text/javascript">
        // Функция ymaps.ready() будет вызвана, когда
        // загрузятся все компоненты API, а также когда будет готово DOM-дерево.
        ymaps.ready(init);

        function init() {
            // Создание карты.
            var myMap = new ymaps.Map("map", {
                // Координаты центра карты.
                // Порядок по умолчанию: «широта, долгота».
                // Чтобы не определять координаты центра карты вручную,
                // воспользуйтесь инструментом Определение координат.
                center: [43.270112, 76.935233],
                controls: ['zoomControl', 'geolocationControl'],
                // Уровень масштабирования. Допустимые значения:
                // от 0 (весь мир) до 19.
                zoom: 15
            });
            // Создаем геообъект с типом геометрии "Точка".
            myGeoObject = new ymaps.GeoObject({
                // Описание геометрии.
                geometry: {
                    type: "Point",
                    coordinates: [55.8, 37.8]
                },
                // Свойства.
                properties: {
                    // Контент метки.
                    iconContent: 'Я тащусь',
                    hintContent: 'Ну давай уже тащи'
                }
            }, {
                // Опции.
                // Иконка метки будет растягиваться под размер ее содержимого.
                preset: 'islands#blackStretchyIcon',
                // Метку можно перемещать.
                draggable: true
            }),
                myPieChart = new ymaps.Placemark([
                    55.847, 37.6
                ], {
                    // Данные для построения диаграммы.
                    data: [
                        {weight: 8, color: '#0E4779'},
                        {weight: 6, color: '#1E98FF'},
                        {weight: 4, color: '#82CDFF'}
                    ],
                    iconCaption: "Диаграмма"
                }, {
                    // Зададим произвольный макет метки.
                    iconLayout: 'default#pieChart',
                    // Радиус диаграммы в пикселях.
                    iconPieChartRadius: 30,
                    // Радиус центральной части макета.
                    iconPieChartCoreRadius: 10,
                    // Стиль заливки центральной части.
                    iconPieChartCoreFillStyle: '#ffffff',
                    // Cтиль линий-разделителей секторов и внешней обводки диаграммы.
                    iconPieChartStrokeStyle: '#ffffff',
                    // Ширина линий-разделителей секторов и внешней обводки диаграммы.
                    iconPieChartStrokeWidth: 3,
                    // Максимальная ширина подписи метки.
                    iconPieChartCaptionMaxWidth: 200
                });
            myMap.geoObjects
                .add(myGeoObject)
                .add(myPieChart)
                .add(new ymaps.Placemark([43.270112, 76.935233], {
                    balloonContent: 'цвет <strong>носика Гены</strong>',
                    iconCaption: 'проспект Райымбека д. 165'
                }, {
                    preset: 'islands#greenDotIconWithCaption'
                }));

//    footer map

            var myMap2 = new ymaps.Map("mapOffice", {
                // Координаты центра карты.
                // Порядок по умолчанию: «широта, долгота».
                // Чтобы не определять координаты центра карты вручную,
                // воспользуйтесь инструментом Определение координат.
                center: [43.270112, 76.935233],
                controls: ['zoomControl', 'geolocationControl'],
                // Уровень масштабирования. Допустимые значения:
                // от 0 (весь мир) до 19.
                zoom: 15
            });
            myMap2.geoObjects
                .add(myGeoObject)
                .add(myPieChart)
                .add(new ymaps.Placemark([43.270112, 76.935233], {
                    balloonContent: 'цвет <strong>носика Гены</strong>',
                    iconCaption: 'проспект Райымбека д. 165'
                }, {
                    preset: 'islands#greenDotIconWithCaption'
                }));

        }

    </script>
    <script type="text/javascript">

        $('.form-label input ,.form-label textarea').focus(function () {
            $(this).closest('.form-label').addClass('form-label-focus');
        });

        $('.form-label input,.form-label textarea').blur(function () {
            $(this).closest('.form-label').removeClass('form-label-focus');
            $(this).closest('.form-label').addClass('form-label-done');
            if ($(this).val().length === 0) {
                $(this).closest('.form-label').removeClass('form-label-focus');
                $(this).closest('.form-label').removeClass('form-label-done');
            }
        });

        $('#send_order').click(function () {
            addOrder();
        });

        function addOrder() {
            $('.ajax-loader').fadeIn(100);
            $.ajax({
                url: '/order',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    // user_name: $('input[name="user_name"]').val(),
                    // user_email: $('input[name="user_email"]').val(),
                    // order_text: $('textarea[name="order_text"]').val(),
                    user_name: $('#user_name').val(),
                    user_email: $('#user_email').val(),
                    order_text: $('#order_text').val(),
                },
                success: function (data) {
                    $('.ajax-loader').fadeOut(100);
                    if (data.status == 0) {
                        showError(data.error);
                        // $('#error').html(data.error);
                        return;
                    }
                    $('#user_name').val('');
                    $('#user_email').val('');
                    $('#order_text').val('');
                    showMessage(data.message);
                }
            });
        }
    </script>
@endsection

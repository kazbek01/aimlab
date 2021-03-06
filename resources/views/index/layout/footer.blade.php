<?php

        $contact = \App\Models\Contact::select(
        'phone',
        'whatsapp',
        'email',
        'fax'
        )
        ->orderBy('created_at', 'desc')
        ->take(1)
        ->get();
?>

<footer>
    <div class="container">
        <div class="row row-eq-height">
            <div class="col-xl-3 col-lg-3 col-md-3 col-height">
                <a href="index.html" class="logo">
                    <img src="/index/img/logo/logo.png" alt="">
                </a>
                <div class="copyright">
                    <p>AIM Lab — Advanced investigation materials
                        Все права защищены © 2020 </p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 offset-lg-1 col-md-5 col-height">
                <ul class="footer-nav">
                    <li><a href="/about">О компании</a></li>
                    <li><a href="/partner">Партнеры</a></li>
                    <li><a href="/service">Услуги</a></li>
                    <li><a href="/project">Проекты</a></li>
                    <li><a href="/contact">Контакты</a></li>
                    <li><a href="/order_info">Как заказать?</a></li>
                    <li><a href="/delivery">Условия доставки</a></li>
                    <li><a href="/payment">Способы оплаты</a></li>
                    <li><a href="/news">Новости</a></li>
                </ul>
            </div>
            <div class="col-xl-3 col-lg-3 offset-lg-1 col-md-4 col-height">
                <ul class="contact-nav">
                    <li>
                        <a href="tel:{{ $contact[0]->phone }}">
                            <svg width="22" height="20" viewBox="0 0 22 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.667 19L11 17.667M11 17.667L9.667 16.334M11 17.667C5.477 17.667 1 15.926 1 13.778C1 13.138 1.408 12.538 2.111 12.006M19.889 12.006C20.592 12.538 21 13.138 21 13.778C21 15.414 18.4 16.811 14.722 17.386M8.6 1V3.16C8.6 3.557 8.869 3.88 9.2 3.88H12.8C13.131 3.88 13.4 3.557 13.4 3.16V1M5 13V3.4C5 2.074 6.074 1 7.4 1H14.6C15.926 1 17 2.074 17 3.4V13"
                                      stroke="#777777" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>{{ $contact[0]->phone }}</span>
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
                                <span>{{ $contact[0]->fax }}</span>
                                <p>факс, рабочий</p>
                            </div>

                        </a>
                    </li>
                    <li>
                        <a href="https://wa.me/{{ $contact[0]->whatsapp }}">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.82748 12.1611C9.84735 14.1733 12.4059 15.4547 13.9282 13.946L14.2972 13.5786C14.7896 13.0894 14.7207 12.2788 14.1492 11.8837C13.7894 11.634 13.4029 11.3658 12.9753 11.067C12.5333 10.7579 11.9268 10.806 11.5434 11.1847L11.1261 11.5971C10.609 11.2707 10.0971 10.852 9.62224 10.3792L9.62018 10.3772C9.14528 9.9043 8.72486 9.39461 8.39695 8.8798L8.81121 8.46426C9.19257 8.0825 9.23985 7.47865 8.92942 7.03855C8.62823 6.61278 8.35892 6.22795 8.10913 5.86973C7.71235 5.3017 6.89824 5.23313 6.40689 5.72235L6.03786 6.08978C4.5227 7.60556 5.80966 10.152 7.82954 12.1642M16.3778 3.61602C14.6858 1.93035 12.4357 1.00102 10.0385 1C5.09731 1 1.07709 5.0008 1.07607 9.91863C1.07401 11.4835 1.48621 13.0218 2.27154 14.378L1 19L5.75107 17.7595C7.06579 18.4719 8.53778 18.8455 10.0344 18.8455H10.0385C14.9777 18.8455 18.9979 14.8436 19 9.9258C19.001 7.54313 18.0697 5.30272 16.3778 3.61602Z"
                                      stroke="#777777" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div>
                                <span>{{ $contact[0]->whatsapp }}</span>
                                <p>whatsapp и звонки</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:{{ $contact[0]->email }}">
                            <svg width="20" height="16" viewBox="0 0 20 16" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.119 2.03674L8.813 7.57574C9.508 8.07599 10.442 8.077 11.138 7.57775L18.876 2.02265M2.636 1H17.363C18.267 1 19 1.7378 19 2.64771V13.3533C19 14.2632 18.267 15 17.364 15H2.636C1.733 15.001 1 14.2632 1 13.3533V2.64771C1 1.7378 1.733 1 2.636 1Z"
                                      stroke="#777777" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>{{ $contact[0]->email }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
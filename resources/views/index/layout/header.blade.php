<header>
    <div class="container">
        <div class="header">
            <div class="header-xs">
                <div class="nav-box">
                    <button class="btn-plain close-menu">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L15 15M1 15L15 1" stroke="#FFF3F3"/>
                        </svg>
                    </button>
                    <ul class="main-nav">
                        <li><a href="/" class="@if(isset($menu) && $menu == 'index') active @endif">Главная</a></li>
                        <li><a href="/project" class="@if(isset($menu) && $menu == 'project') active @endif">Наши проекты</a></li>
                        <li><a href="/service" class="@if(isset($menu) && $menu == 'service') active @endif">Услуги</a></li>
                        <li><a href="/news" class="@if(isset($menu) && $menu == 'news') active @endif">Новости</a></li>
                        <li><a href="/contact" class="@if(isset($menu) && $menu == 'contact') active @endif">Контакты</a></li>
                    </ul>
                </div>
                <button class="btn-plain call-menu">
                    <svg width="24" height="14" viewBox="0 0 24 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1H23M1 13H23M1 7H23" stroke="#222222" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <a href="/" class="logo">
                    <img src="/index/img/logo/logo.png" alt="">
                </a>
            </div>
            <div class="touch">
                <ul class="contact-list">
                    <li>
                        <a href="mailto:aimlabkz@gmail.com">
                            <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.119 2.03674L8.813 7.57574C9.508 8.07599 10.442 8.077 11.138 7.57775L18.876 2.02265M2.636 1H17.363C18.267 1 19 1.7378 19 2.64771V13.3533C19 14.2632 18.267 15 17.364 15H2.636C1.733 15.001 1 14.2632 1 13.3533V2.64771C1 1.7378 1.733 1 2.636 1Z"
                                      stroke="#777777" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>aimlabkz@gmail.com </span>
                        </a>
                    </li>
                    <li>
                        <a href="tel:+7 (727) 292 86 49">
                            <svg width="14" height="20" viewBox="0 0 14 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.75 4H8.25M11 19H3C1.895 19 1 18.105 1 17V3C1 1.895 1.895 1 3 1H11C12.105 1 13 1.895 13 3V17C13 18.105 12.105 19 11 19ZM6.999 15.25C6.861 15.25 6.749 15.362 6.75 15.5C6.75 15.638 6.862 15.75 7 15.75C7.138 15.75 7.25 15.638 7.25 15.5C7.25 15.362 7.138 15.25 6.999 15.25Z"
                                      stroke="#777777" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>8 (727) 292 86 49</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 1V10M10 10L7 7M10 10L13 7M7 3H5.386C4.552 3 3.806 3.517 3.513 4.298L1.127 10.66C1.043 10.885 1 11.123 1 11.363V15C1 16.105 1.895 17 3 17H17C18.105 17 19 16.105 19 15V11.363C19 11.123 18.957 10.885 18.873 10.661L16.487 4.298C16.194 3.517 15.448 3 14.614 3H13M1.034 11H5.382C5.761 11 6.107 11.214 6.276 11.553L6.723 12.447C6.893 12.786 7.239 13 7.618 13H12.382C12.761 13 13.107 12.786 13.276 12.447L13.723 11.553C13.893 11.214 14.239 11 14.618 11H18.966"
                                      stroke="#777777" stroke-miterlimit="10" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                            <span>8 (727) 292 86 49</span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>

</header>
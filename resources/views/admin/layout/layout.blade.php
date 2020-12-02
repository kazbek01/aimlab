<!DOCTYPE html>
<html lang="en">

@include('admin.layout.app')

<body class="fix-header fix-sidebar card-no-border">


<i class="ajax-loader" ></i>
<div class="preloader">
  <svg class="circular" viewBox="25 25 50 50">
    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>

<div id="main-wrapper">
  <header class="topbar">
    <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
      <div class="navbar-header">
        <a class="navbar-brand" href="/">
          <b>
            <img style="max-width: 200px" src="/img/logo/logo.png" alt="homepage" class="dark-logo" />
            <img style="max-width: 200px" src="/img/logo/logo.png" alt="homepage" class="light-logo" />
          </b>

              {{--          <span>
                         <img src="/admin/img/logo.png" alt="homepage" class="dark-logo" />
                         <img src="/admin/img/logo.png" class="light-logo" alt="homepage" /></span>--}} </a>
      </div>

      <div class="navbar-collapse">

        <ul class="navbar-nav mr-auto mt-md-0 ">
          <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
          <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="icon-arrow-left-circle"></i></a> </li>



        </ul>

        <ul class="navbar-nav my-lg-0">

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{Auth::user()->avatar}}" alt="user" class="profile-pic" /></a>
            <div class="dropdown-menu dropdown-menu-right animated flipInY">
              <ul class="dropdown-user">
                <li>
                  <div class="dw-user-box">
                    <div class="u-img"><img src="https://daryn.online{{Auth::user()->avatar}}" alt="user"></div>
                    <div class="u-text">
                      <h4>{{Auth::user()->name}}</h4>
                      <p class="text-muted">{{Auth::user()->login}}</p>{{--<a href="#" class="btn btn-rounded btn-danger btn-sm">View Profile</a>--}}</div>
                  </div>
                </li>
                <li role="separator" class="divider"></li>
                <li><a href="/admin/password"><i class="ti-settings"></i> {!!Lang::get('app.change_password')!!}</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="/admin/logout"><i class="fa fa-power-off"></i> {!!Lang::get('app.logout')!!}</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <strong style="color: white; text-decoration: underline">{!!Lang::get('app.lang')!!}</strong></a>
            <div class="dropdown-menu  dropdown-menu-right animated bounceInDown">
              <a class="dropdown-item" href="{{\App\Http\Helpers::setSessionLang('kk',$request)}}"> Қазақша</a>
              <a class="dropdown-item" href="{{\App\Http\Helpers::setSessionLang('ru',$request)}}"> Орысша</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  @include('admin.layout.sidebar.admin')

  <div class="page-wrapper">

    @yield('content')

    <footer class="footer">
      © {{date('Y')}}
    </footer>

  </div>
</div>

<script src="/admin/assets/plugins/jquery/jquery.min.js"></script>
<script src="/admin/assets/plugins/bootstrap/js/tether.min.js"></script>
<script src="/admin/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<script src="/admin/js/jquery.slimscroll.js"></script>
<script src="/admin/js/waves.js"></script>
<script src="/admin/js/sidebarmenu.js"></script>
<script src="/admin/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
<script src="/admin/js/custom.min.js"></script>

{{--<script type="text/javascript" src="/custom/wysiwyg/kindeditor.js?v=5"></script>
<script type="text/javascript" src="/custom/wysiwyg/ru_Ru.js?v=1"></script>--}}
<script type="text/javascript" src="/custom/js/jquery.gritter.js"></script>

<script src="/custom/js/admin.js?v=18"></script>

{{--@if(!isset($_COOKIE['show_info_modal_olympiad_teacher']))

  <div id="modal_after_olympiad_teacher" class="modal fade modal-css"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog">
      <div class="modal-content">
        <form>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <div>
              "Кемеңгер ұстаз" олимпиадасының басталғанын хабарлаймыз.
              15-мамырға дейін қатысып үлгеріңіз.
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Закрыть</button>
            <a class="mb-10" href="https://daryn.online/olympiad" target="_blank">
              <button class="btn btn-danger waves-effect waves-light" type="button">Олимпиадаға қатысу</button>
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>


  <script>

    var date = new Date();
    date.setTime(date.getTime()+(60*24*60*60*1000));
    var expires = "; expires="+date.toGMTString();
    document.cookie = "show_info_modal_olympiad_teacher=1; expires=" + expires;

    $('#modal_after_olympiad_teacher').modal('show');
  </script>

@endif--}}

@yield('js')

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
  (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
    m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
  (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

  ym(61902051, "init", {
    clickmap:true,
    trackLinks:true,
    accurateTrackBounce:true,
    webvisor:true
  });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/61902051" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-92SDW7P3BP"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-92SDW7P3BP');
</script>

</body>

</html>

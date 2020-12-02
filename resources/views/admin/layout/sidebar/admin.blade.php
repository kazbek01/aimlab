<aside class="left-sidebar">
  <div class="scroll-sidebar">
    <div class="user-profile">
      <div class="profile-img"> <img src="https://daryn.online{{Auth::user()->avatar}}" alt="user" /> </div>
      <div class="profile-text"> <a href="#" class="dropdown-toggle link u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">{{Auth::user()->name}} <span class="caret"></span></a>
        <div class="dropdown-menu animated flipInY {{Auth::user()->role_id}}">
          <div class="dropdown-divider"></div> <a href="/admin/password" class="dropdown-item"><i class="ti-settings"></i> Құпия сөзді ауыстыру</a>
          <div class="dropdown-divider"></div> <a href="/admin/logout" class="dropdown-item"><i class="fa fa-power-off"></i> Шығу</a>
        </div>
      </div>
    </div>
    <nav class="sidebar-nav">
      <ul id="sidebarnav" style="padding-bottom: 140px">

        <li>
          <a class="@if(isset($menu) && $menu == 'category') active @endif" href="/admin/category" >
            <i class="mdi mdi-video"></i><span class="hide-video">Категория</span>
          </a>
        </li>
        <li>
          <a class="@if(isset($menu) && $menu == 'products') active @endif" href="/admin/products" >
            <i class="mdi mdi-video"></i><span class="hide-video">Продукты</span>
          </a>
        </li>
        <li>
          <a class="has-arrow @if(isset($menu) && $menu == 'order') active @endif" href="#" aria-expanded="false">
            <?php $count = \App\Models\Order::where('is_show','=','0')->count();?>
            <i class="mdi mdi-message"></i><span class="hide-menu">Заявки <span @if($count > 0) style="display: block" @endif class="label label-rounded label-success">{{$count}}</span></span>
          </a>
          <ul aria-expanded="false" class="collapse">
            <li><a href="/admin/order?active=0" class="active">Непрочитанные</a></li>
            <li><a href="/admin/order">Прочитанные</a></li>
          </ul>
        </li>
        <li>
          <a class="@if(isset($menu) && $menu == 'banner') active @endif" href="/admin/banner" >
            <i class="mdi mdi-image"></i><span class="hide-video">Слайдер</span>
          </a>
        </li>
        <li>
          <a class="@if(isset($menu) && $menu == 'project') active @endif" href="/admin/project" >
            <i class="mdi mdi-image"></i><span class="hide-video">Проекты</span>
          </a>
        </li>
        <li>
          <a class="@if(isset($menu) && $menu == 'service') active @endif" href="/admin/service" >
            <i class="mdi mdi-image"></i><span class="hide-video">Услуги</span>
          </a>
        </li>
        <li>
          <a class="@if(isset($menu) && $menu == 'news') active @endif" href="/admin/news" >
            <i class="mdi mdi-image"></i><span class="hide-video">Новости</span>
          </a>
        </li>
        <li>
          <a class="@if(isset($menu) && $menu == 'password') active @endif" href="/admin/password" >
            <i class="mdi mdi-settings"></i><span class="hide-menu">{!!Lang::get('app.change_password')!!}</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>

  <div class="sidebar-footer">
    <!-- item-->
    <a href="/admin/password" class="link" data-toggle="tooltip" title="{!!Lang::get('app.change_password')!!}"><i class="ti-settings"></i></a>
    <!-- item-->
    <!-- item-->
    <a href="/admin/logout" class="link" data-toggle="tooltip" title="{!!Lang::get('app.logout')!!}"><i class="mdi mdi-power"></i></a>
  </div>

</aside>
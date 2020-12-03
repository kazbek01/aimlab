<section class="panel">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="dropdown dropdown-category @if(isset($menu) && $menu == 'index') dropdown-main @endif">
                    <button class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" id="dropdownCategory">
                        <span>Категории</span>
                        <svg width="18" height="10" viewBox="0 0 18 10" class="arrDown" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1L9 9L17 1" stroke="#777777"/>
                        </svg>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownCategory">

                        <?php
                        $categories = \App\Models\Category::getCategories();
                        ?>
                        @foreach($categories['categories'] as $item)
                            @if(count($categories['subcategories'][$item->category_id]) == 0)
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
                                        @foreach($categories['subcategories'][$item->category_id] as $subItem)
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

            </div>
            <div class="col-lg-9 col-md-8">
                <form action="/search">
                    <div class="search-cover">
                        <button class="btn-plain btn-search" type="submit">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M17 17L13.24 13.24M13.2443 3.1008C16.0454 5.90186 16.0454 10.4433 13.2443 13.2443C10.4433 16.0454 5.90186 16.0454 3.1008 13.2443C0.299734 10.4433 0.299734 5.90186 3.1008 3.1008C5.90186 0.299734 10.4433 0.299734 13.2443 3.1008Z"
                                      stroke="#777777" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <input type="text" placeholder="Поиск" name="search">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
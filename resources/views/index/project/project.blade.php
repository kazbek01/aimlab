@extends('index.layout.layout')

@section('meta-tags')

    <title>{{$menu['menu_meta_title_'.$lang]}}</title>
    <meta name="description" content="{{$menu['menu_meta_description_'.$lang]}}"/>
    <meta name="keywords" content="{{$menu['menu_meta_keywords_'.$lang]}}"/>

@endsection


@section('content')

    <section class="projects projects-only">
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

    {{ $project->links() }}

@endsection


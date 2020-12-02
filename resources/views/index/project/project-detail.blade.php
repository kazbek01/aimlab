@extends('index.layout.layout')

@section('meta-tags')

    <title>{{$menu['menu_meta_title_'.$lang]}}</title>
    <meta name="description" content="{{$menu['menu_meta_description_'.$lang]}}"/>
    <meta name="keywords" content="{{$menu['menu_meta_keywords_'.$lang]}}"/>

@endsection


@section('content')

    <section class="cart news">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Проекты</li>
                </ol>
            </nav>
            <article class="article-white">
                <h1>{{ $project->project_name }}</h1>
                <p>
                    {{ $project->project_desc }}
                </p>
                {!! $project->project_text  !!}

            </article>
        </div>
    </section>

@endsection


@extends('master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-1">
            <div class="news-item-container">
                <div id="news-item-header">
                    <h1>{{ $news->title }}</h1>
                    <a href="/news/edit/{{ $news->id }}">Edit</a>
                </div>

                <div id="news-item-body">
                    <img class="img-responsive pull-left" src="http://{{ $news->image_url }}" height="400" width="600">
                    <div class="news-intro">
                        <p>{{ $news->intro }}</p>
                    </div>
                    <div class="news-body">
                       {!! $news->body !!}
                    </div>
                </div>
            </div>
        </div>

        @include('partials.sidebar')
    </div>
</div>
@stop
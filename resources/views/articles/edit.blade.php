@extends('master')

@section('header')
Update Post
@stop

@section('content')
<h1>Edit: {!! $article->title !!}</h1>

{!! Form::model($article,['method'=>'PATCH','url'=>'articles/'.$article->id]) !!}
    
    @include ('articles.partials.articleform')
    <div class="form-group">
        {!! Form::submit('Update Article',['class'=>'btn btn-primary form-control']) !!}
    </div>

{!! Form::close() !!}

@include ('errors.list')
@stop
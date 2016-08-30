@extends('master')

@section('header')
My Blogposts
@stop

@section('content')
<ul>
   @foreach ($articles as $article)
       <li><a href="/articles/{{$article->id}}">{{$article->title}}</a></li>
   @endforeach
</ul>
@stop
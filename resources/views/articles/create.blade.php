@extends('master')

@section('header')
Create a blogpost
@stop

@section('content')
<h2>Write an Article</h2>
<hr/>

{!! Form::open(['url'=>'articles']) !!}

    @include('articles.partials.articleform')

    <div class="form-group">
        {!! Form::submit('Add Article',['class'=>'btn btn-primary form-control']) !!}
    </div>

{!! Form::close() !!}

@if ($errors->any())
<ul class="alert alert-danger">
    @foreach($errors->all() as $error)
        <li style="list-style-type: none">{{ $error }}</li>
    @endforeach
</ul>
@endif
@stop


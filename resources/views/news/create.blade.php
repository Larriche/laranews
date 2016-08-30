@extends('master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-1">
                <h3 class="form-header">Publish News</h3>
                <hr />

                @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li style="list-style-type: none">{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
				        
                 <form method="POST" action="{{ url('/news/') }}" accept-charset="UTF-8" class="form" role="form" enctype="multipart/form-data">

                  <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    
                  <div class="form-group">  
                    <label for="title">Title:</label>
                    <input type="text" name="title" class="form-control"> 
                  </div>

                  <div class="form-group">
                    <label for="intro">Intro:</label>
                    <textarea name="intro" rows="10" class="form-control"></textarea>
                  </div> 

                  <div class="form-group">
                    <label for="body">Body:</label>
                     <textarea name="body" rows="20" class="form-control"></textarea>             
                 </div>

                  <div class="form-group">
                    <label for="tags">Tags:</label>
                    <input type="text" name="tags" placeholder="Separate with commas" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="image">Featured Image:</label>
                    <input type="file" name="image" class="form-control">
                  </div>

                  <div class="form-group">
                    <input type="checkbox" name="publish"> Publish
                  </div>

                  <div class="form-group">
                     <input type="submit" class="btn btn-primary" value="Submit" style="float:right">
                  </div>

                {!! Form::close() !!}
            </div>

            @include('partials.sidebar');
        </div>
    </div>
@stop

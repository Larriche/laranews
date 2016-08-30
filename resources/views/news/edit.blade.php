@extends('master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-1" id="edit-form-container">
                  <img src="http://{{ $news->image_url }}" width="600" height="400"
                    class="img-responsive"/>

                    <form method="POST" action="{{ url('/news/edit', [$news->id]) }}" accept-charset="UTF-8" class="form" role="form" enctype="multipart/form-data">

                    <input name="_token" type="hidden" value="{{ csrf_token() }}">


					<div class="form-group">
                        <label for="title">Change featured image:</label>
					    <input name="image" type="file" class="form-control">
				    </div>


					<div class="form-group">
						<label for="title">Title:</label>
						<input type="text" name="title" class="form-control" 
						 value="{{ $news->title }}">
					</div>

					<div class="form-group">
						<label for="intro">Intro:</label>
						<textarea name="intro" class="form-control" rows="10">
						  {{ $news->intro }}</textarea>
					</div>

					<div class="form-group">
						<label for="body">Body:</label>
						<textarea name="body" class="form-control" rows="20">
							{{ $news->body }};
						</textarea>
					</div>

					<div class="form-group">
                        <input type="checkbox" name="publish"> Publish
                    </div>
					<div class="form-group col-sm-12">
                      <button type="submit" class="btn btn-primary" style="float: right">Update</button>
                    </div>

					</form>
            </div>

            @include('partials.sidebar')
        </div>
    </div>
@stop


@extends('master')

@section('content')
<div id="main-container" class="container-fluid">
   <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach($news as $newsitem)
		        <div class="row news-item">
		          <div class="col-md-4">
		            <img src="http://{{ $newsitem->image_url }}" width="250" height="250"/>
		          </div>

		          <div class="col-md-8">
		            <h2 class="newsitem-title">{{ $newsitem->title }}</h3>
		            <hr />
			        <p class="newsitem-intro">{{ $newsitem->intro }}</p>

			        <nav class="news-nav">
			          <ul>
			            <li><a href="/news/{{$newsitem->id}}">Read More</a></li>
			            <li><a href="/news/pdf_download/{{$newsitem->id}}">Download PDF</a></li>
			          </ul>
			        </nav>
		          </div>
		        </div>
	        @endforeach
	    </div>
   </div>
</div>
@stop


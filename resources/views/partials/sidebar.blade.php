<div class="col-md-3 col-md-offset-2">
  <div class="menu">
    <h3>My Published News Articles</h3>
    <hr />
    @if(!$published->isEmpty())
      @foreach($published as $news)
        <div class="menu-group">
          <p>
            <a href="/news/admin_view/{{$news->id}}">{{ $news->title }}</a> 
          </p>

          <p>
            <a href="{{ url('/news/make_unpublished/'.$news->id) }}" class="action-link">Make Unpublished</a>
          </p>
        </div>
      @endforeach
    @else
      <p>No articles in this category</p>
    @endif

  </div>

  <div class="menu">
    <h3>My Pending News Articles</h3>
    <hr />
      @if(!$unpublished->isEmpty())
        @foreach($unpublished as $news)
          <div class="menu-group">
             <p><a href="/news/admin_view/{{$news->id}}">{{ $news->title }}</a></p>

             <p>
               <a href=" {{ url('news/edit/'.$news->id) }}" class="action-link">Edit</a>
               <a href=" {{ url('/news/delete/'.$news->id) }}" class="delete-link">Delete</a>
             </p>
          </div>
        @endforeach
      @else
        <p>No posts in this category</p>
      @endif
  </div>
</div>
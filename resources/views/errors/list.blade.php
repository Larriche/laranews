@if ($errors->any())
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert"
	    aria-hidden="true">
	    &times;
	</button>
    <ul>
    @foreach($errors->all() as $error)
        <li style="list-style-type: none">{{ $error }}</li>
    @endforeach
    </ul>
</div>
@endif
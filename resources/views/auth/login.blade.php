@extends('master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 signup-form-container">
                <h3 class="form-header"> Log In</h3>
                <hr />

                @include('errors.list')
                
                 <form role="form"  method="POST" action="/auth/login">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Email">
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>

                    <input type="submit" value="Log In" class="btn btn-primary" style="float : right">
                </form>
                
            </div>
        </div>
    </div>
@stop
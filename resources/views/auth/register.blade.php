@extends('master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 signup-form-container">
                <h3 class="form-header"> Sign Up with The Gong</h3>
                <hr />

                @include('errors.list')
                
                <form role="form"  method="POST" action="/auth/register" id="signup-form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <label for="name" class="col-sm-4 control-label">Name:</label>
                    <div class="form-group col-sm-8">
                        <input type="text" name="name" class="form-control">
                    </div>

                    <label for="email" class="col-sm-4 control-label">Email:</label>
                    <div class="form-group col-sm-8 control-label">
                        <input type="text" name="email" class="form-control">
                    </div>

                    <label for="password" class="col-sm-4 control-label">Password:</label>
                    <div class="form-group col-sm-8 control-label">
                        <input type="password" name="password" class="form-control">
                    </div>

                    <label for="password_confirmation" class="col-sm-4 control-label">Confirm Password:</label>
                    <div class="form-group col-sm-8 control-label">
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <div class="form-group col-sm-12">
                        <button type="submit" class="btn btn-default" style="float: right">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@extends('layouts.blog')
@section('title')
    REGISTER FORM
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>REGISTER FORM</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form method="POST" action="{{route('register')}}">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name">
                        </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        <label for="password-confirm" class="form-label">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>  
            </div>
        </div>
       
    </div>

@endsection
@extends('layouts.layout')

@section('title')@parent:: {{'Send Mail'}} @endsection

@section('header')
    @parent
@endsection

@section('content')
    <div class="container">

        <form action="/send" method="post">

            @csrf

            <div class="form-group">
                <label for="name">Your name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>

            <div class="form-group">
                <label for="email">Your email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <div class="form-group">
                <label for="text">Your message</label>
                <textarea rows="5" type="text" class="form-control" id="text" name="text"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Send</button>

        </form>

    </div>
@endsection


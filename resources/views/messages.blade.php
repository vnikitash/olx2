@extends('layouts.app')

@section('content')

    <style>


    </style>

    <div class="container">
        <h2>{{$title}}</h2>
        <div class="row">
            <div class="message_left">LEFT</div>
        </div>
        <div class="row">
            <div class="message_right">RIGHT</div>
        </div>
        <div class="row">
            <div class="message_left">LEFT</div>
        </div>


        <div style="bottom: 0;position: fixed;width: 100%;">
            <textarea id="message" style="width: 100%" class="form-control"></textarea>
            <button class="btn btn-success">Send</button>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
    <table class="table table-dark advertisements_table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">User_id</th>
            <th scope="col">Price</th>
            <th scope="col">Category</th>
            @if ($chatId)
                <th scope="col">Subscribe</th>
            @endIf
        </tr>
        </thead>
        <tbody>
        @foreach($advertisements as $advertisement)
            <tr>
                <td>{{$advertisement->id}}</td>
                <td>{{$advertisement->title}}</td>
                <td>{{$advertisement->description}}</td>
                <td>{{$advertisement->user_id}}</td>
                <td>{{$advertisement->price}}</td>
                <td>{{$advertisement->category_id}}</td>
                @if ($chatId)
                    <td><button class="btn btn-success" onclick="sendSubscribeRequest({{$chatId}}, {{$advertisement->id}})">Subscribe</button></td>
                @endIf
            </tr>
        @endforeach
        </tbody>
        {{$advertisements->links()}}
    </table>
    </div>


    <script>


        function sendSubscribeRequest(chatId, advertisementId)
        {

            console.log(chatId, advertisementId);

            let xhr = new XMLHttpRequest();
            xhr.open("POST", '/subscribe', true);

            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() { // Call a function when the state changes.
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    // Request finished. Do processing here.
                }
            };

            xhr.send("chatId=" + chatId + "&advertisementId=" + advertisementId);
        }

    </script>
@endsection
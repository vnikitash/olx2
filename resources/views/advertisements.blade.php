@extends('layouts.app')

@section('content')

    <div id="modal" style="     
                                    display: none;
                                    text-align: center;
                                    position: fixed;
                                    width: 200px;
                                    height: 140px;
                                    background-color: #f7f7f7;
                                    border: 1px solid black;
                                    border-radius: 10px;
                                    top: 50%;
                                    left: 50%;
                                    margin-top: -100px;
                                    margin-left: -100px;
    ">
        <button class="btn btn-small" style="float: right;" onclick="closeSendMessageModal()">X</button>
        <form class="form-group">
            <textarea name="message" class="form-control" style="width: 100%;"></textarea>
            <input type="submit" class="btn btn-success" value="send">
        </form>
    </div>

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
            @if(request()->user())
                <th scope="col">Message</th>
            @endif
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
                @if(request()->user())
                    <td><button class="btn btn-warning" onclick="showSendMessageModal({{$advertisement->id}})">Send message</button></td>
                @endif
                @if ($chatId)
                    @if ($advertisement->subscriptions->isEmpty())
                    <td><button class="btn btn-success" onclick="sendSubscribeRequest({{$chatId}}, {{$advertisement->id}})">Subscribe</button></td>
                        @else
                        <td><button class="btn btn-danger">Unsubscribe</button></td>
                        @endif
                @endIf
            </tr>
        @endforeach
        </tbody>
        {{$advertisements->links()}}
    </table>
    </div>


    <script>

        function closeSendMessageModal()
        {
            document.getElementById("modal").style.display = 'none';
        }

        function showSendMessageModal(advertisementId)
        {
            document.getElementById("modal").style.display = 'block';
        }

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
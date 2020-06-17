<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<table class="table table-dark advertisements_table">
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">User_id</th>
        <th scope="col">Price</th>
        <th scope="col">Category</th>
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
    </tr>
    @endforeach
    </tbody>
    {{$advertisements->links()}}
</table>
</body>
</html>

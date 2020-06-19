@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <th>User</th>
                <th>Subject</th>
                <th>Last Message</th>
                <th>View</th>
            </thead>
            <tbody>
                <tr>
                    <td>some@example.com</td>
                    <td>iPhone 3Gs</td>
                    <td>Привет!</td>
                    <td><a href="/advertisements/5/messages?user_id=1" class="btn btn-success">Go</a></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

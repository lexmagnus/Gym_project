@extends('layouts.appadmin')

@section('AdminContent')
    <h2>Clientes</h2>
    <div>
    <table class="clienttab">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        @foreach($users as $client)
        <tr>
            <td>{{$client->id}}</td>
            <td>{{$client->username}}</td>
            <td><button class="edit-modal btn btn-info" data-id="{{$client->id}}"
                    data-name="{{$client->name}}">
                    <span class="glyphicon glyphicon-edit"></span> Edit
                </button>
                <button class="delete-modal btn btn-danger" data-id="{{$client->id}}"
                    data-name="{{$client->name}}">
                    <span class="glyphicon glyphicon-trash"></span> Delete
                </button></td>
        </tr>
        @endforeach
    </table>
</div>





@endsection
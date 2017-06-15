@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>IP</th>
                            <th>Last activity</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th>{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->getLastIP()}}</td>
                                <td>{{$user->getLastActivity()}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

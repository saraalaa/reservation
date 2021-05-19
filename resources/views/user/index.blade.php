@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Users</div>
                <div class="card-body">
                    @if(count($users))
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>type</th>
                                    <th>email</th>
                                    <th class="text-center">edit</th>
                                    <th class="text-center">ban</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->type}}</td>
                                        <td>{{$user->email}}</td>
                                        <td class="text-center">
                                            <a href="{{url('/users/'.$user->id.'/edit')}}"
                                               class="btn btn-dark btn-xs" ><i class="fa fa-edit"> </i></a></td>
                                        <td class="text-center">
                                            @if(!$user->is_ban)
                                                <a href="users/{{$user->id}}/ban" class="btn btn-xs btn-danger"><i class="fa fa-close"></i> ban</a>
                                            @else
                                                <a href="users/{{$user->id}}/unban" class="btn btn-xs btn-dark"><i class="fa fa-check"></i> unban</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="">{{ $users->links() }}</div>
                        </div>
                    @else
                        no users
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

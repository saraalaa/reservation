@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Doctors</div>
                <div class="card-body">
                    @if(count($doctors))
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>speciality</th>
                                    <th>email</th>
                                    <th>fees</th>
                                    <th>description</th>
                                    @if(auth()->user()->type == 'backoffice')
                                        <th class="text-center">approve</th>
                                    @elseif(auth()->user()->type == 'user')
                                        <th class="text-center">reserve</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($doctors as $doctor)
{{--                                    {{dd($doctor)}}--}}
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$doctor->name}}</td>
                                        <td>{{$doctor->profileDoctor->speciality}}</td>
                                        <td>{{$doctor->email}}</td>
                                        <td>{{$doctor->profileDoctor->fees}}</td>
                                        <td>{{$doctor->profileDoctor->description}}</td>
                                        @if(auth()->user()->type == 'backoffice')
                                           @include('partials.approve_doctor')
                                        @elseif(auth()->user()->type == 'user')
                                            @include('partials.reserve')
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="">{{ $doctors->links() }}</div>
                        </div>
                    @else
                        no doctors
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

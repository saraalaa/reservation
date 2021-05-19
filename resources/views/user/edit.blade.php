@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Users</div>
                <div class="card-body">
                    <form action="{{url('/users/'.$user->id)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name"
                                   value="{{ old('name') ? old('name'):$user->name}}" id="name">
                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email"
                                   value="{{ old('email') ? old('email'):$user->email}}" id="email">
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        {{--<div class="form-group">--}}
                            {{--<label for="type">Type</label>--}}
                            {{--<select class="form-control" name="type" id="type">--}}
                                {{--@foreach($types=['user','backoffice','doctor'] as $type)--}}
                                    {{--<option {{($user->type==$type)?'selected':''}} value="{{$type}}">{{$type}}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                            {{--@error('type')--}}
                            {{--<small class="text-danger">{{ $message }}</small>--}}
                            {{--@enderror--}}
                        {{--</div>--}}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <button type="submit" class="btn btn-dark mt-4">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

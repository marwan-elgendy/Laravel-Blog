@extends('layouts.app')

@section('content')

   
            <div class="card">
                <div class="card-header">My Profile</div>

                <div class="card-body">
                    @include('partials.errors')
                <form action="{{route('users.update-profile')}}" method="post">
                @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                    </div>
                    
                    <div class="form-group">
                        <label for="about">About</label>
                    <textarea class="form-control" name="about" id="about" cols="30" rows="5" >{{$user->about}}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Update Profile</button>

                </form>
                </div>
            </div>
       

@endsection

@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end">
  <a href="{{route('users.add-user')}}" class="btn btn-success float-right mb-2">Add User</a> 
  </div>
    <div class="card card-default">
        <div class="card-header">Users</div>
        <div class="card-body">
         @if ($users->count() > 0)
         <table class="table">
          <thead>
            <th>image</th>
            <th>name</th>
            <th>Email</th>
            <th></th>
          </thead>
          <tbody>
            @foreach($users as $user)
               <tr>
                 <td>
                 <img width="40px" height="40px" style="border-radius:50%;" src="{{Gravatar::src($user->email)}}" alt="">
                 </td>
                 <td>
                   {{$user->name}}
                 </td>
                 <td>
                 {{$user->email}}
                 </td> 
                 <td>
                    @if (!$user->isAdmin())
                 <form action="{{route('users.make-admin',$user->id)}}" method="post"> 
                    @csrf
                    <button class="btn btn-success btn-sm" type="submit">Make Admin</button>
                </form>
                    @endif
                 </td>
               </tr>
            @endforeach
          </tbody>
      </table>
         @else
             <h3 class="text-center">No Users Yet</h3>
         @endif
           <!-- Modal -->
        <form action="" method="post" id="DeletePostForm">
        @csrf
        @method('DELETE')
        <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="DeleteModalLabel">Delete Post</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Are you sure you want to delete this post ?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No , go back</button>
                  <button type="submit" class="btn btn-danger">Yes , delete</button>
                </div>
              </div>
            </div>
          </div>
            </div>
        </div>
    </form>
    @endsection
    @section('scripts')
        <script>
            function handleDelete(id){
                var form = document.getElementById('DeletePostForm')
                form.action = '/posts/' + id 
                $('#DeleteModal').modal('show')
            }
        </script>
@endsection
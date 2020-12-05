@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end">
    <a href="{{route('posts.create')}}" class="btn btn-success float-right mb-2">Add Post</a> 
    </div>
    <div class="card card-default">
        <div class="card-header">Posts</div>
        <div class="card-body">
         @if ($posts->count() > 0)
         <table class="table">
          <thead>
            <th>image</th>
            <th>title</th>
            <th>category</th>
            <th></th>
          </thead>
          <tbody>
            @foreach($posts as $post)
               <tr>
                 <td>
                 <img src="{{asset('storage/' .$post->image)}}" width="120px" height="60px" alt="image">
                 </td>
                 <td>
                   {{$post->title}}
                 </td>
                 <td>
                 <a href="{{route('categories.edit',$post->category->id)}}">
                    {{$post->category->name}}
                   </a>
                 </td>
                 <td>
                   @if (!$post->trashed())
                   <a href="{{route('posts.edit',$post->id)}}" class="btn btn-info btn-sm">Edit</a>
                    @else
                    <form action="{{route('restore.update',$post->id)}}" method="post">
                    @csrf
                    @method('PUT')
                   <button type="submit" class="btn btn-info btn-sm">Recover</button>
                    </form>
                    @endif
                 </td>
                 <td>
                   <button onclick="handleDelete({{$post->id}})" class="btn btn-danger btn-sm">
                   {{$post->trashed() ? 'Delete' : 'Trash'}}
                   </button>
                 </td>
               </tr>
            @endforeach
          </tbody>
      </table>
         @else
             <h3 class="text-center">No Posts Yet</h3>
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
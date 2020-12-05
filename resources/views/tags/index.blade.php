@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end">
<a href="{{route('tags.create')}}" class="btn btn-success float-right mb-2">Add tag</a> 
</div>
<div class="card card-default">
    <div class="card-header">tags</div>
    <div class="card-body">
       @if ($tags->count() > 0)
       <table class="table">
        <thead>
            <th>Name</th>
            <th>Posts Count</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
                <tr>
                    <td>
                        {{$tag->name}}
                    </td>
                    <td>
                      {{$tag->posts->count()}}
                    </td>
                    <td>
                    <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-info btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm" onclick="handleDelete({{$tag->id}})">Delete</button>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
       @else
          <h3 class="text-center">No tags yet</h3>
       @endif
       <!-- Modal -->
    <form action="" method="post" id="DeletetagForm">
    @csrf
    @method('DELETE')
    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="DeleteModalLabel">Delete tag</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure you want to delete this tag ?
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
            var form = document.getElementById('DeletetagForm')
            form.action = '/tags/' + id 
            $('#DeleteModal').modal('show')
        }
    </script>
@endsection
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end">
<a href="{{route('categories.create')}}" class="btn btn-success float-right mb-2">Add Category</a> 
</div>
<div class="card card-default">
    <div class="card-header">Categories</div>
    <div class="card-body">
       @if ($categories->count() > 0)
       <table class="table">
        <thead>
            <th>Name</th>
            <th>Posts Count</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>
                        {{$category->name}}
                    </td>
                    <td>
                      {{ $category->posts->count() }} 
                    </td>
                    <td>
                    <a href="{{route('categories.edit',$category->id)}}" class="btn btn-info btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm" onclick="handleDelete({{$category->id}})">Delete</button>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
       @else
          <h3 class="text-center">No categories yet</h3>
       @endif
       <!-- Modal -->
    <form action="" method="post" id="DeleteCategoryForm">
    @csrf
    @method('DELETE')
    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="DeleteModalLabel">Delete Category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure you want to delete this category ?
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
            var form = document.getElementById('DeleteCategoryForm')
            form.action = '/categories/' + id 
            $('#DeleteModal').modal('show')
        }
    </script>
@endsection
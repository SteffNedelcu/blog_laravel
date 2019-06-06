
@extends('layouts.admin')
@section('content')

<div class="container-fluid">

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="#">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">{{$category->title}}</li>
</ol>
<a href="/admin/categories/{{$category->id}}/posts/create" class="btn btn-primary"><i class="fas fa-plus"> Add</i></a>
<!-- DataTables Example -->
@if($category->posts->count())
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>poza</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        @foreach($category->posts as $post)
                    <form action="/admin/categories/{{$post->id}}" method="POST" id="delete-{{$post->id}}">
                    @method('delete')
                    @csrf
                    </form>
                    <tr>
                        <td>{{$post->id}}</td>
                        <td><a href="/admin/categories/{{$category->id}}" class="">{{$post->title}}</a></td>
                        <td>{{$post->description}}</td>
                        <td>{{$post->poza}}</td>
                        <td>
                            <a href="/admin/posts/{{$post->id}}/edit" class=>Edit</a>
                            <a href="/admin/posts/{{$post->id}}" class="">View</a>
                            <a href="#" class="delete" data-id="{{$post->id}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach

        </tbody>
      </table>
    </div>
@endif

</div>
@endsection
@section('bottomscript')
<script>
    $('.delete').on('click',function(e){
        e.preventDefault();
        console.log($(this).data('id'));
        $('#delete-'+$(this).data('id')).submit();
    });
</script>
@endsection
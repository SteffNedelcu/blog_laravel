@extends('layouts.admin')
@section('content')

<div class="container-fluid">

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="#">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Tables</li>
</ol>
<a href="./categories/create" class="btn btn-primary"><i class="fas fa-plus"> Add</i></a>
<!-- DataTables Example -->
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        @foreach($categories as $i=>$category)
                    <form action="/admin/categories/{{$category->id}}" method="POST" id="delete-{{$category->id}}">
                    @method('delete')
                    @csrf
                    </form>
                    <tr>
                        <td>{{$category->id}}</td>
                        <td><a href="/admin/categories/{{$category->id}}" class="">{{$category->title}}</a></td>
                        <td>{{$category->description}}</td>
                        <td>
                            <a href="/admin/categories/{{$category->id}}/edit" class=>Edit</a>
                            <a href="/admin/categories/{{$category->id}}" class="">View</a>
                            <a href="#" class="delete" data-id="{{$category->id}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach

        </tbody>
      </table>
    </div>


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
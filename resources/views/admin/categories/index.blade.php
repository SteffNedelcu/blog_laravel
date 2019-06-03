@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title ">Categories</h4>
            <p class="card-category">List all categories</p>
            <a href="./categories/create" class="btn btn-default btn-round"><i class="material-icons">add</i></a>
        </div>
      
        <div class="card-body">
            <div class="table-responsive">
            <table class="table">
                <thead class=" text-primary">
                <th>
                    ID
                </th>
                <th>
                    Title
                </th>
                <th>
                    Description
                </th>
                <th>
                </th>
                </thead>
                <tbody>
                @foreach($categories as $i=>$category)
                <form action="/admin/categories/{{$category->id}}" method="POST" id="delete-{{$category->id}}">
                  @method('delete')
                  @csrf
                </form>
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->title}}</td>
                    <td>{{$category->description}}</td>
                    <td>
                        <a href="/admin/categories/{{$category->id}}/edit" class=>Edit</a>
                        <a href="/admin/categories/{{$category->id}}" class=>View</a>
                        <a href="#" class="delete" data-id="{{$category->id}}">Delete</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
   
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
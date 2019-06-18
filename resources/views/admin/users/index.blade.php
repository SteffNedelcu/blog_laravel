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
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        @foreach($users as $i=>$user)
                    <form action="/admin/users/{{$user->id}}" method="POST" id="delete-{{$user->id}}">
                    @method('delete')
                    @csrf
                    </form>
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role}}</td>
                        <td>
                            <a href="/admin/users/{{$user->id}}/edit" class="">Edit</a>
                            <a href="/admin/users/{{$user->id}}" class="">View</a>
                            <a href="#" class="delete" data-id="{{$user->id}}">Delete</a>
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
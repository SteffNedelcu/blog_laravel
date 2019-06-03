@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Add category</h4>
            </div>
            <div class="card-body">
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
                <form action="/admin/categories" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    
                    <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                    </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating">Description</label>
                        <input type="text" name="description" class="form-control" value="{{ old('description') }}">
                    </div>
                    </div>
                
                </div>
                <button type="submit" class="btn btn-primary pull-right">Create</button>
                <div class="clearfix"></div>
                </form>
            </div>
            </div>
        </div>

    </div>
</div>
@endsection
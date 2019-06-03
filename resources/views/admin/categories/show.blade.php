@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title ">{{$category->title}}</h4>
        </div>
      
        <div class="card-body">
            <div class="table-responsive">
                <p>{{$category->description}}</p>
            </div>
            <ul>
                @foreach($category->posts as $post)
                    <li>{{ $post->title }}</li>
                @endforeach
            </ul>
            
        </div>
        </div>
    </div>
   
    </div>
</div>
@endsection

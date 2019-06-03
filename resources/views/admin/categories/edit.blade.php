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
                  <form action="/admin/categories/{{$category->id}}" method="POST">
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                    <div class="row">
                      
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Title</label>
                          <input type="text" name="title" class="form-control" value="{{$category->title}}">
                        </div>
                      </div>
        
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Description</label>
                          <input type="text" name="description" class="form-control" value="{{$category->description}}">
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
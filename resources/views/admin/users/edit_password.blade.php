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
                  <h1>{{$user->username}}</h1>
                  <form action="/admin/users/{{$user->id}}/update-password" method="POST">
                  {{ csrf_field() }}
                  {{ method_field('PATCH') }}
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">New password</label>
                          <input type="password" name="password" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Repeat password</label>
                          <input type="password" name="password_confirmation" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Old password</label>
                          <input type="password" name="current-password" class="form-control">
                        </div>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>
@endsection
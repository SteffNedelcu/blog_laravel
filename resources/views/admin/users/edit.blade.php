@extends('layouts.admin')
@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Favorites</h4>
          </div>
          <div class="card-body">
            <div class="table">
              @if(count($user->favorites))
              <table>
                <thead>
                <tr>
                  <td>id</td>
                  <td>name</td>
                  <td>description</td>
                </tr>
                </thead>
                <tbody>

                    @foreach($user->favorites as $favorite)
                      <tr>
                        <td>{{$favorite->id}}</td>
                        <td>{{$favorite->title}}</td>
                        <td>{{$favorite->pivot->created_at}}</td>
                      </tr>

                    @endforeach

                </tbody>
              </table>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Add category</h4>
          </div>
          <div class="card-body">
            <form action="/admin/users/{{$user->id}}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
              <div class="row">

                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Username</label>
                    <input type="text" name="username" class="form-control" value="{{$user->username}}">
                  </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">email</label>
                  <input type="text" name="email" class="form-control" value="{{$user->email}}">
                </div>
              </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">First name</label>
                    <input type="text" name="firstname" class="form-control" value="{{$user->firstname}}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Last name</label>
                    <input type="text" name="lastname" class="form-control" value="{{$user->lastname}}">
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
    <div class="row"><div class="col-12"><div class="brn btndanger"><a href="/admin/users/{{$user->id}}/edit-password">Change password</a></div></div></div>
  </div>
@endsection
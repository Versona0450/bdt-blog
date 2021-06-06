@extends('layouts.admin')
@section('titlebar')
    User List
@endsection

@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User Admin List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Admin List</li>
            </ol>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col">
              @if (session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
              @endif
              @if (session('success'))
                  <div class="alert alert-secondary">{{ session('success') }}</div>
              @endif
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
         <div class="row">
             <div class="col">
                <form action="{{route('user.update', $user->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="card container">
                    <div class="row">
                        <div class="col mt-3">
                            <label>Username</label>
                            <input type="text" name="name" class="form-control" value="{{$user->name}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label>Role User</label>
                            <select class="form-control select" required name="role_id" style="width: 100%;">
                              @foreach ($role as $row)
                                <option value="{{$row->id}}" {{ $user->id == $row->id ? 'selected':'' }}>
                                    {{$row->name}}
                                </option>
                              @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
      </div>
    </section>
  </div>
@endsection
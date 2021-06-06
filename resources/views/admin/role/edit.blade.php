@extends('layouts.admin')
@section('titlebar')
    {{$role->name}} Role
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Role Permissions</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="{{route('role.index')}}">User Role</a></li>
              <li class="breadcrumb-item active">{{$role->name}}</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
               <div class="col">
                   <div class="card">
                       <div class="card-header">
                           {{$role->name}}
                       </div>
                       <div class="card-body">
                          <form action="{{route('role.update', $role->id)}}" method="POST">
                          @csrf
                          @method('PUT')
                            <input type="text" name="name" class="form-control" value="{{$role->name}}">
                            <br>
                            <div class="select2-primary">
                              @foreach ($permissions as $row)
                              <input type="checkbox" name="permissions[]" value="{{$row->id}}"
                                      @foreach($role->permissions as $value)
                                          @if($row->id == $value->id)
                                           checked
                                          @endif
                                  @endforeach> &nbsp;{{$row->name}} <br>
                              @endforeach
                            </div>
                            <br>
                            <button class="btn btn-primary">
                              Update
                            </button>
                          </form>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </section>
</div>
 @endsection 
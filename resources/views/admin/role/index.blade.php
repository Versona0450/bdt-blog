@extends('layouts.admin')
@section('titlebar')
    Roles List
@endsection

@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Roles Admin List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">User Role</li>
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
        <div class="row mb-2 mt-5">
            <div class="col">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      Create New Role
                  </button>
             </div>
        </div>
      </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
               <div class="col">
                   <table class="table table-striped table-bordered">
                       <tr>
                           <th>#</th>
                           <th>Role</th>
                           <th>Created At</th>
                           <th>Action</th>
                       </tr>
                       <?php $n = 1; ?>
                       @foreach ($role as $row)
                           <tr>
                              <td>{{$n++}}</td>
                              <td>{{$row->name}}</td>
                              <td>{{$row->created_at}}</td>
                              <td>
                                <form action="{{ route('role.destroy', $row->id) }}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('role.edit', $row->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                      <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </div>
                                  </form>
                              </td>
                           </tr>
                       @endforeach
                   </table>
               </div>
            </div>
        </div>
    </section>
</div>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create New Role</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('role.store')}}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="form-label">Role Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group mb-4">
              <label class="form-label">Role Permission</label>
                <div class="row">
                  <div class="col">
                    @foreach ($permission as $item)
                        <input type="checkbox" name="permissions[]" value="{{$item->id}}"> &nbsp;{{$item->name}} <br>
                    @endforeach
                  </div>
                </div>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit">Create</button>
            </div>
         </form>
      </div>
    </div>
   </div>
  </div>
@endsection
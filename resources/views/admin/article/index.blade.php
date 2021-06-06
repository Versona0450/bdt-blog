@extends('layouts.admin')
@section('titlebar')
    All BDT Article
@endsection

@section('css')
<!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('plugins')}}/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection

@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Article List</h1><br>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Article</li>
            </ol>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col">
              @if (session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
              @endif
              @if (session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
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
             <div class="card container">
                <table class="table table-striped table-bordered table-hover mt-2" id="table2">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Thumbnail</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Tags</th>
                            <th>Author</th>
                            @if(Gate::check('isAdmin') || Gate::check('isPublisher'))
                            <th>Status</th>
                            @endif
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @forelse ($article as $item => $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>
                                  <img src="{{ asset('articles/posts/'.$row->thumbnail) }}" width="50px" alt=""> {{-- IMAGE --}}
                                </td>
                                <td>
                                  {{$row->title}} {{-- TITLE --}}
                                </td>
                                <td>
                                  {{$row->category->name}} {{-- CATEGORY --}}
                                </td>
                                <td>
                                    @foreach ($row->tags as $tag)
                                        <span class="badge badge-info">{{$tag->name}}</span> {{-- TAGS --}}
                                    @endforeach
                                </td>
                                <td>
                                  {{$row->user->name}} {{-- AUTHOR --}}
                                </td>

                                @if(Gate::check('isAdmin') || Gate::check('isPublisher'))
                                
                                <td> {{-- STATUS --}}
                                  <div class="btn-group">
                                
                                    @if ($row->status == 0)
                                
                                    <form action="{{route('article.publish', $row->id)}}" method="POST">
                                      @csrf
                                      @method('PUT')

                                      <button class="btn btn-secondary badge ">
                                          Draft
                                          <i class="fa fa-share"></i>
                                      </button>
                                      <span class="badge badge-secondary">
                                        {{$row->comments->count('id')}}
                                      </span>
                                    </form>
                                    @else
                                  
                                    <form action="{{route('article.cancel', $row->id)}}" method="POST">
                                      @csrf
                                      @method('PUT')
                                      <button class="btn btn-success badge">
                                        Published
                                        <i class="fa fa-share" style="transform: rotate(180deg);"></i>
                                      </button>
                                    </form>
                                    <span class="badge badge-success">
                                       {{$row->comments->count('id')}} {{-- TOTAL KOMENTAR --}}
                                    </span>
                                    
                                    @endif
                                  
                                  </div>
                                </td>
                                
                                @endif
                                
                                @if((Gate::check('Edit Article')) || Gate::check('Publish Article'))
                                {{-- ACTION --}}
                                <td> 
                                    <form action="{{ route('article.destroy', $row->id) }}" method="post">
	                                    @csrf
	                                    @method('DELETE')
	                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        @can('Edit Article')
                                        <a href="{{ route('article.edit', $row->id) }}" class="btn btn-warning btn-sm">
                                          <i class="fa fa-edit"></i>
                                        </a>
                                        @endcan
                                
                                        @can('Delete Article')
	                                    		<button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i></button>
                                        @endcan
                                        
                                        @if((Gate::check('View Article')) || Gate::check('Publish Article'))
                                          <a href="{{route('blog.show', $row->id)}}" class="btn btn-info" target="_blank">
                                            <i class="fa fa-copy"></i>
                                          </a>
                                        @endif
                                      </div>
	                                  </form>
                                </td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada Article</td>
                            </tr>
                            @endforelse
                    </tbody>
                </table>
                {{ $article->links() }}
             </div>
         </div>
        </div>
    </section>
  </div>
@endsection


@section('js')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('plugins')}}/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('plugins')}}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('plugins')}}/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{asset('plugins')}}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{asset('plugins')}}/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('plugins')}}/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script>
        $(function(){
            $('#table2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        })
    </script>
@endsection
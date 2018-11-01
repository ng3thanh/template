@extends('admin.layout')
@section('title', 'Blog list')

@section('css')
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box" style="padding:20px">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr class="header-table">
                                <th>ID</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Created date</th>
                                <th>Action</th>
                                <th>Delete</th>
                            </tr>
                            @foreach($blogs as $blog)
                                <tr class="body-table @if($blog->deleted_at) deleted_tr @endif">
                                    <td>{{ $number++ }}</td>
                                    <td class="text-left m-w-200">
                                        <a href="{{ route('blogs.detail', ['id' => $blog->id, 'slug' => $blog->slug]) }}" target="_blank">
                                            <span class="short-text">{{ $blog->title }}</span>
                                        </a>
                                    </td>
                                    <td>
                                        <img class="img-thumbnail" src='{{ asset("$blog->image") }}' width="50px" height="">
                                    </td>
                                    <td class="text-left m-w-400">
                                        <span class="short-text">{!! (strlen($blog->description) > 150) ? substr($blog->description, 0, 147) . ' ... ' : $blog->description !!}</span>
                                    </td>
                                    <td>
                                        {{ date('d/m/Y H:i', strtotime($blog->created_at)) }}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('blog.copy', $blog->id) }}" type="button" class="btn btn-default btn-sm"><i class="fa fa-copy"></i></a>
                                            <a href="{{ route('blog.edit', $blog->id) }}" type="button" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @if($blog->deleted_at)
                                                <form action="{{ route('blog.restore', $blog->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-spinner"></i></button>
                                                </form>
                                            @else
                                                <form action="{{ route('blog.destroy', $blog->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <div class="text-center">
                            {{
                                $blogs->appends([
                                    "title" => Request::get('title'),
                                    "status" => Request::get('status'),
                                    "end_date" => Request::get('end_date'),
                                    "menu" => Request::get('menu')
                                ])->links()
                            }}
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->


@endsection

@section('script')

@endsection

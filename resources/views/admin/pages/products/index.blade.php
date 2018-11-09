@extends('admin.layout')
@section('title', 'Product list')

@section('css')
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box" style="padding:20px">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr class="header-table">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Publish date</th>
                                <th>Action</th>
                                <th>Delete</th>
                            </tr>
                            @foreach($products as $product)
                                <tr class="body-table @if($product->deleted_at) deleted_tr @endif">
                                    <td>{{ $number++ }}</td>
                                    <td class="text-left m-w-200">
                                        <a href="{{ route('blogs.detail', ['id' => $product->id, 'slug' => $product->slug]) }}" target="_blank">
                                            <span class="short-text">{{ $product->title }}</span>
                                        </a>
                                    </td>
                                    <td>
                                        <img class="img-thumbnail" src='{{ $product->image }}' width="50px" height="">
                                    </td>
                                    <td>
                                        {{ date('d/m/Y H:i', strtotime($product->publish_date)) }}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('product.copy', $product->id) }}" type="button" class="btn btn-default btn-sm"><i class="fa fa-copy"></i></a>
                                            <a href="{{ route('product.edit', $product->id) }}" type="button" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @if($product->deleted_at)
                                                <form action="{{ route('product.restore', $product->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-spinner"></i></button>
                                                </form>
                                            @else
                                                <form action="{{ route('product.destroy', $product->id) }}" method="POST">
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
                                $products->appends([
                                    "title" => Request::get('title'),
                                    "status" => Request::get('status'),
                                    "end_date" => Request::get('end_date'),
                                    "menu" => Request::get('menu')
                                ])->links()
                            }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')

@endsection

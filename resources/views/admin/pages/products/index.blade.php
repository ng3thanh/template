@extends('admin.layout')
@section('title', 'Product list')

@section('css')
    <link rel="stylesheet" href="{{ asset('lib/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Search products</h3>
                    </div>
                    <div class="box-body">
                        <form id="search-form" action="{{ route('product.index') }}" method="get">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Product Code</label>
                                        <input type="text" id="code" class="form-control" name="code" placeholder="Example: PR001" value="{{ app('request')->input('code') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Language</label>
                                        <select id="locale" class="form-control select2 wp-100" name="locale">
                                            @foreach($languages as $key => $lang)
                                                <option value="{{ $key }}" @if(app('request')->input('locale') == $key) selected @endif>{{ $lang }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Product name</label>
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Product name" value="{{ app('request')->input('name') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Publish date:</label>

                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" name="publish" id="publish" value="{{ app('request')->input('publish') }}">
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" value="1" name="search">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-sm">Search</button>
                                &nbsp;&nbsp;&nbsp;
                                <button type="button" class="btn btn-sm" id="button-reset">Reset</button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="box-footer">
                        <table id="table-data" class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Publish date</th>
                                    <th>Action</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($products)
                                    @foreach($products as $product)
                                    <tr class="body-table @if($product->deleted_at) deleted_tr @endif">
                                        <td>{{ $product->id }}</td>
                                        <td class="text-left m-w-200">
                                            <a href="{{ route('blogs.detail', ['id' => $product->id, 'slug' => $product->slug]) }}" target="_blank">
                                                <span class="short-text">{{ $product->name }}</span>
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
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('lib/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('lib/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $('#table-data').DataTable({
            "pageLength" : 20,
            'lengthChange': false,
            'searching'   : false
        });

        $('#publish').daterangepicker();

        $('#button-reset').click(function () {
            var date = $.datepicker.formatDate('mm/dd/yy', new Date());
            $('#code').val("");
            $('#locale').val("vi");
            $('#name').val("");
            $('#publish').val(date + " - " + date);
        });
    </script>
@endsection

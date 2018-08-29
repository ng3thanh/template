@extends('admin.layout')
@section('title', 'Contact index')

@section('css')
@endsection
@php
    $from = $limit*($contacts->currentPage()-1) + 1;
    if ($contacts->currentPage() != $contacts->lastPage()) {
        $to = $limit*($contacts->currentPage()-1) + $limit;
    } else {
        $to = $contacts->total();
    }
@endphp
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Inbox</h3>

                        <div class="box-tools pull-right">
                            <div class="has-feedback">
                                <span>{{ $from }}-{{ $to }}/{{ $contacts->total() }}</span>
                            </div>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Status</th>
                                        <th>Customer name</th>
                                        <th>Content</th>
                                        <th>Attachment</th>
                                        <th>Time contact</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($contacts as $contact)
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td class="mailbox-star"><a href="#"><i class="fa {{ ($contact->status == 1) ? 'fa-star-o' : 'fa-star'  }} text-yellow"></i></a></td>
                                        <td class="mailbox-name"><a href="{{ route('contact.show', $contact->id) }}">{{ $contact->name }}</a></td>
                                        <td class="mailbox-subject">
                                            <b>{{ $contact->subject }}</b> - {{ (strlen($contact->content) > 50) ? substr($contact->content, 0, 47) . ' ... ' : $contact->content }}
                                        </td>
                                        <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                                        <td class="mailbox-date">{{ timeElapsedString($contact->created_at) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer no-padding">
                        <div class="mailbox-controls">
                            <div class="pull-right">
                                {{ $contacts->links() }}
                                <!-- /.btn-group -->
                            </div>
                            <!-- /.pull-right -->
                        </div>
                    </div>
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection

@section('script')

@endsection

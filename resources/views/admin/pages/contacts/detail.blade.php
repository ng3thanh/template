@extends('admin.layout')
@section('title', 'Contact detail')

@section('css')
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                @foreach($listFeedback as $day => $list)
                <!-- The time line -->
                <ul class="timeline">
                    <!-- timeline time label -->
                    <li class="time-label">
                        <span class="bg-red">{{ timeElapsedString($day) }}</span>
                    </li>
                    <!-- /.timeline-label -->
                    @foreach ($list as $feedback)
                    <!-- timeline item -->
                    <li>
                        <i class="fa fa-envelope bg-blue"></i>

                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> {{ dateFormat($feedback->created_at, 'H:i') }}</span>

                            <h3 class="timeline-header">
                                <a href="#">{{ $feedback->name }}</a> sent you an feedback: {{ $feedback->subject }}
                            </h3>

                            <div class="timeline-body">
                                {{ $feedback->content }}
                            </div>
                        </div>
                    </li>
                    <!-- END timeline item -->
                    @endforeach

                </ul>
                @endforeach
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection

@section('script')

@endsection

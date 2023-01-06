@extends('admin.layout')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box" style="margin-bottom:0px;">
                    <div style="display:flex; justify-content:space-between; padding:15px;">
                        <div>
                            <form id="form-search">
                                <div class="box-tools">
                                    <div class="input-group input-group-sm hidden-xs" style="width: 250px;">
                                        <input type="text" name="str" value="{{$_GET['str'] ?? ''}}" class="form-control pull-right"
                                               placeholder="Search">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="action" style="display:flex; justify-content:space-between">
                            <button type="button" onclick="document.getElementById('form-search').submit()" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Tìm
                                kiếm
                            </button>
                            @if(\Gate::allows('role', ['role' => ['admin','leader']]))
                                <a href="{{route('task.create')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>
                                    Thêm
                                    mới</a>
                            @endif

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Công việc
                        </h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button type="button" class="btn btn-sm" data-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-sm" data-widget="remove" data-toggle="tooltip"
                                    title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.box-header -->
                    <!-- /.box-header -->

                    <div class="box-body no-padding">

                        <table class="table">
                            <thead>
                            <tr>
                                <th style="width: 50px">#</th>
                                <th class="text-center">Dự án</th>
                                <th class="text-center">Nhân viên</th>
                                <th class="text-center">Tiêu đề</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center">Ngày bắt đầu</th>
                                <th class="text-center">Ngày kết thúc</th>
                                <th class="text-center">Ngày kết thúc thực tế</th>
                                <th class="text-center">Tỷ lệ hoàn thành</th>
                                <th class="text-center">Chi tiết</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($rows)&& $rows->count() > 0)
                                @foreach($rows as $key=> $item)
                                    @php $status_task = config('data.task_status')[$item->status] ?? []; @endphp
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td class="text-center">{{$item->project->name}}</td>
                                        <td class="text-center">{{$item->employee->name}}</td>
                                        <td class="text-center">{{$item->name}}</td>
                                        <td class="text-center">
                                             <span class="badge {{$status_task['class'] ?? ''}}">
                                            {{ $status_task['text'] ?? ''}}</span>
                                        </td>
                                        <td class="text-center">{{$item->intend_time_start}}</td>
                                        <td class="text-center">{{$item->intend_time_end}}</td>
                                        <td class="text-center">{{$item->end_date}}</td>
                                        <td class="text-center">{{$item->progress}} %</td>
                                        <td class="text-center">{{$item->note}}</td>
                                        <td>
                                            <div style="display:flex; width:50px;">
                                                <a href="{{route('task.show', ['task'=>$item])}}" class="view-progress" data-id="{{$item->id}}"
                                                   data-title="{{"Chi tiết công việc ngày {$item->time_start} - {$item->time_end}"}}"
                                                   style="margin-right: 5px;"><i
                                                        class="fa fa-external-link"></i></a>
                                                @if(\Gate::allows('role', ['role' => ['admin','leader']]))
                                                    <a href="{{route('task.edit', ['task'=>$item])}}"
                                                       style="margin-right: 5px;"><i
                                                            class="fa  fa-pencil-square"></i></a>
                                                    <form action="{{route('task.destroy', ['task'=>$item])}}">
                                                        <a class="btn-delete-record"><i class="fa  fa-times-circle"></i></a>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="text-center">
                                        Không tồn tại bản ghi nào
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                            <tfoot>
                            @if(!empty($rows)&& $rows->count() > 0)
                                <tr>
                                    <td colspan="11">
                                        {!! $rows->links() !!}
                                    </td>
                                </tr>
                            @endif
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
    </section>
@endsection

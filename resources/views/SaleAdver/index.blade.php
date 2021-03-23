@extends('layouts.masterPanelAdmin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        {{--                        <div class="row p-t-20">--}}
                        {{--                            <div class="col-md-5">--}}
                        {{--                                <div class="form-group">--}}
                        {{--                                    <div class="input-group search-input">--}}
                        {{--                                        <input type="text" class="form-control input-icon" id="search2"--}}
                        {{--                                               placeholder="جستجو ...">--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                            <!--/span-->--}}
                        {{--                            <div class="col-md-4">--}}
                        {{--                                <div class="form-group">--}}
                        {{--                                    <div class="input-group select3-box">--}}
                        {{--                                        <select class="form-control custom-select select-icon">--}}
                        {{--                                            <option value="">جستجو براساس ...</option>--}}
                        {{--                                            <option value="">تاریخ</option>--}}
                        {{--                                            <option value="">قیمت</option>--}}
                        {{--                                            <option value="">وضعیت</option>--}}
                        {{--                                        </select>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="col-md-3">--}}
                        {{--                                <div class="form-group">--}}
                        {{--                                    <div class="alert-top text-center alert-no-border bg-mashinchi add-factor-btn color-fff p-2 rounded">--}}
                        {{--                                        <a href="add-advertising.html">--}}
                        {{--                                            <img class="add-icon ml-1" src="assets/images/svg/Path%20638.svg">--}}
                        {{--                                            افزودن آگهی جدید--}}
                        {{--                                        </a>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}

                        {{--                        </div>--}}

                        <div class="table-responsive">
                            <table class="table table-expert-ok">
                                <thead class="bg-eaf color-mashinchi th-p15">
                                <tr>
                                    <th>#</th>
                                    <th> عنوان آگهی</th>
                                    <th>تاریخ انتشار</th>
                                    <th>وضعیت</th>
                                    <th>ویرایش</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($sales as $sale)
                                    <tr>
                                        <td>{{$sale->id}}</td>
                                        <td>
                                            {{$sale->adver->title}}
                                        </td>

                                        <td>
                                            {{$sale->created_at}}
                                        </td>

                                        <td>
                                            @include('panelAdmin.statussales')
                                        </td>

                                        <td class="edite-td">
                                            <a href="{{ route('sale.edit',$sale->id) }}" class="icon-box edite-icon"
                                               data-toggle="tooltip"
                                               data-original-title="ویرایش"></a>
                                            <a onclick="return confirm('آیا از حذف این آگهی اطمینان دارید؟');" href="{{route('sale.delete',$sale->id)}}"
                                               class="icon-box delete-icon"></a>
                                            {{--                                            <a href="#" class="btn waves-effect waves-light btn-rounded btn-info">ثبت--}}
                                            {{--                                                کارشناسی</a>--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            {{ $sales->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- End PAge Content -->
    </div>
@stop
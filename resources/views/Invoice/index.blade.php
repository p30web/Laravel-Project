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
                                    <th> #</th>
                                    <th>کد گزارش کارشناسی</th>
                                    <th> نام و نام خانوادگی</th>
                                    <th> شماره تلفن همراه</th>
                                    <th>مبلغ</th>
                                    <th>تاریخ ایجاد فاکتور</th>
                                    <th>وضعیت</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if (count($invoices) > 0)
                                    @foreach($invoices as $invoice)
                                        <tr>
                                            <td>
                                                {{$invoice->id}}
                                            </td>
                                            <td>
                                                @if (!empty($invoice->expert->status == 1))
                                                    <a target="_blank" style="font-family: Arial" href="{{route('expert.edit',$invoice->expert->id)}}">{{$invoice->expert->tracking_code}}</a>
                                                    @else
                                                    کارشناسی نشده
                                                @endif

                                            </td>
                                            <td>
                                                {{$invoice->name_family}}
                                            </td>
                                            <td>
                                                {{$invoice->user->phone_number}}
                                            </td>
{{--                                                                                                <td>--}}
{{--                                                                                                    پکیج کامل--}}
{{--                                                                                                </td>--}}

                                            <td>
                                                {{$invoice->total_amount}} تومان
                                            </td>
                                            <td>
                                                {{$invoice->updated_at}}
                                            </td>
                                            @if ($invoice->status == 0)
                                                <td class="failed-color">
                                                    پرداخت نشده
                                                </td>
                                                @elseif ($invoice->status == 1)
                                                <td class="success-color">
                                                    پرداخت شده
                                                </td>
                                            @endif
                                            <td class="failed-color">
                                                <a href="{{ route('invoice.edit',$invoice->id) }}"
                                                   class="icon-box edite-icon"></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td> -</td>
                                        <td> -</td>
                                        <td> -</td>
                                        <td>فاکتوری وجود ندارد.</td>
                                        <td> -</td>
                                        <td> -</td>
                                        <td> -</td>
                                        <td> -</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            {{ $invoices->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- End PAge Content -->
    </div>
@stop
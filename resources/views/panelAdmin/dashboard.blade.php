@extends('layouts.masterPanelAdmin')
@section ('customCss')
    <link href="{{asset('adminpanel/assets/plugins/morrisjs/morris.css')}}" rel="stylesheet">
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-xlg-7">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">بیشترین مدل های آگهی شده</h4>
                        <ul class="list-inline text-center m-t-20">
                            <li>
                                <h5><i class="fa fa-circle m-r-5" style="color: #0b62a4"></i>فراری</h5>
                            </li>
                            <li>
                                <h5><i class="fa fa-circle m-r-5" style="color: #7a92a3"></i>هیوندای</h5>
                            </li>
                            <li>
                                <h5><i class="fa fa-circle m-r-5" style="color: #4da74d"></i>هاوال</h5>
                            </li>
                        </ul>
                        <div id="period_brands_car"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xlg-5">
                <div class="card card-inverse bg-exprt">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7 align-self-center">
                                <h3 class="card-title color-000">خودروهای کارشناسی شده</h3>
                                <div class="box-exprt m-t-20 m-b-20">
                                    <div class="wrench-icon align-self-center"></div>
                                    <span class="font-bold m-r-15 number-wrench">{{$countExpertAdver}}</span>
                                </div>
                                <p class="m-b-5 m-t-10 color-000">
                                    تعداد خودرو های کارشناسی شده که دارای کدرهگیری می باشند.</p>
                            </div>

                            <div class="col-5 text-center align-self-center">
                                <div class="spark-count2"></div>
                            </div>

                        </div>

                    </div>
                </div>


                <div class="card card-inverse card-info">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7 align-self-center">
                                <h3 class="card-title color-fff">آگهی های ارسال شده</h3>
                                <div class="box-exprt m-t-20 m-b-20">
                                    <div class="notices-icon align-self-center"></div>
                                    <span class="font-bold color-fff m-r-15 number-wrench">{{$countSaleAdver}}</span>
                                </div>
                                <p class="m-b-5 m-t-10 color-fff"> تعداد آگهی های تایید شده که روی سایت فعال و قابل مشاهده می باشند.
                                </p>
                            </div>

                            <div class="col-5 text-center align-self-center">
                                <div class="spark-count"></div>
                            </div>

                        </div>

                    </div>
                </div>


            </div>
            <!-- Column -->
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            <i class="not-verified-icon m-l-5"></i>
                            <span class="vt text-info">آگهی های در انتظار تایید</span>
                        </h4>
                        <h6 class="card-subtitle"></h6>
                        <div class="table-responsive">
                            <table id="demo-foo-addrow" class="table table-ads-no m-t-10 contact-list"
                                   data-page-size="10">
                                <tbody>
                                @if (count($saleAdver) > 0)
                                    @foreach($saleAdver as $sale)
                                        <tr>
                                            {{--                                                <td>--}}
                                            {{--                                                    <a href="advertising-list.html"><img src="{{asset('adminpanel/assets/images/volvo@3x.png')}}" alt="user" width="40" class="img-circle"></a>--}}
                                            {{--                                                </td>--}}
                                            <td>
                                                <a href="{{ route('sale.edit',$sale->id) }}">
                                                    {{$sale->adver->title}}</a>
                                            </td>
                                            <td>{{$sale->created_at}}</td>
                                            <td>@include('panelAdmin.statussales')</td>
                                            <td>
                                                <a href="{{ route('sale.edit',$sale->id) }}"><i class="edite-icon"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td> -</td>
                                        <td> -</td>
                                        <td> آگهی برای تایید وجود ندارد</td>
                                        <td> -</td>
                                        <td> -</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            <i class="not-verified-icon m-l-5"></i>
                            <span class="vt text-info">آخرین آگهی های کارشناسی</span>
                        </h4>
                        <h6 class="card-subtitle"></h6>
                        <div class="table-responsive">
                            <table id="demo-foo-addrow" class="table table-ads-no m-t-10 contact-list"
                                   data-page-size="10">
                                <tbody>
                                @if (count($expertAdver) > 0)
                                    @foreach($expertAdver as $expert)
                                        <tr>
                                            <td>
                                                {{$expert->user->name}} {{$expert->user->family}}
                                            </td>
                                            <td>{{$expert->created_at}}</td>
                                            <td>@include('panelAdmin.statusexperts')</td>
                                            <td>
                                                <a href="{{ route('expert.edit',$expert->id) }}"><i
                                                            class="edite-icon"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td> -</td>
                                        <td> -</td>
                                        <td> آگهی برای تایید وجود ندارد</td>
                                        <td> -</td>
                                        <td> -</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            <i class="experts-icon m-l-5"></i>
                            <span class="vt text-info">لیست فاکتور ها</span>
                        </h4>
                        <h6 class="card-subtitle"></h6>
                        <div class="table-responsive">
                            <table id="demo-foo-addrow2" class="table table-ads-no m-t-10 contact-list"
                                   data-page-size="10">
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
                                                    <a target="_blank" style="font-family: Arial"
                                                       href="{{route('expert.edit',$invoice->expert->id)}}">{{$invoice->expert->tracking_code}}</a>
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
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            <i class="experts-icon m-l-5"></i>
                            <span class="vt text-info">آخرین کاربران ثبت نام شده</span>
                        </h4>
                        <h6 class="card-subtitle"></h6>
                        <div class="table-responsive">
                            <table id="demo-foo-addrow2" class="table table-ads-no m-t-10 contact-list"
                                   data-page-size="10">
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <a href="{{$user->id}}"><img
                                                        src="{{asset('adminpanel/assets/images/users/experts-img.png')}}"
                                                        alt="user" width="40" class="img-circle"></a>
                                        </td>
                                        <td>
                                            {{$user->name}} {{$user->family}}
                                        </td>
                                        <td>
                                            {{$user->phone_number}}
                                        </td>
                                        <td>{{$user->created_at}}</td>
                                        <td>
                                            <a href="{{ route('user.edit',$user->id) }}" class="icon-box edite-icon"
                                               data-toggle="tooltip"
                                               data-original-title="ویرایش"></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('customJs')
    <!--morris JavaScript -->
    <script src="{{asset('adminpanel/assets/plugins/raphael/raphael-min.js')}}"></script>
    <script src="{{asset('adminpanel/assets/plugins/morrisjs/morris.min.js')}}"></script>
    <!-- Chart JS -->
    <script src="{{asset('adminpanel/assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('adminpanel/assets/js/dashboard1.js')}}"></script>
@stop
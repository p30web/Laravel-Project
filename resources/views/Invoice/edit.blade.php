@extends('layouts.masterPanelAdmin')
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="col-lg-10 mx-auto">
                        <div class="card no-shadow rounded mt-5">
                            <div class="card-body ">
                                <div class="table-responsive no-over-flow">
                                    <table class="table color-table info-table">
                                        <thead class="text-center bg-mashinchi">
                                        <tr class="border">
                                            <th colspan="2" class="text-center">
                                                <img class="ml-2" src="{{asset('adminpanel/assets/images/svg/sabte_package.svg')}} ">
                                                مشاهده فاکتور گزارش کارشناسی  <a style="color:yellow" target="_blank" href="{{route('expert.edit',$expert->id)}}">شماره {{$expert->id}}</a>
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody class="border">
                                        @if ($invoice->user->name && $invoice->user->family)
                                            <tr>
                                                <td class="border-left ">
                                                    <img class="pl-2 svg-icons" src="{{asset('adminpanel/assets/images/svg/Group%207921.svg')}}">
                                                    نام و نام خانوادگی
                                                </td>
                                                <td>  {{$invoice->user->name}} {{$invoice->user->family}}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="border-left">
                                                <img class="pl-2 svg-icons" src="{{asset('adminpanel/assets/images/svg/Group%207922.svg')}}">
                                                شماره تلفن همراه
                                            </td>
                                            <td><a target="_blank" href="{{route('user.edit',$invoice->user->id)}}">{{$invoice->phone_number}}</a> </td>

                                        </tr>
                                        <tr>
                                            <td class="border-left">
                                                <img class="pl-2 svg-icons" src="{{asset('adminpanel/assets/images/svg/Group%207923.svg')}}">
                                                برند / مدل خودرو
                                            </td>
                                            <td>{{$expert->brand_id}} / {{$expert->model_id}}</td>
                                        </tr>

                                        <tr>
                                            <td class="border-left">
                                                <img class="pl-2 svg-icons" src="{{asset('adminpanel/assets/images/svg/Group%207925.svg')}}">
                                                تاریخ و ساعت رزرو شده
                                            </td>
                                            <td>{{$reserve['date']}} {{$reserve['time']}}</td>
                                        </tr>

                                        <tr>
                                            <td class="border-left">
                                                <img class="pl-2 svg-icons" src="{{asset('adminpanel/assets/images/svg/Group%207925.svg')}}">
                                                تاریخ و ساعت کارشناسی
                                            </td>
                                            <td>{{$expert->updated_at}}</td>
                                        </tr>
                                        @if (!empty($expert->chassisـnumber))
                                            <tr>
                                                <td class="border-left">
                                                    <img class="pl-2 svg-icons" src="{{asset('adminpanel/assets/images/svg/Group%207926.svg')}}">
                                                    شماره شاسی خودرو
                                                </td>
                                                <td style="font-family: Arial">{{$expert->chassisـnumber}}</td>
                                            </tr>
                                        @endif

                                        @if (!empty($expert->tracking_code))
                                            <tr>
                                                <td class="border-left">
                                                    <img class="pl-2 svg-icons" src="{{asset('adminpanel/assets/images/svg/Group%207926.svg')}}">
                                                    کد رهگیری گزارش کارشناسی
                                                </td>
                                                <td style="font-family: Arial"><a target="_blank" href="{{route('expert.edit',$expert->id)}}">{{$expert->tracking_code}}</a></td>
                                            </tr>
                                        @endif

                                            <tr>
                                                <td class="border-left">
                                                    <img class="pl-2 svg-icons" src="{{asset('adminpanel/assets/images/svg/Group%207926.svg')}}">
                                                    وضعیت کارشناسی
                                                </td>
                                                <td>
                                                    @if ($expert->status == 1)
                                                        کارشناسی شده
                                                        @elseif($expert->status == 0)
                                                        کارشناسی نشده
                                                    @endif
                                                </td>
                                            </tr>
                                        <tr>
                                            <td class="border-left">
                                                <img class="pl-2 svg-icons" src="{{asset('adminpanel/assets/images/svg/Group%207926.svg')}}">
                                                وضعیت پرداخت فاکتور
                                            </td>
                                            <td>
                                                @if ($invoice->status == 1)
                                                    <div class="label label-table label-success">پرداخت شده</div>
                                                @elseif ($invoice->status == 0)
                                                    <div class="label label-table label-danger">پرداخت نشده</div>
                                                @endif
                                            </td>
                                        </tr>


                                        <tr>
                                            <td class="border-left">
                                                <img class="pl-2 svg-icons" src="{{asset('adminpanel/assets/images/svg/Group%207928.svg')}}">
                                                پکیج های انتخابی
                                            </td>
                                            <td>
                                                <ul style="    line-height: 36px;margin: 0;">
                                                    @foreach ($packages as $package)
                                                        <li>{{$package->title}}</li>
                                                    @endforeach
                                                </ul>
                                            </td>

                                        </tr>
                                        <tr class="bg-mashinchi color-fff">
                                            <td class="border pr-4">
                                                جمع مبلغ <span style="    font-size: 0.75rem;
    margin-right: 7px;
    color: #dcf6ff;
    vertical-align: initial;">(شامل 9٪ مالیات بر ارزش افزوده)</span>
                                            </td>
                                            <td> {{$invoice->total_amount}} تومان</td>

                                        </tr>
                                        <tr style="background: #0b6786" class="color-fff">
                                            <td class="border pr-4">
                                                باقی مانده
                                            </td>
                                            <td> {{$sumUnAmountPaid}} تومان</td>

                                        </tr>

                                        </tbody>
                                    </table>
{{--                                    <div class="d-flex justify-content-center pt-3">--}}
{{--                                        <button type="button" class="btn waves-light btn-warning color-000 px-4">--}}
{{--                                            ثبت فاکتور--}}
{{--                                        </button>--}}
{{--                                    </div>--}}

                                </div>

                                <div class="table-responsive no-over-flow">
{{--                                    <a href="#" style="float:left;margin: 25px 0;" class="btn btn-inverse waves-effect waves-light addField"> + افزودن پرداختنی جدید</a>--}}
                                    <form action="{{route('payment.store',$invoice->id)}}" method="post" id="leberman">
                                        @csrf
                                        @method('post')
                                        <div class="row clear">
                                            <div class="col-sm-3 no-padding">
                                                <div class="form-group m-t-20">
                                                    <label for="price">قیمت  <span class="text-danger">*</span> <sup>به مبلغ 9٪ مالیات افزوده خواهد شد</sup></label>
                                                    <input style="direction:ltr;text-align: left;" id="price" value="" placeholder="قیمت به تومان" name="price" type="text" class=" form-control rounded-0" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-sm-8 no-padding">
                                                <div class="form-group m-t-20">
                                                    <label for="price">توضیحات </label>
                                                    <input value="" name="description" type="text" class=" form-control rounded-0" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-sm-1 no-padding">
                                                <div class="form-group m-t-40">
                                                    <a style="
    position: relative;
    display: block;
    background: #21b94a;
    border: 1px solid #13a039;
    top: 7px;color:white;
    padding: 9px 0;" onclick="document.getElementById('leberman').submit();" class="btn btn-inverse waves-effect waves-light addField"> افزودن</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <table class="table table-expert-ok">
                                        <thead class="bg-eaf color-mashinchi th-p15">
                                        <tr>
                                            <th> #</th>
                                            <th>مبلغ</th>
                                            <th>تاریخ پرداخت</th>
                                            <th>شناسه پرداخت</th>
                                            <th>نوع پرداخت</th>
                                            <th>وضعیت</th>
                                            <th>عملیات</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($invoice->payments as $payment)
                                            <tr>
                                                <td>{{$payment->id}}</td>
                                                <td> {{$payment->amount}}</td>
                                                <td> @if ($payment->status == 1) {{$payment->updated_at}} @else - @endif</td>
                                                <td>@if ($payment->status == 1) {{$payment->transactionId}} @else - @endif</td>
                                                <td> @if ($payment->status == 1) {{$payment->payment_type}} @else - @endif </td>
                                                <td> @if ($payment->status == 1)
                                                        پرداخت شده
                                                    @elseif ($payment->status == 0)
                                                        پرداخت نشده
                                                    @endif</td>
                                                <td>
                                                    @if ($payment->status != 1)  <a class="mdi mdi-verified" data-toggle="tooltip" data-original-title="تایید دستی" href="{{route('payment.approve',$payment->id)}}"></a> @endif
                                                    <a onclick="return confirm('آیا از حذف این پرداخت اطمینان دارید؟');" class="mdi mdi-delete" data-toggle="tooltip" data-original-title="حذف" href="{{route('payment.delete',$payment->id)}}"></a>
                                                    @if (!empty($payment->details))
                                                            <span class="mytooltip tooltip-effect-4"> <i class="mdi mdi-alert-octagram"></i> <span class="tooltip-content clearfix"> <span class="tooltip-text">{!! json_decode($payment->details) !!}</span> </span> </span>
                                                        @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{--                                    <div class="d-flex justify-content-center pt-3">--}}
                                    {{--                                        <button type="button" class="btn waves-light btn-warning color-000 px-4">--}}
                                    {{--                                            ثبت فاکتور--}}
                                    {{--                                        </button>--}}
                                    {{--                                    </div>--}}

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- row -->

                </div>
            </div>
        </div>


    </div>
@stop
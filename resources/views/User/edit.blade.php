@extends('layouts.masterPanelAdmin')
@section('content')
    <div class="container-fluid">


        <!-- Row -->
        <div class="row machinchi-tabs">
            <div class="col-md-12">
                <div class="tab-container">
                    <div class="card-body">
                        <ul class="nav nav-pills m-t-30 pr-0">
                            <li class=" nav-item" style="
"><a href="#navpills-1" class="nav-link active" data-toggle="tab" aria-expanded="false"> اطلاعات کاربر</a></li>
                            <li class="nav-item"><a href="#navpills-2" class="nav-link" data-toggle="tab"
                                                    aria-expanded="false"> لیست فاکتورها</a></li>
                            <li class="nav-item"><a href="#navpills-3" class="nav-link" data-toggle="tab"
                                                    aria-expanded="true">لیست کارشناسی ها </a></li>
                            <li class="nav-item"><a href="#navpills-4" class="nav-link" data-toggle="tab"
                                                    aria-expanded="true">لیست آگهی‌ها </a></li>
                        </ul>
                        <div class="tab-content br-n pn px-4 py-5">
                            <div id="navpills-1" class="tab-pane active">
                                <form method="POST"
                                      action="{{ route('user.update', $user->id) }}">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <span>آخرین کد ارسالی پیامک شده به کاربر : </span> <b>{!! ($user->phone_token ? $user->phone_token : 'یافت نشد') !!}</b>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <span>آدرس IP کاربر :</span> <b>{{$user->ip_adress}}</b>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <span>تاریخ عضویت :</span> <b>{{$user->created_at}}</b>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">شمارنده خطاهای ورود <sup style="color:red"> برای غیر فعالسازی عدد 0 وارد شود </sup> </label>
                                                <input type="number" name="count_fail" value="{{$user->phone_token_fails}}" style="width: 13%;float: left;padding-left: 4px;"
                                                       class="form-control rounded-0" min="0" max="6">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">نام </label>
                                                <input type="text" name="name" value="{{$user->name}}"
                                                       class="form-control rounded-0" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">نام خانوادگی </label>
                                                <input type="text" name="family" value="{{$user->family}}"
                                                       class="form-control rounded-0" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">کد ملی </label>
                                                <input type="text" name="code_melli" value="{{$user->code_melli}}"
                                                       class="form-control rounded-0" placeholder="  ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">ایمیل (اختیاری) </label>
                                                <input type="text" autocomplete="off" name="email_panel" value="{{$user->email}}"
                                                       class="form-control rounded-0" placeholder="  ">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">شماره تلفن </label>
                                                <input type="text" autocomplete="new-phone_number" name="phone_number_panel" value="{{$user->phone_number}}"
                                                       class="form-control rounded-0" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">پسورد </label>
                                                <input type="password" autocomplete="new-password" name="password" class="form-control rounded-0"
                                                       placeholder="  ">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">تایید پسورد </label>
                                                <input type="password" autocomplete="new-password" name="password_confirmation" class="form-control rounded-0"
                                                       placeholder="  ">
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">آدرس پستی </label>
                                                <input value="{{$user->adress}}" name="adress" type="text" class=" form-control rounded-0" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-5 d-flex justify-content-center">
                                        <button type="submit" class="btn waves-light btn-rounded btn-info px-4">ثبت
                                            تغییرات
                                        </button>
                                    </div>
                                </form>
                                <!--/row-->
                            </div>
                            <div id="navpills-2" class="tab-pane">
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-expert-ok">
                                            <thead class="bg-eaf color-mashinchi th-p15">
                                            <tr>
                                                <th> #</th>
                                                <th>کد گزارش کارشناسی</th>
                                                <th> مدل خودرو</th>
                                                {{--                                                <th>پکیج</th>--}}
                                                <th>مبلغ</th>
                                                <th>تاریخ ایجاد فاکتور</th>
                                                <th>شناسه پرداخت</th>
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
                                                            {{$invoice->expert->brand_id}}
                                                        </td>
                                                        {{--                                                    <td>--}}
                                                        {{--                                                        پکیج کامل--}}
                                                        {{--                                                    </td>--}}

                                                        <td>
                                                            {{$invoice->total_amount}} تومان
                                                        </td>
                                                        <td>
                                                            {{$invoice->created_at}}
                                                        </td>
                                                        <td>
                                                               {{$invoice->transactionId}}
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
                            <div id="navpills-3" class="tab-pane">
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-expert-ok">
                                            <thead class="bg-eaf color-mashinchi th-p15">
                                            <tr>
                                                <th>#</th>
                                                <th>برند</th>
                                                <th>مدل</th>
                                                <th>تاریخ ثبت درخواست</th>
                                                <th>روز و زمان مراجعه</th>
                                                <th>وضعیت</th>
                                                <th>ویرایش</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @if (count($experts) > 0)
                                                @foreach ($experts as $expert)
                                                    <tr>
                                                        <td> {{$expert->id}}</td>
                                                        <td> {{$expert->brand_id}}</td>
                                                        <td> {{$expert->model_id}}</td>
                                                        <td>
                                                                {{$expert->created_at}}
                                                        </td>

                                                        <td>
                                                            {{json_decode($expert->reserve['reserveDate'],true)['time']}} -
                                                            {{json_decode($expert->reserve['reserveDate'],true)['date']}}
                                                        </td>
                                                        <td>
                                                            @include('panelAdmin.statusexperts')
                                                        </td>

                                                        <td class="edite-td">
                                                            <a href="{{ route('expert.edit',$expert->id) }}"
                                                               class="icon-box edite-icon"></a>
                                                            <a onclick="return confirm('آیا از حذف این آگهی اطمینان دارید؟');"
                                                               href="{{ route('expert.delete',$expert->id) }}"
                                                               class="icon-box delete-icon"></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td> -</td>
                                                    <td> -</td>
                                                    <td> -</td>
                                                    <td>آگهی کارشناسی وجود ندارد.</td>
                                                    <td> -</td>
                                                    <td> -</td>
                                                    <td> -</td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        {{$experts->links()}}
                                    </div>
                                </div>
                            </div>
                            <div id="navpills-4" class="tab-pane">
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-expert-ok">
                                            <thead class="bg-eaf color-mashinchi th-p15">
                                            <tr>
                                                <th>#</th>
                                                <th> عنوان آگهی</th>
                                                <th>تاریخ</th>
                                                <th>برند</th>
                                                <th>مدل</th>
                                                <th>وضعیت</th>
                                                <th>ویرایش</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @if (count($advers) > 0)
                                                @foreach ($advers as $adver)
                                                    <tr>
                                                        <td> {{$adver->id}}</td>
                                                        <td> {{$adver->title}}</td>
                                                        <td> {{$adver->created_at}}</td>
                                                        <td> {{$adver->brand_id}}</td>
                                                        <td> {{$adver->model_id}}</td>
                                                        <td>
                                                            <style>
                                                                span.danger-color {
                                                                    color: red;
                                                                }
                                                                span.del-color {
                                                                    color: #ff6c00;
                                                                    text-decoration: line-through;
                                                                }
                                                            </style>
                                                            @if ($adver->sale->status == 1)
                                                                <span class="success-color">
        تایید شده
    </span>
                                                            @elseif($adver->sale->status == 2)
                                                                <span class="del-color">
        حذف شده
    </span>
                                                            @elseif($adver->sale->status == 3)
                                                                <span class="danger-color">
        فروخته شده
    </span>
                                                            @elseif($adver->sale->status == 4)
                                                                <span style="color:#ef8519">
        در انتظار تایید
    </span>
                                                            @elseif($adver->sale->status == 0)
                                                                <span class="failed-color">
        تایید نشده
    </span>
                                                            @endif
                                                        </td>

                                                        <td class="edite-td">
                                                            <a href="{{ route('sale.edit',$adver->sale->id) }}"
                                                               class="icon-box edite-icon"></a>
                                                            <a onclick="return confirm('آیا از حذف این آگهی اطمینان دارید؟');"
                                                               href="{{ route('sale.delete',$adver->sale->id) }}"
                                                               class="icon-box delete-icon"></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td> -</td>
                                                    <td> -</td>
                                                    <td> -</td>
                                                    <td>آگهی وجود ندارد.</td>
                                                    <td> -</td>
                                                    <td> -</td>
                                                    <td> -</td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        {{$advers->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@stop
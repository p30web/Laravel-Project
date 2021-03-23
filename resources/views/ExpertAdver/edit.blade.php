@extends('layouts.masterPanelAdmin')
@section('customCss')
    <link href="{{asset('adminpanel/assets/plugins/wizard/steps.css')}}" rel="stylesheet">
    <style>
        .editExpertAdver h6 {
            padding: 25px 0;
        }

        .part {
            transition: 0.2s;
            fill: #fff !important;
        }

        .part:hover {
            fill: #ffdd5b !important;
            transition: 0.2s;
            cursor: pointer;
        }

        .part-active {
            fill: #ff1f2e !important;
        }
    </style>
@stop
@php
    $expertc = json_decode($expert->reserve->reserveDate);
    $expertp = json_decode($expert->reserve->reserveDetails);
@endphp
@section('content')
    <div class="container-fluid">

        <!-- Start Page Content -->
        <!-- Row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body expert-form">
                        <form class="editExpertAdver" method="POST"
                              action="{{ route('expert.update', $expert->id) }}">
                        @csrf
                        @method('POST')
                        <!-- Step 1 -->
                            <h6>مشخصات اولیه
                                @if (!empty($expert->adver))
                                    <a target="_blank" href="{{ route('sale.edit', $expert->adver->sale->id) }}"
                                       class="btn btn-success waves-effect waves-light float-left">ویرایش آگهی فروش این
                                        درخواست کارشناسی</a>
                                @else
                                    <a target="_blank" href="{{ route('sale.create', $expert->id) }}"
                                       class="btn btn-add-ads waves-effect waves-light float-left">ایجاد آگهی فروش</a>
                                @endif
                            </h6>

                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"> انتخاب برند </label>
                                            <select name="brand" class="form-control custom-select selectBrand"
                                                    placeholder="" tabindex="1">
                                                @foreach($brands as $brand)
                                                    <option {!! ($expert->brand_id == $brand->title ? 'selected' : '' ) !!} value="{{$brand->id}}">{{$brand->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"> مدل خودرو </label>
                                            <select name="model" class="form-control custom-select selectModel"
                                                    placeholder="" tabindex="1">
                                                @foreach($models as $model)
                                                    <option {!! ($expert->model_id == $model->title ? 'selected' : '' ) !!} value="{{$model->id}}">{{$model->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="numberplates">شماره پلاک</label>
                                                    <input name="plaque[iran]" type="text"
                                                           class="form-control iran-input rounded-0"
                                                           placeholder="ایران - " id="numberplates"
                                                           value="{{$plaque['iran']}}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="label-empty"></label>
                                                    <input name="plaque[first]" type="text"
                                                           class="form-control rounded-0" value="{{$plaque['first']}}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="label-empty"></label>
                                                    <select name="plaque[alphabet]" class="form-control rounded-0">
                                                        <option {!! ( $plaque['alphabet'] == 'ب' ? 'selected' : '') !!} value="ب">
                                                            ب
                                                        </option>
                                                        <option {!! ( $plaque['alphabet'] == 'ج' ? 'selected' : '') !!} value="ج">
                                                            ج
                                                        </option>
                                                        <option {!! ( $plaque['alphabet'] == 'د' ? 'selected' : '') !!} value="د">
                                                            د
                                                        </option>
                                                        <option {!! ( $plaque['alphabet'] == 'س' ? 'selected' : '') !!} value="س">
                                                            س
                                                        </option>
                                                        <option {!! ( $plaque['alphabet'] == 'ص' ? 'selected' : '') !!} value="ص">
                                                            ص
                                                        </option>
                                                        <option {!! ( $plaque['alphabet'] == 'ط' ? 'selected' : '') !!} value="ط">
                                                            ط
                                                        </option>
                                                        <option {!! ( $plaque['alphabet'] == 'ق' ? 'selected' : '') !!} value="ق">
                                                            ق
                                                        </option>
                                                        <option {!! ( $plaque['alphabet'] == 'ل' ? 'selected' : '') !!} value="ل">
                                                            ل
                                                        </option>
                                                        <option {!! ( $plaque['alphabet'] == 'م' ? 'selected' : '') !!} value="م">
                                                            م
                                                        </option>
                                                        <option {!! ( $plaque['alphabet'] == 'ن' ? 'selected' : '') !!} value="ن">
                                                            ن
                                                        </option>
                                                        <option {!! ( $plaque['alphabet'] == 'و' ? 'selected' : '') !!} value="و">
                                                            و
                                                        </option>
                                                        <option {!! ( $plaque['alphabet'] == 'ه' ? 'selected' : '') !!} value="ه">
                                                            ه
                                                        </option>
                                                        <option {!! ( $plaque['alphabet'] == 'ی' ? 'selected' : '') !!} value="ی">
                                                            ی
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="label-empty"></label>
                                                    <input name="plaque[second]" type="text"
                                                           class="form-control rounded-0" value="{{$plaque['second']}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ownername">نام مالک</label>
                                            <input type="text" class="form-control rounded-0" disabled="disabled"
                                                   value="{{$expert->user->name}} {{$expert->user->family}}"
                                                   id="ownername">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">موبایل</label>
                                            <input type="tel" class="form-control rounded-0" disabled="disabled"
                                                   value="{{$expert->user->phone_number}}" id="phone">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="emailaddress">ایمیل</label>
                                            <input type="email" class="form-control rounded-0" disabled="disabled"
                                                   value="{{$expert->user->email}}" id="emailaddress">
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <hr>
                            <!-- Step 2 -->
                            <h6>انتخاب پکیج</h6>
                            <section>
                                <div class="row justify-content-center">
                                    <div class="col-md-12 text-center">
                                        <div class="card2">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-expert">
                                                        <tbody>
                                                        @foreach($packages as $package)
                                                            <tr>
                                                                <td class="plan-input">
                                                                    <input type="checkbox" name="package[]"
                                                                           id="package_expert_{{$package->id}}"
                                                                           value="{{$package->id}}"
                                                                           class="filled-in chk-col-indigo" {!! ($expert->reserve->packages->contains($package->id) ? 'checked' : '') !!}>
                                                                    <label for="package_expert_{{$package->id}}">{{$package->title}}
                                                                        <span style="margin-top: 8px;display: block;font-size: 0.8rem;color: #4bbb4b;">{{$package->price}} تومان</span></label>
                                                                </td>
                                                                <td class="text-left">
                                                                    <span class="full-expert-dec">
                                                                     {{$package->description}}
                                                                    </span>
                                                                    <span class="short-expert-dec">
                                                                       {{ str_limit($package->description, $limit = 90, $end = '...') }}
                                                                    </span>
                                                                </td>
                                                                <td class="plan-arrow"><i
                                                                            class="arrow-top-icon arrow-expert"></i>
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
                            </section>
                            <hr>
                            <!-- Step 3 -->
                            <h6>انتخاب زمان و تاریخ</h6>

                            <section id="example-basic-p-3" role="tabpanel" aria-labelledby="example-basic-h-3"
                                     class="body current time-date-expert" aria-hidden="false" style="left: 0px;">
                                <div style="    color: #619844;
                                        font-weight: bold;
                                        float: right;
                                        background: #61b7366e;
                                        position: relative;
                                        padding: 7px 20px;
                                        top: -34px;
                                        border-radius: 6px 6px 0 0;">
                                    روز انتخاب شده : {{$expertc->date}} | <span style="display:inline-block">
                                       ساعت انتخاب شده : {{$expertc->time}}</span>

                                </div>
                                <div class="days-container">
                                    <div class="available-days">
                                        @foreach($dates as $date)
                                            <div class="day {!! $date == $expertc->date ? 'selected' : '' !!}"
                                                 data-date="{!! str_replace('/', '-', $date) !!}">{{$date}}</div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="days-container m-t-30" style="display:none">
                                    <h3 class="step-header__text dtime-icon">زمان کارشناسی را برای مراجعه حضوری
                                        انتخاب کنید</h3>
                                    <div class="available-days times ">
                                    </div>
                                </div>
                            </section>
                            <!-- Step 4 -->
                            {{--                            <h6>پیش فاکتور</h6>--}}
                            {{--                            <section id="example-basic-p-5" role="tabpanel" aria-labelledby="example-basic-h-5"--}}
                            {{--                                     class="body price-expert current" aria-hidden="false" style="left: 0px;">--}}

                            {{--                                <div class="container-fluid invoice-container">--}}
                            {{--                                    <div class="d-flex justify-content-center invoice-header py-4">--}}
                            {{--                                        <h2 class="invoice-step-h3">پیش نمایش تغییرات خود را بررسی کنید</h2>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="row invoice-border">--}}
                            {{--                                        <div class="col-md-3 invoice-border-left py-3">--}}
                            {{--                                            <strong class="name-icon">نام</strong>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-md-9 py-3">--}}
                            {{--                                            {{$expert->user->name}}--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="row invoice-border">--}}
                            {{--                                        <div class="col-md-3 invoice-border-left py-3">--}}
                            {{--                                            <strong class="family-icon">نام خانوادگی</strong>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-md-9 py-3">--}}
                            {{--                                            {{$expert->user->family}}--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="row invoice-border">--}}
                            {{--                                        <div class="col-md-3 invoice-border-left py-3">--}}
                            {{--                                            <strong class="brand-icon">برند</strong>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-md-9 py-3">--}}
                            {{--                                            بنز--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="row invoice-border">--}}
                            {{--                                        <div class="col-md-3 invoice-border-left py-3">--}}
                            {{--                                            <strong class="model-icon">مدل</strong>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-md-9 py-3">--}}
                            {{--                                            بنز، کلاس E‏ ، E200--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="row invoice-border">--}}
                            {{--                                        <div class="col-md-3 invoice-border-left py-3">--}}
                            {{--                                            <strong class="expert-date-icon">تاریخ کارشناسی</strong>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-md-9 py-3">--}}
                            {{--                                            <span id="selectDate">{{$expertc->date}}</span>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="row invoice-border">--}}
                            {{--                                        <div class="col-md-3 invoice-border-left py-3">--}}
                            {{--                                            <strong class="expert-time-icon">ساعت کارشناسی</strong>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-md-9 py-3">--}}
                            {{--                                            <span id="selectTime">{{$expertc->time}}</span>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="row invoice-border">--}}
                            {{--                                        <div class="col-md-3 invoice-border-left py-3">--}}
                            {{--                                            <strong class="expert-address-icon">آدرس محل کارشناسی</strong>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="col-md-9 py-3">--}}
                            {{--                                            تهران ، هفت تیر ، خیابان قائم مقام فراهانی ، نرسیده به مطهری ، کوچه--}}
                            {{--                                            الوند پلاک 11 ، واحد 12--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}

                            {{--                            </section>--}}

                            <input type="hidden" value="{{$expertc->date}}" name="reserveDate" id="reserveDate">
                            <input type="hidden" value="{{$expertc->time}}" name="reserveTime" id="reserveTime">
                            <input type="hidden" value="1" name="location">

                            <button type="submit" class="btn btn-success waves-effect waves-light float-right m-r-10">
                                ویرایش
                            </button>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"> اطلاعات تکمیلی </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('expert.edit.properties',  $expert->id) }}" method="post"
                              enctype="multipart/form-data"class="editExpertAdver">
                            @csrf
                            @method('post')
                            <div class="form-body">

                                <div class="row p-t-20">
                                    <!-- start battery properties -->
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        @if (empty($expert->tracking_code))
                                                            <label for="ownername">کد رهگیری گزارش کارشناسی : <span
                                                                        class="text-danger">*</span> </label>
                                                            <div style="display:inline-block;width: 58%;margin-right: 7px;">
                                                                <sub>عدد بصورت تصادفی انتخاب شده است، پس از ثبت قابل
                                                                    ویرایش نمی باشد</sub>
                                                                <input style="font-family: Arial;text-align: left;width:100%;"
                                                                       type="text"
                                                                       class="form-control{{ $errors->has('tracking_code') ? ' is-invalid' : '' }} rounded-0"
                                                                       value=""
                                                                       id="trackingCode" name="tracking_code">
                                                            </div>
                                                            <div style="display:inline-block;">
                                                                <span style="direction:rtl;">-MCE</span>
                                                            </div>
                                                        @else
                                                            <label style="font-weight: bold;" for="ownername">کد رهگیری
                                                                گزارش کارشناسی : </label>
                                                            <span style="font-family: Arial">{{ $expert->tracking_code }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        @if (empty($expert->chassisـnumber))
                                                            <div style="display:inline-block"><label
                                                                        for="chassisـnumber">شماره شاسی خودرو : <span
                                                                            class="text-danger">*</span> </label></div>
                                                            <div style="display:inline-block;width: 58%;margin-right: 7px;">
                                                                <sub>حروف بزرگ و کوچک رعایت شود</sub>
                                                                <input style="font-family: Arial;display:inline-block;text-align: left;"
                                                                       type="text"
                                                                       class="form-control{{ $errors->has('chassisـnumber') ? ' is-invalid' : '' }} rounded-0"
                                                                       value="{{ $expert->chassisـnumber }}"
                                                                       id="chassisـnumber" name="chassisـnumber">
                                                            </div>
                                                        @else
                                                            <label style="font-weight: bold;" for="tracking_code">شماره
                                                                شاسی خودرو : </label>
                                                            <span style="font-family: Arial">{{ $expert->chassisـnumber }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h6>ثبت اطلاعات کارشناسی</h6>
                                        <div class="form-group">
                                            <div class="vtabs col-md-12">
                                                <ul class="nav nav-tabs tabs-vertical" role="tablist">
                                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                                                                            href="#properties_battery" role="tab"><span
                                                                    style="font-weight: bold"> باتری</span></a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                                            href="#properties_mechanic" role="tab"><span
                                                                    style="font-weight: bold">مکانیک خودرو </span></a>
                                                    </li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                                            href="#properties_paint" role="tab"><span
                                                                    style="font-weight: bold">مشخصات نقاشی و رنگ</span></a>
                                                    </li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                                            href="#properties_electric" role="tab"><span
                                                                    style="font-weight: bold">سیستم های الکتریکی</span></a>
                                                    </li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                                            href="#properties_safety" role="tab"><span
                                                                    style="font-weight: bold">سیستم ایمنی</span></a>
                                                    </li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                                            href="#properties_wheels" role="tab"><span
                                                                    style="font-weight: bold">رینگ و تایر</span></a>
                                                    </li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                                            href="#properties_check_documents"
                                                                            role="tab"><span
                                                                    style="font-weight: bold">بررسی مدارک</span></a>
                                                    </li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab"
                                                                            href="#properties_check_option"
                                                                            role="tab"><span
                                                                    style="font-weight: bold">بررسی آپشن خودرو</span></a>
                                                    </li>
                                                </ul>
                                                <!-- Tab panes -->
                                                <div class="tab-content">
                                                    <div class="tab-pane p-20 active" id="properties_battery"
                                                         role="tabpanel">
                                                        <div class="form-group">

                                                            <div class="form-group">
                                                                <label class="col-sm-3 form-control-label">امتیاز کلی
                                                                    سلامت
                                                                    باتری</label>
                                                                <div class="col-sm-4">
                                                                    <input name="properties_battery[rate]" type="text"
                                                                           class="form-control" placeholder=""
                                                                           value="{!! ($batteryHealth['rate'] != null ? $batteryHealth['rate'] :  0) !!}">
                                                                </div>
                                                            </div>

                                                            <textarea class="mymce"
                                                                      name="properties_battery[description]">{!! ($batteryHealth['description'] != null ? $batteryHealth['description'] : null) !!}</textarea>

                                                            <div class="form-group properties_battery">
                                                                @if (!empty($batteryHealth['atributies']))
                                                                    @foreach ($batteryHealth['atributies'] as $id => $attribute)
                                                                        <div class="row" data-id="{{$id}}">
                                                                            <div class="col-sm-9 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <input value="{{$attribute['title']}}"
                                                                                           name="properties_battery[atributies][{{$id}}][title]"
                                                                                           type="text"
                                                                                           class=" form-control rounded-0"
                                                                                           placeholder="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <div class="input-group">
                                                                                        <select class="form-control"
                                                                                                id="educationDate"
                                                                                                name="properties_battery[atributies][{{$id}}][status]">
                                                                                            @include('ExpertAdver.selectValuesDynamic')
                                                                                        </select>
                                                                                        <a class="deleteField btn btn-danger waves-effect waves-light"
                                                                                           href="#"
                                                                                           style="margin-right: 19px;">حذف</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @else
                                                                    @php $fields_properties_battery = [1 => 'توان استارت','تست باتری با دستگاه' , 'شارژدهی دینام' ];@endphp
                                                                    @foreach ($fields_properties_battery as $id => $field_properties_battery)
                                                                        <div class="row">
                                                                            <div class="col-sm-9 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <input value="{{$field_properties_battery}}"
                                                                                           name="properties_battery[atributies][{{$id}}][title]"
                                                                                           type="text"
                                                                                           class="form-control rounded-0"
                                                                                           placeholder="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <div class="input-group">
                                                                                        <select class="form-control"
                                                                                                id="educationDate"
                                                                                                name="properties_battery[atributies][{{$id}}][status]">
                                                                                            @include('ExpertAdver.selectValuesStatic')
                                                                                        </select>
                                                                                        <a class="deleteField btn btn-danger waves-effect waves-light"
                                                                                           href="#"
                                                                                           style="margin-right: 19px;">حذف</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif

                                                                <a href="#" style="float:left;margin-top: 25px;"
                                                                   class="btn btn-inverse waves-effect waves-light addField">
                                                                    + افزودن فیلد جدید</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane p-20" id="properties_mechanic" role="tabpanel">
                                                        <div class="form-group">

                                                            <div class="form-group">
                                                                <label class="col-sm-3 form-control-label">امتیاز کلی
                                                                    مکانیک
                                                                    خودرو</label>
                                                                <div class="col-sm-4">
                                                                    <input name="properties_mechanic[rate]" type="text"
                                                                           class="form-control" placeholder=""
                                                                           value="{!! ($mechanic['rate'] != null ? $mechanic['rate'] :  0) !!}">
                                                                </div>
                                                            </div>

                                                            <textarea class="mymce"
                                                                      name="properties_mechanic[description]">
                                                           {!! ($mechanic['description'] != null ? $mechanic['description'] : null) !!}</textarea>

                                                            <div class="form-group properties_mechanic">
                                                                @if (!empty($mechanic['atributies']))
                                                                    @foreach ($mechanic['atributies'] as $id => $attribute)
                                                                        <div class="row" data-id="{{$id}}">
                                                                            <div class="col-sm-9 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <input value="{{$attribute['title']}}"
                                                                                           name="properties_mechanic[atributies][{{$id}}][title]"
                                                                                           type="text"
                                                                                           class=" form-control rounded-0"
                                                                                           placeholder="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <div class="input-group">
                                                                                        <select class="form-control"
                                                                                                id="educationDate"
                                                                                                name="properties_mechanic[atributies][{{$id}}][status]">
                                                                                            @include('ExpertAdver.selectValuesDynamic')
                                                                                        </select>
                                                                                        <a class="deleteField btn btn-danger waves-effect waves-light"
                                                                                           href="#"
                                                                                           style="margin-right: 19px;">حذف</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @else
                                                                    @php $fields_properties_mechanic = [1 => 'خودرو به راحتی روشن میشود'
                                                                    ,'کارکرد صحیح موتور'
                                                                    , 'لرزش موتور ' ,
                                                                    'دمای موتور و سیستم فن',
'کمپرس موتور ',
'کمپرس موتور سرد و گرم ',
'نشت روغن موتور ',
'صدای غیر عادی موتور',
'واشر در سوپاپ',
'واشر سر سیلندر',
'نشت روغن گیربکس',
'نشت روغن هیدرولیک',
'رادیاتور',
'دود اگزوز',
'تطبیق کارکرد با ظاهر خودرو',
'تست دیاگ',
'کنترل پایداری',
'آنالیز روغن موتور',
'آنالیز روغن ترمز',
'استعلام سوابق تعمیراتی',
'تصاویر ویدئو برسکوپ (آندوسکوپی)'];@endphp
                                                                    @foreach ($fields_properties_mechanic as $id => $field_properties_mechanic)
                                                                        <div class="row">
                                                                            <div class="col-sm-9 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <input value="{{$field_properties_mechanic}}"
                                                                                           name="properties_mechanic[atributies][{{$id}}][title]"
                                                                                           type="text"
                                                                                           class="form-control rounded-0"
                                                                                           placeholder="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <div class="input-group">
                                                                                        <select class="form-control"
                                                                                                id="educationDate"
                                                                                                name="properties_mechanic[atributies][{{$id}}][status]">
                                                                                            @include('ExpertAdver.selectValuesStatic')
                                                                                        </select>
                                                                                        <a class="deleteField btn btn-danger waves-effect waves-light"
                                                                                           href="#"
                                                                                           style="margin-right: 19px;">حذف</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                                <a href="#" style="float:left;margin-top: 25px;"
                                                                   class="btn btn-inverse waves-effect waves-light addField">
                                                                    + افزودن فیلد جدید</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane p-20" id="properties_paint" role="tabpanel">
                                                        <div class="form-group">

                                                            <div class="form-group">
                                                                <label class="col-sm-3 form-control-label">امتیاز کلی
                                                                    نقاشی
                                                                    و رنگ</label>
                                                                <div class="col-sm-4">
                                                                    <input name="properties_paint[rate]" type="text"
                                                                           class="form-control" placeholder=""
                                                                           value="{!! ($paint['rate'] != null ? $paint['rate'] :  0) !!}">
                                                                </div>
                                                            </div>

                                                            @include('ExpertAdver.svgBodystatus')

                                                            <textarea class="mymce"
                                                                      name="properties_paint[description]">
                                                           {!! ($paint['description'] != null ? $paint['description'] : null) !!}</textarea>
                                                            <span class="hidden-input-paint">
                                                            <input type="hidden" class="defval"
                                                                   name="properties_paint[placestain]"
                                                                   value="{!! (!empty($paint['placestain'] ) && $paint['placestain'] !=null ? $paint['placestain'] : null) !!}">
                                                        </span>

                                                            <div class="form-group properties_paint">
                                                                @if (!empty($paint['atributies']))
                                                                    @foreach ($paint['atributies'] as $id => $attribute)
                                                                        <div class="row" data-id="{{$id}}">
                                                                            <div class="col-sm-9 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <input value="{{$attribute['title']}}"
                                                                                           name="properties_paint[atributies][{{$id}}][title]"
                                                                                           type="text"
                                                                                           class=" form-control rounded-0"
                                                                                           placeholder="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <div class="input-group">
                                                                                        <select class="form-control"
                                                                                                id="educationDate"
                                                                                                name="properties_paint[atributies][{{$id}}][status]">
                                                                                            @include('ExpertAdver.selectValuesDynamic')
                                                                                        </select>
                                                                                        <a class="deleteField btn btn-danger waves-effect waves-light"
                                                                                           href="#"
                                                                                           style="margin-right: 19px;">حذف</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @else
                                                                    @php $fields_properties_paint = [1 =>
                                                                 'در جلو سمت راننده',
'در جلو سمت شاگرد',
'در عقب سمت راننده',
'در عقب سمت شاگرد',
'در صندوق',
'در موتور',
'گلگیر جلو سمت راننده',
'گلگیر جلو سمت شاگرد',
'گلگیر عقب سمت راننده',
'گلگیر عقب سمت شاگرد',
'ستون جلو سمت راننده',
'ستون جلو سمت شاگرد',
'ستون عقب سمت راننده',
'ستون عقب سمت شاگرد',
'ستون وسط سمت راننده',
'ستون وسط سمت شاگرد',
'رکاب سمت راننده',
'رکاب سمت شاگرد',
'سقف',
'شاسی جلو',
'شاسی عقب'
];@endphp
                                                                    @foreach ($fields_properties_paint as $id => $field_properties_paint)
                                                                        <div class="row">
                                                                            <div class="col-sm-9 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <input value="{{$field_properties_paint}}"
                                                                                           name="properties_paint[atributies][{{$id}}][title]"
                                                                                           type="text"
                                                                                           class="form-control rounded-0"
                                                                                           placeholder="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <div class="input-group">
                                                                                        <select class="form-control"
                                                                                                id="educationDate"
                                                                                                name="properties_paint[atributies][{{$id}}][status]">
                                                                                            @include('ExpertAdver.selectValuesStatic')
                                                                                        </select>
                                                                                        <a class="deleteField btn btn-danger waves-effect waves-light"
                                                                                           href="#"
                                                                                           style="margin-right: 19px;">حذف</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                                <a href="#" style="float:left;margin-top: 25px;"
                                                                   class="btn btn-inverse waves-effect waves-light addField">
                                                                    + افزودن فیلد جدید</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane p-20" id="properties_electric" role="tabpanel">
                                                        <div class="form-group">

                                                            <div class="form-group">
                                                                <label class="col-sm-3 form-control-label">امتیاز کلی
                                                                    سیستم
                                                                    های الکتریکی</label>
                                                                <div class="col-sm-4">
                                                                    <input name="properties_electric[rate]" type="text"
                                                                           class="form-control" placeholder=""
                                                                           value="{!! ($electric['rate'] != null ? $electric['rate'] :  0) !!}">
                                                                </div>
                                                            </div>

                                                            <textarea class="mymce"
                                                                      name="properties_electric[description]">
                                                           {!! ($electric['description'] != null ? $electric['description'] : null) !!}</textarea>

                                                            <div class="form-group properties_electric">
                                                                @if (!empty($electric['atributies']))
                                                                    @foreach ($electric['atributies'] as $id => $attribute)
                                                                        <div class="row" data-id="{{$id}}">
                                                                            <div class="col-sm-9 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <input value="{{$attribute['title']}}"
                                                                                           name="properties_electric[atributies][{{$id}}][title]"
                                                                                           type="text"
                                                                                           class=" form-control rounded-0"
                                                                                           placeholder="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <div class="input-group">
                                                                                        <select class="form-control"
                                                                                                id="educationDate"
                                                                                                name="properties_electric[atributies][{{$id}}][status]">
                                                                                            @include('ExpertAdver.selectValuesDynamic')
                                                                                        </select>
                                                                                        <a class="deleteField btn btn-danger waves-effect waves-light"
                                                                                           href="#"
                                                                                           style="margin-right: 19px;">حذف</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @else
                                                                    @php $fields_properties_electric = [1 => 'چراغ چک',
'چراغ روغن',
'چراغ ترمز',
'چراغ ABS',
'چراغ ایربگ',
'چراغ کمربند',
'بوق',
'گرمکن فرمان',
'کلیدهای روی فرمان',
'تنظیمات فرمان',
'بالابر شیشه های جلو',
'بالابر شیشه های عقب',
'برف پاک کن جلو',
'برف پاک کن عقب',
'آب پاش برف پاک کن',
'سنسور باران',
'تنظیمات برقی آینه ها',
'سانروف',
'پرده سانروف',
'گرمکن شیشه عقب',
'سیستم رادیو پخش',
'باند ها',
'کولر',
'بخاری',
'دریچه های تهویه',
'تنظیمات مربوط به صندلی ها',
'سردکن صندلی ها',
'گرمکن صندلی ها',
'داشبورد',
'کنسول وسط',
'رودری ها',
'چراغ های جلو',
'چراغ های عقب',
'مه شکن جلو',
'مه شکن عقب',
'راهنما',
'چراغ شور', ];@endphp
                                                                    @foreach ($fields_properties_electric as $id => $field_properties_electric)
                                                                        <div class="row">
                                                                            <div class="col-sm-9 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <input value="{{$field_properties_electric}}"
                                                                                           name="properties_electric[atributies][{{$id}}][title]"
                                                                                           type="text"
                                                                                           class="form-control rounded-0"
                                                                                           placeholder="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <div class="input-group">
                                                                                        <select class="form-control"
                                                                                                id="educationDate"
                                                                                                name="properties_electric[atributies][{{$id}}][status]">
                                                                                            @include('ExpertAdver.selectValuesStatic')
                                                                                        </select>
                                                                                        <a class="deleteField btn btn-danger waves-effect waves-light"
                                                                                           href="#"
                                                                                           style="margin-right: 19px;">حذف</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                                <a href="#" style="float:left;margin-top: 25px;"
                                                                   class="btn btn-inverse waves-effect waves-light addField">
                                                                    + افزودن فیلد جدید</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane p-20" id="properties_safety" role="tabpanel">
                                                        <div class="form-group">

                                                            <div class="form-group">
                                                                <label class="col-sm-3 form-control-label">امتیاز کلی
                                                                    سیستم
                                                                    ایمنی</label>
                                                                <div class="col-sm-4">
                                                                    <input name="properties_safety[rate]" type="text"
                                                                           class="form-control" placeholder=""
                                                                           value="{!! ($safety['rate'] != null ? $safety['rate'] :  0) !!}">
                                                                </div>
                                                            </div>

                                                            <textarea class="mymce"
                                                                      name="properties_safety[description]">
                                                           {!! ($safety['description'] != null ? $safety['description'] : null) !!}</textarea>

                                                            <div class="form-group properties_safety">
                                                                @if (!empty($safety['atributies']))
                                                                    @foreach ($safety['atributies'] as $id => $attribute)
                                                                        <div class="row" data-id="{{$id}}">
                                                                            <div class="col-sm-9 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <input value="{{$attribute['title']}}"
                                                                                           name="properties_safety[atributies][{{$id}}][title]"
                                                                                           type="text"
                                                                                           class=" form-control rounded-0"
                                                                                           placeholder="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <div class="input-group">
                                                                                        <select class="form-control"
                                                                                                id="educationDate"
                                                                                                name="properties_safety[atributies][{{$id}}][status]">
                                                                                            @include('ExpertAdver.selectValuesDynamic')
                                                                                        </select>
                                                                                        <a class="deleteField btn btn-danger waves-effect waves-light"
                                                                                           href="#"
                                                                                           style="margin-right: 19px;">حذف</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @else
                                                                    @php $fields_properties_safety = [1 =>
                                                               'سنسورهای جلو',
'سنسور دنده عقب',
'سنسورهای جانبی',
'رادار جلو',
'رادار عقب',
'رادار بین خطوط',
'رادار تابلوخان',
'کروز کنترل',
'قفل مرکزی',
'سیستم keyless',
'ایربگ ها',
'کمربندهای ایمنی',
'سوئیچ یدک',
'ABS',
'کنترل پایداری',
'آینه وسط',
'شیشه جلو',
'شیشه عقب',
'آینه های جانبی'

];
                                                                    @endphp
                                                                    @foreach ($fields_properties_safety as $id => $field_properties_safety)
                                                                        <div class="row">
                                                                            <div class="col-sm-9 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <input value="{{$field_properties_safety}}"
                                                                                           name="properties_safety[atributies][{{$id}}][title]"
                                                                                           type="text"
                                                                                           class="form-control rounded-0"
                                                                                           placeholder="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <div class="input-group">
                                                                                        <select class="form-control"
                                                                                                id="educationDate"
                                                                                                name="properties_safety[atributies][{{$id}}][status]">
                                                                                            @include('ExpertAdver.selectValuesStatic')
                                                                                        </select>
                                                                                        <a class="deleteField btn btn-danger waves-effect waves-light"
                                                                                           href="#"
                                                                                           style="margin-right: 19px;">حذف</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                                <a href="#" style="float:left;margin-top: 25px;"
                                                                   class="btn btn-inverse waves-effect waves-light addField">
                                                                    + افزودن فیلد جدید</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane p-20" id="properties_wheels" role="tabpanel">
                                                        <div class="form-group">

                                                            <div class="form-group">
                                                                <label class="col-sm-3 form-control-label">امتیاز کلی
                                                                    رینگ و
                                                                    تایر</label>
                                                                <div class="col-sm-4">
                                                                    <input name="properties_wheels[rate]" type="text"
                                                                           class="form-control" placeholder=""
                                                                           value="{!! ($wheels['rate'] != null ? $wheels['rate'] :  0) !!}">
                                                                </div>
                                                            </div>

                                                            <textarea class="mymce"
                                                                      name="properties_wheels[description]">
                                                           {!! ($wheels['description'] != null ? $wheels['description'] : null) !!}</textarea>

                                                            <div class="form-group properties_wheels">
                                                                @if (!empty($wheels['atributies']))
                                                                    @foreach ($wheels['atributies'] as $id => $attribute)
                                                                        <div class="row" data-id="{{$id}}">
                                                                            <div class="col-sm-9 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <input value="{{$attribute['title']}}"
                                                                                           name="properties_wheels[atributies][{{$id}}][title]"
                                                                                           type="text"
                                                                                           class=" form-control rounded-0"
                                                                                           placeholder="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <div class="input-group">
                                                                                        <select class="form-control"
                                                                                                id="educationDate"
                                                                                                name="properties_wheels[atributies][{{$id}}][status]">
                                                                                            @include('ExpertAdver.selectValuesDynamic')
                                                                                        </select>
                                                                                        <a class="deleteField btn btn-danger waves-effect waves-light"
                                                                                           href="#"
                                                                                           style="margin-right: 19px;">حذف</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @else
                                                                    @php $fields_properties_wheels = [1 =>
                                                              'هیدرولیک فرمان',
'میزان فرمان',
'کمک فنرها',
'شتاب خودرو',
'دیسک و صفحه',
'تعویض دنده',
'سیستم ترمز',
'تیپ ترونیک',
'جلوبندی',
'صدای اضافی اتاق',
'تست تکمیلی رانندگی',
'رینگ و لاستیک',
'لاستیک جلو سمت راننده (100%)',
'لاستیک جلو سمت شاگرد (100%)',
'لاستیک عقب سمت راننده (100%)',
'لاستیک عقب سمت شاگرد (100%)',
'لاستیک زاپاس (100%)',
'رینگ ها',
'جک و آچار چرخ'

];
                                                                    @endphp
                                                                    @foreach ($fields_properties_wheels as $id => $field_properties_wheels)
                                                                        <div class="row">
                                                                            <div class="col-sm-9 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <input value="{{$field_properties_wheels}}"
                                                                                           name="properties_wheels[atributies][{{$id}}][title]"
                                                                                           type="text"
                                                                                           class="form-control rounded-0"
                                                                                           placeholder="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <div class="input-group">
                                                                                        <select class="form-control"
                                                                                                id="educationDate"
                                                                                                name="properties_wheels[atributies][{{$id}}][status]">
                                                                                            @include('ExpertAdver.selectValuesStatic')
                                                                                        </select>
                                                                                        <a class="deleteField btn btn-danger waves-effect waves-light"
                                                                                           href="#"
                                                                                           style="margin-right: 19px;">حذف</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                                <a href="#" style="float:left;margin-top: 25px;"
                                                                   class="btn btn-inverse waves-effect waves-light addField">
                                                                    + افزودن فیلد جدید</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane p-20" id="properties_check_documents"
                                                         role="tabpanel">
                                                        <div class="form-group">

                                                            <div class="form-group">
                                                                <label class="col-sm-3 form-control-label">بررسی
                                                                    مدارک</label>
                                                                <div class="col-sm-4">
                                                                    <input name="properties_check_documents[rate]"
                                                                           type="text"
                                                                           class="form-control" placeholder=""
                                                                           value="{!! ($check_documents['rate'] != null ? $check_documents['rate'] :  0) !!}">
                                                                </div>
                                                            </div>

                                                            <textarea class="mymce"
                                                                      name="properties_check_documents[description]">
                                                           {!! ($check_documents['description'] != null ? $check_documents['description'] : null) !!}</textarea>

                                                            <div class="form-group properties_check_documents">
                                                                @if (!empty($check_documents['atributies']))
                                                                    @foreach ($check_documents['atributies'] as $id => $attribute)
                                                                        <div class="row" data-id="{{$id}}">
                                                                            <div class="col-sm-9 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <input value="{{$attribute['title']}}"
                                                                                           name="properties_check_documents[atributies][{{$id}}][title]"
                                                                                           type="text"
                                                                                           class=" form-control rounded-0"
                                                                                           placeholder="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <div class="input-group">
                                                                                        <select class="form-control"
                                                                                                id="educationDate"
                                                                                                name="properties_check_documents[atributies][{{$id}}][status]">
                                                                                            @include('ExpertAdver.selectValuesDynamic')
                                                                                        </select>
                                                                                        <a class="deleteField btn btn-danger waves-effect waves-light"
                                                                                           href="#"
                                                                                           style="margin-right: 19px;">حذف</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                                <a href="#" style="float:left;margin-top: 25px;"
                                                                   class="btn btn-inverse waves-effect waves-light addField">
                                                                    + افزودن فیلد جدید</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane p-20" id="properties_check_option"
                                                         role="tabpanel">
                                                        <div class="form-group">

                                                            <div class="form-group">
                                                                <label class="col-sm-3 form-control-label">امتیاز کلی
                                                                    آپشن خودرو</label>
                                                                <div class="col-sm-4">
                                                                    <input name="properties_check_option[rate]"
                                                                           type="text"
                                                                           class="form-control" placeholder=""
                                                                           value="{!! ($check_options['rate'] != null ? $check_options['rate'] :  0) !!}">
                                                                </div>
                                                            </div>

                                                            <textarea class="mymce"
                                                                      name="properties_check_option[description]">
                                                           {!! ($check_options['description'] != null ? $check_options['description'] : null) !!}</textarea>

                                                            <div class="form-group properties_check_option">
                                                                @if (!empty($check_options['atributies']))
                                                                    @foreach ($check_options['atributies'] as $id => $attribute)
                                                                        <div class="row" data-id="{{$id}}">
                                                                            <div class="col-sm-9 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <input value="{{$attribute['title']}}"
                                                                                           name="properties_check_option[atributies][{{$id}}][title]"
                                                                                           type="text"
                                                                                           class=" form-control rounded-0"
                                                                                           placeholder="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-3 nopadding">
                                                                                <div class="form-group m-t-20">
                                                                                    <div class="input-group">
                                                                                        <select class="form-control"
                                                                                                id="educationDate"
                                                                                                name="properties_check_option[atributies][{{$id}}][status]">
                                                                                            @include('ExpertAdver.selectValuesDynamic')
                                                                                        </select>
                                                                                        <a class="deleteField btn btn-danger waves-effect waves-light"
                                                                                           href="#"
                                                                                           style="margin-right: 19px;">حذف</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                                <a href="#" style="float:left;margin-top: 25px;"
                                                                   class="btn btn-inverse waves-effect waves-light addField">
                                                                    + افزودن فیلد جدید</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- end battery properties -->
                                        <div class="forum-group">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    @if ($expert->download_pdf_link)<a
                                                            style="margin: 32px 0 0 0;
    color: #109e33;
    display: inline-block;
    font-weight: bold;"
                                                            href="{{Storage::disk('file')->url($expert->download_pdf_link)}}">
                                                        جهت دریافت پی دی اف کارشناسی کلیک کنید. »</a>
                                                        @else
                                                        <h5>آپلود PDF <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="file" name="pdfexpert" class="form-control"/>
                                                        </div>
                                                    @endif

                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label"> وضعیت سلامت خودرو </label>
                                                        <select name="health_status"
                                                                class="form-control custom-select selectBrand"
                                                                placeholder="" tabindex="1">

                                                            @foreach($health_status as $status)
                                                                <option {!! ($expert->health_status_id == $status['id'] ? 'selected' : '' ) !!} value="{{$status['id']}}">{{$status['title']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="col-sm-12 form-control-label">امتیاز کلی</label>
                                                        <div class="col-sm-12">
                                                            <input name="health_rating" type="text" class="form-control"
                                                                   value="{!! ($expert->properties && $expert->properties->health_rating != null ? $expert->properties->health_rating : 0) !!}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit"
                                                class="btn btn-success waves-effect waves-light float-right m-r-10">ثبت
                                            اطلاعات تکمیلی کارشناسی
                                        </button>

                                    </div>

                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="model_id_for_jquery" value="{{$expert->model_id}}">

    </div>

@stop
@section('customJs')
    <script src="{{asset('adminpanel/assets/plugins/wizard/jquery.steps.min.js')}}"></script>
    <script src="{{asset('adminpanel/assets/plugins/wizard/jquery.validate.min.js')}}"></script>
    <!-- Sweet-Alert  -->
    <script src="{{asset('adminpanel/assets/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('adminpanel/assets/js/steps.js')}}"></script>

    <script src="{{asset('adminpanel/assets/js/expert-form.js')}}"></script>
    <script src="{{asset('adminpanel/assets/plugins/tinymce/tinymce.min.js')}}"></script>
    <script type="text/javascript">

        $('.deleteField').on('click', function (b) {
            b.preventDefault();
            var parent = $(this).parents('div.row')[0];
            parent.remove();
        });

        $('.addField').on('click', function (e) {
            e.preventDefault();
            var elem = $(this).parents('.active');
            var elemName = elem.attr('id');
            // console.log($(this));
            var n = elem.find('.' + elemName).children('div').last().data('id');
            if (!n) {
                n = 0;
            }
            n++;
            elem.find('.' + elemName).append('<div class="row" style="clear: both;" data-id="' + n + '">\n' +
                '                                                                        <div class="col-sm-9 nopadding">\n' +
                '                                                                            <div class="form-group m-t-20">\n' +
                '                                                                                <input value="" name="' + elemName + '[atributies][' + n + '][title]" type="text" class=" form-control rounded-0"\n' +
                '                                                                                       placeholder="">\n' +
                '                                                                            </div>\n' +
                '                                                                        </div>\n' +
                '                                                                        <div class="col-sm-3 nopadding">\n' +
                '                                                                            <div class="form-group m-t-20">\n' +
                '                                                                                <div class="input-group">\n' +
                '                                                                                    <select class="form-control" id="educationDate"\n' +
                '                                                                                            name="' + elemName + '[atributies][' + n + '][status]">\n' +
                '                                                                                        <option value="positive">سالم</option>\n' +
                '                                                                                        <option value="negative">معیوب</option>\n' +
                '                                                                                        <option value="undocumented">کارشناسی نشده</option>\n' +
                '                                                                                        <option value="swap">تعویضی</option>\n' +
                '                                                                                        <option value="have">دارد</option>\n' +
                '                                                                                        <option value="nothave">ندارد</option>\n' +
                '                                                                                        <option value="voided">باطل شده</option>\n' +
                '                                                                                    </select>\n' +
                '                                                                                </div>\n' +
                '                                                                            </div>\n' +
                '                                                                        </div>\n' +
                '                                                                    </div>');
        });

        //set default value
        var def = {
            reserveDate: '{{$expertc->date}}',
            reserveTime: '{{$expertc->time}}'
        };

        //set date & time for factor
        function setDateTimeFactor() {
            var getCustomValue = {
                cValDate: $('#reserveDate').val(),
                cValTime: $('#reserveTime').val(),
            };
            $('#selectDate').text(getCustomValue.cValDate);
            $('#selectTime').text(getCustomValue.cValTime);
        }
    </script>
    <script>
        (function () {
            //show dates
            var element = $('.available-days > div.day');
            element.each(function (e) {
                $(this).on('click', function () {
                    $('.days-container').fadeIn();
                    $('#reserveDate').val($(this).text());
                    setDateTimeFactor();
                    $('.times').empty();
                    getDatesWithLocation(1, $(this).data("date"));
                });
            });

            function getDatesWithLocation(locationId, date) {
                var DateUrl = '{{ route("getDates", [":locationId" , ":date"]) }}';
                DateUrl = DateUrl.replace(':locationId', locationId);
                DateUrl = DateUrl.replace(':date', date);
                $.getJSON(DateUrl)
                    .done(function (data) {
                        $.each(data.data, function (i, item) {
                            var btnTime = $('<div class="time ' + (item.status == false || item.limit == false ? "disabled" : "") + '">' + item.time + '</div>').attr("data-value", item.time).appendTo('.times');
                            btnTime.each(function () {
                                $(this).on('click', function () {
                                    if (!$(this).hasClass('disabled')) {
                                        $(this).parent().find('.selected').removeClass('selected');
                                        $(this).addClass('selected');
                                        $('#reserveTime').val($(this).text());
                                        setDateTimeFactor();
                                    }
                                });
                            });
                        });
                    });
            }


            $(document).ready(function(){
                var idselectedBrand = $('select.selectBrand').children("option:selected").val();
                var modelsUrl = '{{ route("brandid", ":id") }}';
                modelsUrl = modelsUrl.replace(':id', idselectedBrand);
                getChildren(modelsUrl, idselectedBrand, ".selectModel");
            });

            //select and show brand & model
            $('select.selectBrand').on('change', function () {
                var idselectedBrand = $(this).children("option:selected").val();
                var modelsUrl = '{{ route("brandid", ":id") }}';
                modelsUrl = modelsUrl.replace(':id', idselectedBrand);
                getChildren(modelsUrl, idselectedBrand, ".selectModel");
            });

            function getChildren(brandApi, id, appendToClass) {
                $(appendToClass).empty().append('<option value="null">انتخاب کنید</option>');
                $.getJSON(brandApi)
                    .done(function (data) {
                        var em = $('#model_id_for_jquery').val();
                        $(appendToClass).prop('selectedIndex', null);
                        $.each(data, function (i, item) {
                            $('<option '+ (item.title == em ? ' selected' : ' ') +'>' + item.title + '</option>').attr("value", item.id).appendTo(appendToClass);
                        });
                    });
            }

            if ($(".mymce").length > 0) {
                tinymce.init({
                    selector: "textarea.mymce",
                    theme: "silver",
                    toolbar: "ltr rtl",
                    directionality: "rtl",
                    height: 300,
                    language: 'fa_IR',
                    rtl_ui: true,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

                });
            }


            var defaultValue = $('.hidden-input-paint input.defval');
            if (defaultValue.length > 0) {
                var spliter = defaultValue.attr('value').split(",");
                $.each(spliter, function (o, n) {
                    $.each($('.part'), function () {
                        if ($(this).data('id') == n) {
                            $(this).addClass('part-active');
                        }
                    });
                });
            }

            var result = [];
            $('.part').on("click", function () {

                var defaultValue = $('.hidden-input-paint input.defval');
                if (defaultValue.length > 0) {
                    var spliter = defaultValue.attr('value').split(",");
                    $.each(spliter, function (o, n) {
                        $.each($('.part'), function () {
                            if ($(this).data('id') == n) {
                                $(this).removeClass('part-active');
                            }
                        });
                    });
                }


                var a = $(this).data("id");
                if ($(this).hasClass('part-active')) {
                    for (var i = 0; i < result.length; i++) {
                        if (result[i] === a) {
                            result.splice(i, 1);
                        }
                    }
                    $(this).removeClass('part-active');
                } else {

                    result.push(a);

                    $(this).addClass('part-active');
                }
                $('.hidden-input-paint').html('<input  type="hidden" name="properties_paint[placestain]" value="' + result + '"/>');
                // if(result.length > 0) {
                // } else {
                //     $('.hidden-input-paint').html('');
                // }
            });

        })();
    </script>
    @if (empty($expert->tracking_code))
        <script>
            (function () {
                function makeid(length) {
                    var result = '';
                    var characters = '0123456789';
                    var charactersLength = characters.length;
                    for (var i = 0; i < length; i++) {
                        result += characters.charAt(Math.floor(Math.random() * charactersLength));
                    }
                    return result;
                }

                $('body').find('input#trackingCode').val(makeid(5));
            })();
        </script>
    @endif
@stop

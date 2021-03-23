@extends('layouts.masterPanelAdmin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        {{--                        <div class="row p-t-20">--}}
                        {{--                            <div class="col-md-8">--}}
                        {{--                                <div class="form-group">--}}
                        {{--                                    <div class="input-group search-input ">--}}
                        {{--                                        <input type="text" class="form-control input-icon" id="search2"--}}
                        {{--                                               placeholder="جستجو ...">--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="col-md-4">--}}
                        {{--                                <div class="form-group">--}}
                        {{--                                    <div class="input-group select3-box">--}}
                        {{--                                        <select class="form-control custom-select select-icon">--}}
                        {{--                                            <option value="">جستجو براساس ...</option>--}}
                        {{--                                            <option value="">زن</option>--}}
                        {{--                                            <option value="">مرد</option>--}}
                        {{--                                            <option value="">پسر</option>--}}
                        {{--                                        </select>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <link rel="stylesheet" href="{{asset('adminpanel/assets/css/DatePicker.css')}}">
                        <script src="{{asset('adminpanel/assets/js/DatePicker.js')}}"></script>
                        <form class="form-horizontal" method="post" action="{{ route('expert.filter') }}">
                            {{csrf_field()}}
                            <div class="form-group row" style="margin-bottom: 2px">


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="expert_status" class="form-control custom-select">
                                            @foreach($Status_array as $key => $Status)
                                                <option value="{{ $key }}" {!! ($key == $expert_status ? 'selected' : '' ) !!}>{{ $Status }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input autocomplete="off" type="text"
                                               value="@if(!empty($date)) {{ $date }} @endif" name="date" mh1pdp
                                               class="form-control"
                                               placeholder="روز/ماه/سال">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info waves-effect waves-light">اعمال فیلتر
                                            ها
                                        </button>
                                    </div>
                                </div>

                                <script>
                                    @php $b = explode(" ", verta()); @endphp
                                    var today = "{!! str_replace('-','/',$b[0]) !!}";
                                    //script1
                                    var inputs = document.querySelectorAll("input[mh1pdp]");
                                    for (i = 0; i < inputs.length; i++) {
                                        (function (i) {
                                            inputs[i].addEventListener('click', function () {
                                                Mh1PersianDatePicker.Show(this, today, window.holidays);
                                            });
                                        })(i);
                                    }
                                    //script1
                                </script>
                                <!--/span-->

                            </div>
                        </form>
                        {{--@foreach( as $brand)--}}
                        {{--{{$brand}}--}}
                        {{--@endforeach--}}

                        <div class="table-responsive">
                            <table class="table table-expert-ok">
                                <thead class="bg-eaf color-mashinchi th-p15">
                                <tr>
                                    <th>نام و نام خانوادگی</th>
                                    <th>برند و مدل</th>
                                    <th>شماره تماس</th>
                                    <th>روز و زمان مراجعه</th>
                                    <th style="display: none">تاریخ</th>
                                    <th>وضعیت</th>
                                    <th>ویرایش</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if (count($experts) > 0)
                                    @foreach($experts as $expert)
                                        <tr>
                                            <td>
                                                {{$expert->name}} {{$expert->family}}
                                            </td>
                                            <td>

                                                @foreach($brands as $brand)
                                                    @if($brand->id == $expert->brand_id)
                                                        {{$brand->title}}
                                                    @endif
                                                @endforeach

                                                -

                                                @foreach($models as $model)
                                                    @if($model->id == $expert->model_id)
                                                        {{$model->title}}
                                                    @endif
                                                @endforeach

                                            </td>
                                            <td>
                                                {{$expert->phone_number}}
                                            </td>
                                            <td>
                                                <span>
                                                @foreach(json_decode($expert->reserveDate, true) as $key => $value)

                                                        @if($key == "date")
                                                            {{ $value }} :
                                                        @endif

                                                        @if($key == "time")
                                                            {{ $value }}
                                                        @endif

                                                    @endforeach
                                                </span>
                                            </td>
                                            <td style="display: none">
                                                {{$expert->created_at}}
                                            </td>

                                            <td>
                                                @include('panelAdmin.statusexperts')
                                            </td>

                                            <td class="edite-td">
                                                <a href="{{ route('expert.edit',$expert->id) }}"
                                                   class="icon-box edite-icon" data-toggle="tooltip"
                                                   data-original-title="ویرایش"></a>
                                                <a href="{{ route('expert.delete',$expert->id) }}"
                                                   class="icon-box delete-icon" data-toggle="tooltip"
                                                   data-original-title="حذف"></a>
                                                {{--                                            <a href="#" class="btn waves-effect waves-light btn-rounded btn-info px-4">ثبت--}}
                                                {{--                                                آگهی</a>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td> -</td>
                                        <td> -</td>
                                        <td> آگهی کارشناس وجود ندارد</td>
                                        <td> -</td>
                                        <td> -</td>
                                        <td> -</td>
                                    </tr>
                                @endif

                                </tbody>
                            </table>
                        </div>
                        <div class="btn-group mr-2" role="group" aria-label="First group">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

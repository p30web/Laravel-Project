@extends('layouts.masterPanelAdmin')

@section('customCss')
    <link rel="stylesheet" href="{{asset('adminpanel/assets/css/DatePicker.css')}}">
@stop

@section('customJs')
    <script src="{{asset('adminpanel/assets/js/DatePicker.js')}}"></script>
@stop

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

                        <form class="form-horizontal" method="post" action="{{ route('expert.filter') }}">
                            {{csrf_field()}}
                            <div class="form-group row" style="margin-bottom: 2px">


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="expert_status" class="form-control custom-select" data-placeholder="Choose a Category"
                                                tabindex="1">
                                            <option value="11" selected>همه</option>
                                            <option value="1">کارشناسی شده</option>
                                            <option value="0">کارشناسی نشده</option>
                                        </select>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input autocomplete="off" type="text"  name="date" mh1pdp class="form-control"
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


                        <div class="table-responsive">
                            <table class="table table-expert-ok">
                                <thead class="bg-eaf color-mashinchi th-p15">
                                <tr>
                                    <th>نام و نام خانوادگی</th>
                                    <th>برند و مدل</th>
                                    <th>شماره تماس</th>
                                    <th>روز و زمان مراجعه</th>
                                    <th>وضعیت</th>
                                    <th>ویرایش</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if (count($experts) > 0)
                                    @foreach($experts as $expert)
                                        <tr>
                                            <td>
                                                {{$expert->user->name}} {{$expert->user->family}}
                                            </td>
                                            <td>
                                                {{$expert->brand_id}} -  {{$expert->model_id}}
                                            </td>
                                            <td>
                                                {{$expert->user->phone_number}}
                                            </td>

                                            <td>
                                                <span style="display: inline-block;direction: ltr">
                                                    {{json_decode($expert->reserve['reserveDate'],true)['time']}} -
                                                    {{json_decode($expert->reserve['reserveDate'],true)['date']}}
                                                </span>
                                            </td>

                                            <td>
                                                @include('panelAdmin.statusexperts')
                                            </td>

                                            <td class="edite-td">
                                                <a href="{{ route('expert.edit',$expert->id) }}" class="icon-box edite-icon" data-toggle="tooltip"
                                                   data-original-title="ویرایش"></a>
                                                <a href="{{ route('expert.delete',$expert->id) }}" class="icon-box delete-icon" data-toggle="tooltip"
                                                   data-original-title="حذف"></a>
                                                {{--                                            <a href="#" class="btn waves-effect waves-light btn-rounded btn-info px-4">ثبت--}}
                                                {{--                                                آگهی</a>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td> - </td>
                                        <td> - </td>
                                        <td> آگهی کارشناس وجود ندارد </td>
                                        <td> - </td>
                                        <td> - </td>
                                    </tr>
                                @endif

                                </tbody>
                            </table>
                        </div>
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            {{ $experts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
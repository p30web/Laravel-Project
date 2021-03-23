@extends('layouts.masterPanelAdmin')
@section('content')
    <div class="container-fluid">


        <!-- Row -->
        <div class="row machinechiaddad">
            <div class="col-lg-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"> اطلاعات آگهی </h4>
                    </div>
                    <div class="card-body">
                        <form method="POST"
                              action="{{ route('sale.update', $sale->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"> عنوان آگهی </label>
                                            <input type="text" class="form-control rounded-0" placeholder=""
                                                   name="title" value="{{($sale->adver->title?$sale->adver->title : old('title'))}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"> عنوان آگهی (انگلیسی) </label>
                                            <input type="text" class="form-control rounded-0" placeholder="" name="slug"
                                                   value="{{$sale->adver->slug}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"> انتخاب برند </label>
                                            <select name="brand" class="form-control custom-select selectBrand"
                                                    placeholder="" tabindex="1">
                                                @foreach($brands as $brand)
                                                    <option {!! ($sale->adver->brand_id == $brand->title ? 'selected' : '' ) !!} value="{{$brand->id}}">{{$brand->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"> مدل خودرو </label>
                                            <select name="model" class="form-control custom-select selectModel"
                                                    placeholder="" tabindex="1">
                                                @foreach($models as $model)
                                                    <option {!! ($sale->adver->model_id == $model->title ? 'selected' : '' ) !!} value="{{$model->id}}">{{$model->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                </div>

                                <div class="row">
                                {{--                                    <div class="col-md-6">--}}
                                {{--                                        <div class="form-group">--}}
                                {{--                                            <label class="control-label"> پکیج خودرو</label>--}}
                                {{--                                            <select class="form-control custom-select rounded-0" placeholder="" tabindex="1">--}}
                                {{--                                                <option value="Category 1"></option>--}}
                                {{--                                            </select>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"> سال ساخت (میلادی) </label>
                                            <select name="production" class="form-control custom-select rounded-0"
                                                    placeholder="" tabindex="1">
                                                @foreach($productions as $production)
                                                    <option {!! ($sale->production_id == $production->id ? 'selected' : '' ) !!} value="{{$production->id}}">{{$production->slug}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"> قیمت (تومان) </label>
                                            <input name="price" type="text" class="form-control rounded-0"
                                                   placeholder="" value="{{$sale->price}}">
                                        </div>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"> نوع شاسی </label>
                                            <select name="chassistype" class="form-control custom-select rounded-0"
                                                    placeholder="" tabindex="1">
                                                @foreach($chassistypes as $chassistype)
                                                    <option {!! ($chassistype->id == $adver->sale->chassi_type ? 'selected' : '' ) !!} value="{{$chassistype->id}}">{{$chassistype->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"> وضعیت گیربکس </label>
                                            <select name="gearboxstatus" class="form-control custom-select rounded-0"
                                                    placeholder="" tabindex="1">
                                                @foreach($gearboxstatuses as $gearboxstatus)
                                                    <option {!! ($gearboxstatus['id'] == $adver->sale->girbox ? 'selected' : '' ) !!} value="{{$gearboxstatus['id']}}">{{$gearboxstatus['title']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"> وضعیت خودرو </label>
                                            <select name="carstatus" class="form-control custom-select rounded-0"
                                                    placeholder="" tabindex="1">
                                                @foreach($carstatuses as $carstatus)
                                                    <option {!! ($carstatus['id'] == $adver->sale->car_status ? 'selected' : '' ) !!} value="{{$carstatus['id']}}">{{$carstatus['title']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"> نوع دیفرانسیل </label>
                                            <select name="differential" class="form-control custom-select rounded-0"
                                                    placeholder="" tabindex="1">
                                                @foreach($differentiales as $differential)
                                                    <option {!! ($differential['id'] == $adver->sale->differential ? 'selected' : '' ) !!} value="{{$differential['id']}}">{{$differential['title']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"> کارکرد </label>
                                            <input name="amortization" type="text" class="form-control rounded-0"
                                                   value="{{$sale->amortization}}" placeholder="">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"> رنگ </label>
                                            <select name="color" class="form-control custom-select rounded-0"
                                                    placeholder="" tabindex="1">
                                                @foreach($colors as $color)
                                                    <option {!! ($sale->color_id == $color->id ? 'selected' : '' ) !!} value="{{$color->id}}">{{$color->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--/span-->

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"> استان </label>
                                            <select class="form-control custom-select rounded-0" placeholder=""
                                                    tabindex="1" name="city">
                                                @foreach($cities as $city)
                                                    <option {!! ($sale->city_id == $city->id ? 'selected' : '' ) !!} value="{{$city->id}}">{{$city->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"> شهر </label>
                                            <select name="town" class="form-control custom-select rounded-0"
                                                    placeholder="" tabindex="1">
                                                @foreach($towns as $town)
                                                    <option {!! ($sale->town_id == $town->id ? 'selected' : '' ) !!} value="{{$town->id}}">{{$town->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--/span-->

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"> نوع خرید </label>
                                            <select name="cash" class="form-control custom-select rounded-0"
                                                    placeholder="" tabindex="1">
                                                @foreach($cashes as $cashe)
                                                    <option {!! ($cashe['id'] == $adver->sale->cash ? 'selected' : '' ) !!} value="{{$cashe['id']}}">{{$cashe['title']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"> محل فروش </label>
                                            <select name="in_place" class="form-control custom-select rounded-0"
                                                    placeholder="" tabindex="1">
                                                    <option {!! ($sale->in_place == true ? 'selected' : '') !!} value="true">ماشین چی</option>
                                                    <option {!! ($sale->in_place == false ? 'selected' : '') !!} value="false">نزد مشتری</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label "> توضیحات </label>
                                            <textarea name="description" class="mymce">{{$sale->description}}</textarea>
                                        </div>
                                        <label class="control-label"> وضعیت آگهی : </label>
                                        <select name="status" {!! ( $sale->status == 1 ? 'disabled' : '') !!} class="col-md-6 form-control custom-select rounded-0"
                                                placeholder="">
                                            <option {!! ( $sale->status == 1 ? 'selected' : '') !!} value="1">تایید آگهی</option>
                                            <option {!! ( $sale->status == 0 ? 'selected' : '') !!} value="0">رد آگهی</option>
                                            <option {!! ( $sale->status == 2 ? 'selected' : '') !!} value="2">حذف شده</option>
                                            <option {!! ( $sale->status == 3 ? 'selected' : '') !!} value="3">فروخته شده</option>
                                            <option {!! ( $sale->status == 4 ? 'selected' : '') !!} value="4">در انتظار تایید</option>
                                        </select>
                                        {!! ( $sale->status == 1 ? '<a href="#" id="changeStatus">آیا تمایل به تغییر وضعیت این آگهی دارید ؟</a>' : '') !!}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <input type="file" multiple name="images[]">
                                        <div class="row el-element-overlay editSaleMashinchi">
                                            @foreach($adver->images as $image)
                                                <div class="col-lg-3 col-md-6 p-30" id="images">
                                                    <input type="checkbox" name="deleteimages[]" style="display:none !important;"
                                                           id="package_expert_{{$image->id}}" value="{{$image->id}}"
                                                           class="filled-in chk-col-indigo">
                                                    <label for="package_expert_{{$image->id}}">
                                                        <div class="card">
                                                            <div class="el-card-item">
                                                                <div class="el-card-avatar el-overlay-1">
                                                                    <img src="{{ Storage::disk('public')->url($image->image_path) }}"
                                                                         alt="user">
                                                                    <div class="el-overlay">
                                                                        <ul class="el-info">
                                                                            <li>
                                                                                <a class="btn default btn-outline image-popup-vertical-fit"
                                                                                   href="{{ Storage::disk('public')->url($image->image_path) }}"><i
                                                                                            class="icon-magnifier"></i></a>
                                                                            </li>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="el-card-content">
                                                                    <a style="color:white" href="#"
                                                                       class="btn btn-danger">حذف تصویر</a>
                                                                    <br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="form-body last-section m-t-20">
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-rounded btn-info px-5">ویرایش آگهی
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="model_id_for_jquery" value="{{$sale->adver->model_id}}">
    </div>
@stop

@section('customJs')
    <script src="{{asset('adminpanel/assets/plugins/tinymce/tinymce.min.js')}}"></script>
    <script type="text/javascript">

        //change satus sale adver
        $('#changeStatus').on('click',function (e) {
            e.preventDefault();
            var selector = $("select[name='status']" );
            if (selector.is(':disabled')) {
                $(this).text('برای غیر فعال کردن کلیک کنید.');
                selector.prop('disabled', false);
            } else {
                $(this).text('آیا تمایل به تغییر وضعیت این آگهی دارید ؟');
                selector.prop('disabled', true);
            }

        });

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

        $('.el-card-content a').on('click',function (e) {
            e.preventDefault();
            var findElement = $(this).parent().parent().parent().parent().parent();
            var inputCheck = findElement.find('input[type="checkbox"]');
            if(inputCheck.prop("checked") == true){
                findElement.find('img').css({
                    "-webkit-filter" : "grayscale(0%)",
                    "filter" : "grayscale(0%)",
                });
                inputCheck.prop( "checked", false );
                $(this).text('حذف تصویر');
            }
            else if(inputCheck.prop("checked") == false){
                findElement.find('img').css({
                    "-webkit-filter" : "grayscale(100%)",
                    "filter" : "grayscale(100%)",
                });
                inputCheck.prop( "checked", true );
                $(this).text('برگشت تصویر');
            }

        });
    </script>
@stop
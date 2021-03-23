<?php

use Illuminate\Validation\Rule;

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'مقدار عددی :attribute باید بین :min و :max باشد.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'تعداد کاراکتر :attribute باید بین :min و :max باشد.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'مقدار وارد شده برای فیلدهای :attribute با هم مطابقت ندارند.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'فرمت ارسالی برای  فیلد :attribute باید بصورت :format باشد.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'در فیلد :attribute باید حتما :digits عدد وارد شود.',
    'digits_between' => 'در فیلد :attribute مقدار عددی وارد شده باید بین :min و :max باشد.',
    'dimensions' => 'برای فیلد :attribute ابعاد تصویر نامناسب است.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'یک :attribute معتبر وارد نمایید.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'فیلد :attribute حتما باید تصویر باشد.',
    'in' => 'فیلد :attribute نامعتبر می باشد.',
    'in_array' => 'مقدار :attribute در  :other یافت نشد.',
    'integer' => 'در فیلد :attribute حتما باید یک مقدار عددی صحیح وارد شود.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'فیلد :attribute نباید بزرگتر از :max باشد. ',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'مقدار وارد شده برای فیلد :attribute باید حتما از نوع :values باشد.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'فیلد :attribute حداقل باید :min باشد.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'تعداد کاراکتر فیلد :attribute حداقل باید :min باشد.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'فیلد :attribute باید از نوع عددی باشد.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'مقدار :attribute نامعتبر است.',
    'required' => 'پر کردن فیلد :attribute الزامیست.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'تعداد کاراکتر فیلد :attribute باید :size باشد.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'این :attribute قبلا ثبت شده است.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [

        'email' => 'ادرس ایمیل',
        'selectBrand' => 'برند',
        'selectModel' => 'مدل',
        'selectProductions' => 'سال تولید',
        'selectColors' => 'رنگ ماشین',
        'price' => 'قیمت',
        'karkard' => 'کارکرد',
        'selectCities' => 'استان',
        'description' => 'توضیحات',
        'titleProduct' => 'عنوان آگهی',
        'password' => 'پسورد',
        'phone_number' => 'شماره تلفن همراه',
        'reserveDate' => 'تاریخ رزرو',
        'chassisـnumber' => 'شماره شاسی خودرو',
        'tracking_code' => 'کد رهگیری گزارش کارشناسی',
        'differential' => 'نوع دیفرانسیل',
        'cash' => 'نوع پرداخت',
        'code_melli' => 'کد ملی',
        'inputLogin' => 'فیلد ورودی',
        'expire_time' => 'زمان انقضا',
        'name' => 'نام',
        'family' => 'نام خانوادگی',
        'production' => 'سال ساخت',
        'color' => 'رنگ خودرو',
        'bodystatus' => 'وضعیت بدنه',
        'placestain' => 'محل نقطه ها',//محل نقطه
        'amortization' => 'میزان کارکرد',//میزان کارکرد
        'city' => 'استان', //استان
        'town' => 'شهر', //شهر
        'in_place' => 'محل خودرو',
        'chassistype' => 'نوع شاسی',
        'gearboxstatus' => 'وضعیت گیربکس',
        'carstatus' => 'وضعیت خودرو',
        'image' => 'تصویر',
        'plaque.iran' => 'شماره پلاک (ایران)',
        'plaque.alphabet' => 'شماره پلاک‌ (حروف الفبا)',
        'plaque.first' => 'شماره پلاک (اولین رقم)',
        'plaque.second' => 'شماره پلاک (دومین رقم)',
        'package' => 'پکیج',
        'reserveTime' => 'ساعت رزرو'
    ],

];

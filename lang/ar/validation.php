<?php

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
    'phone' => 'المجال :attribute يجب أن يكون رقما صالحا.',
    'accepted' => 'يجب قبوله :attribute.',
    'accepted_if' => 'يجب قبول :attribute عندما يكون :other بقيمة :value.',
    'active_url' => ':attribute ليس عنوان URL صالحا.'
,    'after' => 'يجب أن يكون :attribute تاريخا بعد :date.',
    'after_or_equal' => 'يجب أن يكون :attribute تاريخا بعد أو يساوي :date.',
    'alpha' => 'يجب أن يتضمن :attribute حروفًا فقط.',
    'alpha_dash' => 'يجب أن يتضمن :attribute فقط حروفًا وأرقامًا وواصلات (-_)',
    'alpha_num' => 'يجب أن يتضمن :attribute فقط حروفًا وأرقامًا.',
    'array' => 'يجب أن يكون :attribute مصفوفة.',
    'before' => 'يجب أن يكون :attribute تاريخا قبل :date.',
    'before_or_equal' => 'يجب أن يكون :attribute تاريخا قبل أو يساوي :date.',
    'between' => [
        'array' => 'يجب أن يحتوي :attribute على ما بين :min و :max عنصر.',
        'file' => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
        'numeric' => 'يجب أن تكون القيمة العددية :attribute بين :min و :max.',
        'string' => 'يجب أن يتكون :attribute بين :min و :max حرف.',
    ],
    'boolean' => 'يجب أن يكون حقل :attribute قيمة صواب (true) أو خطأ (false).',
    'confirmed' => 'تأكيد :attribute غير مطابق.',
    'current_password' => 'كلمة المرور غير صحيحة.',
    'date' => ':attribute ليس تاريخا صحيحا.',
    'date_equals' => 'يجب أن يكون :attribute تاريخا مساويا لـ :date.',
    'date_format' => 'لا يتطابق تنسيق :attribute مع التنسيق المطلوب :format.',
    'declined' => 'يجب رفض :attribute.',
    'declined_if' => 'يجب رفض :attribute عندما يكون :other بقيمة :value.',
    'different' => 'يجب أن يختلف كل من :attribute و :other.',
    'digits' => 'يجب أن يكون :attribute مكونًا من :digits رقمًا.',
    'digits_between' => 'يجب أن يكون :attribute بين :min و :max رقمًا.',
    'dimensions' => 'أبعاد الصورة في :attribute غير صحيحة.',
    'distinct' => 'حقل :attribute يجب أن يكون مميز.',
    'email' => 'يجب أن يكون :attribute عنوان بريد إلكتروني صالحًا.',
    'ends_with' => 'يجب أن ينتهي :attribute بأحد العناصر التالية: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'exists' => ':attribute المحدد غير صالح.',
    'file' => ':attribute يجب أن يكون ملفًا.',
    'filled' => 'حقل :attribute يجب أن يحتوي على قيمة.',
    'gt' => [
        'array' => ':attribute يجب أن يحتوي على أكثر من :value عنصر.',
        'file' => ':attribute يجب أن يكون أكبر من :value كيلوبايت.',
        'numeric' => ':attribute يجب أن يكون أكبر من :value.',
        'string' => ':attribute يجب أن يكون أطول من :value حرف.',
    ],
    'gte' => [
        'array' => ':attribute يجب أن يحتوي على :value عنصر أو أكثر.',
        'file' => ':attribute يجب أن يكون أكبر من أو يساوي :value كيلوبايت.',
        'numeric' => ':attribute يجب أن يكون أكبر من أو يساوي :value.',
        'string' => ':attribute يجب أن يكون أطول من أو يساوي :value حرف.',
    ],
    'image' => ':attribute يجب أن يكون صورة.',
    'in' => ':attribute المحدد غير صالح.',
    'in_array' => 'حقل :attribute غير موجود في :other.',
    'integer' => ':attribute يجب أن يكون عددًا صحيحًا.',
    'ip' => ':attribute يجب أن يكون عنوان IP صالحًا.',
    'ipv4' => ':attribute يجب أن يكون عنوان IPv4 صالحًا.',
    'ipv6' => ':attribute يجب أن يكون عنوان IPv6 صالحًا.',
    'json' => ':attribute يجب أن يكون سلسلة JSON صالحة.',
    'lt' => [
        'array' => ':attribute يجب أن يحتوي على أقل من :value عنصر.',
        'file' => ':attribute يجب أن يكون أقل من :value كيلوبايت.',
        'numeric' => ':attribute يجب أن يكون أقل من :value.',
        'string' => ':attribute يجب أن يكون أقل من :value حرف.',
    ],
    'lte' => [
        'array' => ':attribute يجب أن لا يزيد عن :value عنصر.',
        'file' => ':attribute يجب أن يكون أقل من أو يساوي :value كيلوبايت.',
        'numeric' => ':attribute يجب أن يكون أقل من أو يساوي :value.',
        'string' => ':attribute يجب أن يكون أقل من أو يساوي :value حرف.',
    ],
    'mac_address' => ':attribute يجب أن يكون عنوان MAC صالحًا.',
    'max' => [
        'array' => ':attribute يجب أن لا يزيد عن :max عنصر.',
        'file' => ':attribute يجب أن لا يكون أكبر من :max كيلوبايت.',
        'numeric' => ':attribute يجب أن لا يكون أكبر من :max.',
        'string' => ':attribute يجب أن لا يكون أكبر من :max حرف.',
    ],

    'mimes' => ':attribute يجب أن يكون ملفًا من نوع: :values.',
    'mimetypes' => ':attribute يجب أن يكون ملفًا من نوع: :values.',
    'min' => [
        'array' => ':attribute يجب أن يحتوي على :min عنصر على الأقل.',
        'file' => ':attribute يجب أن يكون :min كيلوبايت على الأقل.',
        'numeric' => ':attribute يجب أن يكون :min على الأقل.',
        'string' => ':attribute يجب أن يكون :min حرف على الأقل.',
    ],

    'multiple_of' => ':attribute يجب أن يكون مضاعفًا لـ :value.',
    'not_in' => ':attribute المحدد غير صالح.',
    'not_regex' => 'تنسيق :attribute غير صالح.',
    'numeric' => ':attribute يجب أن يكون رقمًا.',

    'password' => [
        'letters' => ':attribute يجب أن يحتوي على حرف واحد على الأقل.',
        'mixed' => ':attribute يجب أن يحتوي على حرف واحد على الأقل كبيرًا وصغيرًا.',
        'numbers' => ':attribute يجب أن يحتوي على رقم واحد على الأقل.',
        'symbols' => ':attribute يجب أن يحتوي على رمز واحد على الأقل.',
        'uncompromised' => 'ظهرت قيمة :attribute في تسريب للبيانات. يرجى اختيار قيمة مختلفة لـ :attribute.',
    ],

    'present' => 'حقل :attribute يجب أن يكون موجودًا.',
    'prohibited' => 'حقل :attribute محظور.',
    'prohibited_if' => 'حقل :attribute محظور عندما يكون :other يساوي :value.',
    'prohibited_unless' => 'حقل :attribute محظور إلا إذا كانت قيمة :other ضمن :values.',
    'prohibits' => 'حقل :attribute يمنع وجود حقل :other.',
    'regex' => 'تنسيق :attribute غير صالح.',
    'required' => 'حقل :attribute مطلوب.',
    'required_array_keys' => 'يجب أن يحتوي حقل :attribute على مداخل للـ:values.',
    'required_if' => 'حقل :attribute مطلوب عندما يكون :other يساوي :value.',
    'required_unless' => 'حقل :attribute مطلوب إلا إذا كانت قيمة :other ضمن :values.',
    'required_with' => 'حقل :attribute مطلوب عندما توجد قيمة في :values.',
    'required_with_all' => 'حقل :attribute مطلوب عندما توجد قيم في :values.',
    'required_without' => 'حقل :attribute مطلوب عندما لا توجد قيمة في :values.',
    'required_without_all' => 'حقل :attribute مطلوب عندما لا توجد أي قيم من :values.',
    'same' => ':attribute يجب أن يتطابق مع :other.',
    'size' => [
        'array' => ':attribute يجب أن يحتوي على :size عنصر.',
        'file' => ':attribute يجب أن يكون :size كيلوبايت.',
        'numeric' => ':attribute يجب أن يكون :size.',
        'string' => ':attribute يجب أن يكون :size حرفًا.',
    ],
    'starts_with' => ':attribute يجب أن يبدأ بأحد العناصر التالية: :values.',
    'doesnt_start_with' => ':attribute يجب ألا يبدأ بأحد العناصر التالية: :values.',
    'string' => ':attribute يجب أن يكون سلسلة نصية.',
    'timezone' => ':attribute يجب أن تكون منطقة زمنية صالحة.',
    'unique' => 'قيمة :attribute مستخدمة بالفعل.',
    'uploaded' => 'فشل في تحميل :attribute.',
    'url' => ':attribute يجب أن يكون عنوان URL صالحًا.',
    'uuid' => ':attribute يجب أن يكون معرفًا عالميًا فريدًا (UUID) صالحًا.',

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

    'attributes' => [],

];

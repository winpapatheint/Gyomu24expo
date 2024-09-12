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

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    // 'after' => 'The :attribute must be a date after :date.',
    'after' => ':attributeの設定が正しくありません',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute must only contain letters.',
    'alpha_dash' => 'The :attribute must only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute must only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => ':attribute 일치하지 않습니다',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => ':max桁以内に入力してくだい',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => '유효한 :attribute 입력하세요',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
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
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
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
        'numeric' => 'The :attribute must not be greater than :max.',
        'file' => 'The :attribute must not be greater than :max kilobytes.',
        'string' => '最大:max桁半角数字を入力してください',
        'array' => 'The :attribute must not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => ':attribute :min 자리 이상 자리수로 입력하세요',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => ':attribute :min 자리 이상 자리수로 입력하세요',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => ':attribute 선택하세요',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => ':attributeに数字を入力してください ',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'regex' => ' 유효한  :attribute 입력하세요.',
    'required' => ':attribute 입력하세요',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => ':attribute 이미 등록되어 있습니다',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',
    'pleasecheck' => '체크해 주세요',
    'pleasefilltaskname' => '의뢰명을 입력하세요',
    'pleasefilltaskmsg' => '의뢰 내용/상품을 입력해 주세요',
    'hcompanynamepleaseinput' => '관리회사 이름을 입력하세요',
    'hcompanyfurinamepleaseinput' => '대표자 이름을 입력하세요',
    'pleaseuploadimgfile' => '이미지 파일을 업로드하세요',

    
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
        'email' => [
            'unique' => '이메일 주소가 이미 등록되어 있습니다',
        ],
        'entity' => [
            'not_in' => '사업 형태를 선택해 주세요',
        ],
        'infcdesirepay' => [
            'not_in' => '항목 희망사항을 선택해 주세요',
        ],
        'password' => [
            'confirmed' => '비밀번호가 일치하지 않습니다',
        ],
    ],

    /*
항목 희망사항을 선택해 주세요
    사업 형태를 선택해 주세요
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
        'email' => '이메일 주소를',
        'password' => '비밀번호를 ',
        'name' => '성명을',
        'furiname' => '성명 (영문)을',
        'gender' => '성별을',
        'agerange' => '연령을',
        'phone' => '전화번호를',
        'types' => '分類種類',
        'b_type' => '大分類',
        'm_type' => '中分類',
        's_type' => '小分類',
        'fee' => 'チケット価格',
        'seminar_name' => 'セミナー氏名',
        'startdt' => '開始日時',
        'enddt' => '終了日時',
        'participant_limit' => '制限人数',
        'subject' => '제목을',
        'message' => '내용을',
        'title' => '제목을',
        'category' => 'カテゴリー',
        'content' => '内容',
        'image' => 'イメージ',
        'bunrui' => '分類',
        'qname' => '問題名',
        'qtype' => '本文/質問',
        'ansformat' => '解答方式',
        'mark' => '配点',
        'qid' => '任意の番号',
        'testname' => '試験名',
        'testminute' => '試験時間(分)',
        'anskeyin' => '正解',
        'passkey' => '予約許可番号',

        'address' => '주소를',
        'compname' => '회사명을',
        'entity' => '사업형태',
        'purpose' => '이용목적을',
        'compindustry' => '업종을',
        'position' => '직책을',
        
        'deliveryperiod' => '선정시기를',
        'contactmethod' => '연락 방법을',
        'budget' => '예산을',
        'infcgender'=>'성별을',
        'infccountry'=>'게시할 국가를',
        'infcmedia'=>'주요 게시물 미디어를',
        'infcgenre'=>'주요 게시물 장르를',
        'infcdesirepay'=>'案件依頼のご連絡',
        'city'=>'거주 지역을',

    ],

];

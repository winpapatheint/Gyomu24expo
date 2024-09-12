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
    'confirmed' => ':attributeが一致しません',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => ':max桁以内に入力してくだい',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => '有効な:attributeを入力してください',
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
        'numeric' => ':attribute を:min 桁以上で入力してください',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => ':attribute を:min 桁以上で入力してください',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => ':attributeを選択してください',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => ':attributeに数字を入力してください ',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'regex' => '有効な:attributeを入力してください',
    'required' => ':attributeを入力してください',
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
    'unique' => ':attributeが既に登録されています',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',
    'pleasecheck' => 'チェックしてください',
    'pleasefilltaskname' => '依頼名を入力してください',
    'pleasefilltaskmsg' => '依頼内容/商材を入力してください',
    'hcompanynamepleaseinput' => '会社名を入力してください',
    'hcompanyfurinamepleaseinput' => '代表者名を入力してください',
    'pleaseuploadimgfile' => '画像ファイルをアップロードしてください',



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
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'name' => '氏名',
        'furiname' => '氏名（フリガナ）',
        'gender' => '性別',
        'agerange' => '年齢代',
        'phone' => '電話番号',
        'types' => '分類種類',
        'b_type' => '大分類',
        'm_type' => '中分類',
        's_type' => '小分類',
        'fee' => 'チケット価格',
        'seminar_name' => 'セミナー氏名',
        'startdt' => '開始日時',
        'enddt' => '終了日時',
        'participant_limit' => '制限人数',
        'subject' => '件名',
        'message' => '内容',
        'title' => 'タイトル',
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

        'address' => '住所',
        'compname' => '会社名',
        'entity' => '事業形態',
        'purpose' => 'リスト閲覧の目的',
        'compindustry' => '業種',
        'position' => '役職',
        
        'deliveryperiod' => '選定時期',
        'contactmethod' => '連絡方法',
        'budget' => '予算',
        'infcgender'=>'性別',
        'infccountry'=>'投稿先国',
        'infcmedia'=>'おもな投稿のメディア',
        'infcgenre'=>'おもな投稿のジャンル',
        'infcdesirepay'=>'案件依頼のご連絡',
        'city'=>'居住地域',

        'teamname'=>'担当部署',
        'expireddate'=>'募集終了予定日',
        'positionname'=>'求人タイトル',
        'openingcount'=>'予定募集人数',
        'worklocation'=>'勤務地',
        'jobdesp'=>'仕事内容',
        'requiredskill'=>'必須要件',
        'educationlevel'=>'最終学歴',
        'startage'=>'応募可能年齢',
        'untilage'=>'応募可能年齢',
        'previouscompanies'=>'就業経験社数',
        'divisionname'=>'部署名',
        'divisiondetails'=>'部署詳細',
        'salaryfrom'=>'想定年収',
        'salaryto'=>'想定年収',
        'annualleave'=>'年間休日',
        'leavedetails'=>'休日・休暇',
        'welfare'=>'福利厚生',

        'membernumber'=>'従業員数',
        'dob'=>'設立年月',
        'companyinfo'=>'事業内容',

        'closemonth' => '決算月',
        'listed' => '上場有無',
        'companycontent' => '事業内容',

        'picname' => '代表者名',
        'picnamefurigana' => '代表者名（ふりかな）',
        'capital' => '資本金',
        'establishdate' => '設立年月',
        'postalcode' => '郵便番号',

        'companyname' => '所属会社名',
        'officepostalcode' => '勤務先郵便番号',
        'officeaddress' => '勤務先住所',
        'departmentname' => '部署名',
        'occupation' => '役職',

        'negoid' => '商談番号',
        'negovalue' => '商談金額',
        'discount' => '値引価額',
        'agreementnumber' => '契約数',
        'purchasevalue' => '仕入金額',
        'productname' => '商品/サービス名',
        'createdate' => '作成日',
        'orderdate' => '受注予定日',
        'action' => 'ネクストアクション',
        'invoicetype' => '請求タイプ',
        'inquiryno' => '問合せ番号',
        'addressextra' => '住所2',

        
        'agreementvalue' => '契約金額',
        'agreementid' => '契約番号',
    ],

];

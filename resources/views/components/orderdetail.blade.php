
                @foreach( $lists as $key => $list )
                <!-- Modal -->
               <div class="modal fade" id="showdetailmodal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="deleteConfirmModalLabel">{{ __('user.taskdetail') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">

                        @php
                            $role = auth()->user()->role;
                        @endphp
                                  @if(!empty($list->image))
                        <p>
                                  <img id="preview-image-before-upload" alt="your image" 
                                  src="{{ asset('images/avatar/'.$list->image   ) }}"
                                  style="max-width: 100%;">
                        </p>
                                  @endif


                        <p><strong>{{ __('user.taskno') }} : </strong><span>{{ sprintf('%06d', $list->taskidno ?? $list->id) }}</span></p>
                        <p><strong>{{ __('user.taskname') }} : </strong><span>{{ $list->positionname }}</span></p>
                        <p><strong>{{ __('user.tasktime') }} : </strong><span>{{ date('Y/m/d H:i', strtotime($list->created_at)) }}</span></p>
                        <p><strong>{{ __('募集終了予定日') }} : </strong><span>{{ date('Y/m/d', strtotime($list->expireddate)) }}</span></p>

                        <p><strong>{{ __('担当部署') }} : </strong><span>{{ $list->teamname }}</span></p>
                        <p><strong>{{ __('募集職種') }} : </strong><span>{{ $list->positioncategory }}</span></p>
                        <p><strong>{{ __('労働時間区分') }} : </strong><span>{{ $list->positiondivision }}</span></p>

@php

$attractcustomer = array(
                        '2' => '集客利用可',
                        '1' => '集客利用不可',
                        );

$educationlevel = array(
                        "1" => "不問",
                        "2" => "高校卒業以上",
                        "3" => "高専卒業以上",
                        "4" => "短大・専門卒業以上",
                        "5" => "大学卒業以上",
                        "6" => "MARCH以上",
                        "7" => "早慶・国公立以上",
                        "8" => "大学院卒以上",
                        );

$previouscompanies = array(
                        "1" => "1社まで可",
                        "2" => "2社まで可",
                        "3" => "3社まで可",
                        "4" => "4社まで可",
                        "5" => "不問",
                        );

$gender = array(
                "1" => "男性",
                "2" => "女性",
                "3" => "どちらでも",
                );

$inexperienced = array(
                "1" => "不可",
                "2" => "業界未経験可",
                "3" => "職種未経験可",
                "4" => "業界・職種未経験可",
                );

$foreign = array(
                "1" => "不可",
                "2" => "可",
                );

$englishlvl = array(
                "1" => "不問",
                "2" => "日常会話レベル",
                "3" => "ビジネスレベル",
                "4" => "ネイティブレベル",
                );

$drivinglicense = array(
                "1" => "不要",
                "2" => "必須",
                "3" => "入社時までに取得必須",
                );

$positionoffer = array(
                "1" => "雇用形態を選択",
                "2" => "正社員",
                "3" => "契約社員",
                "4" => "パート・アルバイト",
                );

$workinghourtype = array(
                        "1" => "固定（一般的な勤務時間）",
                        "2" => "フレックス制（コアタイムあり）",
                        "3" => "フレックス制（コアタイムなし）",
                        "4" => "変形労働時間制（1ヶ月単位）",
                        "5" => "変形労働時間制（1年単位）",
                        "6" => "裁量労働時間制（みなし労働時間制）",
                        "7" => "その他",
                        );

$salarysystem = array(
                        "1" => "月給制（月給=基本給）",
                        "2" => "月給制（定額手当あり、みなし残業代なし）",
                        "3" => "月給制（定額手当なし、みなし残業代あり）",
                        "4" => "月給制（定額手当あり、みなし残業代あり）",
                        "5" => "年棒製（になし残業代なし）",
                        "6" => "年棒製（みなし残業代あり）",
                        "7" => "時給制",
                        "8" => "日給制",
                        "9" => "その他",
                        );

$smoking = array(
            "1" => "禁煙",
            "2" => "喫煙スペースあり",
            "3" => "無し（喫煙可）",
            );
@endphp


                        <p><strong>{{ __('集客利用の可/不可') }} : </strong><span>{{ $attractcustomer[$list->attractcustomer] }}</span></p>

                        <p><strong>{{ __('勤務地') }} : </strong><span>{{ $list->worklocation }}</span></p>

                        <p><strong>{{ __('仕事内容') }} : </strong><br><span>{!! $list->jobdesp ?? '' !!}</span></p>
                        <p><strong>{{ __('仕事の醍醐味') }} : </strong><br><span>{!! $list->workdetail ?? '' !!}</span></p>
                        <p><strong>{{ __('活躍できる経験') }} : </strong><br><span>{!! $list->workexperience ?? '' !!}</span></p>
                        <p><strong>{{ __('必須要件') }} : </strong><br><span>{!! $list->requiredskill ?? '' !!}</span></p>

                        <p><strong>{{ __('最終学歴') }} : </strong><span>{{ $educationlevel[$list->educationlevel] }}</span></p>
                        <p><strong>{{ __('応募可能年齢') }} : </strong><span>{{ $list->startage }} ～ {{ $list->untilage }}</span></p>
                        <p><strong>{{ __('就業経験社数') }} : </strong><span>{{ $previouscompanies[$list->previouscompanies] }}</span></p>
                        <p><strong>{{ __('性別') }} : </strong><span>{{ $gender[$list->gender] }}</span></p>
                        <p><strong>{{ __('外国籍の可否') }} : </strong><span>{{ $foreign[$list->foreign] }}</span></p>
                        <p><strong>{{ __('英語レベル') }} : </strong><span>{{ $englishlvl[$list->englishlvl] }}</span></p>
                        <p><strong>{{ __('普通自動車免許') }} : </strong><span>{{ $drivinglicense[$list->drivinglicense] }}</span></p>

                        <p><strong>{{ __('部署名') }} : </strong><span>{{ $list->divisionname }}</span></p>
                        <p><strong>{{ __('部署詳細') }} : </strong><br><span>{!! $list->divisiondetails ?? '' !!}</span></p>
                        <p><strong>{{ __('雇用形態') }} : </strong><span>{{ $positionoffer[$list->positionoffer] }}</span></p>
                        <p><strong>{{ __('勤務時間タイプ') }} : </strong><span>{{ $workinghourtype[$list->workinghourtype] }}</span></p>
                        <p><strong>{{ __('残業時間') }} : </strong><br><span>{!! $list->overtime ?? '' !!}</span></p>

                        <p><strong>{{ __('選考詳細') }} : </strong><br><span>{!! $list->selectiondetails ?? '' !!}</span></p>

                        <p><strong>{{ __('想定年収') }} : </strong><span>{{ $list->salaryfrom }} 万円～ {{ $list->salaryto }} 万円</span></p>
                        <p><strong>{{ __('試用期間') }} : </strong><span>@if( $list->probation == 'on' ) あり @else なし @endif</span></p>
                        <p><strong>{{ __('給与タイプ') }} : </strong><span>{{ $salarysystem[$list->salarysystem] }}</span></p>
                        <p><strong>{{ __('年間休日') }} : </strong><span>{{ $list->annualleave }} 日</span></p>

                        <p><strong>{{ __('休日・休暇') }} : </strong><br><span>{!! $list->leavedetails ?? '' !!}</span></p>
                        <p><strong>{{ __('福利厚生') }} : </strong><br><span>{!! $list->welfare ?? '' !!}</span></p>

                        <p><strong>{{ __('受動喫煙対策') }} : </strong><span>{{ $smoking[$list->smoking] }}</span></p>
                        <p><strong>{{ __('受動喫煙対策（詳細）') }} : </strong><br><span>{!! $list->smokingdetails ?? '' !!}</span></p>                        
                        
                     </div>
                 <!--     <div class="modal-footer">
                        <button type="button" class="btn btn-danger">削除する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div> -->
                  </div>
                  </div>
               </div>
                @endforeach
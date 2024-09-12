<x-auth-layout>

<style type="text/css">
   .boxlabel{
      margin-left: 20px;
   }
</style>

      @php $subtitle=__('welcome.managetask'); @endphp
      @include('components.subtitle')

      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center">
                     <!-- <span>依頼</span> -->
                     {{ __('求人情報登録') }}
                  </h2>
               </div><!-- col end-->
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block" id="alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>    
                <strong>{{ $message }}</strong>
            </div>
            @endif

            @php $error = $errors->toArray(); @endphp
            @php $action = route('savetask'); @endphp

            <form id="makeapplication" method="POST" action="{{ $action }}" enctype="multipart/form-data">
            @csrf

            @if(!empty($task->id))
            <input type="hidden" name="id" value="{{$task->id}}">
            @endif

            <div class="row">

               <div class="col-lg-8 form-group mx-auto" style="border:1px solid #304586;">
                     <div class="error-container"></div>
                     <!-- <label for="email"><b>{{ __('user.taskrequest') }}</b></label> -->

                     <div class="row">
                        <div class="form-group col-12" style="background: #304586;">
                           <div>
                              <h4 style="color: white; margin-top: 0.5rem;"><b>{{ __('担当部署') }} </b></h4>                             
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('担当部署') }} {{--xxx_teamname--}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                              <input class="form-control form-control-name" placeholder="{{ __('') }}" name="teamname" id="teamname"
                                 type="text" value="{{ old('teamname') ?? $task->teamname ?? '' }}" style="line-height: 2.0;">
                                  <p class="error teamname text-danger"></p>
                           </div>
                        </div>
                     </div>

               </div>


               <div class="col-lg-8 form-group mx-auto" style="border:1px solid #304586;">
                     <div class="error-container"></div>
                     <!-- <label for="email"><b>{{ __('user.taskrequest') }}</b></label> -->

                     <div class="row">
                        <div class="form-group col-12" style="background: #304586;">
                           <div>
                              <h4 style="color: white; margin-top: 0.5rem;"><b>{{ __('募集期間') }}</b></h4>                             
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="expireddate"><b>{{ __('募集終了予定日') }} {{--xxx_expireddate--}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>          
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group" style="font-size: 16px;">
                              <input class="form-control form-control-name" name="expireddate" id="expireddate"
                                 type="date" @if(!empty($task->id)) value="{{ date('Y-m-d', strtotime($task->expireddate))  }}" @else value="{{ old('expireddate') ?? ''  }}" @endif style="line-height: 2.0;">
                              <p class="error expireddate text-danger"></p>
                        </div>
                        </div>
                     </div>

               </div>

               <div class="col-lg-8 form-group mx-auto" style="border:1px solid #304586;">
                     <div class="error-container"></div>
                     <!-- <label for="email"><b>{{ __('user.taskrequest') }}</b></label> -->

                     <div class="row">
                        <div class="form-group col-12" style="background: #304586;">
                           <div>
                              <h4 style="color: white; margin-top: 0.5rem;"><b>{{ __('募集ポジション') }}</b></h4>                             
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label><b>{{ __('求人タイトル') }} {{--xxx_positionname--}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                             
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                              <input class="form-control form-control-name" placeholder="{{ __('求人タイトル') }}" name="positionname" id="positionname"
                                 type="text" value="{{ old('positionname') ?? $task->positionname ?? '' }}" style="line-height: 2.0;">
                                  <p class="error positionname text-danger"></p>
                           </div>
                        </div>
                     </div>


                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label><b>{{ __('予定募集人数') }} {{--xxx_openingcount--}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                             
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                <select class="form-control selectpicker" name="openingcount" id="openingcount" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                    <option value="0">選択してください</option>
                                    <option @if((isset($task->openingcount)) AND ($task->openingcount == '1人')) selected @endif >1人</option>
                                    <option @if((isset($task->openingcount)) AND ($task->openingcount == '2人')) selected @endif >2人</option>
                                    <option @if((isset($task->openingcount)) AND ($task->openingcount == '3人')) selected @endif >3人</option>
                                    <option @if((isset($task->openingcount)) AND ($task->openingcount == '4人')) selected @endif >4人</option>
                                    <option @if((isset($task->openingcount)) AND ($task->openingcount == '10~19人')) selected @endif >10~19人</option>
                                    <option @if((isset($task->openingcount)) AND ($task->openingcount == '20~29人')) selected @endif >20~29人</option>
                                    <option @if((isset($task->openingcount)) AND ($task->openingcount == '30人~')) selected @endif >30人~</option>
                                </select>

                               <p class="error openingcount text-danger"></p>                            
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label><b>{{ __('募集職種') }}{{--xxx_positioncategory--}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                             
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                <select class="form-control" name="positioncategory" id="positioncategory" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                    <optgroup label="営業">
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '法人営業')) selected @endif >法人営業</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '個人営業')) selected @endif >個人営業</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'ルートセールス・代理店営業')) selected @endif >ルートセールス・代理店営業</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '内勤営業・カウンターセールス')) selected @endif >内勤営業・カウンターセールス</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '海外営業')) selected @endif >海外営業</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'カスタマーサポート・コールセンター運営')) selected @endif >カスタマーサポート・コールセンター運営</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'キャリアカウンセラー・人材コーディネーター')) selected @endif >キャリアカウンセラー・人材コーディネーター</option>
                                    </optgroup>
                                    <optgroup label="事務・管理">
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '財務・経理')) selected @endif >財務・経理</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '人事')) selected @endif >人事</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '総務・事務')) selected @endif >総務・事務</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '法務')) selected @endif >法務</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '広報・IR')) selected @endif >広報・IR</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '物流・貿易')) selected @endif >物流・貿易</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '一般事務・営業事務')) selected @endif >一般事務・営業事務</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '秘書')) selected @endif >秘書</option>
                                    </optgroup>
                                    <optgroup label="マーケティング">
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '商品企画・商品開発')) selected @endif >商品企画・商品開発</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'ブランドマネージャー・プロダクトマネージャー')) selected @endif >ブランドマネージャー・プロダクトマネージャー</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '広告・宣伝')) selected @endif >広告・宣伝</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '販売促進・販促企画')) selected @endif >販売促進・販促企画</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '営業企画')) selected @endif >営業企画</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'イベント企画・運営')) selected @endif >イベント企画・運営</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'Web・SNSマーケティング')) selected @endif >Web・SNSマーケティング</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'データアナリスト')) selected @endif >データアナリスト</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '市場調査・分析')) selected @endif >市場調査・分析</option>
                                    </optgroup>
                                    <optgroup label="経営企画・経営戦略">
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '経営企画・事業統括')) selected @endif >経営企画・事業統括</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '管理職・エグゼクティブ')) selected @endif >管理職・エグゼクティブ</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'MD・バイヤー・店舗開発・FCオーナー')) selected @endif >MD・バイヤー・店舗開発・FCオーナー</option>
                                    </optgroup>
                                    <optgroup label="ディレクター">
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'Webディレクター・Webプロデューサー')) selected @endif >Webディレクター・Webプロデューサー</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'テクニカルディレクター・プロジェクトマネージャー')) selected @endif >テクニカルディレクター・プロジェクトマネージャー</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'クリエイティブディレクター')) selected @endif >クリエイティブディレクター</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '制作・進行管理（その他）')) selected @endif >制作・進行管理（その他）</option>
                                    </optgroup>
                                    <optgroup label="クリエイティブ関連">
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'Webデザイナー')) selected @endif >Webデザイナー</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'UI・UXデザイナー')) selected @endif >UI・UXデザイナー</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'ゲームデザイナー・イラストレーター')) selected @endif >ゲームデザイナー・イラストレーター</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'CGデザイナー')) selected @endif >CGデザイナー</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'Web・モバイル・ソーシャル・ゲーム制作／開発')) selected @endif >Web・モバイル・ソーシャル・ゲーム制作／開発</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '編集・ライター')) selected @endif >編集・ライター</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '映像・動画関連')) selected @endif >映像・動画関連</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'ファッション・インテリア・空間・プロダクトデザイン')) selected @endif >ファッション・インテリア・空間・プロダクトデザイン</option>
                                    </optgroup>
                                    <optgroup label="ITエンジニア">
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '業務系アプリケーションエンジニア・プログラマ')) selected @endif >業務系アプリケーションエンジニア・プログラマ</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'Webサービス系エンジニア・プログラマ')) selected @endif >Webサービス系エンジニア・プログラマ</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '制御系ソフトウェア開発（通信・ネットワーク・IoT関連）')) selected @endif >制御系ソフトウェア開発（通信・ネットワーク・IoT関連）</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'インフラエンジニア')) selected @endif >インフラエンジニア</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'IT・システムコンサルタント')) selected @endif >IT・システムコンサルタント</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '社内情報システム（社内SE）')) selected @endif >社内情報システム（社内SE）</option>
                                    </optgroup>
                                    <optgroup label="エンジニア（機械・電気・電子・半導体・制御）">
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '機械・機構設計・金型設計')) selected @endif >機械・機構設計・金型設計</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '回路・システム設計')) selected @endif >回路・システム設計</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'サービスエンジニア・サポートエンジニアー')) selected @endif >サービスエンジニア・サポートエンジニアー</option>
                                    </optgroup>
                                    <optgroup label="素材・化学・食品・医薬品技術職">
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '素材・半導体素材・化成品関連')) selected @endif >素材・半導体素材・化成品関連</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '化粧品・食品・香料関連')) selected @endif >化粧品・食品・香料関連</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '医薬品関連')) selected @endif >医薬品関連</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '医療用具関連')) selected @endif >医療用具関連</option>
                                    </optgroup>
                                    <optgroup label="建築・土木技術">
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '研究開発・技術開発・構造解析・特許')) selected @endif >研究開発・技術開発・構造解析・特許</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '施工管理・設備・環境保全')) selected @endif >施工管理・設備・環境保全</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'プランニング・測量・設計・積算')) selected @endif >プランニング・測量・設計・積算</option>      
                                    </optgroup>
                                    <optgroup label="技能工・設備・交通・運輸">
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '技能工（整備・工場生産・製造・工事）')) selected @endif >技能工（整備・工場生産・製造・工事）</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '生産・品質管理')) selected @endif >生産・品質管理</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '運輸・配送・倉庫関連')) selected @endif >運輸・配送・倉庫関連</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '交通（鉄道・バス・タクシー）関連')) selected @endif >交通（鉄道・バス・タクシー）関連</option>
                                    </optgroup>
                                    <optgroup label="サービス 接客 店舗">
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '店長・SV（スーパーバイザー）')) selected @endif >店長・SV（スーパーバイザー）</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'ホールスタッフ')) selected @endif >ホールスタッフ</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '料理長')) selected @endif >料理長</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '調理')) selected @endif >調理</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '警備・施設管理関連職')) selected @endif >警備・施設管理関連職</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '販売・サービススタッフ')) selected @endif >販売・サービススタッフ</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '宿泊施設・ホテル')) selected @endif >宿泊施設・ホテル</option>
                                    </optgroup>
                                    <optgroup label="専門職（コンサルタント 士業 金融 不動産）">
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'ビジネスコンサルタント・シンクタンク')) selected @endif >ビジネスコンサルタント・シンクタンク</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '士業・専門コンサルタント')) selected @endif >士業・専門コンサルタント</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '金融系専門職')) selected @endif >金融系専門職</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '金融系専門職')) selected @endif >金融系専門職</option>
                                    </optgroup>
                                    <optgroup label="医療・福祉・介護">
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '医療・看護')) selected @endif >医療・看護</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '薬事')) selected @endif >薬事</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '臨床開発')) selected @endif >臨床開発</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '福祉・介護')) selected @endif >福祉・介護</option>
                                    </optgroup>
                                    <optgroup label="教育・保育関連">
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == '教育・保育')) selected @endif >教育・保育</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'インストラクター・通訳・翻訳')) selected @endif >インストラクター・通訳・翻訳</option>
                                       <option @if((isset($task->positioncategory)) AND ($task->positioncategory == 'その他')) selected @endif >その他</option>
                                    </optgroup>
                                </select>
                               <p class="error positioncategory text-danger"></p>                            
                           </div>
                        </div>
                     </div>

                     <div class="row border-bottom">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('労働時間区分') }} {{--xxx_positiondivision--}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                <select class="form-control selectpicker" name="positiondivision" id="positiondivision" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">

                                    <option @if((isset($task->positiondivision)) AND ($task->positiondivision == '通常（実労働時間と連動）')) selected @endif>通常（実労働時間と連動）</option>
                                    <option @if((isset($task->positiondivision)) AND ($task->positiondivision == 'みなし労働時間制')) selected @endif>みなし労働時間制</option>
                                </select>

                               <p class="error positiondivision text-danger"></p>                            
                           </div>
                        </div>
                     </div>

                     <div class="row border-bottom">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('集客利用の可/不可') }} {{--xxx_attractcustomer--}} </b></label>                            
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                <select class="form-control selectpicker" name="attractcustomer" id="attractcustomer" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                    <option @if((isset($task->attractcustomer)) AND ($task->attractcustomer == '2')) selected @endif  value="2">集客利用可</option>
                                    <option @if((isset($task->attractcustomer)) AND ($task->attractcustomer == '1')) selected @endif  value="1">集客利用不可</option>
                                 </select>
                           </div>
                        </div>
                     </div>

               </div>

               <div class="col-lg-8 form-group mx-auto" style="border:1px solid #304586;">
                     <div class="error-container"></div>
                     <!-- <label for="email"><b>{{ __('user.taskrequest') }}</b></label> -->

                     <div class="row">
                        <div class="form-group col-12" style="background: #304586;">
                           <div>
                              <h4 style="color: white; margin-top: 0.5rem;"><b>{{ __('魅力訴求') }}</b></h4>                             
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('カバー写真') }} {{--xxx_image--}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                              <input type="file" name="image" id="image" class="form-control" >
                                 <p class="error image text-danger"></p>
                                 <p><small>サイズ：横幅980px 縦幅400px推奨、ファイル形式：png, jpg<br>ファイル容量：3MBまで</small></p>
	                              @if(!empty($task->image))
	                              <img id="preview-image-before-upload" alt="your image" src="{{ asset('images/avatar/'.$task->image   ) }}" style="max-width: 100%;" />
                                 @else
                                 <img id="preview-image-before-upload" alt="your image" style="max-width: 100%; display: none;" />
	                              @endif
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label><b>{{ __('訴求ポイント') }}</b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                           
                           </div>
                        </div>
                        <div class="col-md-8">

                           @php

                              if(!empty($task->checkpoint)){
                                 $checkpoint = json_decode($task->checkpoint, true);
                              }

                           @endphp

                           <div class="form-group" style="font-size: 16px;">
                              <div>
                                 <input type="checkbox" class="form-check-input form-control form-control-name" style="width: 16px;height: 16px;  margin-left: unset;" name="checkpoint[1]" @if((isset($checkpoint[1])) AND ($checkpoint[1] == 'on')) checked @endif>
                                 <label class="boxlabel">{{ __(' 正社員経験なしOK') }}</label> 
                              </div>  
                              <div>
                                 <input type="checkbox" class="form-check-input form-control form-control-name" style="width: 16px;height: 16px;  margin-left: unset;" name="checkpoint[2]" @if((isset($checkpoint[2])) AND ($checkpoint[2] == 'on')) checked @endif>
                                 <label class="boxlabel">{{ __(' 上場企業') }}</label> 
                              </div>  
                              <div>
                                 <input type="checkbox" class="form-check-input form-control form-control-name" style="width: 16px;height: 16px;  margin-left: unset;" name="checkpoint[3]" @if((isset($checkpoint[3])) AND ($checkpoint[3] == 'on')) checked @endif>
                                 <label class="boxlabel">{{ __(' 車通勤OK') }}</label> 
                              </div>  
                              <div>
                                 <input type="checkbox" class="form-check-input form-control form-control-name" style="width: 16px;height: 16px;  margin-left: unset;" name="checkpoint[4]" @if((isset($checkpoint[4])) AND ($checkpoint[4] == 'on')) checked @endif>
                                 <label class="boxlabel">{{ __(' 転勤なし') }}</label> 
                              </div>  
                              <div>
                                 <input type="checkbox" class="form-check-input form-control form-control-name" style="width: 16px;height: 16px;  margin-left: unset;" name="checkpoint[5]" @if((isset($checkpoint[5])) AND ($checkpoint[5] == 'on')) checked @endif>
                                 <label class="boxlabel">{{ __(' 服装自由') }}</label> 
                              </div>  
                              <div>
                                 <input type="checkbox" class="form-check-input form-control form-control-name" style="width: 16px;height: 16px;  margin-left: unset;" name="checkpoint[6]" @if((isset($checkpoint[6])) AND ($checkpoint[6] == 'on')) checked @endif>
                                 <label class="boxlabel">{{ __(' 社員寮あり') }}</label> 
                              </div>  
                              <div>
                                 <input type="checkbox" class="form-check-input form-control form-control-name" style="width: 16px;height: 16px;  margin-left: unset;" name="checkpoint[7]" @if((isset($checkpoint[7])) AND ($checkpoint[7] == 'on')) checked @endif>
                                 <label class="boxlabel">{{ __(' 年間休日120日以上') }}</label> 
                              </div>  
                              <div>
                                 <input type="checkbox" class="form-check-input form-control form-control-name" style="width: 16px;height: 16px;  margin-left: unset;" name="checkpoint[8]" @if((isset($checkpoint[8])) AND ($checkpoint[8] == 'on')) checked @endif>
                                 <label class="boxlabel">{{ __(' 土日祝休み') }}</label> 
                              </div>  
                              <div>
                                 <input type="checkbox" class="form-check-input form-control form-control-name" style="width: 16px;height: 16px;  margin-left: unset;" name="checkpoint[9]" @if((isset($checkpoint[9])) AND ($checkpoint[9] == 'on')) checked @endif>
                                 <label class="boxlabel">{{ __(' 残業20時間以内') }}</label> 
                              </div>                                
                           </div>
                        </div>
                     </div>
               </div>

               <div class="col-lg-8 form-group mx-auto" style="border:1px solid #304586;">
                     <div class="error-container"></div>
                     <!-- <label for="email"><b>{{ __('user.taskrequest') }}</b></label> -->

                     <div class="row">
                        <div class="form-group col-12" style="background: #304586;">
                           <div>
                              <h4 style="color: white; margin-top: 0.5rem;"><b>{{ __('勤務地') }}</b></h4>                             
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label><b>{{ __('勤務地') }} {{--xxx_worklocation--}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                             
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                 <p><small>データがありません<br>複製元と同じ勤務地を入力したい場合は「過去に使用した勤務地を選択する」をクリック、異なる勤務地を入力したい場合は「勤務地を新規登録する」をクリックしてください。</small></p>
                              <input class="form-control form-control-name" placeholder="{{ __('勤務地') }}" name="worklocation" id="worklocation"
                                 type="text" value="{{ old('worklocation') ?? $task->worklocation ?? '' }}" style="line-height: 2.0;">
                                  <p class="error worklocation text-danger"></p>
                           </div>
                        </div>
                     </div>
               </div>

               <div class="col-lg-8 form-group mx-auto" style="border:1px solid #304586;">
                     <div class="error-container"></div>
                     <!-- <label for="email"><b>{{ __('user.taskrequest') }}</b></label> -->

                     <div class="row">
                        <div class="form-group col-12" style="background: #304586;">
                           <div>
                              <h4 style="color: white; margin-top: 0.5rem;"><b>{{ __('仕事内容') }}</b></h4>                             
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('仕事内容') }} {{--xxx_jobdesp--}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                             
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                <textarea class="form-control form-control-message" id="jobdesptextarea" 
                                placeholder="&bull;&nbsp;顧客ニーズに基づいた求人獲得戦略の立案&#10;&bull;&nbsp;アウトソーシング管理&#10;&bull;&nbsp;他社とのアライアンス策定&#10;&bull;&nbsp;セールスチームの予実管理&#10;&bull;&nbsp;セールスチームの生産性向上&#10;&bull;&nbsp;CRMツールを活用した顧客データ管理" rows="8"
                                >{!! str_replace("<br />","&#013;",old('jobdesp') ?? $task->jobdesp ?? '')  !!}</textarea>
                                <p style="display:none" class="jobdesp error text-danger"></p>                                 
                                <input type="hidden" name="jobdesp" id="jobdesp" value="{!! old('jobdesp') ?? $task->jobdesp ?? '' !!}">
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('仕事の醍醐味') }} {{--xxx_workdetail--}} </b></label>                             
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                <textarea class="form-control form-control-message" id="workdetailtextarea" placeholder="スタートアップで働くことは、新しい価値を生み出す苦悩が常に伴います。
まだ誰も実現していないことを実現するためには、決められた業務をこなし続けるだけでは不十分だからです。
会社の一人一人が顧客の課題に向き合い続け、打ち手を絶やさないように考え、そして実行し続けて初めて本質的な価値を生み出すことができると考えています。
言い換えれば、成熟した環境では決して得られない経験を短期間で経験できるチャンスです。
年齢やこれまでの経歴は、あくまで入社時点での一つの指標でしかありません。
入社後どのようにサービスをグロースさせるのかが全ての評価になります。
手を抜けない環境だからこそ本質的な成長を追い求めることができます。" rows="8">{!! str_replace("<br />","&#013;",old('workdetail') ?? $task->workdetail ?? '')  !!}</textarea>
                                <p style="display:none" class="workdetail error text-danger"></p>                                 
                                <input type="hidden" name="workdetail" id="workdetail" value="{!! old('workdetail') ?? $task->workdetail ?? '' !!}">
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('活躍できる経験') }}  {{--xxx_workexperience--}} </b></label>                             
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                <textarea class="form-control form-control-message" id="workexperiencetextarea" placeholder="&bull;&nbsp;クライアントやチームメンバーと信頼関係を構築できるスキルをお持ちの方&#10;&bull;&nbsp;数値思考を基にした業務遂行を心掛けている方" rows="8">{!! str_replace("<br />","&#013;",old('workexperience') ?? $task->workexperience ?? '')  !!}</textarea>
                                <p style="display:none" class="workexperience error text-danger"></p>                                 
                                <input type="hidden" name="workexperience" id="workexperience" value="{!! old('workexperience') ?? $task->workexperience ?? '' !!}">
                           </div>
                        </div>
                     </div>


               </div>

               <div class="col-lg-8 form-group mx-auto" style="border:1px solid #304586;">
                     <div class="error-container"></div>
                     <!-- <label for="email"><b>{{ __('user.taskrequest') }}</b></label> -->

                     <div class="row">
                        <div class="form-group col-12" style="background: #304586;">
                           <div>
                              <h4 style="color: white; margin-top: 0.5rem;"><b>{{ __('必須要件') }}</b></h4>                             
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('必須要件') }} {{--xxx_requiredskill--}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                             
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                <textarea class="form-control form-control-message" id="requiredskilltextarea" placeholder="&bull;&nbsp;法人営業 2年以上&#10;&bull;&nbsp;セールスチームのマネジメント経験(会社、チーム、売上の規模は不問)" rows="8">{!! str_replace("<br />","&#013;",old('requiredskill') ?? $task->requiredskill ?? '')  !!}</textarea>
                                <p style="display:none" class="requiredskill error text-danger"></p>                                 
                                <input type="hidden" name="requiredskill" id="requiredskill" value="{!! old('requiredskill') ?? $task->requiredskill ?? '' !!}">
                           </div>
                        </div>
                     </div>

                     <div class="row border-bottom">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('最終学歴') }} {{--xxx_educationlevel--}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                            
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                <select class="form-control selectpicker" name="educationlevel" id="educationlevel" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                    <option @if((isset($task->educationlevel)) AND ($task->educationlevel == '0')) selected @endif value="0">選択してください</option>
                                    <option @if((isset($task->educationlevel)) AND ($task->educationlevel == '1')) selected @endif value="1">不問</option>
                                    <option @if((isset($task->educationlevel)) AND ($task->educationlevel == '2')) selected @endif value="2">高校卒業以上</option>
                                    <option @if((isset($task->educationlevel)) AND ($task->educationlevel == '3')) selected @endif value="3">高専卒業以上</option>
                                    <option @if((isset($task->educationlevel)) AND ($task->educationlevel == '4')) selected @endif value="4">短大・専門卒業以上</option>
                                    <option @if((isset($task->educationlevel)) AND ($task->educationlevel == '5')) selected @endif value="5">大学卒業以上</option>
                                    <option @if((isset($task->educationlevel)) AND ($task->educationlevel == '6')) selected @endif value="6">MARCH以上</option>
                                    <option @if((isset($task->educationlevel)) AND ($task->educationlevel == '7')) selected @endif value="7">早慶・国公立以上</option>
                                    <option @if((isset($task->educationlevel)) AND ($task->educationlevel == '8')) selected @endif value="8">大学院卒以上</option>
                                </select>

                               <p class="error educationlevel text-danger"></p>                            
                           </div>
                        </div>
                     </div>

                     <div class="row border-bottom">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('応募可能年齢') }} {{--xxx_startageuntilage --}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                            
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group" style="display:inline-block;">
                                <select class="form-control selectpicker" name="startage" id="startage" style="width:100%;" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                    <option @if((isset($task->startage)) AND ($task->startage == '0')) selected @endif value="0">応募可能年齢を選択</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '18')) selected @endif value="18">18歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '19')) selected @endif value="19">19歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '20')) selected @endif value="20">20歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '21')) selected @endif value="21">21歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '22')) selected @endif value="22">22歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '23')) selected @endif value="23">23歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '24')) selected @endif value="24">24歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '25')) selected @endif value="25">25歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '26')) selected @endif value="26">26歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '27')) selected @endif value="27">27歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '28')) selected @endif value="28">28歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '29')) selected @endif value="29">29歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '30')) selected @endif value="30">30歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '31')) selected @endif value="31">31歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '32')) selected @endif value="32">32歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '33')) selected @endif value="33">33歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '34')) selected @endif value="34">34歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '35')) selected @endif value="35">35歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '36')) selected @endif value="36">36歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '37')) selected @endif value="37">37歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '38')) selected @endif value="38">38歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '39')) selected @endif value="39">39歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '40')) selected @endif value="40">40歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '41')) selected @endif value="41">41歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '42')) selected @endif value="42">42歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '43')) selected @endif value="43">43歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '44')) selected @endif value="44">44歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '45')) selected @endif value="45">45歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '46')) selected @endif value="46">46歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '47')) selected @endif value="47">47歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '48')) selected @endif value="48">48歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '49')) selected @endif value="49">49歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '50')) selected @endif value="50">50歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '51')) selected @endif value="51">51歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '52')) selected @endif value="52">52歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '53')) selected @endif value="53">53歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '54')) selected @endif value="54">54歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '55')) selected @endif value="55">55歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '56')) selected @endif value="56">56歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '57')) selected @endif value="57">57歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '58')) selected @endif value="58">58歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '59')) selected @endif value="59">59歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '60')) selected @endif value="60">60歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '61')) selected @endif value="61">61歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '62')) selected @endif value="62">62歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '63')) selected @endif value="63">63歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '64')) selected @endif value="64">64歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '65')) selected @endif value="65">65歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '66')) selected @endif value="66">66歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '67')) selected @endif value="67">67歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '68')) selected @endif value="68">68歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '69')) selected @endif value="69">69歳</option>
                                    <option @if((isset($task->startage)) AND ($task->startage == '70')) selected @endif value="70">70歳</option>

                                </select>

                               <p class="error startage text-danger"></p>                          
                           </div>

                           <div class="form-group" style="display:inline-block;">
                               <p>～</p>                          
                           </div>

                           <div class="form-group" style="display:inline-block;">
                                <select class="form-control selectpicker" name="untilage" id="untilage" style="width:100%;" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '0')) selected @endif value="0">応募可能年齢を選択</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '18')) selected @endif value="18">18歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '19')) selected @endif value="19">19歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '20')) selected @endif value="20">20歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '21')) selected @endif value="21">21歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '22')) selected @endif value="22">22歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '23')) selected @endif value="23">23歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '24')) selected @endif value="24">24歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '25')) selected @endif value="25">25歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '26')) selected @endif value="26">26歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '27')) selected @endif value="27">27歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '28')) selected @endif value="28">28歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '29')) selected @endif value="29">29歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '30')) selected @endif value="30">30歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '31')) selected @endif value="31">31歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '32')) selected @endif value="32">32歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '33')) selected @endif value="33">33歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '34')) selected @endif value="34">34歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '35')) selected @endif value="35">35歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '36')) selected @endif value="36">36歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '37')) selected @endif value="37">37歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '38')) selected @endif value="38">38歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '39')) selected @endif value="39">39歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '40')) selected @endif value="40">40歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '41')) selected @endif value="41">41歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '42')) selected @endif value="42">42歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '43')) selected @endif value="43">43歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '44')) selected @endif value="44">44歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '45')) selected @endif value="45">45歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '46')) selected @endif value="46">46歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '47')) selected @endif value="47">47歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '48')) selected @endif value="48">48歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '49')) selected @endif value="49">49歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '50')) selected @endif value="50">50歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '51')) selected @endif value="51">51歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '52')) selected @endif value="52">52歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '53')) selected @endif value="53">53歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '54')) selected @endif value="54">54歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '55')) selected @endif value="55">55歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '56')) selected @endif value="56">56歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '57')) selected @endif value="57">57歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '58')) selected @endif value="58">58歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '59')) selected @endif value="59">59歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '60')) selected @endif value="60">60歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '61')) selected @endif value="61">61歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '62')) selected @endif value="62">62歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '63')) selected @endif value="63">63歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '64')) selected @endif value="64">64歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '65')) selected @endif value="65">65歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '66')) selected @endif value="66">66歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '67')) selected @endif value="67">67歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '68')) selected @endif value="68">68歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '69')) selected @endif value="69">69歳</option>
                                    <option @if((isset($task->untilage)) AND ($task->untilage == '70')) selected @endif value="70">70歳</option>

                                </select>

                               <p class="error untilage text-danger"></p>                           
                           </div>                           
                        </div>
                     </div>

                     <div class="row border-bottom">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('就業経験社数') }} {{--xxx_previouscompanies--}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                            
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                <select class="form-control selectpicker" name="previouscompanies" id="previouscompanies" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                    <option @if((isset($task->previouscompanies)) AND ($task->previouscompanies == '0')) selected @endif value="0">就業経験社数を選択</option>
                                    <option @if((isset($task->previouscompanies)) AND ($task->previouscompanies == '1')) selected @endif value="1">1社まで可</option>
                                    <option @if((isset($task->previouscompanies)) AND ($task->previouscompanies == '2')) selected @endif value="2">2社まで可</option>
                                    <option @if((isset($task->previouscompanies)) AND ($task->previouscompanies == '3')) selected @endif value="3">3社まで可</option>
                                    <option @if((isset($task->previouscompanies)) AND ($task->previouscompanies == '4')) selected @endif value="4">4社まで可</option>
                                    <option @if((isset($task->previouscompanies)) AND ($task->previouscompanies == '5')) selected @endif value="5">不問</option>
                                </select>
                               <p class="error previouscompanies text-danger"></p>                            
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('性別') }}</b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                           
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group" style="font-size: 16px;">
                              <div>
                                 <input type="radio" class="form-check-input form-control form-control-name" style="width: 16px;height: 16px;  margin-left: unset;" name="gender" @if((isset($task->gender)) AND ($task->gender == '1')) checked @endif value="1">
                                 <label class="boxlabel">{{ __(' 男性') }} {{--xxx_genderman--}} </label> 
                              </div>  
                              <div>
                                 <input type="radio" class="form-check-input form-control form-control-name" style="width: 16px;height: 16px;  margin-left: unset;" name="gender" @if((isset($task->gender)) AND ($task->gender == '2')) checked @endif value="2">
                                 <label class="boxlabel">{{ __(' 女性') }} {{--xxx_genderwoman--}} </label> 
                              </div>  
                              <div>
                                 <input type="radio" class="form-check-input form-control form-control-name" style="width: 16px;height: 16px;  margin-left: unset;" name="gender" @if((isset($task->gender)) AND ($task->gender == '3')) checked @endif value="3">
                                 <label class="boxlabel">{{ __(' どちらでも') }} {{--xxx_genderboth--}} </label> 
                              </div>                             
                           <p class="error gender text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row border-bottom">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('未経験の可否') }} {{--xxx_inexperienced--}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                            
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                <select class="form-control selectpicker" name="inexperienced" id="inexperienced" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                    <option @if((isset($task->inexperienced)) AND ($task->inexperienced == '1')) selected @endif value="1">不可</option>
                                    <option @if((isset($task->inexperienced)) AND ($task->inexperienced == '2')) selected @endif value="2">業界未経験可</option>
                                    <option @if((isset($task->inexperienced)) AND ($task->inexperienced == '3')) selected @endif value="3">職種未経験可</option>
                                    <option @if((isset($task->inexperienced)) AND ($task->inexperienced == '4')) selected @endif value="4">業界・職種未経験可</option>
                                </select>

                               <p class="error inexperienced text-danger"></p>                            
                           </div>
                        </div>
                     </div>

                     <div class="row border-bottom">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('外国籍の可否') }} {{--xxx_foreign--}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                            
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                <select class="form-control selectpicker" name="foreign" id="foreign" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                    <option @if((isset($task->foreign)) AND ($task->foreign == '1')) selected @endif value="1">不可</option>
                                    <option @if((isset($task->foreign)) AND ($task->foreign == '2')) selected @endif value="2">可</option>
                                </select>

                               <p class="error foreign text-danger"></p>                            
                           </div>
                        </div>
                     </div>

                     <div class="row border-bottom">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('英語レベル') }} {{--xxx_englishlvl--}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                            
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                <select class="form-control selectpicker" name="englishlvl" id="englishlvl" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                    <option @if((isset($task->englishlvl)) AND ($task->englishlvl == '1')) selected @endif value="1">不問</option>
                                    <option @if((isset($task->englishlvl)) AND ($task->englishlvl == '2')) selected @endif value="2">日常会話レベル</option>
                                    <option @if((isset($task->englishlvl)) AND ($task->englishlvl == '3')) selected @endif value="3">ビジネスレベル</option>
                                    <option @if((isset($task->englishlvl)) AND ($task->englishlvl == '4')) selected @endif value="4">ネイティブレベル</option>
                                </select>
                               <p class="error englishlvl text-danger"></p>                            
                           </div>
                        </div>
                     </div>


                     <div class="row border-bottom">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('普通自動車免許') }} {{--xxx_drivinglicense--}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                            
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                <select class="form-control selectpicker" name="drivinglicense" id="drivinglicense" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                    <option @if((isset($task->drivinglicense)) AND ($task->drivinglicense == '1')) selected @endif value="1">不要</option>
                                    <option @if((isset($task->drivinglicense)) AND ($task->drivinglicense == '2')) selected @endif value="2">必須</option>
                                    <option @if((isset($task->drivinglicense)) AND ($task->drivinglicense == '3')) selected @endif value="3">入社時までに取得必須</option>
                                </select>
                               <p class="error drivinglicense text-danger"></p>                            
                           </div>
                        </div>
                     </div>


               </div>

               <div class="col-lg-8 form-group mx-auto" style="border:1px solid #304586;">
                     <div class="error-container"></div>
                     <!-- <label for="email"><b>{{ __('user.taskrequest') }}</b></label> -->

                     <div class="row">
                        <div class="form-group col-12" style="background: #304586;">
                           <div>
                              <h4 style="color: white; margin-top: 0.5rem;"><b>{{ __('募集要項') }}</b></h4>                             
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('部署名') }} {{--xxx_divisionname--}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                             
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                              <input class="form-control form-control-name" placeholder="{{ __('SCOUTER事業部 SalesTeam') }}" name="divisionname"
                                 type="text" value="{{ old('divisionname') ?? $task->divisionname ?? '' }}" style="line-height: 2.0;">
                                  <p class="error divisionname text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('部署詳細') }} {{--xxx_divisiondetails--}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                             
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                <textarea class="form-control form-control-message" id="divisiondetailstextarea" placeholder="Sales：3名 （新卒、中途）&#10;&#10;＜組織全体＞&#10;社員11名業務委託・インターン4名&#10;customer success：3名&#10;marketing：2名&#10;開発：4名&#10;corporate：3名" rows="8">{!! str_replace("<br />","&#013;",old('divisiondetails') ?? $task->divisiondetails ?? '')  !!}</textarea>
                                <p style="display:none" class="divisiondetails error text-danger"></p>                                 
                                <input type="hidden" name="divisiondetails" id="divisiondetails" value="{!! old('divisiondetails') ?? $task->divisiondetails ?? '' !!}">
                           </div>
                        </div>
                     </div>

                     <div class="row border-bottom">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('雇用形態') }} {{--xxx_positionoffer--}} </b></label>                            
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                <select class="form-control selectpicker" name="positionoffer" id="positionoffer" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                    <!-- <option @if((isset($task->positionoffer)) AND ($task->positionoffer == '0')) selected @endif value="0">雇用形態を選択</option> -->
                                    <option @if((isset($task->positionoffer)) AND ($task->positionoffer == '1')) selected @endif value="1">正社員</option>
                                    <option @if((isset($task->positionoffer)) AND ($task->positionoffer == '2')) selected @endif value="2">契約社員</option>
                                    <option @if((isset($task->positionoffer)) AND ($task->positionoffer == '3')) selected @endif value="3">パート・アルバイト</option>
                                </select>
                               <p class="error positionoffer text-danger"></p>                            
                           </div>
                        </div>
                     </div>

                     <div class="row border-bottom">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('勤務時間タイプ') }} {{--xxx_workinghourtype--}} </b></label>                            
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                <select class="form-control selectpicker" name="workinghourtype" id="workinghourtype" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                    <option @if((isset($task->workinghourtype)) AND ($task->workinghourtype == '1')) selected @endif value="1">固定（一般的な勤務時間）</option>
                                    <option @if((isset($task->workinghourtype)) AND ($task->workinghourtype == '2')) selected @endif value="2">フレックス制（コアタイムあり）</option>
                                    <option @if((isset($task->workinghourtype)) AND ($task->workinghourtype == '3')) selected @endif value="3">フレックス制（コアタイムなし）</option>
                                    <option @if((isset($task->workinghourtype)) AND ($task->workinghourtype == '4')) selected @endif value="4">変形労働時間制（1ヶ月単位）</option>
                                    <option @if((isset($task->workinghourtype)) AND ($task->workinghourtype == '5')) selected @endif value="5">変形労働時間制（1年単位）</option>
                                    <option @if((isset($task->workinghourtype)) AND ($task->workinghourtype == '6')) selected @endif value="6">裁量労働時間制（みなし労働時間制）</option>
                                    <option @if((isset($task->workinghourtype)) AND ($task->workinghourtype == '7')) selected @endif value="7">その他</option>
                                </select>
                               <p class="error workinghourtype text-danger"></p>                            
                           </div>
                        </div>
                     </div>                     

                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('残業時間') }} {{--xxx_overtime--}} </b></label>                             
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                <textarea class="form-control form-control-message" id="overtimetextarea" placeholder="20〜40時間程度&#10;※繁忙期によって差あり" rows="8">{!! str_replace("<br />","&#013;",old('overtime') ?? $task->overtime ?? '')  !!}</textarea>
                                <p style="display:none" class="overtime error text-danger"></p>                                 
                                <input type="hidden" name="overtime" id="overtime" value="{!! old('overtime') ?? $task->overtime ?? '' !!}">
                           </div>
                        </div>
                     </div>


                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('選考詳細') }} {{--xxx_selectiondetails--}} </b></label>                             
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                <textarea class="form-control form-control-message" id="selectiondetailstextarea" placeholder="選考詳細を入力してください" rows="8">{!! str_replace("<br />","&#013;",old('selectiondetails') ?? $task->selectiondetails ?? '')  !!}</textarea>
                                <p style="display:none" class="selectiondetails error text-danger"></p>                                 
                                <input type="hidden" name="selectiondetails" id="selectiondetails" value="{!! old('selectiondetails') ?? $task->selectiondetails ?? '' !!}">
                           </div>
                        </div>
                     </div>

               </div>

               <div class="col-lg-8 form-group mx-auto" style="border:1px solid #304586;">
                     <div class="error-container"></div>
                     <!-- <label for="email"><b>{{ __('user.taskrequest') }}</b></label> -->

                     <div class="row">
                        <div class="form-group col-12" style="background: #304586;">
                           <div>
                              <h4 style="color: white; margin-top: 0.5rem;"><b>{{ __('仕事環境') }}</b></h4>                             
                           </div>
                        </div>
                     </div>

                     <div class="row border-bottom">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('想定年収') }} {{--xxx_salaryfromsalaryto--}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                            
                           </div>
                        </div>
<div class="col-md-8">
                           <div class="form-group" style="display:inline-block;">
                                <select class="form-control selectpicker" name="salaryfrom" id="salaryfrom" style="width:100%;" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '0')) selected @endif value="0">年収を選択</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '200')) selected @endif value="200">200</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '250')) selected @endif value="250">250</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '300')) selected @endif value="300">300</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '350')) selected @endif value="350">350</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '400')) selected @endif value="400">400</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '450')) selected @endif value="450">450</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '500')) selected @endif value="500">500</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '550')) selected @endif value="550">550</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '600')) selected @endif value="600">600</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '650')) selected @endif value="650">650</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '700')) selected @endif value="700">700</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '750')) selected @endif value="750">750</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '800')) selected @endif value="800">800</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '850')) selected @endif value="850">850</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '900')) selected @endif value="900">900</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '950')) selected @endif value="950">950</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '1000')) selected @endif value="1000">1000</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '1050')) selected @endif value="1050">1050</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '1100')) selected @endif value="1100">1100</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '1150')) selected @endif value="1150">1150</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '1200')) selected @endif value="1200">1200</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '1250')) selected @endif value="1250">1250</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '1300')) selected @endif value="1300">1300</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '1350')) selected @endif value="1350">1350</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '1400')) selected @endif value="1400">1400</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '1450')) selected @endif value="1450">1450</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '1500')) selected @endif value="1500">1500</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '1600')) selected @endif value="1600">1600</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '1700')) selected @endif value="1700">1700</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '1800')) selected @endif value="1800">1800</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '1900')) selected @endif value="1900">1900</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '2000')) selected @endif value="2000">2000</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '2100')) selected @endif value="2100">2100</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '2200')) selected @endif value="2200">2200</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '2300')) selected @endif value="2300">2300</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '2400')) selected @endif value="2400">2400</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '2500')) selected @endif value="2500">2500</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '2600')) selected @endif value="2600">2600</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '2700')) selected @endif value="2700">2700</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '2800')) selected @endif value="2800">2800</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '2900')) selected @endif value="2900">2900</option>
                                    <option @if((isset($task->salaryfrom)) AND ($task->salaryfrom == '3000')) selected @endif value="3000">3000</option>
                                </select>

                               <p class="error salaryfrom text-danger"></p>                          
                           </div>

                           <div class="form-group" style="display:inline-block;">
                               <p>万円～</p>                          
                           </div>

                           <div class="form-group" style="display:inline-block;">
                                <select class="form-control selectpicker" name="salaryto" id="salaryto" style="width:100%;" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '0')) selected @endif value="0">年収を選択</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '200')) selected @endif value="200">200</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '250')) selected @endif value="250">250</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '300')) selected @endif value="300">300</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '350')) selected @endif value="350">350</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '400')) selected @endif value="400">400</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '450')) selected @endif value="450">450</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '500')) selected @endif value="500">500</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '550')) selected @endif value="550">550</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '600')) selected @endif value="600">600</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '650')) selected @endif value="650">650</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '700')) selected @endif value="700">700</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '750')) selected @endif value="750">750</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '800')) selected @endif value="800">800</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '850')) selected @endif value="850">850</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '900')) selected @endif value="900">900</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '950')) selected @endif value="950">950</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '1000')) selected @endif value="1000">1000</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '1050')) selected @endif value="1050">1050</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '1100')) selected @endif value="1100">1100</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '1150')) selected @endif value="1150">1150</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '1200')) selected @endif value="1200">1200</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '1250')) selected @endif value="1250">1250</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '1300')) selected @endif value="1300">1300</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '1350')) selected @endif value="1350">1350</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '1400')) selected @endif value="1400">1400</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '1450')) selected @endif value="1450">1450</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '1500')) selected @endif value="1500">1500</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '1600')) selected @endif value="1600">1600</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '1700')) selected @endif value="1700">1700</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '1800')) selected @endif value="1800">1800</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '1900')) selected @endif value="1900">1900</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '2000')) selected @endif value="2000">2000</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '2100')) selected @endif value="2100">2100</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '2200')) selected @endif value="2200">2200</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '2300')) selected @endif value="2300">2300</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '2400')) selected @endif value="2400">2400</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '2500')) selected @endif value="2500">2500</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '2600')) selected @endif value="2600">2600</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '2700')) selected @endif value="2700">2700</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '2800')) selected @endif value="2800">2800</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '2900')) selected @endif value="2900">2900</option>
                                    <option @if((isset($task->salaryto)) AND ($task->salaryto == '3000')) selected @endif value="3000">3000</option>

                                </select>

                               <p class="error salaryto text-danger"></p>                           
                           </div>

                           <div class="form-group" style="display:inline-block;">
                               <p>万円</p>                          
                           </div>

                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('試用期間') }}</b></label>                           
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group" style="font-size: 16px;">
                              <div>
                                 <input type="checkbox" class="form-check-input form-control form-control-name" style="width: 16px;height: 16px;  margin-left: unset;" name="probation" @if((isset($task->probation)) AND ($task->probation == 'on')) checked @endif>
                                 <label class="boxlabel">{{ __('あり') }} {{--xxx_probation--}} </label> 
                              </div>                                  
                           </div>
                        </div>
                     </div>


                     <div class="row border-bottom">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('給与タイプ') }} {{--xxx_salarysystem--}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                            
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                <select class="form-control selectpicker" name="salarysystem" id="salarysystem" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                    <option @if((isset($task->salarysystem)) AND ($task->salarysystem == '1')) selected @endif value="1">月給制（月給=基本給）</option>
                                    <option @if((isset($task->salarysystem)) AND ($task->salarysystem == '2')) selected @endif value="2">月給制（定額手当あり、みなし残業代なし）</option>
                                    <option @if((isset($task->salarysystem)) AND ($task->salarysystem == '3')) selected @endif value="3">月給制（定額手当なし、みなし残業代あり）</option>
                                    <option @if((isset($task->salarysystem)) AND ($task->salarysystem == '4')) selected @endif value="4">月給制（定額手当あり、みなし残業代あり）</option>
                                    <option @if((isset($task->salarysystem)) AND ($task->salarysystem == '5')) selected @endif value="5">年棒製（になし残業代なし）</option>
                                    <option @if((isset($task->salarysystem)) AND ($task->salarysystem == '6')) selected @endif value="6">年棒製（みなし残業代あり）</option>
                                    <option @if((isset($task->salarysystem)) AND ($task->salarysystem == '7')) selected @endif value="7">時給制</option>
                                    <option @if((isset($task->salarysystem)) AND ($task->salarysystem == '8')) selected @endif value="8">日給制</option>
                                    <option @if((isset($task->salarysystem)) AND ($task->salarysystem == '9')) selected @endif value="9">その他</option>
                                </select>
                               <p class="error salarysystem text-danger"></p>                            
                           </div>
                        </div>
                     </div> 

                     <div class="row border-bottom">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('年間休日') }} {{--xxx_annualleave--}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                            
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                 <input style="width:40%;" class="form-control form-control-name" placeholder="{{ __('125日') }}" name="annualleave" id="annualleave"
                                 type="text" value="{{ old('annualleave') ?? $task->annualleave ?? '' }}" style="line-height: 2.0;">
                                  <p class="error annualleave text-danger"></p>                            
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('休日・休暇') }} {{--xxx_leavedetails--}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                <textarea class="form-control form-control-message" id="leavedetailstextarea" placeholder="完全週休二日制（土日祝）&#10;年次有給休暇（所定勤務日の8割以上出勤した場合に付与）&#10;夏季休暇&#10;年末年始休暇&#10;慶弔休暇&#10;産前産後休暇&#10;育児・介護休業&#10;リフレッシュ休暇（※在籍2年で9連休取得可能）" rows="8">{!! str_replace("<br />","&#013;",old('leavedetails') ?? $task->leavedetails ?? '')  !!}</textarea>
                                <p style="display:none" class="leavedetails error text-danger"></p>                                 
                                <input type="hidden" name="leavedetails" id="leavedetails" value="{!! old('leavedetails') ?? $task->leavedetails ?? '' !!}">
                           </div>
                        </div>
                     </div>                    

                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('福利厚生') }} {{--xxx_welfare--}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                <textarea class="form-control form-control-message" id="welfaretextarea" placeholder="社会保険完備（雇用/労災/厚生/健康）
導入研修（座学・OJT）
スキルアップ研修
外部研修
ストックオプション
フリードリンク制度（20時以降）
書籍購入補助制度" rows="8">{!! str_replace("<br />","&#013;",old('welfare') ?? $task->welfare ?? '')  !!}</textarea>
                                <p style="display:none" class="welfare error text-danger"></p>                                 
                                <input type="hidden" name="welfare" id="welfare" value="{!! old('welfare') ?? $task->welfare ?? '' !!}">
                           </div>
                        </div>
                     </div>

                     <div class="row border-bottom">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('受動喫煙対策') }} {{--xxx_smoking--}} </b><span class="badge badge-danger">{{ __('auth.required') }}</span></label>                            
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                <select class="form-control selectpicker" name="smoking" id="smoking" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                    <option @if((isset($task->smoking)) AND ($task->smoking == '1')) selected @endif value="1">禁煙</option>
                                    <option @if((isset($task->smoking)) AND ($task->smoking == '2')) selected @endif value="2">喫煙スペースあり</option>
                                    <option @if((isset($task->smoking)) AND ($task->smoking == '3')) selected @endif value="3">無し（喫煙可）</option>
                                </select>
                               <p class="error smoking text-danger"></p>                            
                           </div>
                        </div>
                     </div> 

                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="email"><b>{{ __('受動喫煙対策（詳細）') }} {{--xxx_smokingdetails--}} </b></label>                             
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                                <textarea class="form-control form-control-message" id="smokingdetailstextarea" placeholder="屋内喫煙可、喫煙目的室設置など" rows="8">{!! str_replace("<br />","&#013;",old('smokingdetails') ?? $task->smokingdetails ?? '')  !!}</textarea>
                                <p style="display:none" class="smokingdetails error text-danger"></p>                                 
                                <input type="hidden" name="smokingdetails" id="smokingdetails" value="{!! old('smokingdetails') ?? $task->smokingdetails ?? '' !!}">
                           </div>
                        </div>
                     </div>

               </div>



            </div>
            </form><!-- Contact form end -->

            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="text-center"><br>
               <button class="btn btn-submit" type="submit" 

                      @if(!empty($task->id)) 
                           data-askconfirmtitle="{{ __('求人を更新') }}" data-askconfirmtext="{{ __('更新しますか?') }}" data-yes="{{ __('更新する') }}"> {{ __('更新する') }}
                      @else
                           data-askconfirmtitle="{{ __('user.applytitle') }}" data-askconfirmtext="{{ __('user.applytext') }}" data-yes="{{ __('user.dorequest') }}"> {{ __('user.dorequest') }}
                      @endif
               </button>
            </div>
         </div>
         <div class="speaker-shap">
            <img class="shap1" src="images/shap/home_schedule_memphis2.png" alt="">
         </div>
      </section>

<script type="text/javascript">



    $(document).ready(function() {

	      $('#image').change(function(){
	          let reader = new FileReader();
	          reader.onload = (e) => { 
	            $('#preview-image-before-upload').attr('src', e.target.result); 
	            $('#preview-image-before-upload').show();
	          }
	          reader.readAsDataURL(this.files[0]); 
	      });

        $('textarea').on('input', function() {
			id = $( this ).attr("id");
			inputname = id.replace("textarea","");
            // alert(inputname);
            text = $( this ).val();
            text = text.replace(/\r?\n/g, '<br />')
            $('#'+inputname).val(text);
        });


        $(".btn-submit").click(function(e){

            e.preventDefault();
            var _token = $("input[name='_token']").val();
            let formData = new FormData(makeapplication);
   
            $.ajax({
                url: "{{ $action }}",
                type:'POST',

                data: formData,

                 contentType: false,
                 processData: false,

                success: function(data) {
                    if($.isEmptyObject(data.error)){

                          $('.error').hide()
                          askconfirmboxshow($(".btn-submit"),'makeapplication');
                    }else{
                        // alert("err");
                        console.log(data.error);
                          $('.error').hide()
                        $.each( data.error, function( key, value ) {


                          $('.error.'+key).text(value[0])
                          $('.error.'+key).show()
                          
                        });
                    }
                },
                fail: function(data) {
                        alert("エラー：ajax error");
                }
            });
       
        });


    });




</script>
</x-auth-layout>
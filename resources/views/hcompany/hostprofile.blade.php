

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

      @php $error = $errors->toArray(); if(!isset($editmode)){$editmode = false;} if(!isset($editother)){$editother = false;} @endphp

      @php $subtitle=__('auth.manageinfl'); @endphp
      @php 
        if($editmode) {
          if ($editother) {
            $subtitle=__('auth.manageinfl'); 
          } else {
            $subtitle=__('welcome.profileedit'); 
          }
        } else {
          $subtitle=__('auth.manageinfl');
        }
      @endphp

      @guest
         @php $subtitle=__('会員登録'); @endphp
      @endguest
      
      @include('components.subtitle')

      <section class="ts-contact-form">


                  @if (!$editmode)
                  @php $action= route('registerhost'); @endphp
                  @else
                  @php $action= route('edituser') ; @endphp
                  @endif

                  <form id="registerhostform" id="registerhostform" class="contact-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                  @csrf

                  @if ($editmode)
                  <input type="hidden" name="id" value="{{ $edituser['id'] }}">
                  @endif

         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">

                  @auth
                    @if ($editmode)
                      @if ($editother)
                      {{ __('auth.infledit') }}
                      @else
                      {{ __('auth.profileedit') }}
                      @endif
                    @else
                    {{ __('auth.makenew') }}
                    @endif
                  @endauth

                  @guest
                     求職希望者無料登録
                  @endguest

                  </h2>
               </div><!-- col end-->
            </div>
            <div class="row">
               <div class="col-lg-8 mx-auto">

                     <div class="error-container"></div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="fullname"><b>{{ __('auth.inflname') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('contact.name') }}" name="name" id="name"
                                 type="text" value="{{ old('name') ?? $edituser['name'] ?? '' }}"  autofocus >
                                <p style="display:none" class="name error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="picture"><b>{{ __('auth.profileimg') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input type="file" name="image" id="image" class="form-control" >
                              <img id="preview-image-before-upload" alt="{{ __('auth.profileimg') }}"  
                                @if(!empty($edituser['profileimg']))
                                      style="max-height: 200px;" 
                                      src="{{ asset('images/avatar/'.$edituser['profileimg'] ) }}"
                                @else
                                      style="max-height: 200px; display: none;" 
                                @endif
                              />
                                <p style="display:none" class="image error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="phonenumber"><b>{{ __('auth.phone') }}</b> <span class="badge badge-secondary">{{ __('auth.optional') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.phone') }}" name="phone" id="phone"
                                 type="text" value="{{ old('phone') ?? $edituser['phone'] ?? '' }}">
                                <p style="display:none" class="phone error text-danger"></p>
                           </div>
                        </div>
                     </div>  

                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="email"><b>{{ __('auth.mailaddress') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-email" placeholder="{{ __('auth.mailaddress') }}" name="email" id="email"
                                 type="text" value="{{ old('email') ?? $edituser['email'] ?? '' }}" >
                                <p style="display:none" class="email error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="pwd"><b>{{ __('auth.password') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.password') }}" id="password"
                                 type="password"  autocomplete="new-password" value="{{ $edituser['password'] ?? '' }}">
                                <p style="display:none" class="password error text-danger"></p>
                           </div>
                        </div>
                     </div>
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="pwdagain"><b>{{ __('auth.confirmpassword') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.confirmpassword') }}" id="password_confirmation"
                                 type="password" value="{{ $edituser['password'] ?? '' }}">
                                 <p style="display:none" class="password_confirmation  error text-danger"></p>
                           </div>
                        </div>
                     </div>                     

                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="gender_select"><b>{{ __('hostlisting.gender') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <select class="form-control" name="gender" id="gender" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                @foreach (config('global.gender') as $key => $value)
                                  <option value="{{$key}}" {{ old('gender') == $key ? "selected" : "" }} @if(!empty($edituser['gender']) && ($edituser['gender'] == $key)) selected @endif >{{__($value)}}</option>
                                @endforeach
                              </select>
                              <p style="display:none" class="gender error text-danger"></p>                             
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="dob"><b>{{ __('生年月日') }}</b></label> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="開始日時" name="dob" id="dob"
                                 type="date"  @if(!empty($edituser['dob'])) value="{{date('Y-m-d', strtotime($edituser['dob']))}}" @else @endif>
                              <p style="display:none" class="dob error text-danger"></p>                              
                           </div>
                        </div>
                     </div>                      

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="field"><b>{{ __('希望職種') }} </b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                                 <select class="form-control" name="field" id="field" style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                     <option value="0">選択してください</option>
                                    <optgroup label="営業">
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '法人営業')) selected @endif >法人営業</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '個人営業')) selected @endif >個人営業</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'ルートセールス・代理店営業')) selected @endif >ルートセールス・代理店営業</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '内勤営業・カウンターセールス')) selected @endif >内勤営業・カウンターセールス</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '海外営業')) selected @endif >海外営業</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'カスタマーサポート・コールセンター運営')) selected @endif >カスタマーサポート・コールセンター運営</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'キャリアカウンセラー・人材コーディネーター')) selected @endif >キャリアカウンセラー・人材コーディネーター</option>
                                    </optgroup>
                                    <optgroup label="事務・管理">
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '財務・経理')) selected @endif >財務・経理</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '人事')) selected @endif >人事</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '総務・事務')) selected @endif >総務・事務</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '法務')) selected @endif >法務</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '広報・IR')) selected @endif >広報・IR</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '物流・貿易')) selected @endif >物流・貿易</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '一般事務・営業事務')) selected @endif >一般事務・営業事務</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '秘書')) selected @endif >秘書</option>
                                    </optgroup>
                                    <optgroup label="マーケティング">
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '商品企画・商品開発')) selected @endif >商品企画・商品開発</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'ブランドマネージャー・プロダクトマネージャー')) selected @endif >ブランドマネージャー・プロダクトマネージャー</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '広告・宣伝')) selected @endif >広告・宣伝</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '販売促進・販促企画')) selected @endif >販売促進・販促企画</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '営業企画')) selected @endif >営業企画</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'イベント企画・運営')) selected @endif >イベント企画・運営</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'Web・SNSマーケティング')) selected @endif >Web・SNSマーケティング</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'データアナリスト')) selected @endif >データアナリスト</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '市場調査・分析')) selected @endif >市場調査・分析</option>
                                    </optgroup>
                                    <optgroup label="経営企画・経営戦略">
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '経営企画・事業統括')) selected @endif >経営企画・事業統括</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '管理職・エグゼクティブ')) selected @endif >管理職・エグゼクティブ</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'MD・バイヤー・店舗開発・FCオーナー')) selected @endif >MD・バイヤー・店舗開発・FCオーナー</option>
                                    </optgroup>
                                    <optgroup label="ディレクター">
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'Webディレクター・Webプロデューサー')) selected @endif >Webディレクター・Webプロデューサー</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'テクニカルディレクター・プロジェクトマネージャー')) selected @endif >テクニカルディレクター・プロジェクトマネージャー</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'クリエイティブディレクター')) selected @endif >クリエイティブディレクター</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '制作・進行管理（その他）')) selected @endif >制作・進行管理（その他）</option>
                                    </optgroup>
                                    <optgroup label="クリエイティブ関連">
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'Webデザイナー')) selected @endif >Webデザイナー</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'UI・UXデザイナー')) selected @endif >UI・UXデザイナー</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'ゲームデザイナー・イラストレーター')) selected @endif >ゲームデザイナー・イラストレーター</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'CGデザイナー')) selected @endif >CGデザイナー</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'Web・モバイル・ソーシャル・ゲーム制作／開発')) selected @endif >Web・モバイル・ソーシャル・ゲーム制作／開発</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '編集・ライター')) selected @endif >編集・ライター</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '映像・動画関連')) selected @endif >映像・動画関連</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'ファッション・インテリア・空間・プロダクトデザイン')) selected @endif >ファッション・インテリア・空間・プロダクトデザイン</option>
                                    </optgroup>
                                    <optgroup label="ITエンジニア">
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '業務系アプリケーションエンジニア・プログラマ')) selected @endif >業務系アプリケーションエンジニア・プログラマ</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'Webサービス系エンジニア・プログラマ')) selected @endif >Webサービス系エンジニア・プログラマ</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '制御系ソフトウェア開発（通信・ネットワーク・IoT関連）')) selected @endif >制御系ソフトウェア開発（通信・ネットワーク・IoT関連）</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'インフラエンジニア')) selected @endif >インフラエンジニア</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'IT・システムコンサルタント')) selected @endif >IT・システムコンサルタント</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '社内情報システム（社内SE）')) selected @endif >社内情報システム（社内SE）</option>
                                    </optgroup>
                                    <optgroup label="エンジニア（機械・電気・電子・半導体・制御）">
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '機械・機構設計・金型設計')) selected @endif >機械・機構設計・金型設計</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '回路・システム設計')) selected @endif >回路・システム設計</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'サービスエンジニア・サポートエンジニアー')) selected @endif >サービスエンジニア・サポートエンジニアー</option>
                                    </optgroup>
                                    <optgroup label="素材・化学・食品・医薬品技術職">
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '素材・半導体素材・化成品関連')) selected @endif >素材・半導体素材・化成品関連</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '化粧品・食品・香料関連')) selected @endif >化粧品・食品・香料関連</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '医薬品関連')) selected @endif >医薬品関連</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '医療用具関連')) selected @endif >医療用具関連</option>
                                    </optgroup>
                                    <optgroup label="建築・土木技術">
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '研究開発・技術開発・構造解析・特許')) selected @endif >研究開発・技術開発・構造解析・特許</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '施工管理・設備・環境保全')) selected @endif >施工管理・設備・環境保全</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'プランニング・測量・設計・積算')) selected @endif >プランニング・測量・設計・積算</option>      
                                    </optgroup>
                                    <optgroup label="技能工・設備・交通・運輸">
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '技能工（整備・工場生産・製造・工事）')) selected @endif >技能工（整備・工場生産・製造・工事）</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '生産・品質管理')) selected @endif >生産・品質管理</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '運輸・配送・倉庫関連')) selected @endif >運輸・配送・倉庫関連</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '交通（鉄道・バス・タクシー）関連')) selected @endif >交通（鉄道・バス・タクシー）関連</option>
                                    </optgroup>
                                    <optgroup label="サービス 接客 店舗">
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '店長・SV（スーパーバイザー）')) selected @endif >店長・SV（スーパーバイザー）</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'ホールスタッフ')) selected @endif >ホールスタッフ</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '料理長')) selected @endif >料理長</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '調理')) selected @endif >調理</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '警備・施設管理関連職')) selected @endif >警備・施設管理関連職</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '販売・サービススタッフ')) selected @endif >販売・サービススタッフ</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '宿泊施設・ホテル')) selected @endif >宿泊施設・ホテル</option>
                                    </optgroup>
                                    <optgroup label="専門職（コンサルタント 士業 金融 不動産）">
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'ビジネスコンサルタント・シンクタンク')) selected @endif >ビジネスコンサルタント・シンクタンク</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '士業・専門コンサルタント')) selected @endif >士業・専門コンサルタント</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '金融系専門職')) selected @endif >金融系専門職</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '金融系専門職')) selected @endif >金融系専門職</option>
                                    </optgroup>
                                    <optgroup label="医療・福祉・介護">
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '医療・看護')) selected @endif >医療・看護</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '薬事')) selected @endif >薬事</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '臨床開発')) selected @endif >臨床開発</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '福祉・介護')) selected @endif >福祉・介護</option>
                                    </optgroup>
                                    <optgroup label="教育・保育関連">
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == '教育・保育')) selected @endif >教育・保育</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'インストラクター・通訳・翻訳')) selected @endif >インストラクター・通訳・翻訳</option>
                                       <option @if((isset($edituser['field'])) AND ($edituser['field'] == 'その他')) selected @endif >その他</option>
                                    </optgroup>
                                 </select>
                              <p style="display:none" class="field error text-danger"></p> 
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="fullname_furi"><b>{{ __('居住国名') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <select class="form-control" name="country" id="country" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                  <option value="1" @if(!empty($edituser['country']) && ($edituser['country'] == "1")) selected @endif>Japan</option>
                                  <option value="2" @if(!empty($edituser['country']) && ($edituser['country'] == "2")) selected @endif>Afghanistan</option>
                                  <option value="3" @if(!empty($edituser['country']) && ($edituser['country'] == "3")) selected @endif>Åland Islands</option>
                                  <option value="4" @if(!empty($edituser['country']) && ($edituser['country'] == "4")) selected @endif>Albania</option>
                                  <option value="5" @if(!empty($edituser['country']) && ($edituser['country'] == "5")) selected @endif>Algeria</option>
                                  <option value="6" @if(!empty($edituser['country']) && ($edituser['country'] == "6")) selected @endif>American Samoa</option>
                                  <option value="7" @if(!empty($edituser['country']) && ($edituser['country'] == "7")) selected @endif>Andorra</option>
                                  <option value="8" @if(!empty($edituser['country']) && ($edituser['country'] == "8")) selected @endif>Angola</option>
                                  <option value="9" @if(!empty($edituser['country']) && ($edituser['country'] == "9")) selected @endif>Anguilla</option>
                                  <option value="10" @if(!empty($edituser['country']) && ($edituser['country'] == "10")) selected @endif>Antarctica</option>
                                  <option value="11" @if(!empty($edituser['country']) && ($edituser['country'] == "11")) selected @endif>Antigua and Barbuda</option>
                                  <option value="12" @if(!empty($edituser['country']) && ($edituser['country'] == "12")) selected @endif>Argentina</option>
                                  <option value="13" @if(!empty($edituser['country']) && ($edituser['country'] == "13")) selected @endif>Armenia</option>
                                  <option value="14" @if(!empty($edituser['country']) && ($edituser['country'] == "14")) selected @endif>Aruba</option>
                                  <option value="15" @if(!empty($edituser['country']) && ($edituser['country'] == "15")) selected @endif>Australia</option>
                                  <option value="16" @if(!empty($edituser['country']) && ($edituser['country'] == "16")) selected @endif>Austria</option>
                                  <option value="17" @if(!empty($edituser['country']) && ($edituser['country'] == "17")) selected @endif>Azerbaijan</option>
                                  <option value="18" @if(!empty($edituser['country']) && ($edituser['country'] == "18")) selected @endif>Bahamas</option>
                                  <option value="19" @if(!empty($edituser['country']) && ($edituser['country'] == "19")) selected @endif>Bahrain</option>
                                  <option value="20" @if(!empty($edituser['country']) && ($edituser['country'] == "20")) selected @endif>Bangladesh</option>
                                  <option value="21" @if(!empty($edituser['country']) && ($edituser['country'] == "21")) selected @endif>Barbados</option>
                                  <option value="22" @if(!empty($edituser['country']) && ($edituser['country'] == "22")) selected @endif>Belarus</option>
                                  <option value="23" @if(!empty($edituser['country']) && ($edituser['country'] == "23")) selected @endif>Belgium</option>
                                  <option value="24" @if(!empty($edituser['country']) && ($edituser['country'] == "24")) selected @endif>Belize</option>
                                  <option value="25" @if(!empty($edituser['country']) && ($edituser['country'] == "25")) selected @endif>Benin</option>
                                  <option value="26" @if(!empty($edituser['country']) && ($edituser['country'] == "26")) selected @endif>Bermuda</option>
                                  <option value="27" @if(!empty($edituser['country']) && ($edituser['country'] == "27")) selected @endif>Bhutan</option>
                                  <option value="28" @if(!empty($edituser['country']) && ($edituser['country'] == "28")) selected @endif>Bolivia</option>
                                  <option value="29" @if(!empty($edituser['country']) && ($edituser['country'] == "29")) selected @endif>Bosnia and Herzegovina</option>
                                  <option value="30" @if(!empty($edituser['country']) && ($edituser['country'] == "30")) selected @endif>Botswana</option>
                                  <option value="31" @if(!empty($edituser['country']) && ($edituser['country'] == "31")) selected @endif>Bouvet Island</option>
                                  <option value="32" @if(!empty($edituser['country']) && ($edituser['country'] == "32")) selected @endif>Brazil</option>
                                  <option value="33" @if(!empty($edituser['country']) && ($edituser['country'] == "33")) selected @endif>British Indian Ocean Territory</option>
                                  <option value="34" @if(!empty($edituser['country']) && ($edituser['country'] == "34")) selected @endif>Brunei Darussalam</option>
                                  <option value="35" @if(!empty($edituser['country']) && ($edituser['country'] == "35")) selected @endif>Bulgaria</option>
                                  <option value="36" @if(!empty($edituser['country']) && ($edituser['country'] == "36")) selected @endif>Burkina Faso</option>
                                  <option value="37" @if(!empty($edituser['country']) && ($edituser['country'] == "37")) selected @endif>Burundi</option>
                                  <option value="38" @if(!empty($edituser['country']) && ($edituser['country'] == "38")) selected @endif>Cambodia</option>
                                  <option value="39" @if(!empty($edituser['country']) && ($edituser['country'] == "39")) selected @endif>Cameroon</option>
                                  <option value="40" @if(!empty($edituser['country']) && ($edituser['country'] == "40")) selected @endif>Canada</option>
                                  <option value="41" @if(!empty($edituser['country']) && ($edituser['country'] == "41")) selected @endif>Cape Verde</option>
                                  <option value="42" @if(!empty($edituser['country']) && ($edituser['country'] == "42")) selected @endif>Cayman Islands</option>
                                  <option value="43" @if(!empty($edituser['country']) && ($edituser['country'] == "43")) selected @endif>Central African Republic</option>
                                  <option value="44" @if(!empty($edituser['country']) && ($edituser['country'] == "44")) selected @endif>Chad</option>
                                  <option value="45" @if(!empty($edituser['country']) && ($edituser['country'] == "45")) selected @endif>Chile</option>
                                  <option value="46" @if(!empty($edituser['country']) && ($edituser['country'] == "46")) selected @endif>China</option>
                                  <option value="47" @if(!empty($edituser['country']) && ($edituser['country'] == "47")) selected @endif>Christmas Island</option>
                                  <option value="48" @if(!empty($edituser['country']) && ($edituser['country'] == "48")) selected @endif>Cocos (Keeling) Islands</option>
                                  <option value="49" @if(!empty($edituser['country']) && ($edituser['country'] == "49")) selected @endif>Colombia</option>
                                  <option value="50" @if(!empty($edituser['country']) && ($edituser['country'] == "50")) selected @endif>Comoros</option>
                                  <option value="51" @if(!empty($edituser['country']) && ($edituser['country'] == "51")) selected @endif>Congo</option>
                                  <option value="52" @if(!empty($edituser['country']) && ($edituser['country'] == "52")) selected @endif>Congo, The Democratic Republic of The</option>
                                  <option value="53" @if(!empty($edituser['country']) && ($edituser['country'] == "53")) selected @endif>Cook Islands</option>
                                  <option value="54" @if(!empty($edituser['country']) && ($edituser['country'] == "54")) selected @endif>Costa Rica</option>
                                  <option value="55" @if(!empty($edituser['country']) && ($edituser['country'] == "55")) selected @endif>Cote D'ivoire</option>
                                  <option value="56" @if(!empty($edituser['country']) && ($edituser['country'] == "56")) selected @endif>Croatia</option>
                                  <option value="57" @if(!empty($edituser['country']) && ($edituser['country'] == "57")) selected @endif>Cuba</option>
                                  <option value="58" @if(!empty($edituser['country']) && ($edituser['country'] == "58")) selected @endif>Cyprus</option>
                                  <option value="59" @if(!empty($edituser['country']) && ($edituser['country'] == "59")) selected @endif>Czech Republic</option>
                                  <option value="60" @if(!empty($edituser['country']) && ($edituser['country'] == "60")) selected @endif>Denmark</option>
                                  <option value="61" @if(!empty($edituser['country']) && ($edituser['country'] == "61")) selected @endif>Djibouti</option>
                                  <option value="62" @if(!empty($edituser['country']) && ($edituser['country'] == "62")) selected @endif>Dominica</option>
                                  <option value="63" @if(!empty($edituser['country']) && ($edituser['country'] == "63")) selected @endif>Dominican Republic</option>
                                  <option value="64" @if(!empty($edituser['country']) && ($edituser['country'] == "64")) selected @endif>Ecuador</option>
                                  <option value="65" @if(!empty($edituser['country']) && ($edituser['country'] == "65")) selected @endif>Egypt</option>
                                  <option value="66" @if(!empty($edituser['country']) && ($edituser['country'] == "66")) selected @endif>El Salvador</option>
                                  <option value="67" @if(!empty($edituser['country']) && ($edituser['country'] == "67")) selected @endif>Equatorial Guinea</option>
                                  <option value="68" @if(!empty($edituser['country']) && ($edituser['country'] == "68")) selected @endif>Eritrea</option>
                                  <option value="69" @if(!empty($edituser['country']) && ($edituser['country'] == "69")) selected @endif>Estonia</option>
                                  <option value="70" @if(!empty($edituser['country']) && ($edituser['country'] == "70")) selected @endif>Ethiopia</option>
                                  <option value="71" @if(!empty($edituser['country']) && ($edituser['country'] == "71")) selected @endif>Falkland Islands (Malvinas)</option>
                                  <option value="72" @if(!empty($edituser['country']) && ($edituser['country'] == "72")) selected @endif>Faroe Islands</option>
                                  <option value="73" @if(!empty($edituser['country']) && ($edituser['country'] == "73")) selected @endif>Fiji</option>
                                  <option value="74" @if(!empty($edituser['country']) && ($edituser['country'] == "74")) selected @endif>Finland</option>
                                  <option value="75" @if(!empty($edituser['country']) && ($edituser['country'] == "75")) selected @endif>France</option>
                                  <option value="76" @if(!empty($edituser['country']) && ($edituser['country'] == "76")) selected @endif>French Guiana</option>
                                  <option value="77" @if(!empty($edituser['country']) && ($edituser['country'] == "77")) selected @endif>French Polynesia</option>
                                  <option value="78" @if(!empty($edituser['country']) && ($edituser['country'] == "78")) selected @endif>French Southern Territories</option>
                                  <option value="79" @if(!empty($edituser['country']) && ($edituser['country'] == "79")) selected @endif>Gabon</option>
                                  <option value="80" @if(!empty($edituser['country']) && ($edituser['country'] == "80")) selected @endif>Gambia</option>
                                  <option value="81" @if(!empty($edituser['country']) && ($edituser['country'] == "81")) selected @endif>Georgia</option>
                                  <option value="82" @if(!empty($edituser['country']) && ($edituser['country'] == "82")) selected @endif>Germany</option>
                                  <option value="83" @if(!empty($edituser['country']) && ($edituser['country'] == "83")) selected @endif>Ghana</option>
                                  <option value="84" @if(!empty($edituser['country']) && ($edituser['country'] == "84")) selected @endif>Gibraltar</option>
                                  <option value="85" @if(!empty($edituser['country']) && ($edituser['country'] == "85")) selected @endif>Greece</option>
                                  <option value="86" @if(!empty($edituser['country']) && ($edituser['country'] == "86")) selected @endif>Greenland</option>
                                  <option value="87" @if(!empty($edituser['country']) && ($edituser['country'] == "87")) selected @endif>Grenada</option>
                                  <option value="88" @if(!empty($edituser['country']) && ($edituser['country'] == "88")) selected @endif>Guadeloupe</option>
                                  <option value="89" @if(!empty($edituser['country']) && ($edituser['country'] == "89")) selected @endif>Guam</option>
                                  <option value="90" @if(!empty($edituser['country']) && ($edituser['country'] == "90")) selected @endif>Guatemala</option>
                                  <option value="91" @if(!empty($edituser['country']) && ($edituser['country'] == "91")) selected @endif>Guernsey</option>
                                  <option value="92" @if(!empty($edituser['country']) && ($edituser['country'] == "92")) selected @endif>Guinea</option>
                                  <option value="93" @if(!empty($edituser['country']) && ($edituser['country'] == "93")) selected @endif>Guinea-bissau</option>
                                  <option value="94" @if(!empty($edituser['country']) && ($edituser['country'] == "94")) selected @endif>Guyana</option>
                                  <option value="95" @if(!empty($edituser['country']) && ($edituser['country'] == "95")) selected @endif>Haiti</option>
                                  <option value="96" @if(!empty($edituser['country']) && ($edituser['country'] == "96")) selected @endif>Heard Island and Mcdonald Islands</option>
                                  <option value="97" @if(!empty($edituser['country']) && ($edituser['country'] == "97")) selected @endif>Holy See (Vatican City State)</option>
                                  <option value="98" @if(!empty($edituser['country']) && ($edituser['country'] == "98")) selected @endif>Honduras</option>
                                  <option value="99" @if(!empty($edituser['country']) && ($edituser['country'] == "99")) selected @endif>Hong Kong</option>
                                  <option value="100" @if(!empty($edituser['country']) && ($edituser['country'] == "100")) selected @endif>Hungary</option>
                                  <option value="101" @if(!empty($edituser['country']) && ($edituser['country'] == "101")) selected @endif>Iceland</option>
                                  <option value="102" @if(!empty($edituser['country']) && ($edituser['country'] == "102")) selected @endif>India</option>
                                  <option value="103" @if(!empty($edituser['country']) && ($edituser['country'] == "103")) selected @endif>Indonesia</option>
                                  <option value="104" @if(!empty($edituser['country']) && ($edituser['country'] == "104")) selected @endif>Iran, Islamic Republic of</option>
                                  <option value="105" @if(!empty($edituser['country']) && ($edituser['country'] == "105")) selected @endif>Iraq</option>
                                  <option value="106" @if(!empty($edituser['country']) && ($edituser['country'] == "106")) selected @endif>Ireland</option>
                                  <option value="107" @if(!empty($edituser['country']) && ($edituser['country'] == "107")) selected @endif>Isle of Man</option>
                                  <option value="108" @if(!empty($edituser['country']) && ($edituser['country'] == "108")) selected @endif>Israel</option>
                                  <option value="109" @if(!empty($edituser['country']) && ($edituser['country'] == "109")) selected @endif>Italy</option>
                                  <option value="110" @if(!empty($edituser['country']) && ($edituser['country'] == "110")) selected @endif>Jamaica</option>
                                  <option value="111" @if(!empty($edituser['country']) && ($edituser['country'] == "111")) selected @endif>Jersey</option>
                                  <option value="112" @if(!empty($edituser['country']) && ($edituser['country'] == "112")) selected @endif>Jordan</option>
                                  <option value="113" @if(!empty($edituser['country']) && ($edituser['country'] == "113")) selected @endif>Kazakhstan</option>
                                  <option value="114" @if(!empty($edituser['country']) && ($edituser['country'] == "114")) selected @endif>Kenya</option>
                                  <option value="115" @if(!empty($edituser['country']) && ($edituser['country'] == "115")) selected @endif>Kiribati</option>
                                  <option value="116" @if(!empty($edituser['country']) && ($edituser['country'] == "116")) selected @endif>Korea, Democratic People's Republic of</option>
                                  <option value="117" @if(!empty($edituser['country']) && ($edituser['country'] == "117")) selected @endif>Korea, Republic of</option>
                                  <option value="118" @if(!empty($edituser['country']) && ($edituser['country'] == "118")) selected @endif>Kuwait</option>
                                  <option value="119" @if(!empty($edituser['country']) && ($edituser['country'] == "119")) selected @endif>Kyrgyzstan</option>
                                  <option value="120" @if(!empty($edituser['country']) && ($edituser['country'] == "120")) selected @endif>Lao People's Democratic Republic</option>
                                  <option value="121" @if(!empty($edituser['country']) && ($edituser['country'] == "121")) selected @endif>Latvia</option>
                                  <option value="122" @if(!empty($edituser['country']) && ($edituser['country'] == "122")) selected @endif>Lebanon</option>
                                  <option value="123" @if(!empty($edituser['country']) && ($edituser['country'] == "123")) selected @endif>Lesotho</option>
                                  <option value="124" @if(!empty($edituser['country']) && ($edituser['country'] == "124")) selected @endif>Liberia</option>
                                  <option value="125" @if(!empty($edituser['country']) && ($edituser['country'] == "125")) selected @endif>Libyan Arab Jamahiriya</option>
                                  <option value="126" @if(!empty($edituser['country']) && ($edituser['country'] == "126")) selected @endif>Liechtenstein</option>
                                  <option value="127" @if(!empty($edituser['country']) && ($edituser['country'] == "127")) selected @endif>Lithuania</option>
                                  <option value="128" @if(!empty($edituser['country']) && ($edituser['country'] == "128")) selected @endif>Luxembourg</option>
                                  <option value="129" @if(!empty($edituser['country']) && ($edituser['country'] == "129")) selected @endif>Macao</option>
                                  <option value="130" @if(!empty($edituser['country']) && ($edituser['country'] == "130")) selected @endif>Macedonia, The Former Yugoslav Republic of</option>
                                  <option value="131" @if(!empty($edituser['country']) && ($edituser['country'] == "131")) selected @endif>Madagascar</option>
                                  <option value="132" @if(!empty($edituser['country']) && ($edituser['country'] == "132")) selected @endif>Malawi</option>
                                  <option value="133" @if(!empty($edituser['country']) && ($edituser['country'] == "133")) selected @endif>Malaysia</option>
                                  <option value="134" @if(!empty($edituser['country']) && ($edituser['country'] == "134")) selected @endif>Maldives</option>
                                  <option value="135" @if(!empty($edituser['country']) && ($edituser['country'] == "135")) selected @endif>Mali</option>
                                  <option value="136" @if(!empty($edituser['country']) && ($edituser['country'] == "136")) selected @endif>Malta</option>
                                  <option value="137" @if(!empty($edituser['country']) && ($edituser['country'] == "137")) selected @endif>Marshall Islands</option>
                                  <option value="138" @if(!empty($edituser['country']) && ($edituser['country'] == "138")) selected @endif>Martinique</option>
                                  <option value="139" @if(!empty($edituser['country']) && ($edituser['country'] == "139")) selected @endif>Mauritania</option>
                                  <option value="140" @if(!empty($edituser['country']) && ($edituser['country'] == "140")) selected @endif>Mauritius</option>
                                  <option value="141" @if(!empty($edituser['country']) && ($edituser['country'] == "141")) selected @endif>Mayotte</option>
                                  <option value="142" @if(!empty($edituser['country']) && ($edituser['country'] == "142")) selected @endif>Mexico</option>
                                  <option value="143" @if(!empty($edituser['country']) && ($edituser['country'] == "143")) selected @endif>Micronesia, Federated States of</option>
                                  <option value="144" @if(!empty($edituser['country']) && ($edituser['country'] == "144")) selected @endif>Moldova, Republic of</option>
                                  <option value="145" @if(!empty($edituser['country']) && ($edituser['country'] == "145")) selected @endif>Monaco</option>
                                  <option value="146" @if(!empty($edituser['country']) && ($edituser['country'] == "146")) selected @endif>Mongolia</option>
                                  <option value="147" @if(!empty($edituser['country']) && ($edituser['country'] == "147")) selected @endif>Montenegro</option>
                                  <option value="148" @if(!empty($edituser['country']) && ($edituser['country'] == "148")) selected @endif>Montserrat</option>
                                  <option value="149" @if(!empty($edituser['country']) && ($edituser['country'] == "149")) selected @endif>Morocco</option>
                                  <option value="150" @if(!empty($edituser['country']) && ($edituser['country'] == "150")) selected @endif>Mozambique</option>
                                  <option value="151" @if(!empty($edituser['country']) && ($edituser['country'] == "151")) selected @endif>Myanmar</option>
                                  <option value="152" @if(!empty($edituser['country']) && ($edituser['country'] == "152")) selected @endif>Namibia</option>
                                  <option value="153" @if(!empty($edituser['country']) && ($edituser['country'] == "153")) selected @endif>Nauru</option>
                                  <option value="154" @if(!empty($edituser['country']) && ($edituser['country'] == "154")) selected @endif>Nepal</option>
                                  <option value="155" @if(!empty($edituser['country']) && ($edituser['country'] == "155")) selected @endif>Netherlands</option>
                                  <option value="156" @if(!empty($edituser['country']) && ($edituser['country'] == "156")) selected @endif>Netherlands Antilles</option>
                                  <option value="157" @if(!empty($edituser['country']) && ($edituser['country'] == "157")) selected @endif>New Caledonia</option>
                                  <option value="158" @if(!empty($edituser['country']) && ($edituser['country'] == "158")) selected @endif>New Zealand</option>
                                  <option value="159" @if(!empty($edituser['country']) && ($edituser['country'] == "159")) selected @endif>Nicaragua</option>
                                  <option value="160" @if(!empty($edituser['country']) && ($edituser['country'] == "160")) selected @endif>Niger</option>
                                  <option value="161" @if(!empty($edituser['country']) && ($edituser['country'] == "161")) selected @endif>Nigeria</option>
                                  <option value="162" @if(!empty($edituser['country']) && ($edituser['country'] == "162")) selected @endif>Niue</option>
                                  <option value="163" @if(!empty($edituser['country']) && ($edituser['country'] == "163")) selected @endif>Norfolk Island</option>
                                  <option value="164" @if(!empty($edituser['country']) && ($edituser['country'] == "164")) selected @endif>Northern Mariana Islands</option>
                                  <option value="165" @if(!empty($edituser['country']) && ($edituser['country'] == "165")) selected @endif>Norway</option>
                                  <option value="166" @if(!empty($edituser['country']) && ($edituser['country'] == "166")) selected @endif>Oman</option>
                                  <option value="167" @if(!empty($edituser['country']) && ($edituser['country'] == "167")) selected @endif>Pakistan</option>
                                  <option value="168" @if(!empty($edituser['country']) && ($edituser['country'] == "168")) selected @endif>Palau</option>
                                  <option value="169" @if(!empty($edituser['country']) && ($edituser['country'] == "169")) selected @endif>Palestinian Territory, Occupied</option>
                                  <option value="170" @if(!empty($edituser['country']) && ($edituser['country'] == "170")) selected @endif>Panama</option>
                                  <option value="171" @if(!empty($edituser['country']) && ($edituser['country'] == "171")) selected @endif>Papua New Guinea</option>
                                  <option value="172" @if(!empty($edituser['country']) && ($edituser['country'] == "172")) selected @endif>Paraguay</option>
                                  <option value="173" @if(!empty($edituser['country']) && ($edituser['country'] == "173")) selected @endif>Peru</option>
                                  <option value="174" @if(!empty($edituser['country']) && ($edituser['country'] == "174")) selected @endif>Philippines</option>
                                  <option value="175" @if(!empty($edituser['country']) && ($edituser['country'] == "175")) selected @endif>Pitcairn</option>
                                  <option value="176" @if(!empty($edituser['country']) && ($edituser['country'] == "176")) selected @endif>Poland</option>
                                  <option value="177" @if(!empty($edituser['country']) && ($edituser['country'] == "177")) selected @endif>Portugal</option>
                                  <option value="178" @if(!empty($edituser['country']) && ($edituser['country'] == "178")) selected @endif>Puerto Rico</option>
                                  <option value="179" @if(!empty($edituser['country']) && ($edituser['country'] == "179")) selected @endif>Qatar</option>
                                  <option value="180" @if(!empty($edituser['country']) && ($edituser['country'] == "180")) selected @endif>Reunion</option>
                                  <option value="181" @if(!empty($edituser['country']) && ($edituser['country'] == "181")) selected @endif>Romania</option>
                                  <option value="182" @if(!empty($edituser['country']) && ($edituser['country'] == "182")) selected @endif>Russian Federation</option>
                                  <option value="183" @if(!empty($edituser['country']) && ($edituser['country'] == "183")) selected @endif>Rwanda</option>
                                  <option value="184" @if(!empty($edituser['country']) && ($edituser['country'] == "184")) selected @endif>Saint Helena</option>
                                  <option value="185" @if(!empty($edituser['country']) && ($edituser['country'] == "185")) selected @endif>Saint Kitts and Nevis</option>
                                  <option value="186" @if(!empty($edituser['country']) && ($edituser['country'] == "186")) selected @endif>Saint Lucia</option>
                                  <option value="187" @if(!empty($edituser['country']) && ($edituser['country'] == "187")) selected @endif>Saint Pierre and Miquelon</option>
                                  <option value="188" @if(!empty($edituser['country']) && ($edituser['country'] == "188")) selected @endif>Saint Vincent and The Grenadines</option>
                                  <option value="189" @if(!empty($edituser['country']) && ($edituser['country'] == "189")) selected @endif>Samoa</option>
                                  <option value="190" @if(!empty($edituser['country']) && ($edituser['country'] == "190")) selected @endif>San Marino</option>
                                  <option value="191" @if(!empty($edituser['country']) && ($edituser['country'] == "191")) selected @endif>Sao Tome and Principe</option>
                                  <option value="192" @if(!empty($edituser['country']) && ($edituser['country'] == "192")) selected @endif>Saudi Arabia</option>
                                  <option value="193" @if(!empty($edituser['country']) && ($edituser['country'] == "193")) selected @endif>Senegal</option>
                                  <option value="194" @if(!empty($edituser['country']) && ($edituser['country'] == "194")) selected @endif>Serbia</option>
                                  <option value="195" @if(!empty($edituser['country']) && ($edituser['country'] == "195")) selected @endif>Seychelles</option>
                                  <option value="196" @if(!empty($edituser['country']) && ($edituser['country'] == "196")) selected @endif>Sierra Leone</option>
                                  <option value="197" @if(!empty($edituser['country']) && ($edituser['country'] == "197")) selected @endif>Singapore</option>
                                  <option value="198" @if(!empty($edituser['country']) && ($edituser['country'] == "198")) selected @endif>Slovakia</option>
                                  <option value="199" @if(!empty($edituser['country']) && ($edituser['country'] == "199")) selected @endif>Slovenia</option>
                                  <option value="200" @if(!empty($edituser['country']) && ($edituser['country'] == "200")) selected @endif>Solomon Islands</option>
                                  <option value="201" @if(!empty($edituser['country']) && ($edituser['country'] == "201")) selected @endif>Somalia</option>
                                  <option value="202" @if(!empty($edituser['country']) && ($edituser['country'] == "202")) selected @endif>South Africa</option>
                                  <option value="203" @if(!empty($edituser['country']) && ($edituser['country'] == "203")) selected @endif>South Georgia and The South Sandwich Islands</option>
                                  <option value="204" @if(!empty($edituser['country']) && ($edituser['country'] == "204")) selected @endif>Spain</option>
                                  <option value="205" @if(!empty($edituser['country']) && ($edituser['country'] == "205")) selected @endif>Sri Lanka</option>
                                  <option value="206" @if(!empty($edituser['country']) && ($edituser['country'] == "206")) selected @endif>Sudan</option>
                                  <option value="207" @if(!empty($edituser['country']) && ($edituser['country'] == "207")) selected @endif>Suriname</option>
                                  <option value="208" @if(!empty($edituser['country']) && ($edituser['country'] == "208")) selected @endif>Svalbard and Jan Mayen</option>
                                  <option value="209" @if(!empty($edituser['country']) && ($edituser['country'] == "209")) selected @endif>Swaziland</option>
                                  <option value="210" @if(!empty($edituser['country']) && ($edituser['country'] == "210")) selected @endif>Sweden</option>
                                  <option value="211" @if(!empty($edituser['country']) && ($edituser['country'] == "211")) selected @endif>Switzerland</option>
                                  <option value="212" @if(!empty($edituser['country']) && ($edituser['country'] == "212")) selected @endif>Syrian Arab Republic</option>
                                  <option value="213" @if(!empty($edituser['country']) && ($edituser['country'] == "213")) selected @endif>Taiwan</option>
                                  <option value="214" @if(!empty($edituser['country']) && ($edituser['country'] == "214")) selected @endif>Tajikistan</option>
                                  <option value="215" @if(!empty($edituser['country']) && ($edituser['country'] == "215")) selected @endif>Tanzania, United Republic of</option>
                                  <option value="216" @if(!empty($edituser['country']) && ($edituser['country'] == "216")) selected @endif>Thailand</option>
                                  <option value="217" @if(!empty($edituser['country']) && ($edituser['country'] == "217")) selected @endif>Timor-leste</option>
                                  <option value="218" @if(!empty($edituser['country']) && ($edituser['country'] == "218")) selected @endif>Togo</option>
                                  <option value="219" @if(!empty($edituser['country']) && ($edituser['country'] == "219")) selected @endif>Tokelau</option>
                                  <option value="220" @if(!empty($edituser['country']) && ($edituser['country'] == "220")) selected @endif>Tonga</option>
                                  <option value="221" @if(!empty($edituser['country']) && ($edituser['country'] == "221")) selected @endif>Trinidad and Tobago</option>
                                  <option value="222" @if(!empty($edituser['country']) && ($edituser['country'] == "222")) selected @endif>Tunisia</option>
                                  <option value="223" @if(!empty($edituser['country']) && ($edituser['country'] == "223")) selected @endif>Turkey</option>
                                  <option value="224" @if(!empty($edituser['country']) && ($edituser['country'] == "224")) selected @endif>Turkmenistan</option>
                                  <option value="225" @if(!empty($edituser['country']) && ($edituser['country'] == "225")) selected @endif>Turks and Caicos Islands</option>
                                  <option value="226" @if(!empty($edituser['country']) && ($edituser['country'] == "226")) selected @endif>Tuvalu</option>
                                  <option value="227" @if(!empty($edituser['country']) && ($edituser['country'] == "227")) selected @endif>Uganda</option>
                                  <option value="228" @if(!empty($edituser['country']) && ($edituser['country'] == "228")) selected @endif>Ukraine</option>
                                  <option value="229" @if(!empty($edituser['country']) && ($edituser['country'] == "229")) selected @endif>United Arab Emirates</option>
                                  <option value="230" @if(!empty($edituser['country']) && ($edituser['country'] == "230")) selected @endif>United Kingdom</option>
                                  <option value="231" @if(!empty($edituser['country']) && ($edituser['country'] == "231")) selected @endif>United States</option>
                                  <option value="232" @if(!empty($edituser['country']) && ($edituser['country'] == "232")) selected @endif>United States Minor Outlying Islands</option>
                                  <option value="233" @if(!empty($edituser['country']) && ($edituser['country'] == "233")) selected @endif>Uruguay</option>
                                  <option value="234" @if(!empty($edituser['country']) && ($edituser['country'] == "234")) selected @endif>Uzbekistan</option>
                                  <option value="235" @if(!empty($edituser['country']) && ($edituser['country'] == "235")) selected @endif>Vanuatu</option>
                                  <option value="236" @if(!empty($edituser['country']) && ($edituser['country'] == "236")) selected @endif>Venezuela</option>
                                  <option value="237" @if(!empty($edituser['country']) && ($edituser['country'] == "237")) selected @endif>Viet Nam</option>
                                  <option value="238" @if(!empty($edituser['country']) && ($edituser['country'] == "238")) selected @endif>Virgin Islands, British</option>
                                  <option value="239" @if(!empty($edituser['country']) && ($edituser['country'] == "239")) selected @endif>Virgin Islands, U.S.</option>
                                  <option value="240" @if(!empty($edituser['country']) && ($edituser['country'] == "240")) selected @endif>Wallis and Futuna</option>
                                  <option value="241" @if(!empty($edituser['country']) && ($edituser['country'] == "241")) selected @endif>Western Sahara</option>
                                  <option value="242" @if(!empty($edituser['country']) && ($edituser['country'] == "242")) selected @endif>Yemen</option>
                                  <option value="243" @if(!empty($edituser['country']) && ($edituser['country'] == "243")) selected @endif>Zambia</option>
                                  <option value="244" @if(!empty($edituser['country']) && ($edituser['country'] == "244")) selected @endif>Zimbabwe</option>
                              </select>
                              <p style="display:none" class="country error text-danger"></p>                              
                           </div>
                        </div>
                     </div>





                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="address"><b>{{ __('auth.address') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input class="form-control form-control-password" placeholder="{{ __('auth.address') }}" name="address" id="address"
                                 type="text" value="{{ old('address') ?? $edituser['address'] ?? '' }}"  autofocus >
                                <p style="display:none" class="address error text-danger"></p>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="resume"><b>{{ __('履歴書') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                              <input type="file" name="resume" id="resume" class="form-control" >
                              <p style="display:none" class="resume error text-danger"></p>
                                @if(!empty($edituser['resume']))
                                 <iframe src="{{ asset('documents/'.$edituser['resume']) }}" width="100%" height="500px"></iframe>
                                @endif
                           </div>
                        </div>
                     </div>


                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="docone"><b>{{ __('職務経歴書') }}</b> <span class="badge badge-secondary">{{ __('auth.optional') }}</span></label>
                              <input type="file" name="docone" id="docone" class="form-control" >
                              <p style="display:none" class="docone error text-danger"></p>
                              @if(!empty($edituser['docone']))
                                 <iframe src="{{ asset('documents/'.$edituser['docone']) }}" width="100%" height="500px"></iframe>
                              @endif
                           </div>
                        </div>
                     </div>


                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="doctwo"><b>{{ __('その他の書類') }}</b> <span class="badge badge-secondary">{{ __('auth.optional') }}</span></label>
                              <input type="file" name="doctwo" id="doctwo" class="form-control" >
                              <p style="display:none" class="doctwo error text-danger"></p>
                              @if(!empty($edituser['doctwo']))
                                 <iframe src="{{ asset('documents/'.$edituser['doctwo']) }}" width="100%" height="500px"></iframe>
                              @endif                              
                           </div>
                        </div>
                     </div>

                     @auth
                     @if (in_array(auth()->user()->role, array("hcompany", "admin")))
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="companyinfo"><b>{{ __('推薦文') }}</b> <span class="badge badge-secondary">{{ __('auth.optional') }}</span></label>
                              <div class="form-group">
                                   <textarea class="form-control form-control-message" id="companyinfotextarea" placeholder="{{ __('推薦文') }}" rows="8">{!! str_replace("<br />","&#013;",old('companyinfo') ?? $edituser['companyinfo'] ?? '')  !!}</textarea>
                                   <p style="display:none" class="companyinfo error text-danger"></p>                                 
                                   <input type="hidden" name="companyinfo" id="companyinfo" value="{!! old('companyinfo') ?? '' !!}">
                              </div>
                           </div>
                        </div>
                     </div>
                     @endif
                     @endauth



                     @if (!$editmode)  
                     <div class="col-md-6 mx-auto">
                        <div class="form-group" style="font-size: 16px;">
                           <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" style="width: 16px;height: 16px;" name="check" id="check_id" value="1"> 
                                     <a href="#">{{ __('auth.policy') }}</a>
                                <p style="display:none" class="check error text-danger"></p>
                           </label>                                 
                        </div>           
                     </div> 
                    @endif

                     <div class="text-center">
                        <button class="btn btn-submit" type="button" role="button" data-toggle="modal">
                        <!-- <button class="btn" type="button" role="button" data-toggle="modal" data-targets="#detailModal"> -->
                      @if (!$editmode)  
                          <i class="fa fa-user-plus" aria-hidden="true"></i>
                           {{ __('auth.doregister') }}
                      @else
                          <i class="fa fa-edit" aria-hidden="true"></i>
                           {{ __('auth.dochange') }}
                      @endif
                         </button>

                     </div>
               </div>
            </div>
         </div>


               <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="deleteConfirmModalLabel">
                      　@if (!$editmode)  
                        {{ __('auth.confirmregister?') }}
                      　@else
                        {{ __('auth.confirmchange?') }}
                      　@endif
                    　　</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                <!--      <div class="modal-body">
                        <p>選択したセミナーを削除してはよろしいですか。</p>
                     </div> -->
                     <div class="modal-footer">

                        <button type="submit" class="btn btn-primary">
                      　@if (!$editmode)  
                        {{ __('auth.doregister') }}
                      　@else
                        {{ __('auth.yeschange') }}
                      　@endif
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('auth.docancel') }}</button>

                     </div>
                  </div>
                  </div>
               </div>
                  </form><!-- Contact form end -->



         <div class="speaker-shap">
            <img class="shap1" src="{{ asset('images/shap/home_schedule_memphis2.png') }}" alt="">
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


        var pwdchnge = false;
        $("#password,#password_confirmation").on("input", function(){
            pwdchnge = true;
            $('#password').attr('name', 'password');
            $('#password_confirmation').attr('name', 'password_confirmation');
        });

        // $("#registerhostform").submit(function() {
        //     alert(pwdchnge);
        //     if (!pwdchnge) {
        //     // alert('remove');
        //         $('#password').remove();
        //         $('#password_confirmation').remove();
        //     }
        // });

        $(".btn-submit").click(function(e){

          // alert("aaa");
            e.preventDefault();
// alert(pwdchnge);

      var _token = $("input[name='_token']").val();
      // var email = $("input[name='email']").val();

      // if (pwdchnge) {
      // var password = $("input[name='password']").val();
      // var password_confirmation = $("input[name='password_confirmation']").val();
      // }

      // var name = $("input[name='name']").val();
      // var furiname = $("input[name='furiname']").val();
      // var gender = $("select[name='gender']").val();
      // var phone = $("input[name='phone']").val();
      // var check = $('#check_id:checked').val();
      
let formData = new FormData(registerhostform);

console.log(formData);      

      // console.log({_token:_token, 
      //                email:email, 
      //                password:password, 
      //                password_confirmation:password_confirmation, 
      //                name:name, 
      //                furiname:furiname, 
      //                gender:gender, 
      //                phone:phone, 
      //                check:check});
      //           // alert(check);
            $.ajax({
                url: "{{ $action }}",
                type:'POST',
                // data: {_token:_token, 
                //      email:email, 
                //      password:password, 
                //      password_confirmation:password_confirmation, 
                //      name:name, 
                //      furiname:furiname, 
                //      gender:gender, 
                //      phone:phone, 
                //      check:check},
                data: formData,

                 contentType: false,
                 processData: false,

                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        // alert("success");
                        console.log(data.success);
                          $('.error').hide()
                        $('#detailModal').modal('show');
                    }else{
                        // alert("err");
                        console.log(data.error);
                          $('.error').hide()
                        $.each( data.error, function( key, value ) {
                          if (key == 'password') {
                            $.each( value, function( k, val ) {
                              if (val == 'パスワードが一致しません') {
                                $('.error.password_confirmation').text(val)
                                $('.error.password_confirmation').show() 
                                // alert('unset')
                              } else {
                                $('.error.'+key).text(val)
                                $('.error.'+key).show() 
                              }
                            });
                          } else {

                            $('.error.'+key).text(value[0])
                            $('.error.'+key).show()
                          }
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

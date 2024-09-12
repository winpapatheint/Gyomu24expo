    <x-auth-layout>

      @php $subtitle="求人管理"; @endphp
      @include('components.subtitle')

 
      <section class="ts-faq-sec ts-contact-form">
         <div class="container">
            <div class="row">

               <div class="col-lg-4">
                  <div class="sidebar-widgets">
                    @include('components.leftwidget')

                     <div class="text-center">
                        <a class="disabled" data-toggle="modal" data-target="#showdetailmodal0"><button class="btn btn-primary" type="button">詳細内容</button></a>
                     </div>

                  </div>
               </div><!-- col end-->

               <div class="col-lg-8" style="border: 1px solid #e5e5e5;">
                  <div class="blog-details">
                     <div class="entry-header" style="padding-top: 20px;">
                        <h2 class="entry-title text-center">
                           <a href="#">求職者検索</a>
                        </h2>
                     </div><!-- header end -->

                     <form id="contact-form" class="contact-form" action="{{ url()->current() }}" method="get">
                        <div class="row">
                           <div class="col-md-12 mx-auto">
                              <div class="form-group">
                                 <label for="email">検索キーワード</label>
                                 <input class="form-control form-control-email" placeholder="求職者名・メールアドレス・エージェント会社" name="kword" id="kword"
                                    type="text" value="{{ $_GET['kword'] ?? '' }}">
                              </div>
                           </div>
                        </div>                    


                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="field">{{ __('希望職種') }}</label>
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


<!--                         <div class="row">
                           <div class="col-md-6">
                           <div class="form-group">
                              <select class="form-control" name="infcgender" id="infcgender" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                @foreach (config('global.infcgender') as $key => $value)
                                  <option value="{{$key}}" @if(!empty($_GET['infcgender']) && ($_GET['infcgender'] == $key)) selected @endif >{{$value}}</option>
                                @endforeach
                              </select>                              
                           </div>
                           </div>
                           <div class="col-md-6">
                           <div class="form-group">
                              <select class="form-control" name="infccountry" id="infccountry" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                @foreach (config('global.infccountry') as $key => $value)
                                  <option value="{{$key}}" @if(!empty($_GET['infccountry']) && ($_GET['infccountry'] == $key)) selected @endif >{{$value}}</option>
                                @endforeach
                              </select>                           
                           </div>
                           </div>

                        </div>  


                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <select class="form-control" name="infcmedia" id="infcmedia" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                @foreach (config('global.infcmedia') as $key => $value)
                                  <option value="{{$key}}" @if(!empty($_GET['infcmedia']) && ($_GET['infcmedia'] == $key)) selected @endif >{{$value}}</option>
                                @endforeach
                              </select>                              
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <select class="form-control" name="infcgenre" id="infcgenre" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                @foreach (config('global.infcgenre') as $key => $value)
                                  <option value="{{$key}}" @if(!empty($_GET['infcgenre']) && ($_GET['infcgenre'] == $key)) selected @endif >{{$value}}</option>
                                @endforeach
                              </select>                              
                           </div>
                        </div>
                     </div> -->

                        @if ($message = Session::get('errorsearch'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>    
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif
                                      
                        <div class="text-center" style="padding-bottom: 30px;">
                           <button class="btn" type="submit"><i class="fa fa-search"></i>
                              検索</button>
                        </div>
                     </form>

                      <form id='inflassign' class="contact-form" method="POST" action="{{ route('inflassign') }}">
                      @csrf
                      <input type="hidden" name="taskid" value="{{ $taskhashid }}">

                      <div class="table-responsive">
                        <table class="table"　style="margin-bottom: 30px;">
                           <thead>
                              <tr>
                                 <th scope="col">#</th>
                                <th style="min-width: 115px" scope="col">求職者名</th>
                                <th scope="col">メールアドレス</th>
                                <th style="min-width: 130px" scope="col">エージェント会社名</th>
                                <th scope="col"></th>

                              </tr>
                            </thead>
                            <tbody>

                              @foreach( $influencers as $key => $influencer )
                              <tr>
                                <th scope="row">{{ $ttl - $key }}</th>
                                <td data-label="求職者名">
                                  <a href="#" role="button" data-toggle="modal" data-target="#detailModal{{ $influencer->id }}" class="ts-image-popup">
                                   {{ $influencer->name }}
                                  </a>
                                </td>
                                <td data-label="メールアドレス">{{ $influencer->email }}</td>
                                <td data-label="エージェント会社名">{{ $influencer->hcompanyname }}</td>
                             　　 <td data-label="TOP" style="vertical-align: middle;text-align: center;">
                                    <input type="checkbox" class="toppage" name="checkinfl[]" value="{{ $influencer->id }}" @if(in_array($influencer->id, $inflassign)) checked  disabled @endif style="width: 16px;height: 16px;"> 
                            　　　 </td>
                              </tr>
                              @endforeach

                            </tbody>
                        </table>

                      </div>

                      <div class="text-center" style="padding-bottom: 30px;">
                        <button class="btn askconfirm" type="submit" data-askconfirmtitle="求人応募を打診" data-askconfirmtext="打診しますか？" data-yes="打診する">打診する</button>
                      </div>
                      </form>

                        <!-- Post comment end-->
                     </div>
                     <!-- Post content end-->
                  </div>

                @include('components.influencerdetail')


            </div><!-- row end-->
         </div><!-- .container end -->
      </section><!-- End faq section -->



    </x-auth-layout>
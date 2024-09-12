<x-auth-layout>

<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">

<style type="text/css">

.btndiv{
  display: contents;
}
  
@media 
only screen and (max-width: 430px){

    .btndiv{
        display: block;
    }

    
}

</style>

      @php $subtitle="求職者一覧"; @endphp
      @include('hcompany.subtitle')

      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     求職者一覧
                  </h2>
               </div><!-- col end-->
            </div>
            <!-- <div class="row">
               <div class="col-lg-8 mx-auto">
                  <p class="text-center mb-5" style="font-size: 18px;">
                     <a  href="register_new_seminar.html">
                        <i class="fa fa-plus" aria-hidden="true"></i> セミナーの新規登録</a>
                  </p>
               </div>
            </div> -->

            <!-- Search filter -->
            <div class="row" style="margin-bottom: 50px;">
               <div class="col-lg-8 mx-auto">
                  <form id="contact-form" class="contact-form" action="{{ url()->current() }}" method="get">
                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="email">検索キーワード</label>
                              <input class="form-control form-control-email" placeholder="求職者名・メールアドレス" name="kword" id="kword"
                                 type="text" value="{{ $_GET['kword'] ?? '' }}">
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="email">{{ __('希望職種') }}</label>
                                 <select class="form-control" name="field" id="field" style="padding-top: 10px;padding-bottom: 10px;height: 55px;">
                                     <option value="0">選択してください</option>
                                    <optgroup label="営業">
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '法人営業')) selected @endif >法人営業</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '個人営業')) selected @endif >個人営業</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'ルートセールス・代理店営業')) selected @endif >ルートセールス・代理店営業</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '内勤営業・カウンターセールス')) selected @endif >内勤営業・カウンターセールス</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '海外営業')) selected @endif >海外営業</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'カスタマーサポート・コールセンター運営')) selected @endif >カスタマーサポート・コールセンター運営</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'キャリアカウンセラー・人材コーディネーター')) selected @endif >キャリアカウンセラー・人材コーディネーター</option>
                                    </optgroup>
                                    <optgroup label="事務・管理">
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '財務・経理')) selected @endif >財務・経理</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '人事')) selected @endif >人事</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '総務・事務')) selected @endif >総務・事務</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '法務')) selected @endif >法務</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '広報・IR')) selected @endif >広報・IR</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '物流・貿易')) selected @endif >物流・貿易</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '一般事務・営業事務')) selected @endif >一般事務・営業事務</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '秘書')) selected @endif >秘書</option>
                                    </optgroup>
                                    <optgroup label="マーケティング">
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '商品企画・商品開発')) selected @endif >商品企画・商品開発</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'ブランドマネージャー・プロダクトマネージャー')) selected @endif >ブランドマネージャー・プロダクトマネージャー</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '広告・宣伝')) selected @endif >広告・宣伝</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '販売促進・販促企画')) selected @endif >販売促進・販促企画</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '営業企画')) selected @endif >営業企画</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'イベント企画・運営')) selected @endif >イベント企画・運営</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'Web・SNSマーケティング')) selected @endif >Web・SNSマーケティング</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'データアナリスト')) selected @endif >データアナリスト</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '市場調査・分析')) selected @endif >市場調査・分析</option>
                                    </optgroup>
                                    <optgroup label="経営企画・経営戦略">
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '経営企画・事業統括')) selected @endif >経営企画・事業統括</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '管理職・エグゼクティブ')) selected @endif >管理職・エグゼクティブ</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'MD・バイヤー・店舗開発・FCオーナー')) selected @endif >MD・バイヤー・店舗開発・FCオーナー</option>
                                    </optgroup>
                                    <optgroup label="ディレクター">
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'Webディレクター・Webプロデューサー')) selected @endif >Webディレクター・Webプロデューサー</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'テクニカルディレクター・プロジェクトマネージャー')) selected @endif >テクニカルディレクター・プロジェクトマネージャー</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'クリエイティブディレクター')) selected @endif >クリエイティブディレクター</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '制作・進行管理（その他）')) selected @endif >制作・進行管理（その他）</option>
                                    </optgroup>
                                    <optgroup label="クリエイティブ関連">
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'Webデザイナー')) selected @endif >Webデザイナー</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'UI・UXデザイナー')) selected @endif >UI・UXデザイナー</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'ゲームデザイナー・イラストレーター')) selected @endif >ゲームデザイナー・イラストレーター</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'CGデザイナー')) selected @endif >CGデザイナー</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'Web・モバイル・ソーシャル・ゲーム制作／開発')) selected @endif >Web・モバイル・ソーシャル・ゲーム制作／開発</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '編集・ライター')) selected @endif >編集・ライター</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '映像・動画関連')) selected @endif >映像・動画関連</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'ファッション・インテリア・空間・プロダクトデザイン')) selected @endif >ファッション・インテリア・空間・プロダクトデザイン</option>
                                    </optgroup>
                                    <optgroup label="ITエンジニア">
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '業務系アプリケーションエンジニア・プログラマ')) selected @endif >業務系アプリケーションエンジニア・プログラマ</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'Webサービス系エンジニア・プログラマ')) selected @endif >Webサービス系エンジニア・プログラマ</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '制御系ソフトウェア開発（通信・ネットワーク・IoT関連）')) selected @endif >制御系ソフトウェア開発（通信・ネットワーク・IoT関連）</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'インフラエンジニア')) selected @endif >インフラエンジニア</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'IT・システムコンサルタント')) selected @endif >IT・システムコンサルタント</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '社内情報システム（社内SE）')) selected @endif >社内情報システム（社内SE）</option>
                                    </optgroup>
                                    <optgroup label="エンジニア（機械・電気・電子・半導体・制御）">
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '機械・機構設計・金型設計')) selected @endif >機械・機構設計・金型設計</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '回路・システム設計')) selected @endif >回路・システム設計</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'サービスエンジニア・サポートエンジニアー')) selected @endif >サービスエンジニア・サポートエンジニアー</option>
                                    </optgroup>
                                    <optgroup label="素材・化学・食品・医薬品技術職">
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '素材・半導体素材・化成品関連')) selected @endif >素材・半導体素材・化成品関連</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '化粧品・食品・香料関連')) selected @endif >化粧品・食品・香料関連</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '医薬品関連')) selected @endif >医薬品関連</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '医療用具関連')) selected @endif >医療用具関連</option>
                                    </optgroup>
                                    <optgroup label="建築・土木技術">
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '研究開発・技術開発・構造解析・特許')) selected @endif >研究開発・技術開発・構造解析・特許</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '施工管理・設備・環境保全')) selected @endif >施工管理・設備・環境保全</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'プランニング・測量・設計・積算')) selected @endif >プランニング・測量・設計・積算</option>      
                                    </optgroup>
                                    <optgroup label="技能工・設備・交通・運輸">
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '技能工（整備・工場生産・製造・工事）')) selected @endif >技能工（整備・工場生産・製造・工事）</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '生産・品質管理')) selected @endif >生産・品質管理</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '運輸・配送・倉庫関連')) selected @endif >運輸・配送・倉庫関連</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '交通（鉄道・バス・タクシー）関連')) selected @endif >交通（鉄道・バス・タクシー）関連</option>
                                    </optgroup>
                                    <optgroup label="サービス 接客 店舗">
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '店長・SV（スーパーバイザー）')) selected @endif >店長・SV（スーパーバイザー）</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'ホールスタッフ')) selected @endif >ホールスタッフ</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '料理長')) selected @endif >料理長</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '調理')) selected @endif >調理</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '警備・施設管理関連職')) selected @endif >警備・施設管理関連職</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '販売・サービススタッフ')) selected @endif >販売・サービススタッフ</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '宿泊施設・ホテル')) selected @endif >宿泊施設・ホテル</option>
                                    </optgroup>
                                    <optgroup label="専門職（コンサルタント 士業 金融 不動産）">
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'ビジネスコンサルタント・シンクタンク')) selected @endif >ビジネスコンサルタント・シンクタンク</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '士業・専門コンサルタント')) selected @endif >士業・専門コンサルタント</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '金融系専門職')) selected @endif >金融系専門職</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '金融系専門職')) selected @endif >金融系専門職</option>
                                    </optgroup>
                                    <optgroup label="医療・福祉・介護">
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '医療・看護')) selected @endif >医療・看護</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '薬事')) selected @endif >薬事</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '臨床開発')) selected @endif >臨床開発</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '福祉・介護')) selected @endif >福祉・介護</option>
                                    </optgroup>
                                    <optgroup label="教育・保育関連">
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == '教育・保育')) selected @endif >教育・保育</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'インストラクター・通訳・翻訳')) selected @endif >インストラクター・通訳・翻訳</option>
                                       <option @if((isset($_GET['field'])) AND ($_GET['field'] == 'その他')) selected @endif >その他</option>
                                    </optgroup>
                                 </select>
                           </div>
                        </div>
                     </div>
                                     
                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="start">登録開始日</label>
                              <input class="form-control form-control-password" placeholder="登録開始日" name="start" id="start"
                                 type="date"  value="{{ $_GET['start'] ?? ''}}">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="end">登録終了日</label>
                              <input class="form-control form-control-password" placeholder="登録終了日" name="end" id="end"
                                 type="date" value="{{ $_GET['end'] ?? ''}}">
                           </div>
                        </div>
                     </div>                                      
                     <div class="text-center">
                        <button class="btn" type="submit"><i class="fa fa-search"></i>
                           検索する</button>
                     </div>
                  </form>
               </div>
            </div>

            @include('components.messagebox')

            <!-- Seminar list-->
            <div class="row">
               <div class="table-responsive">
                  <table class="table">
                     <thead>
                        <tr>
                           <th scope="col">#</th>
                          <th scope="col">登録日</th>
                          <th style="min-width: 115px" scope="col">求職者名</th>
                          <th scope="col">メールアドレス</th>
                          <th style="min-width: 130px" scope="col">エージェント会社名</th>
                          <!-- <th scope="col">年齢</th> -->
                          <th style="min-width: 56px" scope="col" class="text-center">状態</th>
                          <th style="min-width: 90px" scope="col">アクション</th>
                          <!-- <th style="min-width: 58px" scope="col">TOP</th> -->
                        </tr>
                      </thead>
                      <tbody>

                        @foreach( $lists as $key => $list )
                        <tr>
                          <th scope="row">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</th>
                          <td data-label="登録日">{{ date('Y/m/d', strtotime($list->created_at)) }}<br>{{ date('H:i', strtotime($list->created_at)) }}</td>
                          <td data-label="求職者名"><a @if($list->role == 'host')href="{{ url('/takeremotehost/'.rand ( 10000 , 99999 ).$list->id ) }}" @endif>{{ $list->name }}</a></td>
                          <td data-label="メールアドレス">{{ $list->email }}</td>
                          <td data-label="管理社名">{{ $list->hcompanyname }}</td>
                          <td data-label="状態" class="text-center">@if($list->role == 'idlehost')無効@else有効@endif @if($list->inflhide)/非表示@endif</td>
                          <!-- <td data-label="年齢">{{ $list->agerange }}</td> -->
                          <td data-label="アクション">
                              <a class="btnlist btn-primary" href="#" role="button" data-toggle="modal" data-target="#detailModal{{ $list->id }}">詳細</a>
                              <a class="btnlist btn-success" href="{{ url('/edit/host/'.rand ( 10000 , 99999 ).$list->id ) }}" role="button">{{ __('推薦文') }}</a>
                              <!-- @if($list->inflhide)
                              <a class="btnlist btn-danger inflhide-btn" href="" data-hostid='{{$list->id}}' role="button" data-askconfirmtitle="TOPページに表示に設定" data-askconfirmtext="表示にしますか？" data-yes="表示にする">表示にする</a>
                              @else
                              <a class="btnlist btn-danger inflhide-btn" href="" data-hostid='{{$list->id}}' role="button" data-askconfirmtitle="TOPページに非表示に設定" data-askconfirmtext="非表示にしますか？" data-yes="非表示にする">非表示にする</a>
                              @endif -->
                              @if($list->role == 'idlehost')
                              <a class="btnlist btn-danger idlehost-btn" href="" data-hostid='{{$list->id}}' role="button" data-askconfirmtitle="{{ __('auth.onconfirmtitle') }}" data-askconfirmtext="{{ __('auth.onconfirmtext') }}" data-yes="{{ __('auth.onconfirmbtn') }}">{{ __('auth.onconfirmbtn') }}</a>
                              @else
                              <a class="btnlist btn-danger idlehost-btn" href="" data-hostid='{{$list->id}}' role="button" data-askconfirmtitle="{{ __('auth.offconfirmtitle') }}" data-askconfirmtext="{{ __('auth.offconfirmtext') }}" data-yes="{{ __('auth.offconfirmbtn') }}">{{ __('auth.offconfirmbtn') }}</a>
                              @endif
                          </td>
                       　　<!--  <td data-label="TOP" style="vertical-align: middle;text-align: center;">
                              <input type="checkbox" class="toppage" style="width: 16px;height: 16px;"> 
                        　　</td> -->

                        </tr>
                        @endforeach
                                                                                                                                                          
                      </tbody>
                  </table>

                  <form method="POST" id="idlehost" action="{{ route('idlehost') }}" >
                    @csrf
                    <input type="hidden" name="hostid" id="hostid" value="">
                  </form>
                  

                  <form method="POST" id="inflhide" action="{{ route('inflhide') }}" >
                    @csrf
                    <input type="hidden" name="hostid" id="hostid" value="">
                  </form>


                  @if(count($lists) < 1)
                  <div style="text-align: center;">
                  登録された求職者がありません。
                  </div>
                  @endif

                </div>


                @include('components.pagination')


                @foreach( $lists as $key => $list )
                <!-- Modal -->
               <div class="modal fade" id="detailModal{{ $list->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="deleteConfirmModalLabel">求職者の詳細</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p><strong>求職者名 : </strong><span>{{ $list->name }}</span></p>
                        @if(!empty($list->profileimg))
                        <p><strong>プロフィール写真 : </strong>
                        <img src="{{ asset('images/avatar/'.$list->profileimg ) }}" style="width: 100%;">
                        </p>
                        @endif
                        <p><strong>{{ __('auth.phone') }} : </strong><span>{{ $list->phone }}</span></p>
                        <p><strong>{{ __('auth.mailaddress') }} : </strong><span>{{ $list->email }}</span></p>
                        <p><strong>{{ __('auth.infcgender0') }} : </strong><span>{{ __(config('global.gender')[$list->gender]) }}</span></p>
                        <p><strong>{{ __('誕生日') }} : </strong><span>{{date('Y/m/d', strtotime($list->dob))}}</span></p>
                        <p><strong>{{ __('希望職種') }} : </strong><span>{{ $list->field }}</span></p>
                        <p><strong>{{ __('居住国名') }} : </strong><span>{{ __(config('global.country')[$list->country]) }}</span></p>
                        <p><strong>{{ __('auth.address') }} : </strong><span>{{ $list->address }}</span></p>

                     @if(!empty($list->resume))
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="resume"><b>{{ __('履歴書') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                                 <iframe src="{{ asset('documents/'.$list->resume) }}" width="100%" height="500px"></iframe>
                           </div>
                        </div>
                     </div>
                     @endif

                     @if(!empty($list->docone))
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="docone"><b>{{ __('職務経歴書') }}</b> <span class="badge badge-secondary">{{ __('auth.optional') }}</span></label>
                                 <iframe src="{{ asset('documents/'.$list->docone) }}" width="100%" height="500px"></iframe>
                           </div>
                        </div>
                     </div>
                     @endif

                     @if(!empty($list->doctwo))
                     <div class="row ">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="doctwo"><b>{{ __('その他の書類') }}</b> <span class="badge badge-secondary">{{ __('auth.optional') }}</span></label>
                                 <iframe src="{{ asset('documents/'.$list->doctwo) }}" width="100%" height="500px"></iframe>
                           </div>
                        </div>
                     </div>
                     @endif

                     @if(!empty($list->companyinfo))
                        <p><strong>{{ __('推薦文') }} : </strong><br><span>{!! $list->companyinfo  !!}</span></p>
                     @endif

                     </div>

                 <!--     <div class="modal-footer">
                        <button type="button" class="btn btn-danger">削除する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div> -->
                  </div>
                  </div>
               </div>

               <div class="modal fade" id="deleteConfirmModal{{ $list->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="deleteConfirmModalLabel">求職者を削除</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>削除しますか。</p>
                     </div>
                     <div class="modal-footer">
                      <form method="POST" action="{{ route('deleteuser') }}" >
                        @csrf
                        <input type="hidden" name="id" value="{{ $list->id }}">
                        <button type="submit" class="btn btn-danger">削除する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                      </form>
                     </div>
                  </div>
                  </div>
               </div>
               @endforeach


            </div>
         </div>
         <!-- <div class="speaker-shap">
            <img class="shap1" src="images/shap/home_schedule_memphis2.png" alt="">
         </div> -->
    </section>

<script type="text/javascript">
       

    $(document).ready(function() {

        $(".inflhide-btn").click(function(e){
            e.preventDefault();
            $('#hostid').val($(this).data('hostid'));  
            askconfirmboxshow($(this),'inflhide'); 
        });

        $(".idlehost-btn").click(function(e){
            e.preventDefault();
            $('#hostid').val($(this).data('hostid'));  
            askconfirmboxshow($(this),'idlehost'); 
        }); 

       
    });



</script>


</x-auth-layout>
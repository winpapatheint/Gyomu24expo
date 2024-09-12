<x-auth-layout>

<link rel="stylesheet" href="{{ asset('css/tableresponsive.css') }}">

<style type="text/css">

.btndiv{
  display: contents;
}
  
a.disabled {
    pointer-events: none;
    color: #ccc;
}
  
.notinumber {
  font-size: .6rem;
  position: absolute;
  top: -6px;
  right: 0px;
  width: 15px;
  height: 15px;
  color: #fff;
  background-color: red;
  border-radius: 50%;
  align-items: center!important;
  justify-content: center!important;
  display: flex!important;
  font-weight: 700;
}

.table th {
    vertical-align: inherit !important;
    border-top: 1px solid #e9ecef;
    color: white;
    background: #304586;
    font-weight: 400;
}

table tr{
   height: 40px;
}

.table td, .table th {
  padding: 0rem; 
  vertical-align: middle;
  padding-left: 0.45rem;
  padding-right: 0.45rem;
}

.item-row {
   margin-bottom: 0.5rem;
}

.item-header-wrapper {
   border-top: 1px solid #e9ecef;
   color: white;
   background: #304586;
   padding: 0.25rem;
}

.item-detail-wrapper {
   background: #f0f3ff;
   padding: 0.45rem; 
}

.btn-controls {
   column-gap: 5px;
   row-gap: 5px;
}


@media 
only screen and (max-width: 430px){

    .btndiv{
        display: block;
    }
}

@media only screen and (max-width: 600px) {
   .btn-controls {
      flex-direction: column;
   }
}

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <!-- Calender styles-->


      @php $subtitle=__('求人管理'); @endphp
      @include('hcompany.subtitle')


      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     {{ __('求人一覧') }}
                  </h2>
               </div><!-- col end-->
            </div>
<!--             <div class="row">
               <div class="col-lg-8 mx-auto">
                  <p class="text-center mb-5" style="font-size: 18px;">
                     <a href="{{ url('/makeapplication' ) }}">
                        <i class="fa fa-plus" aria-hidden="true"></i> {{ __('user.registertask') }}</a>
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
                              <label for="email">{{ __('user.keywordsearch') }}</label>
                              <input class="form-control form-control-email" placeholder="{{ __('auth.tasknameortaskno') }}" name="kword" id="kword"
                                 type="text" value="{{ $_GET['kword'] ?? '' }}">
                           </div>
                        </div>
                     </div>    

                     <div class="row">
                        <div class="col-md-12 mx-auto">
                           <div class="form-group">
                              <label for="email">{{ __('募集職種') }}</label>
                                 <select class="form-control" name="positioncategory" id="positioncategory" style="padding-top: 10px;padding-bottom: 10px;height: 55px;">
                                     <option value="0">選択してください</option>
                                    <optgroup label="営業">
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '法人営業')) selected @endif >法人営業</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '個人営業')) selected @endif >個人営業</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'ルートセールス・代理店営業')) selected @endif >ルートセールス・代理店営業</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '内勤営業・カウンターセールス')) selected @endif >内勤営業・カウンターセールス</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '海外営業')) selected @endif >海外営業</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'カスタマーサポート・コールセンター運営')) selected @endif >カスタマーサポート・コールセンター運営</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'キャリアカウンセラー・人材コーディネーター')) selected @endif >キャリアカウンセラー・人材コーディネーター</option>
                                    </optgroup>
                                    <optgroup label="事務・管理">
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '財務・経理')) selected @endif >財務・経理</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '人事')) selected @endif >人事</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '総務・事務')) selected @endif >総務・事務</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '法務')) selected @endif >法務</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '広報・IR')) selected @endif >広報・IR</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '物流・貿易')) selected @endif >物流・貿易</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '一般事務・営業事務')) selected @endif >一般事務・営業事務</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '秘書')) selected @endif >秘書</option>
                                    </optgroup>
                                    <optgroup label="マーケティング">
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '商品企画・商品開発')) selected @endif >商品企画・商品開発</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'ブランドマネージャー・プロダクトマネージャー')) selected @endif >ブランドマネージャー・プロダクトマネージャー</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '広告・宣伝')) selected @endif >広告・宣伝</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '販売促進・販促企画')) selected @endif >販売促進・販促企画</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '営業企画')) selected @endif >営業企画</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'イベント企画・運営')) selected @endif >イベント企画・運営</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'Web・SNSマーケティング')) selected @endif >Web・SNSマーケティング</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'データアナリスト')) selected @endif >データアナリスト</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '市場調査・分析')) selected @endif >市場調査・分析</option>
                                    </optgroup>
                                    <optgroup label="経営企画・経営戦略">
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '経営企画・事業統括')) selected @endif >経営企画・事業統括</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '管理職・エグゼクティブ')) selected @endif >管理職・エグゼクティブ</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'MD・バイヤー・店舗開発・FCオーナー')) selected @endif >MD・バイヤー・店舗開発・FCオーナー</option>
                                    </optgroup>
                                    <optgroup label="ディレクター">
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'Webディレクター・Webプロデューサー')) selected @endif >Webディレクター・Webプロデューサー</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'テクニカルディレクター・プロジェクトマネージャー')) selected @endif >テクニカルディレクター・プロジェクトマネージャー</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'クリエイティブディレクター')) selected @endif >クリエイティブディレクター</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '制作・進行管理（その他）')) selected @endif >制作・進行管理（その他）</option>
                                    </optgroup>
                                    <optgroup label="クリエイティブ関連">
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'Webデザイナー')) selected @endif >Webデザイナー</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'UI・UXデザイナー')) selected @endif >UI・UXデザイナー</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'ゲームデザイナー・イラストレーター')) selected @endif >ゲームデザイナー・イラストレーター</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'CGデザイナー')) selected @endif >CGデザイナー</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'Web・モバイル・ソーシャル・ゲーム制作／開発')) selected @endif >Web・モバイル・ソーシャル・ゲーム制作／開発</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '編集・ライター')) selected @endif >編集・ライター</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '映像・動画関連')) selected @endif >映像・動画関連</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'ファッション・インテリア・空間・プロダクトデザイン')) selected @endif >ファッション・インテリア・空間・プロダクトデザイン</option>
                                    </optgroup>
                                    <optgroup label="ITエンジニア">
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '業務系アプリケーションエンジニア・プログラマ')) selected @endif >業務系アプリケーションエンジニア・プログラマ</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'Webサービス系エンジニア・プログラマ')) selected @endif >Webサービス系エンジニア・プログラマ</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '制御系ソフトウェア開発（通信・ネットワーク・IoT関連）')) selected @endif >制御系ソフトウェア開発（通信・ネットワーク・IoT関連）</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'インフラエンジニア')) selected @endif >インフラエンジニア</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'IT・システムコンサルタント')) selected @endif >IT・システムコンサルタント</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '社内情報システム（社内SE）')) selected @endif >社内情報システム（社内SE）</option>
                                    </optgroup>
                                    <optgroup label="エンジニア（機械・電気・電子・半導体・制御）">
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '機械・機構設計・金型設計')) selected @endif >機械・機構設計・金型設計</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '回路・システム設計')) selected @endif >回路・システム設計</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'サービスエンジニア・サポートエンジニアー')) selected @endif >サービスエンジニア・サポートエンジニアー</option>
                                    </optgroup>
                                    <optgroup label="素材・化学・食品・医薬品技術職">
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '素材・半導体素材・化成品関連')) selected @endif >素材・半導体素材・化成品関連</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '化粧品・食品・香料関連')) selected @endif >化粧品・食品・香料関連</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '医薬品関連')) selected @endif >医薬品関連</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '医療用具関連')) selected @endif >医療用具関連</option>
                                    </optgroup>
                                    <optgroup label="建築・土木技術">
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '研究開発・技術開発・構造解析・特許')) selected @endif >研究開発・技術開発・構造解析・特許</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '施工管理・設備・環境保全')) selected @endif >施工管理・設備・環境保全</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'プランニング・測量・設計・積算')) selected @endif >プランニング・測量・設計・積算</option>      
                                    </optgroup>
                                    <optgroup label="技能工・設備・交通・運輸">
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '技能工（整備・工場生産・製造・工事）')) selected @endif >技能工（整備・工場生産・製造・工事）</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '生産・品質管理')) selected @endif >生産・品質管理</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '運輸・配送・倉庫関連')) selected @endif >運輸・配送・倉庫関連</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '交通（鉄道・バス・タクシー）関連')) selected @endif >交通（鉄道・バス・タクシー）関連</option>
                                    </optgroup>
                                    <optgroup label="サービス 接客 店舗">
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '店長・SV（スーパーバイザー）')) selected @endif >店長・SV（スーパーバイザー）</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'ホールスタッフ')) selected @endif >ホールスタッフ</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '料理長')) selected @endif >料理長</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '調理')) selected @endif >調理</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '警備・施設管理関連職')) selected @endif >警備・施設管理関連職</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '販売・サービススタッフ')) selected @endif >販売・サービススタッフ</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '宿泊施設・ホテル')) selected @endif >宿泊施設・ホテル</option>
                                    </optgroup>
                                    <optgroup label="専門職（コンサルタント 士業 金融 不動産）">
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'ビジネスコンサルタント・シンクタンク')) selected @endif >ビジネスコンサルタント・シンクタンク</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '士業・専門コンサルタント')) selected @endif >士業・専門コンサルタント</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '金融系専門職')) selected @endif >金融系専門職</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '金融系専門職')) selected @endif >金融系専門職</option>
                                    </optgroup>
                                    <optgroup label="医療・福祉・介護">
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '医療・看護')) selected @endif >医療・看護</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '薬事')) selected @endif >薬事</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '臨床開発')) selected @endif >臨床開発</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '福祉・介護')) selected @endif >福祉・介護</option>
                                    </optgroup>
                                    <optgroup label="教育・保育関連">
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == '教育・保育')) selected @endif >教育・保育</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'インストラクター・通訳・翻訳')) selected @endif >インストラクター・通訳・翻訳</option>
                                       <option @if((isset($_GET['positioncategory'])) AND ($_GET['positioncategory'] == 'その他')) selected @endif >その他</option>
                                    </optgroup>
                                 </select>
                           </div>
                        </div>
                     </div>

                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="start">求人開始日</label>
                              <input class="form-control form-control-password" placeholder="開始日時" name="start" id="start"
                                 type="date"  value="{{ $_GET['start'] ?? ''}}">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="end">求人終了日</label>
                              <input class="form-control form-control-password" placeholder="終了日時" name="end" id="end"
                                 type="date" value="{{ $_GET['end'] ?? ''}}">
                           </div>
                        </div>
                     </div> 

                     <div class="row ">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="status_select">求人ステータス</label>
                              <select class="form-control" name="status" id="status" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                  <option @if((isset($_GET['status'])) AND ($_GET['status'] == '0')) selected @endif value="0">選択してください</option>
                                  <option @if((isset($_GET['status'])) AND ($_GET['status'] == '1')) selected @endif value="1">下書き 1</option>
                                  <option @if((isset($_GET['status'])) AND ($_GET['status'] == '2')) selected @endif value="2">公開依頼中 2</option>
                                  <option @if((isset($_GET['status'])) AND ($_GET['status'] == '3,4,10,12')) selected @endif value="3,4,10,12">公開中 3,4,10,12</option>
                                  <option @if((isset($_GET['status'])) AND ($_GET['status'] == '13')) selected @endif value="13">募集停止中 13</option>
                              </select>
                              <p style="display:none" class="status error text-danger"></p>   
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="end">選考フロー</label>
                              <select class="form-control" name="inflstatus" id="inflstatus" 
                                    style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                  <option value="">選択してください</option>
                                  <option @if((isset($_GET['inflstatus'])) AND ($_GET['inflstatus'] == '0')) selected @endif value="0">引き合い 0</option>
                                  <option @if((isset($_GET['inflstatus'])) AND ($_GET['inflstatus'] == '4')) selected @endif value="4">書類選考 4</option>
                                  <option @if((isset($_GET['inflstatus'])) AND ($_GET['inflstatus'] == '5')) selected @endif value="5">一次面接 5</option>
                                  <option @if((isset($_GET['inflstatus'])) AND ($_GET['inflstatus'] == '6')) selected @endif value="6">二次面接 6</option>
                                  <option @if((isset($_GET['inflstatus'])) AND ($_GET['inflstatus'] == '7')) selected @endif value="7">最終面接 7</option>
                                  <option @if((isset($_GET['inflstatus'])) AND ($_GET['inflstatus'] == '8')) selected @endif value="8">内定 8</option>
                                  <option @if((isset($_GET['inflstatus'])) AND ($_GET['inflstatus'] == '9')) selected @endif value="9">入社 9</option>
                              </select>
                              <p style="display:none" class="inflstatus error text-danger"></p>
                           </div>
                        </div>
                     </div>

                  @if ($message = Session::get('errorsearch'))
                  <div class="alert alert-danger alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button>    
                      <strong>{{ $message }}</strong>
                  </div>
                  @endif
                                                             
                     <div class="text-center">
                        <button class="btn" type="submit"><i class="fa fa-search"></i>
                           {{ __('user.dosearch') }}</button>
                     </div>
                  </form>
               </div>
            </div>

            @include('components.messagebox')
            
            <!-- Seminar list-->
            <div class="row clearfix">
               <div class="table-responsive">

                  <form id="assignrespon" method="POST" action="{{ route('assignrespon') }}">
                  @csrf
                  <input type="hidden" name="assignid" id="assignid">
                  <input type="hidden" name="respon" id="respon">
                  </form>

                    @foreach( $lists as $key => $list )

                    @php

                      if( ($list->status == '10') AND ($list->inflstatus == '9') ){
                        $list->status = '13';
                      }elseif( ($list->status == '10') AND ($list->inflstatus == '5') ){
                        $list->status = '12';
                      }

                    @endphp

                    <table class="table">
                      <thead>
                        <tr>
                          @php
                            if( $list->status == '3' AND !empty($list->paypal)){
                                $list->status == '4';
                            }
                          @endphp
                          <th colspan="3">{{ $list->positionname }}　　　<a class="btnlist disabled" role="button">{{ __(Config::get('global.taskstatus.' . $list->status)) }} {{-- $list->status --}}</a>
<!--                           <th style="width: 140px;"></th>
                          <th></th> -->
                           <th colspan="2" style="width: 162px; text-align: right;">
                              <div class="btndiv">
                              <!-- <span data-toggle="modal" data-target="#showdetailmodal{{$key}}" style="cursor: pointer;">選考中（4人）</span> -->
                              </div>
                          </th>
                        </tr>
                      </thead>
                      <tbody>

                        <tr style="background: #f0f3ff;"> 
                          <td colspan="3"> <i class="fa fa-caret-right" aria-hidden="true"></i> 求人番号： {{ sprintf('%06d', $list->id) }}　<i class="fa fa-caret-right" aria-hidden="true"></i> 求人日： {{ date('Y/m/d', strtotime($list->created_at)) }}　<i class="fa fa-caret-right" aria-hidden="true"></i> 求人終了日： {{ date('Y/m/d', strtotime($list->expireddate)) }}</td>
                          <td colspan="2" style="text-align:end;">
                           <a class="btnlist btn-success" data-toggle="modal" data-target="#showdetailmodal{{$key}}" style="cursor: pointer;" href="" role="button">求人詳細</a>
                            @if(in_array($list->inflstatus, array("5", "6", "7", "8")))
                            @if($list->applycond != "4")
                            <a class="btnlist btn-danger assignrespon-btn" href="" data-respon="4" data-assignid="{{ $list->id }}" role="button" data-askconfirmtitle="辞退確認" data-askconfirmtext="辞退しますか？" data-yes="辞退する">辞退</a>
                            @endif
                            @endif
                            <!-- <a class="btnlist btn-success" href="" role="button">求人詳細</a> -->
                          </td>    
                        </tr> 

                        <tr style="background: #f0f3ff;"> 
                          <td colspan="3"> <i class="fa fa-caret-right" aria-hidden="true"></i> コンシェルジュ(担当者）： {{ $list->subadminname ?? '' }}</td>
                          <td colspan="2" style="text-align:end;">
                            <a class="btnlist btn-success getmsgnoti" data-msgroom="{{ 'B'.$list->id.'/'.$list->hashid }}" href="{{ url('/message/B'.$list->id.'/'.$list->hashid ) }}" role="button">チャット</a>
                            <sup style="display: none;" id="{{ 'B'.$list->id.'/'.$list->hashid }}"><span id="{{ 'B'.$list->id.'/'.$list->hashid }}" class="notinumber"></span></sup> 
                          </td>    
                        </tr> 

                        <tr style="background: #f0f3ff;"> 
                          <td colspan="7" style="text-align:center;"> 選考フロー： <span @if($list->inflstatus == "") class="text-danger font-weight-bold" @endif>①引き合い</span>　<i class="fa fa-caret-right" aria-hidden="true"></i>　
                                                                                <span @if($list->inflstatus == "4") class="text-danger font-weight-bold" @endif>②書類選考</span>　<i class="fa fa-caret-right" aria-hidden="true"></i>　
                                                                                <span @if($list->inflstatus == "5") class="text-danger font-weight-bold" @endif>③一次面接</span>　<i class="fa fa-caret-right" aria-hidden="true"></i>　
                                                                                <span @if($list->inflstatus == "6") class="text-danger font-weight-bold" @endif>④二次面接</span>　<i class="fa fa-caret-right" aria-hidden="true"></i>　
                                                                                <span @if($list->inflstatus == "7") class="text-danger font-weight-bold" @endif>⑤最終面接</span>　<i class="fa fa-caret-right" aria-hidden="true"></i>　
                                                                                <span @if($list->inflstatus == "8") class="text-danger font-weight-bold" @endif>⑥内定</span>　<i class="fa fa-caret-right" aria-hidden="true"></i>　
                                                                                <span @if($list->inflstatus == "9") class="text-danger font-weight-bold" @endif>⑦入社</span>　
                          </td>   
                        </tr> 



                        @if(!empty($list->Influencername))
                        <tr style="background: #f0f3ff;">
                          <td><i class="fa fa-caret-down" aria-hidden="true"></i> 求職者 </td>  
                          <!-- <td><i class="fa fa-caret-down" aria-hidden="true"></i> エージェント会社 </td> -->
                          <td><i class="fa fa-caret-down" aria-hidden="true"></i> 当社報酬 </td>
                          <!-- <td><i class="fa fa-caret-down" aria-hidden="true"></i> エージェント報酬 </td> -->
                          <td><i class="fa fa-caret-down" aria-hidden="true"></i> 選考フロー </td>   
                          <td><i class="fa fa-caret-down" aria-hidden="true"></i> 状態 </td>   
                          <td >
                          
                          </td>    
                        </tr> 
                        <tr style="background: #f0f3ff;"> 
                          <td> <i class="fa fa-caret-right" aria-hidden="true"></i>
                              <a href="#" role="button" data-toggle="modal" data-target="#detailModal{{ $list->Influencerid }}" class="ts-image-popup">
                                   {{ $list->Influencername }} {{ $list->id }}
                              </a>
                          </td>
                          <!-- <td> {{'$list->Hcompanyname'}}</td> -->
                          <!-- <td> @if(!empty($list->moneyout)) <i class="fa fa-info-circle"></i>@endif</td> -->
                          <td> @if(!empty($list->moneyout)) <!-- <i class="fa fa-info-circle"></i> -->  {{ number_format($list->moneyout) }} 円@endif</td>
                          <td> {{ __(config('global.inflstatus')[$list->inflstatus]) }}</td>
                          <td> {{ __(config('global.applycond')[$list->applycond]) }} {{-- $list->applycond --}}</td>
                          <td style="text-align:end;">
                            <a class="btnlist btn-success getmsgnoti" data-msgroom="{{ 'C'.$list->id.'/'.$list->hashid }}" href="{{ url('/message/C'.$list->id.'/'.$list->hashid ) }}" role="button">チャット</a>
                            <sup style="display: none;" id="{{ 'C'.$list->id.'/'.$list->hashid }}"><span id="{{ 'C'.$list->id.'/'.$list->hashid }}" class="notinumber"></span></sup> 
                              @if(( $list->applycond != '1') AND (empty($list->inflstatus )))
                              <a class="btnlist btn-success assignrespon-btn" href="" data-respon="1" data-assignid="{{ $list->id }}" role="button" data-askconfirmtitle="{{ __('auth.accepttitle') }}" data-askconfirmtext="{{ __('auth.accepttext') }}" data-yes="{{ __('auth.acceptbtn') }}">{{ __('auth.acceptbtn') }}</a>
                              @endif 
                              @if(( $list->applycond != '4') AND (empty($list->inflstatus )))
                              <a class="btnlist btn-success assignrespon-btn" href="" data-respon="4" data-assignid="{{ $list->id }}" role="button" data-askconfirmtitle="{{ __('auth.rejecttitle') }}" data-askconfirmtext="{{ __('auth.rejecttext') }}" data-yes="{{ __('auth.rejectbtn') }}">{{ __('auth.rejectbtn') }}</a> 
                              @endif
                              @if(( $list->inflstatus >= 8) AND (!empty($list->reportupdated_at )))
                              <a class="btnlist btn-success" href="{{ url('/report/'.$list->id.'/'.$list->hashid ) }}" role="button">{{ __('user.makereport') }}</a>
                              @endif

                          </td>    
                        </tr>
                        @endif

                                                                   
                      </tbody>
                    </table>

                    @endforeach


                 @if(count($lists) < 1)
                  <div style="text-align: center;">
                  登録されたリストがありません。
                  </div>
                  @endif
                </div>

                @include('components.pagination')

                @include('components.orderdetail')

                @include('components.influencerdetail')

            </div>
         </div>
         <!-- <div class="speaker-shap">
            <img class="shap1" src="images/shap/home_schedule_memphis2.png" alt="">
         </div> -->
    </section>


<script type="text/javascript">
       

    $(document).ready(function() {

        $(".assignrespon-btn").click(function(e){
            e.preventDefault();
            $('#assignid').val($(this).data('assignid')); 
            $('#respon').val($(this).data('respon')); 
            askconfirmboxshow($(this),'assignrespon');      
        }); 
       
    });

    elements = $("a.getmsgnoti");
    
    var arr = new Array();

    elements.each(function()
    {
        arr.push($(this).data('msgroom'));
    });

    var _token = $("input[name='_token']").val();

    $.ajax({
        url: "{{ route('getmsgnoti') }}",
        type:'POST',
        data: {_token:_token, 
               arr:arr,
               },

        success: function(data) {
            if($.isEmptyObject(data.error)){

              // console.log(data.success);
              // alert(jQuery.type(data.success));
              $.each(data.success, function(key, value) {

                  var formattedkey = key.replace("/", "\\/"); // jquery need some formatted slash

                  $('span#'+formattedkey).text(value);
                  $('sup#'+formattedkey).fadeIn( "slow" );
                  // console.log(formattedkey + ' ' + value);
               
              })



            }else{
                console.log(data.error);
                alert("システムエラー");

            }
        },
        fail: function(data) {
            alert("システムエラー");
        }
    });

</script>


</x-auth-layout>
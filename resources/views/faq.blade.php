    <x-guest-layout>

      @php $subtitle=__('headfoot.ttlefaq'); @endphp
      @include('components.subtitle')

  
      <section class="ts-faq-sec">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <div class="faq-content mb-70">
                     <h2 class="column-title">
                        {{ __('headfoot.ttlefaq') }}
                     </h2>
                     <div class="panel-group faq-item" id="accordion" role="tablist" aria-multiselectable="true">

                        <div class="panel faq-list panel-default">
                           <div class="panel-heading" role="tab" id="headingOne">
                              <h4 class="panel-title">
                                 <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    {{ __('1. どのようなエージェントが利用していますか？') }} 
                                 </a>
                              </h4>
                           </div>
                           <div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
                              <div class="panel-body">
                                  {{ __('ご利用頂いているエージェント人数5名以下の創業直後のエージェントの方となっております。また、「新たに領域を拡大したい」「多様化する候補者のニーズに対応していきたい」といったエージェントの方々にもお使いいただいております。') }} 
                              </div>
                           </div>
                        </div>

@php

$q[2] = '求人のご依頼は無料ですか？';

$a[2] = 'はい、求人のご依頼は完全無料で、採用時の成功報酬のみでご利用いただけます';

$q[3] = '採用単価を教えてください。';

$a[3] = '自由設定されております。';

$q[4] = '求人依頼後は、面談日程から選考はどのように管理していますか？';

$a[4] = '全て採用企業のマイページで、オンラインで完結しております。<br>
従来のようにメールや電話で連絡を取ることなく、面談の日程調整や選考の管理まで全てマイページから管理できます。';
$q[5] = '求人掲載数に制限はありますか？';

$a[5] = '制限はございません。何求人でも無料で掲載することが可能です。';

$q[6] = 'グローバル人材バンクは人材の紹介をしてくれますか？';

$a[6] = 'グローバル人材バンクは、人材を紹介することはありません。グローバル人材バンクは採用プラットフォームであり、エージェントが紹介する人材に採用企業が直接アプローチできるサービスです。';
$q[7] = '個人情報の取り扱いはどのようになっていますか？';
$a[7] = '求職者・求人をご依頼いただく企業様の個人情報を厳密に管理しています。';
$q[8] = '初回の打ち合わせ内容について教えてください。';
$a[8] = 'ご依頼いただいた求人の業務内容や募集背景、イメージしている人物像、その他貴社の事業戦略や組織課題などをヒアリングさせていただきます。';
$q[9] = '求人依頼をしてからの流れを教えてください。';
$a[9] = 'ヒアリング後、担当コンサルタントが自らサーチを行います。ご依頼内容にマッチする人材の応募意思を確認し、候補者の書類をお送りいたします。書類選考後、面接日の調整、面接を実施いただきます。採用決定いただけましたら、別途ご契約お手続きを進めさせていただきます。';

$q[10] = '採用募集活動を行うのに有利な時期はありますか？';
$a[10] = '6月、10月、2月が求職者が増える傾向にあるため、その時期にあわせて、採用活動のご相談からお気軽にお問い合わせください。';
$q[11] = '依頼した募集内容を変更したいのですが、可能でしょうか？';
$a[11] = '可能です。担当コンサルタント宛にご連絡ください。その際、必要な要件について改めてお伺いさせていただきます。';
$q[12] = '採用決定した方が現職中の場合、入社日の決定はどのように進めれば良いでしょうか？';
$a[12] = '入社日の決定については貴社・採用決定した方の双方と担当コンサルタントが調整させていただきますので、ご安心ください。また、候補者に対して事前に入社可能時期を確認した上で、ご紹介をさせていただいています。';
$q[13] = '候補者に内定を出したい場合はどうすれば良いですか？';
$a[13] = '担当コンサルタントへご連絡ください。候補者へ内定通知するとともに、各種採用条件を明示の上、入社意思を確認いたします。';


$q[14] = 'すぐにでも新しい職場で働きたいですが、どれぐらいで見つかりますか？';
$a[14] = '人によってさまざまですが、最初の面談から１ヶ月～３ヶ月ほどで、ご入社される方が多いです。';
$q[15] = '登録を考えていますが、今の職場が忙しくて、コーディネーターとの面談にいく時間がとれません。';
$a[15] = '電話やスカイプでの面談も可能です。ご希望があれば、在職中の職場近くのカフェなどへも出張可能です。';
$q[16] = '内定をいただいた後に、辞退することはできますか？';
$a[16] = '可能です。転職前に不安が感じ始めることもあるかもしれません。納得の上で、転職をしていただきたいと思いますので、まずはお考えになっていることをお伝えください。内定先への辞退の連絡は、専任のコーディネーターが行います。';
$q[17] = '未経験でも応募は可能ですか？';
$a[17] = '応募可能です。<br>
ご自分の夢と情熱を持った方には是非ご応募いただき、サポートさせていただきたいと考えております。<br>
※経験必須の求人につきましてはご了承ください。';

$q[18] = 'エージェント会社登録をしたいですが、どうすればいいですか？';
$a[18] = 'まず、お問い合わせフォームから、お問い合わせください。電話やメールでの面談後、会員ページIDとパスワードを発行させていただきます。';




@endphp
                        @for ($i = 2; $i < 19; $i++)

                        <div class="panel faq-list panel-default">
                           <div class="panel-heading" role="tab" id="heading{{$i}}">
                              <h4 class="panel-title">
                                 <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$i}}" aria-expanded="false" aria-controls="collapse{{$i}}" @if($i == '15') style="padding-right:43px; line-height: unset;" @endif>
                                    {{ $i }}. {{ $q[$i] }}
                                 </a>
                              </h4>
                           </div>
                           <div id="collapse{{$i}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$i}}">
                              <div class="panel-body">
                                    {!! $a[$i] !!}
                              </div>
                           </div>
                        </div>


                        @endfor

                     </div><!-- panel-group -->

                  </div>


               </div><!-- col end -->
               <div class="col-lg-4">
                  <div class="sidebar-widgets">
                     @php $error = $errors->toArray(); @endphp
                     @if ($message = Session::get('success'))
                     <div class="alert alert-success alert-block" id="alert-success">
                         <button type="button" class="close" data-dismiss="alert">×</button>    
                         <strong>{{ $message }}</strong>
                     </div>
                     @endif
                     <div class="widget asq-form">
                        <form id="contact-form" class="ts-form" method="POST" action="{{ route('contact') }}">
                           @csrf
                           <input type="hidden" name="from" value="faq">
                           <input type="text" class="form-control" name="name" placeholder="{{ __('contact.name') }} " id="ts_contact_name" value="{{ old('name') }}">
                           @if (!empty($error['name']))
                                 @foreach ($error['name'] as  $key => $value)
                                     <p class="error text-danger">{{ $value }}</p>
                                 @endforeach
                           @endif
                           <input type="text" class="form-control" name="email" placeholder="{{ __('auth.mailaddress') }}" id="ts_contact_email" value="{{ old('email') }}">
                           @if (!empty($error['email']))
                                 @foreach ($error['email'] as  $key => $value)
                                     <p class="error text-danger">{{ $value }}</p>
                                 @endforeach
                           @endif
                           <textarea name="message" placeholder="{{ __('faq.fillthemessage') }}" id="x_contact_massage" class="form-control message-box"
                              cols="30" rows="10">{{ old('message') }}</textarea>
                           @if (!empty($error['message']))
                                 @foreach ($error['message'] as  $key => $value)
                                     <p class="error text-danger">{{ $value }}</p>
                                 @endforeach
                           @endif
                           <div class="ts-btn-wraper">
                              <input type="submit" class="btn" id="ts_contact_submit" value="{{ __('contact.dosend') }}">
                           </div>
                        </form>
                     </div>

                     <div class="widget social-box">
                        <h4 class="widget-title">Our services</h4>
                        <ul>
                           <li class="ts-facebook">
                              <a href="#"><i class="fa fa-facebook"></i> </a>
                           </li>
                           <li class="ts-twitter">
                              <a href="#"><i class="fa fa-twitter"></i></a>
                           </li>
                           <li class="ts-google-plus">
                              <a href="#"><i class="fa fa-google-plus"></i></a>
                           </li>
                           <li class="ts-linkedin">
                              <a href="#"><i class="fa fa-linkedin"></i></a>
                           </li>
                           <li class="ts-instagram">
                              <a href="#"><i class="fa fa-instagram"></i></a>
                           </li>
                           <li class="ts-youtube">
                              <a href="#"><i class="fa fa-youtube"></i></a>
                           </li>

                        </ul>
                     </div><!-- .widget end -->


                  </div>
               </div><!-- col end-->

            </div><!-- row end-->
         </div><!-- .container end -->
      </section><!-- End faq section -->

    </x-guest-layout>
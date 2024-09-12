    <x-guest-layout>

      @php $subtitle="主催会社"; @endphp
      @include('components.subtitle')

    
    <section id="ts-sponsors" class="ts-sponsors">
      <div class="container">
        <div class="row text-center">
          <div class="col-lg-12 mx-auto">
            <h2 class="section-title text-center">
              <!-- <span>Who Healps us</span> -->
              主催会社
            </h2>
          </div>
        </div>


        @if( count($bunrui1) + count($bunrui2) + count($bunrui3) + count($bunrui4) == 0 )
        <div style="text-align: center;">
              <p>登録された主催会社がありません</p>
        </div>
        @endif

        <!--/ Title row end -->
        @if(count($bunrui1) > 0)
        <div class="sponsors-wrap">
          <h3 class="sponsor-title text-center">教育支援</h3>
          <div class="row sponsor-padding text-center">


            @foreach( $bunrui1 as $key => $list )
            <div class="col-lg-3">
              <a href="#" class="sponsors-logo">
                <img class="img-fluid" src="{{ asset('images/avatar/'.$list->profileimg ) }}" alt="" />
              </a>
            </div>
            @endforeach
          </div>
        </div>
        @endif
        <!--/ Content row 1 end -->
        @if(count($bunrui2) > 0)
        <div class="sponsors-wrap">
          <h3 class="sponsor-title text-center">芸術・デザイン</h3>
          <div class="row sponsor-padding text-center">
            @foreach( $bunrui2 as $key => $list )
            <div class="col-lg-3">
              <a href="#" class="sponsors-logo">
                <img class="img-fluid" src="{{ asset('images/avatar/'.$list->profileimg ) }}" alt="" />
              </a>
            </div>
            @endforeach
          </div>
        </div>
        @endif
        <!--/ Content row 2 end -->
        @if(count($bunrui3) > 0)
        <div class="sponsors-wrap">
          <h3 class="sponsor-title text-center">サービス</h3>
          <div class="row sponsor-padding text-center">
          @foreach( $bunrui3 as $key => $list )
          <div class="col-lg-3">
            <a href="#" class="sponsors-logo">
              <img class="img-fluid" src="{{ asset('images/avatar/'.$list->profileimg ) }}" alt="" />
            </a>
          </div>
          @endforeach
          </div>
        </div>
        @endif
          <!--/ Content row 3 end -->
        @if(count($bunrui4) > 0)
        <div class="sponsors-wrap">
          <h3 class="sponsor-title text-center">製造</h3>
          <div class="row sponsor-padding text-center">
          @foreach( $bunrui4 as $key => $list )
          <div class="col-lg-3">
            <a href="#" class="sponsors-logo">
              <img class="img-fluid" src="{{ asset('images/avatar/'.$list->profileimg ) }}" alt="" />
            </a>
          </div>
          @endforeach
          </div>
        </div>
        @endif
          <!--/ Content row 3 end -->

       <!--  <div class="row">
          <div class="col-lg-12 mx-auto">
            <div class="general-btn text-center">
	            <a class="btn" href="#">Become A Sponsor</a>
	        </div>
          </div>
        </div> -->
        <!--/ Content row 3 end -->
      </div>
      <!--/ Container end -->
    </section>
    <!-- Sponsors end -->

    <!-- ts footer area start-->
    <div class="footer-area">


    </x-guest-layout>
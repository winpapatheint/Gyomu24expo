<x-auth-layout>


      @php $subtitle="決済履歴"; @endphp
      @include('hcompany.subtitle')


      <section class="ts-contact-form">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <h2 class="section-title text-center mb-5">
                     決済履歴一覧
                  </h2>
               </div><!-- col end-->
            </div>

            <!-- Participant list-->
            <div class="row">
  <!--              <div class="col-lg-8 mx-auto">
                  <h3 class="text-center mb-5">
                     参加者一覧
                  </h3>
               </div> -->
               <div class="table-responsive">
                  <table class="table">
                     <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">決済日時</th>
                          <th scope="col">決済者</th>
                          <th scope="col">セミナー名</th>
                          <th scope="col">価額(税込)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">30</th>
                          <td>2021/12/12 08:00</td>
                          <td>00999</td>
                          <td>SANKSYASYA02</td>
                          <td>SEMINAR 123</td>
                          <td>￥2,000</td>
                        </tr>
                        <tr>
                          <th scope="row">29</th>
                          <td>2021/12/12 08:00</td>
                          <td>00999</td>
                          <td>SANKSYASYA02</td>
                          <td>SEMINAR 123</td>
                          <td>￥2,000</td>
                        </tr>
                        <tr>
                          <th scope="row">28</th>
                          <td>2021/12/12 08:00</td>
                          <td>00999</td>
                          <td>SANKSYASYA02</td>
                          <td>SEMINAR 123</td>
                          <td>￥2,000</td>
                        </tr>
                        <tr>
                           <th scope="row">27</th>
                           <td>2021/12/12 08:00</td>
                           <td>00999</td>
                           <td>SANKSYASYA02</td>
                           <td>SEMINAR 123</td>
                           <td>￥2,000</td>
                         </tr>
                         <tr>
                           <th scope="row">26</th>
                           <td>2021/12/12 08:00</td>
                           <td>00999</td>
                           <td>SANKSYASYA02</td>
                           <td>SEMINAR 123</td>
                           <td>￥2,000</td>
                         </tr>          
                         <tr>
                           <th scope="row">25</th>
                           <td>2021/12/12 08:00</td>
                           <td>00999</td>
                           <td>SANKSYASYA02</td>
                           <td>SEMINAR 123</td>
                           <td>￥2,000</td>
                         </tr>    
                         <tr>
                           <th scope="row">24</th>
                           <td>2021/12/12 08:00</td>
                           <td>00999</td>
                           <td>SANKSYASYA02</td>
                           <td>SEMINAR 123</td>
                           <td>￥2,000</td>
                         </tr> 
                         <tr>
                           <th scope="row">23</th>
                           <td>2021/12/12 08:00</td>
                           <td>00999</td>
                           <td>SANKSYASYA02</td>
                           <td>SEMINAR 123</td>
                           <td>￥2,000</td>
                         </tr>    
                         <tr>
                           <th scope="row">22</th>
                           <td>2021/12/12 08:00</td>
                           <td>00999</td>
                           <td>SANKSYASYA02</td>
                           <td>SEMINAR 123</td>
                           <td>￥2,000</td>
                         </tr>        
                         <tr>
                           <th scope="row">21</th>
                           <td>2021/12/12 08:00</td>
                           <td>00999</td>
                           <td>SANKSYASYA02</td>
                           <td>SEMINAR 123</td>
                           <td>￥2,000</td>
                         </tr>                                                                                                                                  
                      </tbody>
                  </table>
                </div>

                <!-- Pagination -->
                <div class="col-lg-8 col-md-8 col-sm-12 mx-auto">
                  <div class="pages mt-60">
                     <nav aria-label="Page navigation ">
                        <ul class="pagination mx-auto">
                           <li class="page-item active"><a class="page-link" href="#">1</a></li>
                           <li class="page-item"><a class="page-link" href="#">2</a></li>
                           <li class="page-item"><a class="page-link" href="#">3</a></li>
                           <li class="page-item"><a class="page-link" href="#"><i class="fa fa-long-arrow-right"></i></a></li>
                        </ul>
                     </nav>
                  </div>
                </div>

                <!-- Modal -->
               <!-- <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="deleteConfirmModalLabel">セミナーの削除</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <p>選択したセミナーを削除してはよろしいですか。</p>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-danger">削除する</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                     </div>
                  </div>
                  </div>
               </div> -->
            </div>
         </div>
         <!-- <div class="speaker-shap">
            <img class="shap1" src="images/shap/home_schedule_memphis2.png" alt="">
         </div> -->
    </section>


</x-auth-layout>
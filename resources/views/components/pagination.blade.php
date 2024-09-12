                @if ($ttlpage > 0)
                <!-- Pagination -->
                <div class="col-lg-8 col-md-8 col-sm-12 mx-auto">
                  <div class="pages mt-60">
                     <nav aria-label="Page navigation ">
                        <ul class="pagination mx-auto">

                            @php if(empty($_GET['page']))$_GET['page']=1; $set=ceil($_GET['page']/5);@endphp
                            @php $ppage=($_GET['page']-1); $npage=($_GET['page']+1);@endphp

                            <li @if($_GET['page'] < 2) style="display: none" @endif class="page-item"><a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $ppage]) }}"><i class="fa fa-long-arrow-left"></i></a></li>
                            

                            @php $m = 5; if($ttlpage<5)$m=$ttlpage; @endphp
                            
                            @php $k=5*($set-1); @endphp
                            @for ($i = ($k)+1; $i <= (($k)+5); $i++)
                                @if($i<=$ttlpage)
                                    @if($i < (($k)+5))
                                    <li class="page-item @if($_GET['page'] == $i) active @endif"><a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{$i}}</a></li>
                                    @endif
                                @endif
                            @endfor
                            
                            <li @if($_GET['page'] == $ttlpage) style="display: none" @endif class="page-item"><a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $npage]) }}"><i class="fa fa-long-arrow-right"></i></a></li>

                        </ul>
                     </nav>
                  </div>
                </div>
                @endif
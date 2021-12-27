
  <!-- Newsletter -->
  <div class="newsletter">
    <div class="container">
       <div class="row">
          <div class="col-md-4">
             <div class="newsletter_title text-left">We accept</div>
             <ul class="we-accept-img">
                <li>
                   <a href="#"><img class="img-fluid" src="{{asset('store/images/payment.png')}}" alt="payments"></a>
                </li>
             </ul>
          </div>
          <div class=" col-md-4">

          </div>
          <div class="col-md-4">
             <div class="newsletter_title text-left">Subscribe for Latest Update</div>
             <div class="newsletter_content clearfix">
                <form action="#" class="newsletter_form">
                   <input type="email" class="newsletter_input" required placeholder="Enter your email address">
                   <button class="newsletter_button">Subscribe</button>
                </form>
             </div>
          </div>
       </div>
    </div>
 </div>
 <!-- Footer -->
 <div class="characteristics">
    <div class="container">
       <div class="row">
          <!-- Char. Item -->
          <div class="col-lg-3 col-md-6 col-sm-6 char_col">
             <div class="char_item d-flex flex-row align-items-center justify-content-start">
                <div class="char_icon"><i class="fas fa-check-circle"></i></div>
                <div class="char_content">
                   <div class="char_title">100% Authorised
                      <br> product
                   </div>
                </div>
             </div>
          </div>
          <!-- Char. Item -->
          <div class="col-lg-3 col-md-6 col-sm-6 char_col">
             <div class="char_item d-flex flex-row align-items-center justify-content-start">
                <div class="char_icon"><i class="fas fa-truck"></i></div>
                <div class="char_content">
                   <div class="char_title">15 Days Return </div>
                </div>
             </div>
          </div>
          <!-- Char. Item -->
          <div class="col-lg-3 col-md-6 col-sm-6 char_col">
             <div class="char_item d-flex flex-row align-items-center justify-content-start">
                <div class="char_icon"><i class="fas fa-headphones"></i></div>
                <div class="char_content">
                   <div class="char_title"> Quick support </div>
                </div>
             </div>
          </div>
          <!-- Char. Item -->
          <div class="col-lg-3 col-md-6 col-sm-6 char_col">
             <div class="char_item d-flex flex-row align-items-center justify-content-start">
                <div class="char_icon"><i class="fas fa-handshake"></i></div>
                <div class="char_content">
                   <div class="char_title">Free Delivery</div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
 <section class="footer-top">
    <div class="container">
       <div class="row">
          <div class=" col-md-4 col-sm-4">
             <div class="footer_column">
                <div class="footer_title">Secure Pay</div>
                <ul class="Secure-pay">
                   <li>
                      <a href="#"><img class="img-responsive" src="{{asset('store/images/SSL_Secure.png')}}" alt="payments"></a>
                   </li>
                   <li>
                      <a href="#"><img class="img-responsive" src="{{asset('store/images/ssl-secure-shopping.png')}}" width="80px" alt="payments"></a>
                   </li>
                </ul>
             </div>
          </div>
          <?php $store = \App\Models\Setting::first(); ?>
          <div class="col-md-4 col-sm-4">
             <div class="footer_column footer-contact">
                <div class="footer_title">Any questions</div>
                <div class="media">
                   <div class="icon-support">
                      <i class="fa fa-phone" aria-hidden="true"></i>
                   </div>
                   <div class="support-text">
                      {{$store->phone}}
                   </div>
                </div>
                <div class="media">
                   <div class="icon-support"><i class="fas fa-envelope"></i></div>
                   <div class="support-text">
                      {{$store->contact_us_email}}
                   </div>
                </div>
             </div>
          </div>
          <div class=" col-md-4 col-sm-4">
             <div class="footer_column">
                <div class="footer_title">Follow us</div>
                <div class="footer_social">
                   <ul>
                      <li><a href="{{$store->fb_link}}"><i class="fab fa-facebook-f"></i></a></li>
                      <li><a href="{{$store->twitter_link}}"><i class="fab fa-twitter"></i></a></li>
                      <li><a href="{{$store->pinterest_link}}"><i class="fab fa-pinterest"></i></a></li>
                      <li><a href="{{$store->instagram_link}}"><i class="fab fa-instagram"></i></a></li>
                      <li><a href="{{$store->whatsapp_link}}"><i class="fab fa-whatsapp"></i></a></li>
                      <li><a href="{{$store->google_link}}"><i class="fab fa-google"></i></a></li>
                   </ul>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>
 {{-- <button  class="float"   >
 <i class="fa fa-comments my-float" id="chatbox" aria-hidden="true"></i>
 </button> --}}
 <div id="myForm" class="hide">
    <form action="/echo/html/" id="popForm" method="get">
       <div class="">
          <label class="chat-label" for="name">Name:</label>
          <input type="text" name="name" id="name" class="form-control input-md">
          <label class="chat-label" for="email">Email:</label>
          <input type="email" name="email" id="email" class="form-control input-md">
          <label class="chat-label" for="phone">Phone:</label>
          <input type="phone" name="email" id="phone" class="form-control input-md">
          <label class="chat-label" for="about">Message:</label>
          <textarea rows="3" name="about" id="about" class="form-control input-md"></textarea>
          <button type="button" class="btn btn-submit-review btn-block mt-4" data-loading-text="Sending info.."><em class="icon-ok"></em> SUBMIT</button>
       </div>
    </form>
 </div>
 <footer class="footer">
    <div class="container">
       <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-3">
             <div class="footer_column">
                <div class="footer_title">
                   @php
                     echo DB::table('footer_titles')->where('identity','first')->first()->title;
                   @endphp
                </div>
                <ul class="footer_list">
                   <?php
                      $pages = \App\Models\CustomerPage::orderBy('order_no')->get();
                    ?>
                    @foreach($pages as $page)
                    <li><a href="{{url($page->pages->url)}}">{{$page->pages->name}}</a></li>
                    @endforeach
                </ul>
             </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3">
             <div class="footer_column">
                <div class="footer_title">
                  @php
                    echo DB::table('footer_titles')->where('identity','second')->first()->title;
                  @endphp
                </div>
                <ul class="footer_list">
                    <?php
                    $pages = \App\Models\PolicyPage::orderBy('order_no')->get();
                  ?>
                  @foreach($pages as $page)
                  <li><a href="{{url($page->pages->url)}}">{{$page->pages->name}}</a></li>
                  @endforeach
                </ul>
             </div>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3">
             <div class="footer_column">
                <div class="footer_title">
                  @php
                    echo DB::table('footer_titles')->where('identity','third')->first()->title;
                  @endphp
                </div>
                <ul class="footer_list">
                    <?php
                    $pages = \App\Models\ShopPage::orderBy('order_no')->get();
                  ?>
                  @foreach($pages as $page)
                  <li><a href="{{url($page->pages->url)}}">{{$page->pages->name}}</a></li>
                  @endforeach
                </ul>
             </div>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-3 footer_col">
             <div class="footer_column">
                <div class="footer_title">Contact Info</div>
                <ul class="contact-info">
                   <li>
                      <p><i class="fas fa-map-marker-alt"></i> <strong>Address:</strong><br>{{$store->address}}<br> {{$store->city}}, {{$store->state}}</p>
                   </li>
                   <li>
                      <p><i class="fas fa-mobile-alt"></i><strong>Phone:</strong> <a href="#"> {{$store->phone}}</p>
                   </li>
                   <li> <a href="#" target="_blank"><img alt="whatsapp" src="{{asset('store/images/whatsapp-icon.png')}}" style="margin-right: 7px;" width="15"><strong>Whatsapp:</strong>{{$store->whatsapp}}</a></li>
                   <li>
                      <p><i class="fas fa-envelope"></i><strong>Email:</strong><a href="mailto:info@vasvi.com">{{$store->company_email}}</a></p>
                   </li>
                   <li>
                      <p><i class="far fa-clock"></i><strong>Working Days/Hours:{{$store->working_day}}</strong><br></p>
                   </li>
                </ul>
             </div>
          </div>
       </div>
    </div>
 </footer>
 <div class="copyright">
    <div class="container">
       <div class="row">
          <div class="col">
             <div class="copyright_container d-flex flex-sm-row flex-column">
                <div style="text-align: center;" class="copyright_content col-md-12">
                   <p>Copyright @ 2021 vasvi.in - All Right Reserved | <a style="color: #979797; border-bottom: 0" href="https://dzoneindia.co.in/" target="_blank">Powered By dzone India.</a></p>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>

 <div class="whatsup">
    <a href="https://api.whatsapp.com/send?phone=916375565058" target="_blank"> <img src="{{asset('store/images/whatsapp-logo.png')}}" alt="wsp"></a>
 </div>

 <div class="wholesale" >
    <a data-toggle="modal" data-target="#wholesale"> Wholesale</a>
 </div>

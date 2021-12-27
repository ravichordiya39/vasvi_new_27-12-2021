@extends('layouts.front')

@section('content')

<!--<div class="container-fluid banner-section" style="padding-left: 0px; padding-right: 0px"></div>-->
<br><br>
<section class="post-content-section">
    <div class="container">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 post-title-block">
               
                <h1 class="text-center">post Title goes here</h1>
                <ul class="post-authorlist text-left">
                    <li><span>Author:</span> Vin Gaeta</li>
                    <li>Category : Fashion Trende</li>
                    <li>Date | 16 oct 2019</li>
                </ul>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 post-content">
                  <p>Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.</p>
                <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ullamcorper nulla non metus auctor fringilla. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec ullamcorper nulla non metus auctor fringilla.</p>
                                
                <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Donec id elit non mi porta gravida at eget metus. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>
                <blockquote>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                </blockquote>  
                 <div class="image-block">
                     <img src="https://static.pexels.com/photos/268455/pexels-photo-268455.jpeg" class="img-responsive" >
                 </div>
            <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Donec id elit non mi porta gravida at eget metus. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.</p>

            <div class="col-md-12 col-sm-12">
                <h4>Leave a Reply </h4>
                <form action="https://jevelin.shufflehound.com/wp-comments-post.php" method="post" id="commentform" class="comment-form" novalidate="">
        <label>Message </label>
      <p class="comment-form-comment">
        <textarea id="comment" name="comment" cols="45" rows="6" aria-required="true" required="" class="form-control"></textarea>
      </p>

      <label>Name</label>
        <p class="comment-form-author">
          <input id="author" name="author" type="text" value="" required="" class="form-control">
        </p>

          <label>Email <i class="icon-check sh-accent-color"></i> </label>
        <p class="comment-form-email">
          <input id="email" name="email" type="text" value="" required="" class="form-control">
        </p>

        <label>Website  </label>
        <p class="comment-form-url">
          <input id="url" name="url" type="text" value="" class="form-control">
        </p>
        
        <p class="form-submit text-center">
          <input name="submit" type="submit" id="submit" class="btn btn-pink" value="Send a comment">
        </p>
    </form>

            </div>

             </div>
            <div class="col-lg-4  col-md-4 col-sm-12 blog-rgt-panel">
                  <div>
                    <div class="input-group" >
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-pink" type="button"><i class="fas fa-search"></i></button>
                    </span>
                   </div>
                </div>

                <div class="sidebar">
                    <h3 class="widget-title">Categories</h3>
                    <ul>
                        <li><a href="#">Lorem ipsum dolor sit amet</a></li>
                        <li><a href="#">Lorem ipsum dolor sit amet</a></li>
                        <li><a href="#">Lorem ipsum dolor sit amet</a></li>
                        <li><a href="#">Lorem ipsum dolor sit amet</a></li>

                    </ul>

                </div>

                <div>
                    <h3>Find Us Social Media</h3>
                    <ul class="social-media-list">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-whatsapp"></i></a></li> 
                        
                    </ul>
                </div>

                 <div class="sidebar">
                    <h3 class="widget-title">Recent Post</h3>
                    <ul class="recent-post">
                        <li><a href="#"><div class="sidebar-post-img"><img src="https://www.impactbnd.com/hubfs/blog-image-uploads/9_Blog_Layout_Best_Practices_From_2017.jpg" alt="" /></div>
                          <div class="post-cat-content">Lorem ipsum dolor sit amet<br/><p>Duis sed enim dictum Lorem ipsum dolor sit amet</p></div>
                          </a>
                        </li>
                       
                       <li><a href="#"><div class="sidebar-post-img"><img src="https://www.impactbnd.com/hubfs/blog-image-uploads/9_Blog_Layout_Best_Practices_From_2017.jpg" alt="" /></div>
                          <div class="post-cat-content">Lorem ipsum dolor sit amet<br/><p>Duis sed enim dictum Lorem ipsum dolor sit amet</p></div>
                          </a>
                        </li>

                        <li><a href="#"><div class="sidebar-post-img"><img src="https://www.impactbnd.com/hubfs/blog-image-uploads/9_Blog_Layout_Best_Practices_From_2017.jpg" alt="" /></div>
                          <div class="post-cat-content">Lorem ipsum dolor sit amet<br/><p>Duis sed enim dictum Lorem ipsum dolor sit amet</p></div>
                          </a>
                        </li>

                        <li><a href="#"><div class="sidebar-post-img"><img src="https://www.impactbnd.com/hubfs/blog-image-uploads/9_Blog_Layout_Best_Practices_From_2017.jpg" alt="" /></div>
                          <div class="post-cat-content">Lorem ipsum dolor sit amet<br/><p>Duis sed enim dictum Lorem ipsum dolor sit amet</p></div>
                          </a>
                        </li>

                    </ul>

                </div>
               

            </div>
        </div>
      

    </div> <!-- /container -->
</section>
@endsection
<script>
    $(function(){
      $('input[type="checkbox"][id^="myCheckbox"]').click(function() {
          $('.image-load').html();
          var id = $(this).attr('id');
          var imagesrc = "{{asset('file')}}"+ "/"+$(this).attr('data-img');
          var identity = "image";
          var name = $(this).attr('data-img');
          $('input[type="checkbox"][id^="myCheckbox"]').each(function () {
                  if (this.checked) {
                      $('input[type="checkbox"][id^="myCheckbox"]').prop('checked', false);
                  }
          });
          $(document).find(`#${id}`).prop('checked', true);
          var cur_url = "{{request()->segment(2)}}";
          var seg_two = "{{request()->segment(3)}}";
          var view = "admin.upload.size";
          var img = new Image();
          img.src = imagesrc;
          var imgwidth = img.width;
          var imgheight = img.height;

          console.log( imgwidth);
          console.log( imgheight);

          if(cur_url === 'home' && seg_two === 'banners'){
            // if((imgwidth === 1138 && imgheight === 640) || (imgwidth === 1920 &&  imgheight === 1080)){
                $('.image-load').html(
                  @include("admin.upload.single")
                );


            // }
            // else{
            //     toastr.error('Error', 'Image diamention should be 640px by 1138px, or 1080px by 1920px.',{
            //         positionClass: 'toast-top-center',
            //     });
            //     return;
            // }
          }
          else if(cur_url != 'testimonials'){
            $('.image-load').html(
              @include("admin.upload.single")
            );
            // $(document).find('#image').append(imagesrc);
          }
          else{
            $(document).find('#img-name').html();
            $(document).find('#img-name').html(name);
            $('.image-load').html(
              @include("admin.upload.singleinline")
            );
          }

          toastr.success('Success', 'Image selected successfully.',{
            positionClass: 'toast-top-center',
          });
      });
    });
  </script>

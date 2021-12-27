<script>
    $(function(){
      $('input[type="checkbox"][id^="myCheckbox"]').click(function() {
          $('.image-load').html();
          var id = $(this).attr('id');
          var imagesrc = "{{asset('file')}}"+ "/"+$(this).attr('data-img');
          var identity = "banner";
          var name = $(this).attr('data-img');
          $('input[type="checkbox"][id^="myCheckbox"]').each(function () {
                  if (this.checked) {
                      $('input[type="checkbox"][id^="myCheckbox"]').prop('checked', false);
                  }
          });
          $(document).find(`#${id}`).prop('checked', true);
          $('.banner-load').html(
              @include('admin.upload.bannersingle')
          );
          toastr.success('Success', 'Image selected successfully.',{
              positionClass: 'toast-top-center',
          });
      });
    });
  </script>

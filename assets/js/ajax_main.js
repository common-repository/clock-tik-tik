(function($){
    $(document).ready(function(){

        $('.form_for_submit').submit(function(e){
        e.preventDefault(); 
        //var stripeForm = $(this).serialize();
        var stripeForm = new FormData(this);
        $(this).find('button[type=submit]').append('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
        $(this).find('button[type=submit]').prop('disabled',true);
        var thiss = $(this);
                $.ajax({
                   type: 'post',
                   url: ajax_script.ajax_url,
                   data: stripeForm,
                   dataType : 'json',
                   cache:false,
                   contentType: false,
                   processData: false,
                   success: function (response) {
                    console.log(response);
                    $('.fa.fa-spinner.fa-spin').remove();
                        $(thiss).find('button[type=submit]').prop('disabled',false);
                        if(!response.status){
                            //$(thiss).append('<p class="eer" style="color:red;">'+response.error+'</p>');
                             swal({
                                  title: "Error!",
                                  text: response.error,
                                  icon: "warning",
                                  button: "Close",
                                });
                        }
                        else{
                            if (response.auto_redirect) {window.location.href = response.redirect_url;}
                            else{ 
                            swal({
                                  text: response.error,
                                  icon: "success",
                                  button: "Close",
                                }); 
                            }
                          ;
                        } 
                    },
                    error : function(errorThrown){
                    console.log(errorThrown);
                    }
                });
        });



        jQuery("#time_zone_see").select2({
        placeholder: "eg : America/New_york",
        // allowClear: true
        });
        jQuery("#time_zone_see1").select2({
        placeholder: "eg : America/New_york",
        // allowClear: true
        });


        $('.MCWC_tablinks').click(function(e){

            var cityName = $(this).attr("call");
            var evt = "event";
            
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("MCWC_tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("MCWC_tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" MCWC_active", "");
            }
            document.getElementById(cityName).style.display = "block";
            $(this).addClass("MCWC_active");
        });


});
})(jQuery);
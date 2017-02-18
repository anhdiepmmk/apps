$(document).ready(function(){
    $("body").click(function(){
        $("#page").removeClass("active_mobile_page");
        $("html").removeClass("mm-opened");
        $("#menufloat").removeClass("navMobile");
    })
    $("#menuCategory").click(function(e){
        e.stopPropagation();  
        if($("#page").hasClass("desktop")){
            
        }else{
            if( $("#menufloat").css("display") == 'block'){
                $("html").removeClass("mm-opened");
                $("#page").removeClass("active_mobile_page");
                $("#menufloat").removeClass("navMobile");
            }else{
                $("html").addClass("mm-opened");
                $("#page").addClass("active_mobile_page");
                $("#menufloat").addClass("navMobile");
            }
        }
    })
})
var Store = {};
Store.LoadMore = function(){
    var track_load = 1; //total loaded record group(s)
    var loading  = false; //to prevents multipal ajax loads
    var total_app = $("input#total_app").val();
    var catid = $("input#catid").val();
    var otp = $("input#otp").val();
    $(window).scroll(function() { //detect page scroll
        if( $(window).scrollTop() + $(window).height() + 100 >= $(".featured").height()){
            if( (track_load <= total_app) && loading==false) //there's more data to load
            {
                loading = true; //prevent further ajax loading
                $('.animation_image').show(); //show loading image
                $.get( base_url+"app/load_category.html", {'catid':catid, 'otp':otp, 'page':track_load} ,function( data ) {             
                    $("#listApp").append(data.html); //append received data into the element
                    $('.animation_image').hide(); //hide loading image once data is received
                    track_load++; //loaded group increment
                    loading = false;
                },'json').fail(function(xhr, ajaxOptions, thrownError) { //any errors?
                    alert(thrownError); //alert with HTTP error
                    $('.animation_image').hide(); //hide loading image
                    loading = false;
                });
               
            }
        }
    })
}

Store.LoadMoreCollections = function(){
    var track_load = 1; //total loaded record group(s)
    var loading  = false; //to prevents multipal ajax loads
    var total_app = $("input#total_app").val();
    var catid = $("input#catid").val();
    var limit = $("input#limit_page").val();
    $(window).scroll(function() { //detect page scroll
        if( $(window).scrollTop() + $(window).height() + 100 >= $(".collection-list").height()){
            if( (track_load <= total_app) && loading==false) //there's more data to load
            {
                loading = true; //prevent further ajax loading
                $('.animation_image').show(); //show loading image
                $.get( base_url+"app/load_collection.html", {'catid':catid ,'limit':limit, 'page':track_load} ,function( data ) {             
                    $("#listApp").append(data.html); //append received data into the element
                    $('.animation_image').hide(); //hide loading image once data is received
                    track_load++; //loaded group increment
                    loading = false;
                },'json').fail(function(xhr, ajaxOptions, thrownError) { //any errors?
                    alert(thrownError); //alert with HTTP error
                    $('.animation_image').hide(); //hide loading image
                    loading = false;
                });
               
            }
        }
    })
}

Store.LoadMoreCollectionsDetail = function(){
    var track_load = 1; //total loaded record group(s)
    var loading  = false; //to prevents multipal ajax loads
    var total_app = $("input#total_app").val();
    var catid = $("input#catid").val();
    var limit = $("input#limit_page").val();
    $(window).scroll(function() { //detect page scroll
        if( $(window).scrollTop() + $(window).height() + 100 >= $(".list_item_collection").height()){
            if( (track_load <= total_app) && loading==false) //there's more data to load
            {
                loading = true; //prevent further ajax loading
                $('.animation_image').show(); //show loading image
                $.get( base_url+"app/load_collection_detail.html", {'catid':catid ,'limit':limit, 'page':track_load} ,function( data ) {             
                    $("#listApp").append(data.html); //append received data into the element
                    $('.animation_image').hide(); //hide loading image once data is received
                    track_load++; //loaded group increment
                    loading = false;
                },'json').fail(function(xhr, ajaxOptions, thrownError) { //any errors?
                    alert(thrownError); //alert with HTTP error
                    $('.animation_image').hide(); //hide loading image
                    loading = false;
                });
               
            }
        }
    })
}

Store.LoadCategory = function(catid, page){
    $.get( base_url+"app/load_category.html", {'catid':catid, 'page':page} ,function( data ) {
        $( ".result" ).html( data );
        alert( "Load was performed." );
    });
}
Store.Search = function(){
    $("#search").autocomplete({
        source: "app/search_ajax",
        minLength: 2,
        select: function( event, ui ) {
            window.location.href = ui.item.link;
            return false;
        }
    })
}
Store.ShowInfoVersion = function(id){
    if( $(".listVersion #app_"+id).css('display') == 'none'){
        $(".listVersion .subinfo").slideUp('fast');
        $(".listVersion li i").removeClass('active');
        $(".listVersion #info_"+id+" i").addClass('active');
        $(".listVersion #app_"+id).slideDown('fast');
    }else{
        $(".listVersion #app_"+id).slideUp('fast');
        $(".listVersion #info_"+id+" i").removeClass('active');
    }
}

Store.LoadMenu = function(){

}

Store.TabComment = function(div){
    $("#nav_comment li").removeClass("active");
    $("#"+div).addClass("active");
    $(".item_con_comment").hide();
    $("#con_"+div).show();
    $('.fb_iframe_widget span').css('width', $('.content-comment').css('width') - 20 );
    $('.fb_iframe_widget iframe').css('width', $('.content-comment').css('width') - 20 );
}

Store.PostComment = function(){
    $('#Form_comment').validator().on('submit', function (e) {
        if (e.isDefaultPrevented()) {
            return false;
        }else{
            var code = $("input[name='code']").val();
            $.get( base_url+"api/check_captcha?code="+code, function( data ) {
              if(data.error == 1){
                  alert("Security code is not correct");
                  return false;
              }else{
                dataString = $("#Form_comment").serialize();
                $.ajax({
                    type: "POST",
                    url: base_url+"api/add_comment",
                    data: dataString,
                    dataType: "json",
                    success: function(data) {
                        if(data.error == 1){
                            alert("Send comments unsuccessful");
                        }else{
                            alert("Send comments success");
                            $("#Form_comment input[type='text'],#Form_comment input[type='email'], #Form_comment input[type='number'], #Form_comment textarea").each(function(){
                                $(this).val("");
                            })
                            Store.ReloadCaptcha("captcha");
                        }
                    }
                });
              }
            },'json');
            return false;
        }
    })

}
Store.ReloadCaptcha = function(div){
    $.get( base_url+"api/reload_captcha", function( data ) {
        $("img#"+div).attr("src",data.src);
    },'json')
}

Store.ReportBrokenLink = function(){
    //var $modal = $('<div class="modal fade in" id="ajaxModal"><div class="modal-body"></div></div>');
    $(".report_broken_link a").click(function(e){
        var data_link = $(this).attr("data_link");
        var version_id = $(this).attr("version_id");
        var file_id = $(this).attr("file_id");
        $('#ajaxModal').remove();
        e.preventDefault();
        var $this = $(this);
        var $remote = base_url+"api/send_broken_link?url="+data_link+"&version_id="+version_id+"&file_id="+file_id;
        var $modal = $('<div class="modal fade in" id="ajaxModal"><div class="modal-body"></div></div>');
        $('body').append($modal);
        //$('body').append('<div class="modal-backdrop fade in"></div>');
        $modal.modal({backdrop: 'static', keyboard: false});
        //$("#loading-body, #loading").show();
        $modal.load($remote);
        
    })
}
Store.ReportBrokenLink_validation = function(){
    $('#myForm_reporting').validator().on('submit', function (e) {
        if (e.isDefaultPrevented()) {
            return false;
        }else{
            var code = $("#myForm_reporting input[name='code']").val();
            $.get( base_url+"api/check_captcha?code="+code, function( data ) {
              if(data.error == 1){
                  alert("Security code is not correct");
                  return false;
              }else{
                dataString = $("#myForm_reporting").serialize();
                $.ajax({
                    type: "POST",
                    url: base_url + "api/save_report_link",
                    data: dataString,
                    dataType: "json",
                    success: function(data) {
                        alert(data.msg);
                         $("#ajaxModal").modal('hide');
                    }
                });
              }
            },'json');
            return false;
        }
    })
}

Store.ShowMoreContent = function(div){
    if($("#"+div).hasClass("con_hiden")){
        $("#"+div).removeClass("con_hiden");
        $("#"+div).addClass("con_show");
        $("#"+div).css('height','auto');
        $("#show_more").html('<i class="fa fa-angle-double-up fa-2x"></i>');
    }else{
        $("#"+div).removeClass("con_show");
        $("#"+div).addClass("con_hiden");
        $("#"+div).css('height','220px');
        $("#show_more").html('<i class="fa fa-angle-double-down fa-2x"></i>');
    }
}

Store.Slider = function(){
    $('.bxslider').bxSlider({
        minSlides: 4,
        maxSlides: 8,
        slideWidth: 174,
        slideMargin: 10
    });
}
Store.Banner = function(){
    var options = {
        $FillMode: 2,                                       //[Optional] The way to fill image in slide, 0 stretch, 1 contain (keep aspect ratio and put all inside slide), 2 cover (keep aspect ratio and cover whole slide), 4 actual size, 5 contain for large image, actual size for small image, default value is 0
        $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
        $AutoPlayInterval: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
        $PauseOnHover: 1,                                   //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

        $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
        $SlideEasing: $JssorEasing$.$EaseOutQuint,          //[Optional] Specifies easing for right to left animation, default value is $JssorEasing$.$EaseOutQuad
        $SlideDuration: 800,                               //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
        $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
        //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
        //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
        $SlideSpacing: 0, 					                //[Optional] Space between each slide in pixels, default value is 0
        $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
        $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
        $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
        $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
        $DragOrientation: 1,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

        $BulletNavigatorOptions: {                          //[Optional] Options to specify and enable navigator or not
            $Class: $JssorBulletNavigator$,                 //[Required] Class to create navigator instance
            $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
            $AutoCenter: 1,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
            $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
            $Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
            $SpacingX: 8,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
            $SpacingY: 8,                                   //[Optional] Vertical space between each item in pixel, default value is 0
            $Orientation: 1,                                //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
            $Scale: false                                   //Scales bullets navigator or not while slider scale
        },

        $ArrowNavigatorOptions: {                           //[Optional] Options to specify and enable arrow navigator or not
            $Class: $JssorArrowNavigator$,                  //[Requried] Class to create arrow navigator instance
            $ChanceToShow: 1,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
            $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
            $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
        }
    };

    //Make the element 'slider1_container' visible before initialize jssor slider.
    $("#slider1_container").css("display", "block");
    var jssor_slider1 = new $JssorSlider$("slider1_container", options);

    //responsive code begin
    //you can remove responsive code if you don't want the slider scales while window resizes
    function ScaleSlider() {
        var bodyWidth = document.body.clientWidth;
        var slWidth = $("#sl").width();
        if (bodyWidth)
            jssor_slider1.$ScaleWidth(Math.min(slWidth, 1920));
        else
            window.setTimeout(ScaleSlider, 30);
    }
    ScaleSlider();

    $(window).bind("load", ScaleSlider);
    $(window).bind("resize", ScaleSlider);
    $(window).bind("orientationchange", ScaleSlider);
}
$(document).ready(function(){
    //Store.Search();
})


function getPosts() {
       var page = parseInt($("#currentPage").val()) + 1;
       var url = window.location.href + '?page=' + page;
       $.ajax({
           url : url,
           dataType: 'json',
       }).done(function (data) {
           $('#loadmore').append(data.html);
           $("#currentPage").val(data.currentPage)

       }).fail(function () {
           alert('Posts could not be loaded.');
       });
   }
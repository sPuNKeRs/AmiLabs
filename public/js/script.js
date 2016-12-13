$(document).ready(function(){
        var $body = $('body');
        var $openCloseBar = $('.navbar .navbar-header .bars');
        var width = $body.width();

        if($.cookie('leftsidebar') == 'true'){
                showLeftSidebar();
        }

        if($.cookie('leftsidebar') == 'false'){        
                closeLeftSidebar();
        }

        function showLeftSidebar() {
          $body.addClass('ls-closed');
          $('.button-bars').one("click", closeLeftSidebar);
          $.cookie('leftsidebar', 'true');
        }
        function closeLeftSidebar() {
          $body.removeClass('ls-closed');
          $('.button-bars').one("click", showLeftSidebar);
          $.cookie('leftsidebar', 'false');
        }

        $(".button-bars").one("click", showLeftSidebar);

        $('[data-toggle="tooltip"]').tooltip({
                container: 'body',
                trigger: 'hover'
        });
});

$(document).ready(function(){
        var $body = $('body');
        var $openCloseBar = $('.navbar .navbar-header .bars');
        var width = $body.width();


        function showLeftSidebar() {
          $body.addClass('ls-closed'); 
          $(this).one("click", closeLeftSidebar);
        }
        function closeLeftSidebar() {
          $body.removeClass('ls-closed');
          $(this).one("click", showLeftSidebar);
        }

        $(".button-bars").one("click", showLeftSidebar);
});
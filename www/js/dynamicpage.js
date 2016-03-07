$(function() {

    if(Modernizr.history){

    var newHash      = "",
        $mainContent = $("#main-content"),
        $pageWrap    = $("#page-wrap"),
        baseHeight   = 0,
        $el;
        
    $pageWrap.height($pageWrap.height());
    baseHeight = $pageWrap.height() - $mainContent.height();
    
    $("nav").delegate("a", "click", function() {
        _link = $(this).attr("rel");
        history.pushState(null, null, _link);

        return false;
    });

    
    $(window).bind('popstate', function(){
       _link = location.pathname.replace(/^.*[\\\/]/, ''); //get filename only

    });

} // otherwise, history is not supported, so nothing fancy here.

    
    
});
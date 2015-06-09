(function ($) {
})(window.jQuery);

jQuery(function ($) {
    "use strict";

    function sortProjects() {
        $('#container').mixItUp({
            animation: {
                effects: 'fade',
                duration: '250'
            }
        });
    }

    /* Opens lightbox for Jira links */
    function fancyboxToggle() {
        $(".light-box").fancybox({
            type: 'image',
            scrolling: 'auto',
            padding: '',
            fitToView: true,
            width: '90%',
            height: '90%',
            autoCenter: true,
            autoSize: true,
            closeBtn: true,
            openEffect: 'fade',
            closeEffect: 'fade',
            closeClick: true
        });
    }

    /**
     * Called when the page is ready
     */
    $(document).ready(function () {
        sortProjects();
        fancyboxToggle();
    });
});

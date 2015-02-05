var instance;
(function(window, PhotoSwipe){

            document.addEventListener('DOMContentLoaded', function(){

                var options = {}

                    instance = PhotoSwipe.attach(
                    window.document.querySelectorAll('gallery-item a:has(img)'), options );

            }, false);

        }(window, window.Code.PhotoSwipe));
$( function() {

        $('.link').click( function() { instance.show(0) } );
});

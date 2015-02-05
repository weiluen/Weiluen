$(document).ready(function(){
            var options = { imageScaleMethod: 'fitNoUpscale' };
            $('.postphotos').each(function(i, e) {
                PhotoSwipe.attach($(e).find('a:has(img)'), options);
            });
        });
// index-cycle-slider   Home Cycle Slider DEMO

$('.cycle-slideshow').on('cycle-before', function (opts) {
    var slideshow = $(this);
    var img = slideshow.find('.banner-background').css('background-image');
    slideshow.css('background-image', img);
});

var progress = $('#progress'),
    slideshow = $( '.cycle-slideshow' );

slideshow.on( 'cycle-initialized cycle-before', function( e, opts ) {
    progress.stop(true).css( 'width', 0 );
});

slideshow.on( 'cycle-initialized cycle-after', function( e, opts ) {
    if ( ! slideshow.is('.cycle-paused') )
        progress.animate({ width: '100%' }, opts.timeout, 'linear' );
});

slideshow.on( 'cycle-paused', function( e, opts ) {
   progress.stop(); 
});

slideshow.on( 'cycle-resumed', function( e, opts, timeoutRemaining ) {
    progress.animate({ width: '100%' }, timeoutRemaining, 'linear' );
});

// Home Cycle Slider Ends

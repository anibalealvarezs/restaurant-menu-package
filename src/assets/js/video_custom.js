
// index-Video Starts

$(document).ready(function (){
    'use strict';
    // JQUERY.MB.YTPLAYER
    $(function(){
      $(".yt-player").mb_YTPlayer();
    });

    // yt controls
    $('#yt-play').click(function(event){
      event.preventDefault();
      if ($(this).hasClass("fa-play") ) {
          $('.yt-player').playYTP();
      } else {
          $('.yt-player').pauseYTP(); 
      }
      $(this).toggleClass("fa-play fa-pause");
      return false;
    });
    $('#yt-volume').click(function(event){
      event.preventDefault();
      $('.yt-player').toggleVolume();
      $(this).toggleClass("fa-volume-off fa-volume-up");
      return false;
    }); 
    
}); 

// index-Video Starts

/************************************************************************************
		  		Index.htm Home TileBox Effect BoxFX
************************************************************************************/
jQuery(document).ready(function($){
"use strict";
new BoxesFx( document.getElementById( 'boxgallery' ) );

// Box Animation Auto Play
jQuery(document).ready(function($){
"use strict";	

      var el=4;
	  
      repeat(2000,function(){
	 // alert(el);
        if(el==4){
        $('#boxgallery nav span:nth-child(0)').click();
           el=2;
        }
        else{
          $('#boxgallery nav span:nth-child('+el+')').click();
		//  alert(el);
          el=el+1;
          }
        });
      });

 });


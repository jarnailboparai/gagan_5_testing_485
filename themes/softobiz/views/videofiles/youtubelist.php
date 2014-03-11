<?php $url =  Yii::app()->getBaseUrl(true); $pathurl = Yii::app()->theme->baseUrl; ?>

<link href="<?php echo $pathurl; ?>/css/media_gallery.css" rel="stylesheet" type="text/css"></link>
<link href="<?php echo $pathurl; ?>/css/custom_settings.css" rel="stylesheet" type="text/css"></link>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/scroller/jquery.mousewheel.js"></script>

<script>
	function selectedVideo(liArg){

		if($(liArg).hasClass('enabled')){
			$(liArg).removeClass('enabled');
			$(liArg).find('input.fieldsetValue').attr('name','fieldset[]');
		}else{
			$(liArg).addClass('enabled');
			$(liArg).find('input.fieldsetValue').attr('name','selectedlisted[]');
		}
	}

	function submitFormMain(arg)
	{
		var form = document.forms[arg];
		$(form).submit();
		console.log(arg);
	} 

	
jQuery(document).ready(function(){
	
	jQuery('#video-files-form').on('submit',function(e){
		e.preventDefault();
	    var postData = $(this).serialize();
	    var actionUrl = document.getElementById('video-files-form');
	   // alert(postData);
	   // alert(actionUrl);
		
	    $.ajax({
	        type: 'POST',
	        url: actionUrl.action,
	        data: postData,
	        success: function(response){
				//alert(response);
				jQuery( "#imageListUpdateVideo").html(response);
				jQuery( ".row-fluid.manage_apps.media_gallery.tab_gallery.video_gallery").show();
				jQuery('#myModalVideoYouTube').modal('hide');

				 jQuery('#myModalVideo').removeData("modal");
	        	 jQuery('#myModalVideo').modal({remote: '<?php echo CHtml::normalizeUrl(array('videofiles/index','module_id'=>$module_id,'layout'=>1))?>',show:false});

	        	
	        	 jQuery('.photowrapper.video').addClass('show');
				return false;
				
				var arg = JSON.parse(response);
	        	console.log(arg.success);
	        	//$('#myModalVideoYouTube').
	        	jQuery('#myModalVideoYouTube').modal('toggle');


	        	 jQuery('#myModalVideo').removeData("modal");
	        	 jQuery('#myModalVideo').modal({remote: '<?php echo CHtml::normalizeUrl(array('videofiles/index','module_id'=>$module_id,'layout'=>1))?>'});
	             
	        	
	        },
	        error: function(){
	            alert('error');
	        }
	    }); 
	   
	});
	
});

function openCloseYoutubeOpenVideo()
{
	jQuery('#myModalVideoYouTube').modal('hide');
	jQuery('#myModalSelectVideo').modal('show');
	// jQuery('#myModalVideo').removeData("modal");
	// jQuery('#myModalVideo').modal({remote: '<?php echo CHtml::normalizeUrl(array('videofiles/index','module_id'=>$module_id,'layout'=>1))?>'});

}
</script>
<script type="text/javascript">
      var clientId = '674166051941.apps.googleusercontent.com';
      var apiKey = 'AIzaSyBI4_1EiCrW3c3pzqq5fLLMQkD0EwwD9pc';
     // var scopes = 'https://www.googleapis.com/auth/youtube';

     var templateSearch = '<li class="span3"><div class="app_box">'
    	 templateSearch +=  '<div class="app_thumb"> <a id="youtubeHref" href="#"  ><img id="youtubeImage" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSa32HOp6iuXHTEh3XqymYDzqz2aXVvIl-0CmUDZkIqBHwkCYsR" alt="app thumb" /> </a></div>';
    	 templateSearch +=  '<div class="select_feature">';
    	 templateSearch +=	'<img alt="" src="images/select_feature.png">';
    	 templateSearch +=	'</div>';
    	 templateSearch +=  '<input class="fieldsetValue" type="hidden" value="" name="fieldset[]"></div></li>';

      function handleAPILoaded() {
    	  $('#search-button').attr('disabled', false);
    	  window.setTimeout(search,1);
    	}

    	// Search for a specified string.
    	function search() {
        	
    	  var q = $('#appendedInputButton').val();

    	  gapi.client.load('youtube', 'v3', function () {

    	  var selecttype = $('#selecttype').val(); 

		switch(selecttype){
			case '1':
			//	console.log(selecttype,'111');
	    	  var request = gapi.client.youtube.search.list({
	      	    part: 'snippet',
	      	    type:'video',
	      	    q: q,
	      	    id:q,
	          	key: apiKey,
	          	maxResults:20,
	      	  });
	  				
			break;
			
			case '2':
			//	console.log(selecttype,'222');
	    	  var request = gapi.client.youtube.search.list({
	      	    part: 'snippet',
	      	  	type: 'playlist',
	      	  	q: q,
	      	  	key: apiKey,
	          	maxResults:20,
	      	  });
	  				
			break;
			case '3':
			//	console.log(selecttype,'333');
	    	  var request = gapi.client.youtube.search.list({
	      	    part: 'snippet',
	      	  type:'channel',
	      	  q:q,
	      	  	key: apiKey,
	          	maxResults:20,
	          	mine:false,
	      	  });
	  				
			
			break;
			
			default:

			//	console.log(selecttype,'default');
	    	  var request = gapi.client.youtube.search.list({
	      	    part: 'snippet',
	      	    q: q,
	          	key: apiKey,
	          	maxResults:20,
	      	  });
	  							
			break;
			
		}
    	   

    	//  console.log(request);

    	  request.execute(function(response) {
        	  //console.log(response);
    	   // var str = "<ul style='margin:5px 10px; float:left'>";//JSON.stringify(response);
			$(".searchlistApi li").remove();
    	    response.items.map(function(s){
					//console.log(s.snippet.thumbnails.default.url);
					//console.log(s);
					
					var liNew = $(templateSearch);

					$(liNew).find('img#youtubeImage').attr('src',s.snippet.thumbnails.high.url);

					switch(selecttype){
					case '1':
						//$(liNew).find('a#youtubeHref').attr('href','http://www.youtube.com/watch?v='+s.id.videoId);
						$(liNew).find('a#youtubeHref').attr('href','javascript:void(0)');
						//$(liNew).addClass('video');
						$(liNew).attr('onclick','selectedVideo(this)');
						$(liNew).find('input.fieldsetValue').val(JSON.stringify(s));
			  				
					break;
					
					case '2':
						
						//$(liNew).find('a#youtubeHref').attr('href','http://www.youtube.com/playlist?list='+s.id.playlistId);
						$(liNew).find('a#youtubeHref').attr('href','javascript:void(0)');
						$(liNew).find('a#youtubeHref').attr('onclick','searchCP("'+s.id.playlistId+'","1")');
			  				
					break;
					case '3':
						
						//$(liNew).find('a#youtubeHref').attr('href','http://www.youtube.com/channel/'+s.id.channelId);
						$(liNew).find('a#youtubeHref').attr('href','javascript:void(0)');
						$(liNew).find('a#youtubeHref').attr('onclick','searchCP("'+s.id.channelId+'","2")');
							
					
					break;
					
					default:

						$(liNew).find('a#youtubeHref').attr('href','http://www.youtube.com/watch?v='+s.id.videoId);
						
			  							
					break;
					
				}
					

				//	$(liNew).find('a#youtubeHref').attr('href','http://www.youtube.com/watch?v='+s.id.videoId);
				//	str += "<li style='margin:5px 10px; float:left'><img src='"+s.snippet.thumbnails.default.url+"' width='128px'  /></li>";

					$(".searchlistApi").append(liNew);
		     });
    	   // str += '</ul>';
    	   //$('#search-container').html('<pre>' + str + '</pre>');
    	  });

    	  });

    	  //$('.scroll3').scrollTop(0);
    	  $(".searchlist").show();
    	  $("#playlistYoutube").hide();
    	}

    	function searchCP(argId,check) {

    		
    		 $("#playlistYoutube").show();
        	
      	  var q = $('#appendedInputButton').val();

      	  gapi.client.load('youtube', 'v3', function () {

      	  var selecttype = $('#selecttype').val(); 

  		switch(check){
  			case '1':
  				console.log(selecttype,'111');
  	    	  var request = gapi.client.youtube.playlistItems.list({
  	      	    part: 'snippet',
  	      	   // type:'video',
  	      	   // q: q,
  	      	   // id:q,
  	      	   playlistId:argId,
  	          	key: apiKey,
  	          	maxResults:20,
  	      	  });
  	  				
  			break;
  			
  			case '2':
  				console.log(selecttype,'222');
  	    	  var request = gapi.client.youtube.search.list({
  	      	    part: 'snippet',
  	      	  	//type: 'playlist',
  	      	  	//q: q,
  	      	  	channelId : argId,
  	      		type:'video',
  	      	  	key: apiKey,
  	          	maxResults:20,
  	      	  });
  	  				
  			break;
  			case '3':
  				console.log(selecttype,'333');
  	    	  var request = gapi.client.youtube.search.list({
  	      	    part: 'snippet',
  	      	  type:'channel',
  	      	  q:q,
  	      	  	key: apiKey,
  	          	maxResults:20,
  	          	mine:false,
  	      	  });
  	  				
  			
  			break;
  			
  			default:

  				console.log(selecttype,'default');
  	    	  var request = gapi.client.youtube.search.list({
  	      	    part: 'snippet',
  	      	    q: q,
  	          	key: apiKey,
  	          	maxResults:20,
  	      	  });
  	  							
  			break;
  			
  		}
      	   

      	  request.execute(function(response) {
  			$(".searchlistApi li").remove();
      	    response.items.map(function(s){
  					//console.log(s.snippet.thumbnails.default.url);
  					//console.log(s);
  					
  					var liNew = $(templateSearch);

  					$(liNew).find('img#youtubeImage').attr('src',s.snippet.thumbnails.high.url);

  					switch(check){
  					case '1':
  						//$(liNew).find('a#youtubeHref').attr('href','http://www.youtube.com/watch?v='+s.snippet.resourceId.videoId);
  						$(liNew).find('a#youtubeHref').attr('href','javascript:void(0)');
  						//$(liNew).addClass('video');
  						$(liNew).attr('onclick','selectedVideo(this)');
  						$(liNew).find('input.fieldsetValue').val(JSON.stringify(s));
  						
  			  				
  					break;
  					
  					case '2':

  						//$(liNew).find('a#youtubeHref').attr('href','http://www.youtube.com/watch?v='+s.id.videoId);
  						$(liNew).find('a#youtubeHref').attr('href','javascript:void(0)');
  						//$(liNew).addClass('video');	
  						$(liNew).attr('onclick','selectedVideo(this)');
  						$(liNew).find('input.fieldsetValue').val(JSON.stringify(s));
  						
  					break;
  					
  					default:

  						$(liNew).find('a#youtubeHref').attr('href','http://www.youtube.com/watch?v='+s.id.videoId);
  						
  			  							
  					break;
  					
  				}
  					

  					$(".searchlistApi").append(liNew);
  					
  		     });
      	  });

      	  });

      	$(".searchlist").show();
      	}

    </script>
    
<!-- <script src="https://apis.google.com/js/client.js"></script> -->
<!-- <div id="search-container"></div> -->
<div class="select_btn pad0">
               <!-- <div class="form-signin-heading">Upload Videos</div> -->
                
                
                <!-- You Tube Panel -->
                <div class="youtube_panel">
<!--                       <div class="input-prepend"> <span class="add-on">http://www.youtube.com/user/</span> -->
<!--                     <input type="text" id="prependedInput" placeholder="http://www.youtube.com/watch?v=" class="span4"> -->
<!--                   </div> -->
                      <div class="form-signin-heading">Content Type:</div>
                  		<!-- Search Video wrapper ends here -->
                      <div class="search_videos_wrapper">
                      <select name="" id="selecttype" class="pull-left">
                    <option value='1'>Search</option>
                    <option value='2'>Playlist</option>
                    <option value='3'>Channel</option>
                  </select>
                    <div class="search">
                  <div class="input-append pull-left">
              <input type="text" id="appendedInputButton" value='' placeholder="Keyword">
              <button type="button" class="btn btn-info" style="font-size: 12px;
    height: 30px;" onclick="search()" >Go!</button>
            </div>
            <div class="select_video">
			<input type="button" class="btn btn-success" value="Select" onclick="submitFormMain('youtube-list')" style="margin-right:10px;">
			<input type="button" class="btn" onclick="openCloseYoutubeOpenVideo()" value="Cancel">
			<input style="display:none;"  id="playlistYoutube" type="button" class="btn btn-info" value="Back" onclick="search()" style="margin-right:10px;">
</div>
                  </div>
                  <div class="clearfix"></div>
                  </div>
                  <!-- Search Video wrapper ends here -->
                  <div class="search_youtube_videos">
                  
                  
                  <!-- Video Search Listing -->
                  <div class="searchlist" style="display:none;">
                  <div class="row-fluid manage_apps media_gallery tab_gallery video_gallery" style="display:block !important">
                  <div class="tab_gallery_wrapper scroll3">
				<?php $form=$this->beginWidget("CActiveForm", array( "id"=>"video-files-form", 
  					 'htmlOptions' => array('enctype' => 'multipart/form-data','name'=>'youtube-list')
					)); ?>
					<?php echo CHtml::hiddenField("module_id",$module_id); ?>
                <ul class='searchlistApi' >

                	
                  
                </ul>
                    <?php $this->endWidget(); ?>
                    <div class="clearfix"></div>
              </div>
                 </div>
                  </div>
                  <!-- Video Search Listing -->
                  </div>
                      
                    </div>
                
                <!-- You Tube Panel Ends Here --> 
              </div> 
   
  </div>




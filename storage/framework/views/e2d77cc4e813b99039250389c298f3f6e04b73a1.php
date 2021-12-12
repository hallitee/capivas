<?php if($movies_info->seo_title): ?>
	<?php $__env->startSection('head_title', stripslashes($movies_info->seo_title).' | '.getcong('site_name')); ?>
<?php else: ?>
	<?php $__env->startSection('head_title', stripslashes($movies_info->video_title).' | '.getcong('site_name')); ?>
<?php endif; ?>

<?php if($movies_info->seo_description): ?>
	<?php $__env->startSection('head_description', stripslashes($movies_info->seo_description)); ?>
<?php else: ?>
	<?php $__env->startSection('head_description', Str::limit(stripslashes($movies_info->video_description),160)); ?>
<?php endif; ?>

<?php if($movies_info->seo_keyword): ?>
	<?php $__env->startSection('head_keywords', stripslashes($movies_info->seo_keyword)); ?> 
<?php endif; ?>


<?php $__env->startSection('head_image', URL::to('upload/source/'.$movies_info->video_image)); ?>

<?php $__env->startSection('head_url', Request::url()); ?>

<?php $__env->startSection('content'); ?>
 

 <?php if(get_player_cong('player_style')!=""): ?>  
 	<link href="<?php echo e(URL::asset('site_assets/videojs_player/css/'.get_player_cong('player_style').'.min.css')); ?>" rel="stylesheet" type="text/css" />    
 <?php else: ?>
	<link href="<?php echo e(URL::asset('site_assets/videojs_player/css/videojs_style1.min.css')); ?>" rel="stylesheet" type="text/css" />
 <?php endif; ?>
 
 <!--<script src="<?php echo e(URL::asset('site_assets/videojs_player/plugins/videojs-chromecast.min.js')); ?>"></script>-->

 <style type="text/css">
    
  .videoWrapper {
  position: relative;
  padding-bottom: 56.25%; /* 16:9 */
  padding-top: 25px;
  height: 0;
}
.videoWrapper iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
} 

.vjs-pip-control
{
	<?php if(get_player_cong('pip_mode')=="ON"): ?>
	display: block!important;
	<?php else: ?>
	display: none!important;
	<?php endif; ?>
}
 
 </style>

 <div class="main-wrap">
  <div class="section section-padding vfx_video_single_section">
    <div class="container">
      <div class="video-single">
        <div class="row">
          <div class="col-xs-12">            
            <div class="content-wrap">              
				<div class="vfx_video_detail xs-top-40">
				  <div class="row">
 
					<div class="single-section col-md-8 col-sm-12 col-xs-12" id="left_video_player">
					  <main>
						
						<?php if($movies_info->video_type=="Embed"): ?>
						  
						  <div class="videoWrapper"><?php echo $movies_info->video_url; ?></div>
						
						<?php elseif($movies_info->video_type=="HLS"): ?>
							
							<div id="container">                   
							<video id="v_player" class="video-js vjs-big-play-centered skin-blue vjs-16-9" controls preload="auto" playsinline crossorigin="anonymous" width="640" height="450" poster="<?php echo e(URL::to('upload/source/'.$movies_info->video_image)); ?>" data-setup="{}" <?php if(get_player_cong('autoplay')=="true"): ?>autoplay="true"<?php endif; ?>>
							  	
							  	<!-- video source -->
							  	<source src="<?php echo e($movies_info->video_url); ?>" type="application/x-mpegURL" />  
  								<?php if($movies_info->subtitle_on_off): ?>
  								<!-- video subtitle -->
								<?php if($movies_info->subtitle_url1): ?>
									<track kind="captions" src="<?php echo e($movies_info->subtitle_url1); ?>"   label="<?php echo e($movies_info->subtitle_language1?$movies_info->subtitle_language1:'English'); ?>" default>		
								<?php endif; ?>
								<?php if($movies_info->subtitle_url2): ?>
									<track kind="captions" src="<?php echo e($movies_info->subtitle_url2); ?>"   label="<?php echo e($movies_info->subtitle_language2?$movies_info->subtitle_language2:'English'); ?>">		
								<?php endif; ?>
								<?php if($movies_info->subtitle_url3): ?>
									<track kind="captions" src="<?php echo e($movies_info->subtitle_url3); ?>"    label="<?php echo e($movies_info->subtitle_language3?$movies_info->subtitle_language3:'English'); ?>">		
								<?php endif; ?>	
								<?php endif; ?>

								<!-- worning text if needed -->
								<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
							</video>
						</div>

						<?php elseif($movies_info->video_type=="DASH"): ?>

						<div id="container">                   
							<video id="v_player" class="video-js vjs-big-play-centered skin-blue vjs-16-9" controls preload="auto" playsinline crossorigin="anonymous" width="640" height="450" poster="<?php echo e(URL::to('upload/source/'.$movies_info->video_image)); ?>" data-setup="{}" <?php if(get_player_cong('autoplay')=="true"): ?>autoplay="true"<?php endif; ?>>
							  	
							  	<!-- video source -->
							  	<source src="<?php echo e($movies_info->video_url); ?>" type="application/dash+xml" />  
  								
  								<?php if($movies_info->subtitle_on_off): ?>
  								<!-- video subtitle -->
								<?php if($movies_info->subtitle_url1): ?>
									<track kind="captions" src="<?php echo e($movies_info->subtitle_url1); ?>"   label="<?php echo e($movies_info->subtitle_language1?$movies_info->subtitle_language1:'English'); ?>" default>		
								<?php endif; ?>
								<?php if($movies_info->subtitle_url2): ?>
									<track kind="captions" src="<?php echo e($movies_info->subtitle_url2); ?>"   label="<?php echo e($movies_info->subtitle_language2?$movies_info->subtitle_language2:'English'); ?>">		
								<?php endif; ?>
								<?php if($movies_info->subtitle_url3): ?>
									<track kind="captions" src="<?php echo e($movies_info->subtitle_url3); ?>"    label="<?php echo e($movies_info->subtitle_language3?$movies_info->subtitle_language3:'English'); ?>">		
								<?php endif; ?>	
								<?php endif; ?>

								<!-- worning text if needed -->
								<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
							</video>
						</div>

						<?php elseif($movies_info->video_type=="URL"): ?>
						  <div id="container">                   
							<video id="v_player" class="video-js vjs-big-play-centered skin-blue vjs-16-9" controls preload="auto" playsinline width="640" height="450" poster="<?php echo e(URL::to('upload/source/'.$movies_info->video_image)); ?>" data-setup="{}" <?php if(get_player_cong('autoplay')=="true"): ?>autoplay="true"<?php endif; ?>>
							  	
							  	<!-- video source -->
							  	<source src="<?php echo e($movies_info->video_url); ?>" type="video/mp4" label='Auto' res='360' default/>  

							  	<?php if($movies_info->video_quality): ?>	

							  	<?php if($movies_info->video_url_480): ?>
							   	<source src="<?php echo e($movies_info->video_url_480); ?>" type='video/mp4' label='480P' res='480'/>
							   	<?php endif; ?>	
							   	
							   	<?php if($movies_info->video_url_720): ?>
							    <source src="<?php echo e($movies_info->video_url_720); ?>" type='video/mp4' label='720P' res='720'/>							    	
							    <?php endif; ?>

							    <?php if($movies_info->video_url_1080): ?>
							    <source src="<?php echo e($movies_info->video_url_1080); ?>" type='video/mp4' label='1080P' res='1080'/>						  
							    <?php endif; ?>	

							    <?php endif; ?>
								
								<?php if($movies_info->subtitle_on_off): ?>
							    <!-- video subtitle -->
								<?php if($movies_info->subtitle_url1): ?>
									<track kind="captions" src="<?php echo e($movies_info->subtitle_url1); ?>"   label="<?php echo e($movies_info->subtitle_language1?$movies_info->subtitle_language1:'English'); ?>" default>		
								<?php endif; ?>
								<?php if($movies_info->subtitle_url2): ?>
									<track kind="captions" src="<?php echo e($movies_info->subtitle_url2); ?>"   label="<?php echo e($movies_info->subtitle_language2?$movies_info->subtitle_language2:'English'); ?>">		
								<?php endif; ?>
								<?php if($movies_info->subtitle_url3): ?>
									<track kind="captions" src="<?php echo e($movies_info->subtitle_url3); ?>"    label="<?php echo e($movies_info->subtitle_language3?$movies_info->subtitle_language3:'English'); ?>">		
								<?php endif; ?>	
								<?php endif; ?>		 
								<!-- worning text if needed -->
								<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
							</video>
							
						</div>                
						<?php else: ?>
						<div id="container">
						  <video id="v_player" class="video-js vjs-big-play-centered skin-blue vjs-16-9" controls preload="auto" playsinline width="640" height="450" poster="<?php echo e(URL::to('upload/source/'.$movies_info->video_image)); ?>" data-setup="{}" <?php if(get_player_cong('autoplay')=="true"): ?>autoplay="true"<?php endif; ?>>
							
							<!-- video source -->				  	   
							<source src="<?php echo e(URL::to('upload/source/'.$movies_info->video_url)); ?>" type="video/mp4" label='Auto' res='360' default/>  
							
							<?php if($movies_info->video_quality): ?>
								<?php if($movies_info->video_url_480): ?>
								<source src="<?php echo e(URL::to('upload/source/'.$movies_info->video_url_480)); ?>" type='video/mp4' label='480P' res='480'/>
								<?php endif; ?>	
									
								<?php if($movies_info->video_url_720): ?>	
							    <source src="<?php echo e(URL::to('upload/source/'.$movies_info->video_url_720)); ?>" type='video/mp4' label='720P' res='720'/>
							    <?php endif; ?>	
							    	
							    <?php if($movies_info->video_url_1080): ?>	
							    <source src="<?php echo e(URL::to('upload/source/'.$movies_info->video_url_1080)); ?>" type='video/mp4' label='1080P' res='1080'/>   
								<?php endif; ?>	  
							<?php endif; ?>	  
							 
							<!-- video subtitle -->
							<?php if($movies_info->subtitle_on_off): ?>
								<?php if($movies_info->subtitle_url1): ?>
									<track kind="captions" src="<?php echo e($movies_info->subtitle_url1); ?>"  label="<?php echo e($movies_info->subtitle_language1?$movies_info->subtitle_language1:'English'); ?>" default>		
								<?php endif; ?>
								<?php if($movies_info->subtitle_url2): ?>
									<track kind="captions" src="<?php echo e($movies_info->subtitle_url2); ?>" label="<?php echo e($movies_info->subtitle_language2?$movies_info->subtitle_language2:'English'); ?>">		
								<?php endif; ?>
								<?php if($movies_info->subtitle_url3): ?>
									<track kind="captions" src="<?php echo e($movies_info->subtitle_url3); ?>"  label="<?php echo e($movies_info->subtitle_language3?$movies_info->subtitle_language3:'English'); ?>">		
								<?php endif; ?>    
							<?php endif; ?>					 
								<!-- worning text if needed -->
								<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
							</video>
						</div>
						<?php endif; ?>
						
					  </main> 

					  <div id="theater_mode_width">

					  <h3 class="vfx_video_title"><?php echo e(stripslashes($movies_info->video_title)); ?></h3> 
					  <ul class="channel_content_info">
						<?php if($movies_info->release_date): ?>
						<li><i class="fa fa-calendar"></i> <?php echo e(isset($movies_info->release_date) ? date('M d Y',$movies_info->release_date) : null); ?></li>
						<?php endif; ?> 
					   <?php if($movies_info->duration): ?> 
					   <li><i class="fa fa-clock-o"></i> <?php echo e($movies_info->duration); ?></li>
					   <?php endif; ?>
					   <?php if($movies_info->imdb_rating): ?> 
					   <li><img src="<?php echo e(URL::to('site_assets/images/icons/imdb-logo.png')); ?>" alt="IMDb Rating"> &nbsp;<b><?php echo e($movies_info->imdb_rating); ?></b></li>
					   <?php endif; ?>

					   <?php if($movies_info->download_enable): ?>
			             <li>
			                <div class="video_download_btn">
			               <a href="<?php echo e($movies_info->download_url); ?>" target="_blank"><i class="fa fa-download"></i> <?php echo e(trans('words.download')); ?></a> 
			                          
			              </div>
			             </li>
			            <?php endif; ?>
					  </ul> 
					   
					  <div class="video-attributes dtl_video">
						<div class="single-footer">
							<div class="row">
								<div class="col-md-5 col-xs-12">
									<div class="news-share">
										<label><?php echo e(trans('words.share_text')); ?>: </label>
										<div class="share-social">
											<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(url()->current()); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
											<a href="https://twitter.com/intent/tweet?text=<?php echo e($movies_info->video_title); ?>&amp;url=<?php echo e(url()->current()); ?>"><i class="fa fa-twitter"></i></a>
											<a href="http://pinterest.com/pin/create/button/?url=<?php echo e(url()->current()); ?>&media=<?php echo e(URL::to('upload/source/'.$movies_info->video_image)); ?>&description=<?php echo e($movies_info->video_title); ?>"><i class="fa fa-pinterest"></i></a>
											<a href="whatsapp://send?text=<?php echo e(url()->current()); ?>" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a>

										</div>
									</div>
								</div>
								<div class="col-md-7 col-xs-12">
									 <div class="news-tag">
										<?php $__currentLoopData = explode(',',$movies_info->movie_genre_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genres_ids): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<p><b><a href="<?php echo e(URL::to('genres/movies/'.App\Genres::getGenresInfo($genres_ids,'genre_slug'))); ?>"><?php echo e(App\Genres::getGenresInfo($genres_ids,'genre_name')); ?></a></b></p>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  

										<p><a href="<?php echo e(URL::to('language/movies/'.App\Language::getLanguageInfo($movies_info->movie_lang_id,'language_slug'))); ?>"><b><?php echo e(App\Language::getLanguageInfo($movies_info->movie_lang_id,'language_name')); ?></b></a></p>
									</div>
								</div>
							</div>
						</div> 							  
					  </div>  
					 <div class="clearfix"></div> 	
					 <?php if(get_ads('movie_single_ad_top')->status!=0): ?>
					  <div class="add_banner_section">					     
					      <div class="row">
					        <div class="col-md-12">
					          <?php echo get_ads('movie_single_ad_top')->ad_code; ?>

					        </div>
					      </div>					     
					  </div>
					  <?php endif; ?> 

					 <div class="single-section video-entry mr-top-20" id="episodes_all">
						  <h3 class="single-vfx_section_title"><?php echo e(trans('words.description')); ?></h3>
						  <div class="section-content">
							 <?php if(strlen($movies_info->video_description) > 500): ?>
								 <div class="listing-section">
								  <div class="show-more">
									<div class="pricing-list-container">
									   <?php echo stripslashes($movies_info->video_description); ?>

									</div>
								  </div>
								  <a href="#" class="show-more-button" data-more-title="Show More" data-less-title="Show Less"><i class="fa fa-angle-down"></i></a> 
								</div>
							 <?php else: ?>
							 	<?php echo stripslashes($movies_info->video_description); ?>	
							 <?php endif; ?>	
						  </div>

						</div> 	
					</div>	

					</div>
					<div class="col-md-4 col-sm-12 col-xs-12" id="right_sidebar_hide">             
					  <div class="sidebar_playlist movie_sidebar_playlist_block">
						<div class="caption">
						   <div class="left"> <a href="#"><i class="fa fa-list"></i> <?php echo e(trans('words.latest_movies')); ?></a> </div>               
						   <div class="clearfix"></div>
						</div>
						<?php $__currentLoopData = $latest_movies_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latest_movies_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="playlist_item">
						  <a href="<?php echo e(URL::to('movies/'.$latest_movies_data->video_slug.'/'.$latest_movies_data->id)); ?>">
							<div class="sidebar_movie_item">
								<?php if(file_exists(public_path('upload/source/'.$latest_movies_data->video_image))): ?>
								<img src="<?php echo e(URL::to('upload/source/'.$latest_movies_data->video_image)); ?>" alt="show" />
								<?php else: ?>
								<img src="<?php echo e(URL::to('upload/thumbs/'.$latest_movies_data->video_image)); ?>" alt="show" />
								<?php endif; ?>
							</div>
							<div class="playlist_content">
							  <h3><?php echo e(Str::limit(stripslashes($latest_movies_data->video_title),20)); ?></h3>
							  <p class="vfx_video_length"><?php echo Str::limit(stripslashes(strip_tags($latest_movies_data->video_description)),50); ?>

							  </p>

							 </div>        
						  </a>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							   
					  </div> 

					    <?php if(get_ads('movie_single_ad_sidebar')->status!=0): ?>
						<div class="add_banner_section">					     
						  <div class="row">
						    <div class="col-md-12">
						      <?php echo get_ads('movie_single_ad_sidebar')->ad_code; ?>

						    </div>
						  </div>					     
						</div>
						<?php endif; ?>

					</div>
				  </div>                

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
   
  <div class="section section-padding top-padding-normal vfx_movie_section_block">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-xs-12">
          <div class="vfx_section_header">
            <h2 class="vfx_section_title"><?php echo e(trans('words.you_may_like')); ?></h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="owl-carousel video-carousel" id="video-carousel">
          <?php $__currentLoopData = $related_movies_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movies_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>            
           <?php if(Auth::check()): ?>              
          <a class="icon" href="<?php echo e(URL::to('movies/'.$movies_data->video_slug.'/'.$movies_data->id)); ?>"> 
	      <?php else: ?>
	         <?php if($movies_data->video_access=='Paid'): ?>
	          <a class="icon" href="Javascript::void();" data-toggle="modal" data-target="#loginAlertModal">
	         <?php else: ?>
	          <a class="icon" href="<?php echo e(URL::to('movies/'.$movies_data->video_slug.'/'.$movies_data->id)); ?>">
	         <?php endif; ?>  
	      <?php endif; ?>	
           <div class="vfx_video_item">
              <div class="thumb-wrap"> <img src="<?php echo e(URL::to('upload/source/'.$movies_data->video_image_thumb)); ?>" alt="Movie Thumb"> <?php if($movies_data->video_access=='Paid'): ?><span class="premium_video"><i class="fa fa-lock"></i>Premium</span><?php endif; ?>
                <div class="thumb-hover"> 
            
                <i class="icon fa fa-play"></i><span class="ripple"></span>
            
              </div>
              </div>
              <div class="vfx_video_detail">
                <h4 class="vfx_video_title"><?php echo e(Str::limit(stripslashes($movies_data->video_title),12)); ?></h4>
                <p class="vfx_video_length"><i class="fa fa-clock-o"></i> <?php echo e($movies_data->duration); ?></p>                
               </div>
            </div>
          </a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       
        </div>
      </div>
    </div>
  </div>

</div>

	<?php if(get_ads('movie_single_ad_bottom')->status!=0): ?>
	<div class="add_banner_section">					     
	  <div class="row">
	    <div class="col-md-12">
	      <?php echo get_ads('movie_single_ad_bottom')->ad_code; ?>

	    </div>
	  </div>					     
	</div>
	<?php endif; ?> 


<?php if($movies_info->video_type!="Embed"): ?>

<script src="https://www.gstatic.com/cv/js/sender/v1/cast_sender.js?loadCastFramework=1"></script>

<script src="<?php echo e(URL::asset('site_assets/videojs_player/js/videojs.min.js')); ?>"></script>

<script src="<?php echo e(URL::asset('site_assets/videojs_player/plugins/videojs.pip.js')); ?>"></script> 

 <!--<script src="https://cdn.jsdelivr.net/npm/@silvermine/videojs-chromecast@1.2.1/dist/silvermine-videojs-chromecast.min.js"></script> -->

 <script src="<?php echo e(URL::asset('site_assets/videojs_player/plugins/videojs-chromecast.min.js')); ?>"></script>
  
 
<script>
        var player = videojs('v_player',{techOrder:['chromecast','html5']});
    
        player.viavi({
            shareMenu: false,
            <?php if(get_player_cong('player_watermark')=="ON"): ?>
            logo: "<?php echo e(get_player_cong('player_logo')? URL::asset('upload/source/'.get_player_cong('player_logo')) : URL::asset('upload/source/'.getcong('site_logo'))); ?>",
            logoposition: '<?php echo e(get_player_cong('player_logo_position')); ?>',
            logourl: '<?php echo e(get_player_cong('player_url')?get_player_cong('player_url'):URL::to('/')); ?>',
            <?php endif; ?>

            video_id: 'movie<?php echo e($movies_info->id); ?>',
            resume: true,
            contextMenu: false,
            <?php if(get_player_cong('rewind_forward')=="ON"): ?>
            buttonRewind: true,
            buttonForward: true,            
        	<?php else: ?>
        	buttonRewind: false,
        	buttonForward: false,
        	<?php endif; ?>            
            mousedisplay:true,
            textTrackSettings: false,
            <?php if(get_player_cong('theater_mode')=="ON"): ?>
            theaterButton: true            
        	<?php else: ?>
        	theaterButton: false
        	<?php endif; ?>

        });

        player.pip();

        
        player.chromecast({ metatitle: '<?php echo e(stripslashes($movies_info->video_title)); ?>', metasubtitle: 'Release : <?php echo e(isset($movies_info->release_date) ? date('M d Y',$movies_info->release_date) : null); ?>' });         
   		
   		<?php if(get_player_cong('player_ad_on_off')=="ON"): ?>           
        player.vroll({src:"<?php echo e(get_player_cong('ad_video_url')); ?>",type:"video/mp4",href:"<?php echo e(get_player_cong('ad_web_url')); ?>",offset:"<?php echo e(get_player_cong('ad_offset')); ?>",skip:"<?php echo e(get_player_cong('ad_skip')); ?>",id:1});
        <?php endif; ?>


         player.on('vroll', function(event, data) {
            var ad_id = data.id;
            var action = data.action;

            //alert(ad_id);
            //alert(action);

           });

         player.on('mode',function(event,mode) {
			if(mode=='large'){
				document.querySelector("#left_video_player").style.width='100%';
				document.querySelector("#right_sidebar_hide").style.display='none';
				document.querySelector("#theater_mode_width").style.width='66%';
				
			}else{
				document.querySelector("#left_video_player").style.width='';
				document.querySelector("#right_sidebar_hide").style.display='block';
				document.querySelector("#theater_mode_width").style.width='100%';
			}
		});
         
        /*limit: 20, //Video will stop playing after 20 seconds
            limiturl: "#",
            limitimage: "http://localhost/laravel_video_script_update/upload/source/logo.png"*/
    </script>

        
    <!-- hotkeys -->
    <script src="<?php echo e(URL::asset('site_assets/videojs_player/plugins/hotkeys/videojs.hotkeys.min.js')); ?>"></script>
    <script>    
      player.ready(function() {
        this.hotkeys({
            volumeStep: 0.1,
			seekStep: 5,
			alwaysCaptureHotkeys: true
        });
      });
    </script>
    <!-- End hotkeys --> 


 <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('site_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\viaviweb\resources\views/pages/movies_single.blade.php ENDPATH**/ ?>
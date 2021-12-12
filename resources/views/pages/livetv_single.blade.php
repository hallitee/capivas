@extends('site_app')
 

@if($tv_info->seo_title)
	@section('head_title', stripslashes($tv_info->seo_title).' | '.getcong('site_name'))
@else
	@section('head_title', stripslashes($tv_info->channel_name).' | '.getcong('site_name') )
@endif

@if($tv_info->seo_description)
	@section('head_description', stripslashes($tv_info->seo_description))
@else
	@section('head_description', Str::limit(stripslashes($tv_info->channel_description),160))
@endif

@if($tv_info->seo_keyword)
	@section('head_keywords', stripslashes($tv_info->seo_keyword)) 
@endif


@section('head_image', URL::to('upload/source/'.$tv_info->channel_thumb) )

@section('head_url', Request::url())

@section('content')
  
 
 @if(get_player_cong('player_style')!="")  
  <link href="{{ URL::asset('site_assets/videojs_player/css/'.get_player_cong('player_style').'.min.css') }}" rel="stylesheet" type="text/css" />    
 @else
  <link href="{{ URL::asset('site_assets/videojs_player/css/videojs_style1.min.css') }}" rel="stylesheet" type="text/css" />
 @endif

 
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
  @if(get_player_cong('pip_mode')=="ON")
  display: block!important;
  @else
  display: none!important;
  @endif
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

            @if($tv_info->channel_url_type=="embed")

              <div class="videoWrapper">{!! $tv_info->channel_url!!}</div>

            @elseif($tv_info->channel_url_type=="hls")
              
              <div id="container">                   
              <video id="v_player" class="video-js vjs-big-play-centered skin-blue vjs-16-9" controls preload="auto" playsinline crossorigin="anonymous" width="640" height="450" poster="{{URL::to('upload/source/'.$tv_info->channel_thumb)}}" data-setup="{}" @if(get_player_cong('autoplay')=="true")autoplay="true"@endif>
                  
                  <!-- video source -->
                  @if(isset($_GET['server']) AND $_GET['server']==2)
                  <source src="{{$tv_info->channel_url2}}" type="application/x-mpegURL" /> 
                  @elseif(isset($_GET['server']) AND $_GET['server']==3)
                  <source src="{{$tv_info->channel_url3}}" type="application/x-mpegURL" /> 
                  @else
                  <source src="{{$tv_info->channel_url}}" type="application/x-mpegURL" /> 
                  @endif
                   
                  
                 

                <!-- worning text if needed -->
                <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
              </video>
            </div>

            @elseif($tv_info->channel_url_type=="dash")

            <div id="container">                   
              <video id="v_player" class="video-js vjs-big-play-centered skin-blue vjs-16-9" controls preload="auto" playsinline crossorigin="anonymous" width="640" height="450" poster="{{URL::to('upload/source/'.$tv_info->channel_thumb)}}" data-setup="{}" @if(get_player_cong('autoplay')=="true")autoplay="true"@endif>
                  
                  <!-- video source -->
                  @if(isset($_GET['server']) AND $_GET['server']==2)
                  <source src="{{$tv_info->channel_url2}}" type="application/dash+xml" /> 
                  @elseif(isset($_GET['server']) AND $_GET['server']==3)
                  <source src="{{$tv_info->channel_url3}}" type="application/dash+xml" /> 
                  @else
                  <source src="{{$tv_info->channel_url}}" type="application/dash+xml" /> 
                  @endif
                   
                   
                <!-- worning text if needed -->
                <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
              </video>
            </div>  

            @else
                <?php 
                parse_str( parse_url( $tv_info->channel_url, PHP_URL_QUERY ), $my_array_of_vars );

                $youtube_id=$my_array_of_vars['v'];
                ?>
                <div class="videoWrapper">
                  <iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{$youtube_id}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>    

            @endif  

										 
					  </main> 

            <div id="theater_mode_width">

					  <h3 class="vfx_video_title">{{stripslashes($tv_info->channel_name)}}</h3> 
            <ul class="channel_content_info">
              @if($tv_info->channel_url2!='' OR $tv_info->channel_url3!='')
              <li>
                  <div class="video_download_btn @if(!isset($_GET['server'])) server_active @endif">
                     <a href="{{ URL::to('live-tv/'.$tv_info->channel_slug.'/'.$tv_info->id) }}"><i class="fa fa-tv"></i> {{trans('words.server_1')}}</a>
                   </div>
              </li>
              @endif
              @if($tv_info->channel_url2)
              <li>
                  <div class="video_download_btn @if(isset($_GET['server']) AND $_GET['server']==2) server_active @endif">
                     <a href="{{ URL::to('live-tv/'.$tv_info->channel_slug.'/'.$tv_info->id) }}?server=2"><i class="fa fa-tv"></i> {{trans('words.server_2')}}</a>
                   </div>
              </li>
              @endif
              @if($tv_info->channel_url3)
              <li>
                  <div class="video_download_btn @if(isset($_GET['server']) AND $_GET['server']==3) server_active @endif">
                     <a href="{{ URL::to('live-tv/'.$tv_info->channel_slug.'/'.$tv_info->id) }}?server=3"><i class="fa fa-tv"></i> {{trans('words.server_3')}}</a>
                   </div>
              </li>
              @endif
               
            </ul>  
					  <div class="video-attributes dtl_video">
						<div class="single-footer">
							<div class="row">
								<div class="col-md-5 col-xs-12">
									<div class="news-share">
										<label>{{trans('words.share_text')}}: </label>
										<div class="share-social">
											<a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" target="_blank"><i class="fa fa-facebook"></i></a>
											<a href="https://twitter.com/intent/tweet?text={{$tv_info->channel_name}}&amp;url={{url()->current()}}"><i class="fa fa-twitter"></i></a>
											<a href="http://pinterest.com/pin/create/button/?url={{url()->current()}}&media={{URL::to('upload/source/'.$tv_info->channel_thumb)}}&description={{$tv_info->channel_name}}"><i class="fa fa-pinterest"></i></a>
											<a href="whatsapp://send?text={{url()->current()}}" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a>
										</div>
									</div>
								</div>
								<div class="col-md-7 col-xs-12">									 
								</div>
							</div>
						</div> 							  
					  </div>
					  <div class="clearfix"></div>
					  @if(get_ads('livetv_single_ad_top')->status!=0)
					  <div class="add_banner_section">					     
					      <div class="row">
					        <div class="col-md-12">
					          {!!get_ads('livetv_single_ad_top')->ad_code!!}
					        </div>
					      </div>					     
					  </div>
					  @endif

					  <div class="single-section video-entry mr-top-20" id="episodes_all">
						  <h3 class="single-vfx_section_title">{{trans('words.description')}}</h3>
						  <div class="section-content">
							@if(strlen($tv_info->channel_description) > 500)
							<div class="listing-section">
								  <div class="show-more">
									<div class="pricing-list-container">
									   {!!stripslashes($tv_info->channel_description)!!}
									</div>
								  </div>
								  <a href="#" class="show-more-button" data-more-title="Show More" data-less-title="Show Less"><i class="fa fa-angle-down"></i></a> 
							</div>
							@else
                				{!!stripslashes($tv_info->channel_description)!!}
							@endif
						  </div>
						</div>	

           </div> 

					</div>
					<div class="col-md-4 col-sm-12 col-xs-12" id="right_sidebar_hide">            
					  @if(get_ads('livetv_single_ad_sidebar')->status!=0)
						<div class="add_banner_section">					     
						  <div class="row">
						    <div class="col-md-12">
						      {!!get_ads('livetv_single_ad_sidebar')->ad_code!!}
						    </div>
						  </div>					     
						</div>
						@endif
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
            <h2 class="vfx_section_title">{{trans('words.you_may_like')}}</h2>
          </div>
        </div>
      </div>
      <div class="row">      	 
        <div class="owl-carousel video-carousel vfx_tvshow_carousel" id="vfx_tvshow_carousel">
        @foreach($related_livetv_list as $related_data)
            <a href="{{ URL::to('live-tv/'.$related_data->channel_slug.'/'.$related_data->id) }}">
              <div class="vfx_video_item">
				<div class="vfx_upcomming_item_block"> 
			    	<img class="img-responsive" src="{{URL::to('upload/source/'.$related_data->channel_thumb)}}" alt="show"> 
				</div>	
                <div class="vfx_upcomming_detail">
                  <h4 class="vfx_video_title">{{Str::limit(stripslashes($related_data->channel_name),25)}}</h4>
                </div>                         
             </div>
           </a>
        @endforeach
        </div>         
      </div>
    </div>
  </div>
   
</div>

@if(get_ads('livetv_single_ad_bottom')->status!=0)
<div class="add_banner_section">					     
  <div class="row">
    <div class="col-md-12">
      {!!get_ads('livetv_single_ad_bottom')->ad_code!!}
    </div>
  </div>					     
</div>
@endif

@if($tv_info->channel_url_type!="embed" AND $tv_info->channel_url_type!="youtube")

 
<script src="https://www.gstatic.com/cv/js/sender/v1/cast_sender.js?loadCastFramework=1"></script>

<script src="{{ URL::asset('site_assets/videojs_player/js/videojs.min.js') }}"></script>

<script src="{{ URL::asset('site_assets/videojs_player/plugins/videojs.pip.js') }}"></script> 
 
<script src="{{ URL::asset('site_assets/videojs_player/plugins/videojs-chromecast.min.js') }}"></script>
  
<script>
        
        var player = videojs('v_player',{techOrder:['chromecast','html5']});

        player.viavi({
            shareMenu: false,

            @if(get_player_cong('player_watermark')=="ON")
            logo: "{{ get_player_cong('player_logo')? URL::asset('upload/source/'.get_player_cong('player_logo')) : URL::asset('upload/source/'.getcong('site_logo')) }}",
            logoposition: '{{get_player_cong('player_logo_position')}}',
            logourl: '{{ get_player_cong('player_url')?get_player_cong('player_url'):URL::to('/') }}',
            @endif

            video_id: 'tv{{$tv_info->id}}',
            resume: true,
            contextMenu: false,
            @if(get_player_cong('rewind_forward')=="ON")
            buttonRewind: true,
            buttonForward: true,            
            @else
            buttonRewind: false,
            buttonForward: false,
            @endif            
            mousedisplay:true,
            textTrackSettings: false,
            @if(get_player_cong('theater_mode')=="ON")
            theaterButton: true            
            @else
            theaterButton: false
            @endif            

        });

        player.pip();

        player.chromecast({ metatitle: '{{stripslashes($tv_info->channel_name)}}', metasubtitle: 'Live TV' }); 
        
        @if(get_player_cong('player_ad_on_off')=="ON")           
        player.vroll({src:"{{get_player_cong('ad_video_url')}}",type:"video/mp4",href:"{{get_player_cong('ad_web_url')}}",offset:"{{get_player_cong('ad_offset')}}",skip:"{{get_player_cong('ad_skip')}}",id:1});
        @endif
          

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
         
    </script>

        
    <!-- hotkeys -->
    <script src="{{ URL::asset('site_assets/videojs_player/plugins/hotkeys/videojs.hotkeys.min.js') }}"></script>
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
 
 @endif

@endsection
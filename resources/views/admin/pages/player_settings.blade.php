@extends("admin.admin_app")

@section("content")

<style type="text/css">
  .iframe-container {
  overflow: hidden;
  padding-top: 56.25% !important;
  position: relative;
}
 
.iframe-container iframe {
   border: 0;
   height: 100%;
   left: 0;
   position: absolute;
   top: 0;
   width: 100%;
}
</style>
 
  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-box">
                 
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if(Session::has('flash_message'))
                      <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                          {{ Session::get('flash_message') }}
                      </div>
                @endif
                

                 {!! Form::open(array('url' => array('admin/player_settings'),'class'=>'form-horizontal','name'=>'player_settings','id'=>'player_settings','role'=>'form','enctype' => 'multipart/form-data')) !!}  
                  
                  <input type="hidden" name="id" value="{{ isset($settings->id) ? $settings->id : null }}">
                  <div class="row">

                  <div class="col-md-6">
                  <h4 class="m-t-0 m-b-30 header-title" style="font-size: 20px;">{{trans('words.player_options')}}</h4>

                  <br/>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.player_style')}}</label>
                      <div class="col-sm-8">
                            <select class="form-control" name="player_style">                               
                                 
                                <option value="videojs_style1" @if($settings->player_style=="videojs_style1") selected @endif>Style 1</option>
                                <option value="videojs_style2" @if($settings->player_style=="videojs_style2") selected @endif>Style 2</option>
                                <option value="videojs_style3" @if($settings->player_style=="videojs_style3") selected @endif>Style 3</option>
                                <option value="videojs_style4" @if($settings->player_style=="videojs_style4") selected @endif>Style 4</option>
                                  
                            </select>
                      </div>
                  </div> 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.autoplay')}}</label>
                    <div class="col-sm-8">
                       <select class="form-control" name="autoplay">
                                <option value="true" @if($settings->autoplay=="true") selected @endif>ON</option>
                                <option value="false" @if($settings->autoplay=="false") selected @endif>OFF</option>
                                  
                        </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.theater_mode')}}</label>
                    <div class="col-sm-8">
                       <select class="form-control" name="theater_mode">
                                <option value="ON" @if($settings->theater_mode=="ON") selected @endif>ON</option>
                                <option value="OFF" @if($settings->theater_mode=="OFF") selected @endif>OFF</option>
                                  
                        </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.pip_mode')}}</label>
                    <div class="col-sm-8">
                       <select class="form-control" name="pip_mode">
                                <option value="ON" @if($settings->pip_mode=="ON") selected @endif>ON</option>
                                <option value="OFF" @if($settings->pip_mode=="OFF") selected @endif>OFF</option>
                                  
                        </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.rewind_forward')}}</label>
                    <div class="col-sm-8">
                       <select class="form-control" name="rewind_forward">
                                <option value="ON" @if($settings->rewind_forward=="ON") selected @endif>ON</option>
                                <option value="OFF" @if($settings->rewind_forward=="OFF") selected @endif>OFF</option>
                                  
                        </select>
                    </div>
                  </div> 
                  <hr>
                  <h4 class="m-t-0 header-title" >{{trans('words.player_watermark')}}</h4>

                  <br/>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.watermark')}}</label>
                    <div class="col-sm-8">
                       <select class="form-control" name="player_watermark">
                                <option value="ON" @if($settings->player_watermark=="ON") selected @endif>ON</option>
                                <option value="OFF" @if($settings->player_watermark=="OFF") selected @endif>OFF</option>
                                  
                        </select>
                    </div>
                  </div>
 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.player_logo')}} <small id="emailHelp" class="form-text text-muted">({{trans('words.recommended_resolution')}} : 180x50)</small></label>
                    <div class="col-sm-8">
                      <div class="input-group">

                        <input type="text" name="player_logo" id="player_logo" value="{{ isset($settings->player_logo) ? $settings->player_logo : null }}" class="form-control" readonly>
                        <div class="input-group-append">                           
                          <button type="button" class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#model_poster">Select</button>
                      
                        </div>
                      </div>
                     
                    </div>
                  </div>                 

                  @if(isset($settings->player_logo)) 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                    <div class="col-sm-8">
                                                                         
                           <img src="{{URL::to('upload/source/'.$settings->player_logo)}}" alt="video image" class="img-thumbnail" width="200">                        
                       
                    </div>
                  </div>
                  @endif
                  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.player_logo_position')}}</label>
                      <div class="col-sm-8">
                            <select class="form-control" name="player_logo_position">                               
                                 
                                <option value="RT" @if($settings->player_logo_position=="RT") selected @endif>Right Top</option>
                                <option value="LT" @if($settings->player_logo_position=="LT") selected @endif>Left Top</option>
                                  
                            </select>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.player_url')}}*</label>
                    <div class="col-sm-8">
                      <input type="text" name="player_url" value="{{ isset($settings->player_url) ? $settings->player_url : null }}" class="form-control">
                    </div>
                  </div>


                  </div>
                  <div class="col-md-6">
                  <h4 class="m-t-0 m-b-30 header-title" style="font-size: 20px;">{{trans('words.player_ads')}}</h4>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.player_ad_on')}}</label>
                      <div class="col-sm-8">
                            <select class="form-control" name="player_ad_on_off">                               
                                 
                                <option value="ON" @if($settings->player_ad_on_off=="ON") selected @endif>ON</option>
                                <option value="OFF" @if($settings->player_ad_on_off=="OFF") selected @endif>OFF</option>
                                  
                            </select>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.ad_offset')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="ad_offset" value="{{ isset($settings->ad_offset) ? $settings->ad_offset : null }}" class="form-control" placeholder="0">

                      <small id="emailHelp" class="form-text text-muted">
                        Preroll Ad Set offset=0 <br>
                        Midroll Ad Set offset=50% OR  offset=30 (30 is seconds)<br>
                        Postroll Ad Set offset=100% 
                      </small>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.ad_skip')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="ad_skip" value="{{ isset($settings->ad_skip) ? $settings->ad_skip : null }}" class="form-control" placeholder="5">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.ad_web_url')}}</label>
                    <div class="col-sm-8">
                      <input type="url" name="ad_web_url" value="{{ isset($settings->ad_web_url) ? $settings->ad_web_url : null }}" class="form-control" placeholder="URL to go on click">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.ad_video_type')}}</label>
                      <div class="col-sm-8">
                            <select class="form-control" name="ad_video_type" id="video_type">                               
                                <option value="Local" @if(isset($settings->ad_video_type) AND $settings->ad_video_type=="Local") selected @endif>Local</option>
                                <option value="URL" @if(isset($settings->ad_video_type) AND $settings->ad_video_type=="URL") selected @endif>URL</option>
                                                             
                            </select>
                      </div>
                  </div>
                  <div class="form-group row" id="local_id" @if($settings->ad_video_type!="Local") style="display:none;" @endif>

                    
                    <label class="col-sm-3 col-form-label">{{trans('words.ad_video_file')}} <small id="emailHelp" class="form-text text-muted"></small></label>
                    <div class="col-sm-8">
                      <div class="input-group">

                        <input type="text" name="video_url_local" id="video_url" value="{{ isset($settings->ad_video_url) ? basename($settings->ad_video_url) : null }}" class="form-control" readonly>
                        <div class="input-group-append">                           
                          <button type="button" class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#model_ad_video_url">Select</button>
                      
                        </div>
                      </div>
                     
                    </div>
                     
                    </div>
                   

                  <div class="form-group row" id="url_id" @if($settings->ad_video_type!="URL" AND $settings->ad_video_type!="") style="display:none;" @endif>
 
                    <label class="col-sm-3 col-form-label">{{trans('words.ad_video_url')}} <small id="emailHelp" class="form-text text-muted"></small></label>
                     <div class="col-sm-8">
                      <input type="text" name="ad_video_url" value="{{ isset($settings->ad_video_url) ? $settings->ad_video_url : null }}" class="form-control" placeholder="http://example.com/demo.mp4">
                    </div>
 
                  </div>

                  <div class="form-group">
                    <div class="offset-sm-8 col-sm-9">
                      <button type="submit" class="btn btn-primary waves-effect waves-light"> {{trans('words.save_settings')}} </button>                      
                    </div>
                  </div>

                  </div>
                  </div> 
                  
                {!! Form::close() !!} 

                <div class="alert alert-danger"><b>Note:</b> This settings only work with web player</div>
              </div>
            </div>            
          </div>              
        </div>
      </div>
      @include("admin.copyright") 
    </div> 
 
<!--  Logo -->
<div id="model_poster" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 900px;">
        <div class="modal-content">             
            <div class="modal-body">
               <div class="iframe-container">
               <iframe src="{{URL::to('responsive_filemanager/filemanager/dialog.php?type=2&field_id=player_logo&relative_url=1')}}" frameborder="0"></iframe>
               </div>
            </div>
        </div> 
    </div> 
</div>

<!--  Ad Video file -->
<div id="model_ad_video_url" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="max-width: 900px;">
        <div class="modal-content">             
            <div class="modal-body">
               <div class="iframe-container">
               <iframe src="{{URL::to('responsive_filemanager/filemanager/dialog.php?type=2&sort_by=date&field_id=video_url&relative_url=1')}}" frameborder="0"></iframe>
               </div>
            </div>
        </div> 
    </div> 
</div> 


@endsection
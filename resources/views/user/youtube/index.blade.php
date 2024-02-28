@extends('layouts.app')
@section('css')
	<!-- Sweet Alert CSS -->
	<link href="{{URL::asset('plugins/sweetalert/sweetalert2.min.css')}}" rel="stylesheet" />
	<!-- Sweet Alert CSS -->
	<link href="{{URL::asset('plugins/sweetalert/sweetalert2.min.css')}}" rel="stylesheet" />
	<!-- RichText CSS -->
	<link href="{{URL::asset('plugins/richtext/richtext.min.css')}}" rel="stylesheet" />
	<!-- FilePond CSS -->
	<link href="{{URL::asset('plugins/filepond/filepond.css')}}" rel="stylesheet" />
	<!-- Green Audio Players CSS -->
	<link href="{{ URL::asset('plugins/audio-player/green-audio-player.css') }}" rel="stylesheet" />

	@endsection

@section('content')

<!-- <form id="openai-form" action="" method="post" enctype="multipart/form-data" class="mt-24">		
	@csrf -->
	<div class="row" id="image-side-space">
		<div class="row no-gutters justify-content-center">
			<div class=" text-center">
				<h3 class="card-title mt-6 fs-20"><i class="fa-solid fa-wand-magic-sparkles mr-2 text-primary"></i></i>Youtube Transcribt</h3>
				<h6 class="text-muted mb-7">Youtube summirize / transcript</h6>
				<div class="card-top d-flex text-right justify-content-right right mx-auto">
					<div class="mr-4">
						<p class="fs-11 text-muted pl-3"><i class="fa-sharp fa-solid fa-bolt-lightning mr-2 text-primary"></i>{{ __('Your Balance is') }} <span class="font-weight-semibold" id="balance-number">1000 Points</p>
					</div>
					
				</div>

				<div class="card mb-4 border-0 image-prompt-wrapper">
					<div class="card-body p-0">					
						<div class="image-prompt d-flex">
							<div class="input-box mb-0">								
								<div class="form-group">							    
									<input type="text" class="form-control" id="prompt" name="prompt" placeholder="Enter Youtube Your URL " required>
								</div> 
							</div> 
						
						</div>	
						
							
					</div>
				</div>
				<div class="mb-10">


								<button  type="submit" name="submit"   class="btn btn-primary pt-2 pb-2" id="article-generate">
									<i class="fa-sharp fa-solid fa-wand-magic-sparkles mr-2"></i>{{ __('Generate Article 2') }}
									<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="spinner-article"></span>
								</button>






								<button type="submit" name="submit" class="btn btn-primary pt-2 pb-2" id="generate-summary">
										<i class="fa-sharp fa-solid fa-wand-magic-sparkles mr-2"></i>{{ __('Generate Summary') }}
										<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="spinner-summary"></span>
									</button>

<button type="submit" name="submit" class="btn btn-primary pt-2 pb-2" id="generate-transcript">
    <i class="fa-sharp fa-solid fa-wand-magic-sparkles mr-2"></i>{{ __('Generate Transcript') }}
    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;" id="spinner-transcript"></span>
</button>

							</div>
<div id="message-box" style="display: none;"></div>





<!-- pppppppppppppppp -->

<div class="mt-10" style="
    margin-top: 15px;
">
			<div class="card border-0">
				<div class="card-body pb-2">
					<div class="row">						
						<div class="col-lg-4 col-md-12 col-sm-12">								
							<div class="input-box mb-2">								
								<div class="form-group">							    
									<input type="text" class="form-control @error('document') is-danger @enderror" id="document" name="document" value="Video Title">
									@error('document')
										<p class="text-danger">{{ $errors->first('document') }}</p>
									@enderror
								</div> 
							</div> 
						</div>
						<div class="col-lg-4 col-md-12 col-sm-12">
							<div class="d-flex" id="template-buttons-group">	
								<div>
									<a id="export-word" class="template-button mr-2" onclick="exportWord();" href="#"><i class="fa-solid fa-file-word table-action-buttons table-action-buttons-big view-action-button" data-tippy-content="{{ __('Export as Word Document') }}"></i></a>
								</div>	
								<div>
									<a id="export-txt" class="template-button mr-2" onclick="exportTXT();" href="#"><i class="fa-solid fa-file-lines table-action-buttons table-action-buttons-big view-action-button" data-tippy-content="{{ __('Download as Text File') }}"></i></a>
								</div>	
								<div>
									<a id="copy-button" class="template-button mr-2" onclick="copyText();" href="#"><i class="fa-solid fa-copy table-action-buttons table-action-buttons-big edit-action-button" data-tippy-content="{{ __('Copy Transcript') }}"></i></a>
								</div>
								<div>
									<a id="save-button" class="template-button" onclick="return saveText(this);" href="#"><i class="fa-solid fa-floppy-disk-pen table-action-buttons table-action-buttons-big delete-action-button" data-tippy-content="{{ __('Save Transcript') }}"></i></a>
								</div>					
							</div>
						</div>
					</div>

					<div class="row">
						<div class="mt-5 text-center" id="waveform-box">      
							<div class="row">
								<div class="col-sm-12">
									<div id="waveform">
										<audio style="display:none" id="media-element" src="" type=""></audio>
									</div> 
									<div id="wave-timeline"></div>
								</div>
								<div class="col-sm-12">
									<div id="controls" class="mt-4 mb-3">
										<a id="backwardBtn" class="result-play result-play-sm mr-2"><i class="fa fa-backward"></i></a>
										<a id="playBtn" class="result-play result-play-sm mr-2"><i class="fa fa-play"></i></a>
										<a id="stopBtn" class="result-play result-play-sm mr-2"><i class="fa fa-stop"></i></a>
										<a id="forwardBtn" class="result-play result-play-sm mr-2"><i class="fa fa-forward"></i></a>														
									</div> 
								</div>
							</div>                                            
						</div>
					</div>
				</div>
			</div>

			<div class="card border-0" id="template-output-transcript">
				<div class="card-body">
					<div>						
						<div id="template-textarea">						
							<div class="form-control" name="content" rows="12" id="richtext"></div>
						</div>	

						<!-- <div id="generating-message" class="text-muted"><span>{{ __('Transcribe your audio file easily') }}</span></div>	 -->

						<div id="generating-status" class="text-muted text-center">
							<p class="mb-2">{{ __('Transcribing the audio file, please wait') }}</p>
							<img src='{{ URL::asset("/img/svgs/code.svg") }}'>
						</div>
					</div>
				</div>
			</div>
		</div>
							
<!-- pppppppppppppppppppp -->





				<div id="negative-prompt" class="card mb-4 border-0 image-prompt-wrapper sd-feature hide-all">
					<div class="card-body p-0">					
						<div class="image-prompt d-flex">
							<div class="input-box negative mb-0">								
								<div class="form-group">							    
									<input type="text" class="form-control" name="negative_prompt" id="negative-prompt-input" placeholder="{{ __('Provide negative prompt to tell what you do not want to see in the generated image...') }}">
								</div> 
							</div> 
						</div>					
					</div>
				</div>

				<div id="sd-multi-prompting" class="sd-feature hide-all">
					<div class="mb-4 multi-prompts">				
						<div class="multi-prompt-input d-flex align-items-center">
							<div class="input-box w-100 mb-0">								
								<div class="form-group">							    
									<input type="text" class="form-control" name="multi_prompt[]" placeholder="{{ __('Describe what you want to see with phrases, and seperate them with commas...') }}">
								</div> 
							</div> 
							<a href="#" class="ml-4 mr-4 delete-prompt-input" data-toggle="remove-input" data-parent=".multi-prompt-input"><i class="fa-solid fa-trash"></i></a>
						</div>				
					</div>
					<div class="text-left mb-2">
						<a href="#" class="btn btn-primary pl-5 pr-5" data-toggle="add-more" data-target=".multi-prompts">{{ __('Add More') }}</a>
					</div>
				</div>

				<div id="sd-image-to-image" class="sd-feature hide-all">
					<div class="card mb-4 border-0">					
						<div class="image-upload-box text-center">
							<input type="file" class="image-select" name="sd_image_to_image" id="sd_image_to_image" accept="image/png" onchange="loadFile(event)">
							<div class="image-upload-icon">
								<i class="fa-solid fa-image-landscape fs-28 text-muted"></i>
							</div>
							<p class="text-dark font-weight-bold mb-2 mt-3">
								{{ __('Drop your image here or browse') }}
							</p>
							<p class="mb-0 text-muted fs-12">
								({{ __('PNG Images') }} / {{ __('5MB Max') }})
							</p>
							<img id="source-image"/>
						</div>
					</div>
				</div>

				<div id="sd-image-upscale" class="sd-feature hide-all">
					<div class="card mb-4 border-0">					
						<div class="image-upload-box text-center">
							<input type="file" class="image-select" name="sd_image_upscale" id="sd_image_upscale" accept="image/png" onchange="loadFileScale(event)">
							<div class="image-upload-icon">
								<i class="fa-solid fa-image-landscape fs-28 text-muted"></i>
							</div>
							<p class="text-dark font-weight-bold mb-2 mt-3">
								{{ __('Select your image that you want to upscale') }}
							</p>
							<p class="mb-0 text-muted fs-12">
								({{ __('PNG Images') }} / {{ __('5MB Max') }})
							</p>
							<img id="source-image-scale"/>
						</div>
					</div>
				</div>

				<div id="sd-image-masking" class="sd-feature hide-all">
					<div class="card mb-4 border-0">					
						<div class="image-upload-box text-center">
							<input type="file" class="image-select" name="sd_image_masking" id="sd_image_masking" accept="image/png" onchange="loadFileMask(event)">
							<div class="image-upload-icon">
								<i class="fa-solid fa-image-landscape fs-28 text-muted"></i>
							</div>
							<p class="text-dark font-weight-bold mb-2 mt-3">
								{{ __('Upload your image with transparent target area for inpainting') }}
							</p>
							<p class="mb-0 text-muted fs-12">
								({{ __('PNG Images') }} / {{ __('5MB Max') }})
							</p>
							<img id="source-image-mask"/>
						</div>
					</div>
				</div>

				<div id="openai-image-masking">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="card mb-4 border-0">					
								<div class="image-upload-box text-center">
									<input type="file" class="image-select" name="openai_image_masking_target" id="openai_image_masking_target" accept="image/png" onchange="loadFileMaskTarget(event)">
									<div class="image-upload-icon">
										<i class="fa-solid fa-image-landscape fs-28 text-muted"></i>
									</div>
									<p class="text-dark font-weight-bold mb-2 mt-3">
										{{ __('Upload your target image') }}
									</p>
									<p class="mb-0 text-muted fs-12">
										({{ __('Square PNG Images') }} / {{ __('4MB Max') }})
									</p>
									<img id="source-image-mask-target"/>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="card mb-4 border-0">					
								<div class="image-upload-box text-center">
									<input type="file" class="image-select" name="openai_image_masking_mask" id="openai_image_masking_mask" accept="image/png" onchange="loadFileMaskOpenai(event)">
									<div class="image-upload-icon">
										<i class="fa-solid fa-image-landscape fs-28 text-muted"></i>
									</div>
									<p class="text-dark font-weight-bold mb-2 mt-3">
										{{ __('Upload your mask image') }}
									</p>
									<p class="mb-0 text-muted fs-12">
										({{ __('Square PNG Images') }} / {{ __('4MB Max') }})
									</p>
									<img id="source-image-mask-openai"/>
								</div>
							</div>
						</div>
					</div>					
				</div>

				<div id="openai-image-variations">
					<div class="card mb-4 border-0">					
						<div class="image-upload-box text-center">
							<input type="file" class="image-select" name="openai_image_variations" id="openai_image_variations" accept="image/png" onchange="loadFileVariations(event)">
							<div class="image-upload-icon">
								<i class="fa-solid fa-image-landscape fs-28 text-muted"></i>
							</div>
							<p class="text-dark font-weight-bold mb-2 mt-3">
								{{ __('Upload your image to create variations') }}
							</p>
							<p class="mb-0 text-muted fs-12">
								({{ __('Square PNG Images') }} / {{ __('4MB Max') }})
							</p>
							<img id="source-image-variations"/>
						</div>
					</div>
				</div>

		

			
			</div>
		</div>
		
		<div class="row mt-8 no-gutters">
			@foreach ($data as $image)
				<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 image-container">				
					<div class="grid-item">
						<div class="grid-image-wrapper">
							<div class="flex grid-buttons text-center">
								<a href="{{ url($image->image) }}" class="grid-image-view text-center" download><i class="fa-sharp fa-solid fa-arrow-down-to-line" title="{{ __('Download Image') }}"></i></a>
								<a href="#" class="grid-image-view text-center viewImageResult" id="{{ $image->id }}"><i class="fa-sharp fa-solid fa-camera-viewfinder" title="{{ __('View Image') }}"></i></a>
								<a href="#" class="grid-image-view text-center deleteResultButton" id="{{ $image->id }}"><i class="fa-solid fa-trash-xmark" title="{{ __('Delete Image') }}"></i></a>							
							</div>
							<div>
								<span class="grid-image">
									<img class="loaded" src="@if($image->storage == 'local') {{ URL::asset($image->image) }} @else {{ $image->image }} @endif" alt="" >
								</span>
							</div>
							<div class="grid-description">
								<span class="fs-9 text-primary">@if ($image->vendor == 'sd') {{ __('Stable Diffusion') }} @else {{ __('Dalle') }} @endif</span>
								<p class="fs-10 mb-0">{{ substr($image->description, 0, 63) }}...</p>
							</div>
						</div>
					</div>
				</div>
			@endforeach

			<input type="hidden" id="start" name="start" value="12">
			<input type="hidden" id="rowperpage" value="6">
			<input type="hidden" id="totalrecords" value="{{ $records }}">
			
			
		</div>
	</div>

	<aside id="image-settings-wrapper">
		<div class="image-settings p-4">
			<a href="#" id="main-settings-toggle-minimized"><i class="fa-sharp fa-solid fa-sliders text-muted"></i></a>
			<div class="image-vendor mb-3 mt-2">
				<div class="middle">
					@if (config('settings.image_vendor') == 'openai' || config('settings.image_vendor') == 'both')
						<label>
							<input type="radio" name="vendor" value="openai" @if (config('settings.image_vendor') == 'openai' || config('settings.image_vendor') == 'both') checked @endif>
							<div class="front-end box">
								<span>Youtube Transcript</span>
							</div>
						</label>
					@endif
			
					<div>
						<p class="mb-0 fs-12 text-muted">Youtube Transcript</p>
					</div>
				</div>				
			</div>

			
<div id="form-group" class="mb-5">
    <h6 class="fs-11 mb-2 font-weight-semibold">Language</h6>
  <select id="language" name="medium" class="form-select">
    <option value="afrikaans">Afrikaans</option>
    <option value="arabic">Arabic</option>
    <option value="armenian">Armenian</option>
    <option value="azerbaijani">Azerbaijani</option>
    <option value="belarusian">Belarusian</option>
    <option value="bosnian">Bosnian</option>
    <option value="bulgarian">Bulgarian</option>
    <option value="catalan">Catalan</option>
    <option value="chinese">Chinese</option>
    <option value="croatian">Croatian</option>
    <option value="czech">Czech</option>
    <option value="danish">Danish</option>
    <option value="dutch">Dutch</option>
    <option value="english" selected>English</option>
    <option value="estonian">Estonian</option>
    <option value="finnish">Finnish</option>
    <option value="french">French</option>
    <option value="galician">Galician</option>
    <option value="german">German</option>
    <option value="greek">Greek</option>
    <option value="hebrew">Hebrew</option>
    <option value="hindi">Hindi</option>
    <option value="hungarian">Hungarian</option>
    <option value="icelandic">Icelandic</option>
    <option value="indonesian">Indonesian</option>
    <option value="italian">Italian</option>
    <option value="japanese">Japanese</option>
    <option value="kannada">Kannada</option>
    <option value="kazakh">Kazakh</option>
    <option value="korean">Korean</option>
    <option value="latvian">Latvian</option>
    <option value="lithuanian">Lithuanian</option>
    <option value="macedonian">Macedonian</option>
    <option value="malay">Malay</option>
    <option value="marathi">Marathi</option>
    <option value="maori">Maori</option>
    <option value="nepali">Nepali</option>
    <option value="norwegian">Norwegian</option>
    <option value="persian">Persian</option>
    <option value="polish">Polish</option>
    <option value="portuguese">Portuguese</option>
    <option value="romanian">Romanian</option>
    <option value="russian">Russian</option>
    <option value="serbian">Serbian</option>
    <option value="slovak">Slovak</option>
    <option value="slovenian">Slovenian</option>
    <option value="spanish">Spanish</option>
    <option value="swahili">Swahili</option>
    <option value="swedish">Swedish</option>
    <option value="tagalog">Tagalog</option>
    <option value="tamil">Tamil</option>
    <option value="thai">Thai</option>
    <option value="turkish">Turkish</option>
    <option value="ukrainian">Ukrainian</option>
    <option value="urdu">Urdu</option>
    <option value="vietnamese">Vietnamese</option>
    <option value="welsh">Welsh</option>
</select>

</div>


			<hr class="text-center m-auto">


			<div id="form-group" class="mb-5 mt-5">
				<h6 class="fs-11 mb-2 font-weight-semibold">Model : <i class="ml-1 text-dark fs-12 fa-solid fa-circle-info" data-tippy-content="Mode you chosen in for summirize article and generate"></i></h6>
				@if (config('settings.image_vendor') == 'openai' || config('settings.image_vendor') == 'both')
					<select id="model" name="resolution" class="form-select openai-feature">
						<option value='gpt_4' selected>GPT-4</option>
												<option value='gpt_3.5' selected>GPT-3.5</option>

								<option value='gemini_pro'>Gemini Pro</option>	
								<option value='palm_2'>Palm 2</option>	

					
				</select>
				@endif	
		</div>

			


		
		</div>
		
	</aside>

	<div class="custom-modal">
		<div class="modal" id="image-styles-modal" tabindex="-1" aria-hidden="true">			
			  <div class="modal-content">
				<span class="close text-right fs-12 text-muted"><i class="fa-solid fa-close"></i></span>
				<div class="modal-body pl-0 pr-0">
					<div class="row no-gutters image-styles-wrapper">
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-none" name="style" value="none"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/none.jpg') }}" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-none-text">{{ __('No Style') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-abstract" name="style" value="abstract"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/abstract.jpg') }}" id="style-abstract-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-abstract-text">{{ __('Abstract') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-realism" name="style" value="realistic"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/realism.jpg') }}" id="style-realism-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-realism-text">{{ __('Realism') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-3d" name="style" value="3d-model"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/3d_model.webp') }}" id="style-3d-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-3d-text">{{ __('3D Model') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-cartoon" name="style" value="cartoon"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/cartoon.jpg') }}" id="style-cartoon-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-cartoon-text">{{ __('Cartoon') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-anime" name="style" value="anime"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/anime.webp') }}"  id="style-anime-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-anime-text">{{ __('Anime') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-digital" name="style" value="digital-art"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/digitalart.jpg') }}" id="style-digital-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-digital-text">{{ __('Digital Art') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-artdeco" name="style" value="art deco"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/artdeco.jpg') }}" id="style-artdeco-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-artdeco-text">{{ __('Art Deco') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-pixel" name="style" value="pixel-art"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/pixelart.jpg') }}" id="style-pixel-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-pixel-text">{{ __('Pixel Art') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-origami" name="style" value="origami"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/origami.webp') }}" id="style-origami-thumb"  width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-origami-text">{{ __('Origami') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-illustration" name="style" value="illustration"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/illustration.webp') }}" id="style-illustration-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-illustration-text">{{ __('Illustration') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-photography" name="style" value="photographic"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/thumb-72.webp') }}" id="style-photography-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-photography-text">{{ __('Photographic') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-retro" name="style" value="retro"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/retro.webp') }}" id="style-retro-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-retro-text">{{ __('Retro') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-pencil" name="style" value="pencil drawing"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/sketch.webp') }}" id="style-pencil-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-pencil-text">{{ __('Pencil Drawing') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-vaporwave" name="style" value="vaporwave"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/vaporwave.jpg') }}" id="style-vaporwave-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-vaporwave-text">{{ __('Vaporwave') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-popart" name="style" value="pop art"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/popart.jpg') }}" id="style-popart-thumb"  width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-popart-text">{{ __('Pop Art') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-sticker" name="style" value="sticker"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/sticker.webp') }}" id="style-sticker-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-sticker-text">{{ __('Sticker') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-minimalism" name="style" value="minimalism"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/minimalism.jpg') }}" id="style-minimalism-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-minimalism-text">{{ __('Minimalism') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-renaissance" name="style" value="renaissance"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/reneissance.webp') }}" id="style-renaissance-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-renaissance-text">{{ __('Renaissance') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-ballpoint" name="style" value="ballpoint pen drawing"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/ink.webp') }}" id="style-ballpoint-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-ballpoint-text">{{ __('Ballpoint Pen') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-cyberpunk" name="style" value="cyberpunk"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/cyberpunk.webp') }}" id="style-cyberpunk-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-cyberpunk-text">{{ __('Cyberpunk') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-isometric" name="style" value="isometric"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/isometric.jpg') }}" id="style-isometric-thumb"width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-isometric-text">{{ __('Isometric') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-bauhaus" name="style" value="bauhaus"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/bauhaust.webp') }}" id="style-bauhaus-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-bauhaus-text">{{ __('Bauhaus') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-glitchcore" name="style" value="glitchcore"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/glitchcore.jpg') }}" id="style-glitchcore-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-glitchcore-text">{{ __('Glitchcore') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-steampunk" name="style" value="steampunk"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/steampunk.webp') }}" id="style-steampunk-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-steampunk-text">{{ __('Steampunk') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-ukiyo" name="style" value="ukiyo-e"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/ukiyo.webp') }}" id="style-ukiyo-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-ukiyo-text">{{ __('Ukiyo-e') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-lowpoly" name="style" value="low-poly"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/lowpoly.jpg') }}" id="style-lowpoly-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-lowpoly-text">{{ __('Low Poly') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-vector" name="style" value="vector"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/vector.png') }}" id="style-vector-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-vector-text">{{ __('Vector') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-impressionism" name="style" value="impressionism"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/imressionism.jpg') }}" id="style-impressionism-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-impressionism-text">{{ __('Impressionism') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4 openai-feature">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-cubism" name="style" value="cubism"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/cubism.webp') }}" id="style-cubism-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-cubism-text">{{ __('Cubism') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-cinematic" name="style" value="cinematic"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/cinematic.jpg') }}" id="style-cinematic-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-cinematic-text">{{ __('Cinematic') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-analog" name="style" value="analog-film"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/analog-film.jpg') }}" id="style-analog-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-analog-text">{{ __('Analog Film') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-fantasy" name="style" value="fantasy-art"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/fantasy-art.jpeg') }}" id="style-fantasy-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-fantasy-text">{{ __('Fantasy Art') }}</span> 
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="image-style">
								<label class="mb-0">
									<input type="radio" id="style-line" name="style" value="line-art"/>
									<div for="style-none" class="image-label">
										<img src="{{ URL::asset('img/frontend/thumbs/line-art.jpg') }}" id="style-line-thumb" width="90" height="80">
										<div class="bg-dark-overlay"></div>
										<span id="style-line-text">{{ __('Line Art') }}</span> 
									</div>
								</label>
							</div>
						</div>
					</div>
				</div>
			  </div>
			
		  </div>
	</div>

	<div class="image-modal">
		<div class="modal fade" id="image-view-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h6>{{ __('Image View') }}</h6>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body pb-6 pr-5 pl-5">
					
				</div>
			</div>
			</div>
	  	</div>
	</div>

<!-- </form> -->
@endsection

@section('js')
<script src="{{URL::asset('plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
<script src="{{URL::asset('plugins/richtext/jquery.richtext.min.js')}}"></script>
<script src="{{URL::asset('plugins/character-count/jquery-simple-txt-counter.min.js')}}"></script>
<script src="{{URL::asset('js/export.js')}}"></script>
<!-- FilePond JS -->
<script src={{ URL::asset('plugins/filepond/filepond-plugin-file-validate-size.min.js') }}></script>
<script src={{ URL::asset('plugins/filepond/filepond-plugin-file-validate-type.min.js') }}></script>
<script src={{ URL::asset('plugins/filepond/filepond.min.js') }}></script>
<!-- Green Audio Players JS -->
<script src="{{ URL::asset('plugins/audio-player/green-audio-player.js') }}"></script>
<script src="{{ URL::asset('js/audio-player.js') }}"></script>
<script src="{{ URL::asset('js/wavesurfer.min.js') }}"></script>
<script src="{{ URL::asset('plugins/wavesurfer/wavesurfer.cursor.min.js') }}"></script>
<script src="{{ URL::asset('plugins/wavesurfer/wavesurfer.timeline.min.js') }}"></script>
<script type="text/javascript">

	$(function () {

		"use strict";
		
		$('#richtext').richText({

			// text formatting
			bold: true,
			italic: true,
			underline: true,

			// text alignment
			leftAlign: true,
			centerAlign: true,
			rightAlign: true,
			justify: true,

			// lists
			ol: true,
			ul: true,

			// title
			heading: true,

			// fonts
			fonts: true,
			fontList: [
				"Arial", 
				"Arial Black", 
				"Comic Sans MS", 
				"Courier New", 
				"Geneva", 
				"Georgia", 
				"Helvetica", 
				"Impact", 
				"Lucida Console", 
				"Tahoma", 
				"Times New Roman",
				"Verdana"
			],
			fontColor: true,
			fontSize: true,

			// uploads
			imageUpload: false,
			fileUpload: false,

			// media
			videoEmbed: false,

			// link
			urls: false,

			// tables
			table: false,

			// code
			removeStyles: false,
			code: false,

			// colors
			colors: [],

			// dropdowns
			fileHTML: '',
			imageHTML: '',

			// translations
			translations: {
				'title': 'Title',
				'white': 'White',
				'black': 'Black',
				'brown': 'Brown',
				'beige': 'Beige',
				'darkBlue': 'Dark Blue',
				'blue': 'Blue',
				'lightBlue': 'Light Blue',
				'darkRed': 'Dark Red',
				'red': 'Red',
				'darkGreen': 'Dark Green',
				'green': 'Green',
				'purple': 'Purple',
				'darkTurquois': 'Dark Turquois',
				'turquois': 'Turquois',
				'darkOrange': 'Dark Orange',
				'orange': 'Orange',
				'yellow': 'Yellow',
				'imageURL': 'Image URL',
				'fileURL': 'File URL',
				'linkText': 'Link text',
				'url': 'URL',
				'size': 'Size',
				'responsive': 'Responsive',
				'text': 'Text',
				'openIn': 'Open in',
				'sameTab': 'Same tab',
				'newTab': 'New tab',
				'align': 'Align',
				'left': 'Left',
				'center': 'Center',
				'right': 'Right',
				'rows': 'Rows',
				'columns': 'Columns',
				'add': 'Add',
				'pleaseEnterURL': 'Please enter an URL',
				'videoURLnotSupported': 'Video URL not supported',
				'pleaseSelectImage': 'Please select an image',
				'pleaseSelectFile': 'Please select a file',
				'bold': 'Bold',
				'italic': 'Italic',
				'underline': 'Underline',
				'alignLeft': 'Align left',
				'alignCenter': 'Align centered',
				'alignRight': 'Align right',
				'addOrderedList': 'Add ordered list',
				'addUnorderedList': 'Add unordered list',
				'addHeading': 'Add Heading/title',
				'addFont': 'Add font',
				'addFontColor': 'Add font color',
				'addFontSize' : 'Add font size',
				'addImage': 'Add image',
				'addVideo': 'Add video',
				'addFile': 'Add file',
				'addURL': 'Add URL',
				'addTable': 'Add table',
				'removeStyles': 'Remove styles',
				'code': 'Show HTML code',
				'undo': 'Undo',
				'redo': 'Redo',
				'close': 'Close'
			},
					
			// privacy
			youtubeCookies: false,

			// developer settings
			useSingleQuotes: false,
			height: 0,
			heightPercentage: 0,
			id: "",
			class: "",
			useParagraph: true,
			maxlength: 0,
			callback: undefined,
			useTabForNext: false
		});


		$(document).ready(function() {

			$('#description').simpleTxtCounter({
				maxLength: 500,
				countElem: '<div class="form-text"></div>',
				lineBreak: false,
			});

		});	
		

	});

	function animateValue(id, start, end, duration) {
		if (start === end) return;
		var range = end - start;
		var current = start;
		var increment = end > start? 1 : -1;
		var stepTime = Math.abs(Math.floor(duration / range));
		var obj = document.getElementById(id);
		var timer = setInterval(function() {
			current += increment;
			if (current > 0) {
				obj.innerHTML = current;
			} else {
				obj.innerHTML = 0;
			}
			
			if (current == end) {
				clearInterval(timer);
			}
		}, stepTime);
	}

	function saveText(event) {

		let textarea = document.querySelector('.richText-editor').innerHTML;
		let title = document.getElementById('document').value;


		if (!event.target) {
			toastr.warning('{{ __('You will need to transcribe audio first before saving') }}');
		} else {
			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				method: 'POST',
				url: '/user/speech-to-text/save',
				data: { 'id': event.target, 'text': textarea, 'title': title},
				success: function (data) {					
					if (data['status'] == 'success') {
						toastr.success('{{ __('Transcript has been successfully saved') }}');
					} else {						
						toastr.warning('{{ __('There was an issue while saving your transcript') }}');
					}
				},
				error: function(data) {
					toastr.warning('{{ __('There was an issue while saving your transcript') }}');
				}
			});

			return false;
		}

	}


	FilePond.registerPlugin(
		FilePondPluginFileValidateSize,
	);

	FilePond.setOptions({
		maxFileSize: 25 + 'MB',
		maxFiles: 1,
		labelIdle: "{{ __('Drag & Drop your audio file or') }} <span class=\"filepond--label-action\">{{ __('Browse') }}</span><br><span class='restrictions'><span class='restrictions-highlight'>.mp3, .mp4, .mpeg, .mpga, .m4a, .wav, .webm</span></span><br><span class='restrictions'><span class='text-muted'>{{ __('Max Audio Size') }}: " + 25 + "MB</span></span>",
		required: true,
		instantUpload:false,
		storeAsFile: true,
		labelFileProcessingError: (error) => {
		console.log(error);
		}
	
	});
	
	// CREATE FILEPOND INSTANCE
	let pond = FilePond.create(document.querySelector('.filepond'));

	let playBtn = document.getElementById('playBtn');
	let stopBtn = document.getElementById('stopBtn');
	let forwardBtn = document.getElementById('forwardBtn');
	let backwardBtn = document.getElementById('backwardBtn');
	let wave = document.getElementById('waveform');

	let wavesurfer = WaveSurfer.create({
		container: wave,
		waveColor: '#ff9d00',
		progressColor: '#1e1e2d',
		selectionColor: '#d0e9c6',
		backgroundColor: '#ffffff',
		barWidth: 2,
		barHeight: 4,
		barMinHeight: 1,
		height: 50,
		responsive: true,				
		barRadius: 1,
		fillParent: true,
		plugins: [
			WaveSurfer.timeline.create({
				container: "#wave-timeline",
				timeInterval: 1,
			}),
			WaveSurfer.cursor.create({
				showTime: true,
				opacity: 1,
				customShowTimeStyle: {
					'background-color': '#000',
					color: '#fff',
					padding: '2px',
					'font-size': '10px'
				}
			}),
		]
	});

	playBtn.onclick = function(e) {
    e.preventDefault();

    wavesurfer.playPause();
		if (playBtn.innerHTML.includes('fa-play')) {
			playBtn.innerHTML = '<i class="fa fa-pause"></i>';
			playBtn.classList.add('isPlaying');
		} else {
			playBtn.innerHTML = '<i class="fa fa-play"></i>';
			playBtn.classList.remove('isPlaying');
		}
	}

	stopBtn.onclick = function(e) {
		e.preventDefault();

		wavesurfer.stop();	
		playBtn.innerHTML = '<i class="fa fa-play"></i>';
		playBtn.classList.remove('isPlaying');
	}

	forwardBtn.onclick = function(e) {
		e.preventDefault();
		
		wavesurfer.skipForward(3);	
	}

	backwardBtn.onclick = function(e) {
		e.preventDefault();

		wavesurfer.skipBackward(3);	
	}

	wavesurfer.on('finish', function() {
		playBtn.innerHTML = '<i class="fa fa-play"></i>';
		playBtn.classList.remove('isPlaying');
		wavesurfer.stop();	
	});

</script>
<script src="{{URL::asset('plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
<script type="text/javascript">
	$(function () {

		"use strict";

		checkWindowSize();

		let openai_engine = "{{ $openai_engine }}";
		let sd_engine = "{{ $sd_engine }}";
		let task = 'none';
		let openai_task = 'none';

		$(".quantity .increase").off().on("click", function(e) {
			e.preventDefault();
			let t = $(this).closest(".quantity").find("input"),
				a = parseInt(t.attr("max"), 10),
				o = parseInt(t.val(), 10);
				o = isNaN(o) ? 0 : o, a !== o && (o++, t.val(o), !1);
		});

		$(".quantity .decrease").off().on("click", function(e) {
			e.preventDefault();
			let t = $(this).closest(".quantity").find("input"),
				a = parseInt(t.val(), 10),
				o = parseInt(t.attr("min"), 10);
				a = isNaN(a) ? 0 : a, o !== a && (a--, t.val(a), !1);
		});

		$('#advanced-settings-toggle').on('click', function (e) {
            e.preventDefault();
            $('#advanced-settings-wrapper').slideToggle();
            let $plus = $(this).find('span');
            if($plus.text() === '+'){
                $plus.text('-')
            } else {
                $plus.text('+')
            }
        });

		$(".range").each(function() {
			let t = $(this),
				a = t.find("input"),
				o = a.val(),
				n = t.find(".value"),
				s = a.attr("min"),
				i = a.attr("max"),
				r = t.find(".slider");
			r.css({
				width: o * (100 * s) / i + "%"
			}), a.on("input", function() {
				o = $(this).val(), n.text(o), r.css({
					width: o * (100 * s) / i + "%"
				})
			})
		});

		// Negative Prompt Checkbox
		$('#negative-prompt-checkbox').on('change', function(e) {

			if ($('#sd-image-to-image-checkbox').is(":checked")) {
				$('#sd-image-to-image-checkbox').prop('checked', false);
				$('#sd-image-to-image').slideToggle();
			}

			if ($('#sd-image-masking-checkbox').is(":checked")) {
				$('#sd-image-masking-checkbox').prop('checked', false);
				$('#sd-image-masking').slideToggle();
			}

			if ($('#sd-image-upscale-checkbox').is(":checked")) {
				$('#sd-image-upscale-checkbox').prop('checked', false);
				$('#sd-image-upscale').slideToggle();
			}

			if ($('#sd-multi-prompting-checkbox').is(":checked")) {
				$('#sd-multi-prompting-checkbox').prop('checked', false);
				$('#sd-multi-prompting').slideToggle();
			}

			if(e.target.checked === true) {
				$('#negative-prompt').slideToggle();
				task = 'sd-negative-prompt';				
			}			
			if(e.target.checked === false) {
				$('#negative-prompt').slideToggle();
				task = 'none';
			}
		});

		// Multi Prompting Checkbox
		$('#sd-multi-prompting-checkbox').on('change', function(e) {

			if ($('#sd-image-to-image-checkbox').is(":checked")) {
				$('#sd-image-to-image-checkbox').prop('checked', false);
				$('#sd-image-to-image').slideToggle();
			}

			if ($('#sd-image-masking-checkbox').is(":checked")) {
				$('#sd-image-masking-checkbox').prop('checked', false);
				$('#sd-image-masking').slideToggle();
			}

			if ($('#sd-image-upscale-checkbox').is(":checked")) {
				$('#sd-image-upscale-checkbox').prop('checked', false);
				$('#sd-image-upscale').slideToggle();
			}

			if ($('#negative-prompt-checkbox').is(":checked")) {
				$('#negative-prompt-checkbox').prop('checked', false);
				$('#negative-prompt').slideToggle();
			}

			if(e.target.checked === true) {
				$('#sd-multi-prompting').slideToggle();
				task = 'sd-multi-prompting';				
			}			
			if(e.target.checked === false) {
				$('#sd-multi-prompting').slideToggle();
				task = 'none';
			}
		});



		

		$(document).ready(function() {
			let vendor = document.querySelector('input[name="vendor"]:checked').value;			
			if (vendor == 'openai') {
				$('#active-engine').text(openai_engine);
				$('.sd-feature').addClass('hide-all');
				$('.openai-feature').addClass('show-all');
				if ($(window).width() > 940 ) {
					$('.openai-select-feature').addClass('style-initial-state');
				} else {
					$('.openai-select-feature').removeClass('style-initial-state').addClass('show-all');
				}	
				var openai_masking = document.getElementById('openai-image-masking');			
				var openai_variations = document.getElementById('openai-image-variations');	
				if (openai_masking.classList.contains('hide-all')) {
					$('#openai-image-masking').removeClass('hide-all');
				}
				if (openai_variations.classList.contains('hide-all')) {
					$('#openai-image-variations').removeClass('hide-all');
				}

			} else {
				$('#active-engine').text(sd_engine);
				$('#openai-image-masking').addClass('hide-all');
				$('#openai-image-variations').addClass('hide-all');
				$('.sd-feature').removeClass('hide-all');
				$('.openai-feature').removeClass('show-all').addClass('hide-all');
				if ($(window).width() > 940 ) {
					$('.sd-select-feature').addClass('style-initial-state');
				} else {
					$('.sd-select-feature').removeClass('style-initial-state');
				}
			}
		});

		document.querySelectorAll('input[name="vendor"]').forEach((elem) => {
			elem.addEventListener('change', function(event) {
				let item = event.target.value;
				if (item == 'openai') {
					$('#active-engine').text(openai_engine);
					$('.sd-feature').addClass('hide-all');
					$('.openai-feature').addClass('show-all');	
					if ($(window).width() < 940 ) {
						$('.openai-select-feature').addClass('show-all');
					}		
					$('.sd-select-feature').removeClass('show-all').addClass('hide-all');
					var openai_masking = document.getElementById('openai-image-masking');			
					var openai_variations = document.getElementById('openai-image-variations');	
					if (openai_masking.classList.contains('hide-all')) {
						$('#openai-image-masking').removeClass('hide-all');
					}
					if (openai_variations.classList.contains('hide-all')) {
						$('#openai-image-variations').removeClass('hide-all');
					}		
				} else {
					$('#active-engine').text(sd_engine);
					$('#openai-image-masking').addClass('hide-all');
					$('#openai-image-variations').addClass('hide-all');
					$('.sd-feature').removeClass('hide-all');
					$('.openai-feature').removeClass('show-all').addClass('hide-all');
					$('.openai-select-feature').removeClass('show-all').addClass('hide-all');
					if ($(window).width() < 940 ) {
						$('.sd-select-feature').addClass('show-all');
					}
				}				
			})
		});

		let style_button = document.getElementById("style-button");
		let span = document.getElementsByClassName("close")[0];
		let modal = document.getElementById("image-styles-modal");
		
		style_button.onclick = function() {
			if (modal.style.display === '' || modal.style.display === 'none') {
				modal.style.display = 'block';
				$('#style-button').addClass('rotate-90');
			} else {
				modal.style.display = 'none';
				$('#style-button').removeClass('rotate-90');
			}
			
		}

		span.onclick = function() {
			modal.style.display = "none";
			$('#style-button').removeClass('rotate-90');
		}

		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
				$('#style-button').removeClass('rotate-90');
			}
		}

		document.querySelectorAll('input[name="style"]').forEach((elem) => {
			elem.addEventListener('change', function(event) {
				if (event.target.value != 'none') {
					let image = $('#' + event.target.id + '-thumb').attr('src');
					let text = $('#'+ event.target.id + '-text').text();
					$("#style-button-img").removeClass("style-button-img");
					$("#style-button").removeClass("style-button-img-placeholder");
					$("#style-button i").addClass("extra-line-height");
					$("#style-button span").html(text);
					$("#style-button-img").attr("src", image);
				} else {
					$("#style-button-img").addClass("style-button-img");
					$("#style-button").addClass("style-button-img-placeholder");
					$("#style-button i").removeClass("extra-line-height");
					$("#style-button span").html('None');
				}
				
			})
		});

		$(window).resize(function() {
			if ($(window).width() < 940 ) {
				$('#image-settings-wrapper').addClass('shrink-main-settings');
				$('.openai-select-feature').removeClass('style-initial-state');
			}
		});
		
		$(document).on('click', '.viewImageResult', function(e) {

			"use strict";

			e.preventDefault();

			var id = $(this).attr("id");

			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				method: 'post',
				url: 'images/view',
				data:{
					id: id,
				},
				success:function(data) {   
					if (data['status'] == 'success') {
						$("#image-view-modal .modal-body").html(data['modal']);
						var myModal = new bootstrap.Modal(document.getElementById('image-view-modal'))
						myModal.show();
					} else {
						toastr.error(data['message']);
					}
				
				}
			});
		});


		// SUBMIT FORM
		$('#openai-form').on('submit', function(e) {

			e.preventDefault();

			let form = new FormData(this);
			form.append('task', task);
			form.append('openai_task', openai_task);

			if (task != 'none') {
				if (task == 'sd-image-to-image') {
					if (document.getElementById('sd_image_to_image').files.length === 0) {
						Swal.fire('{{ __('Image to Image Task Warning') }}', '{{ __('Please select an image file first for this task') }}', 'warning');
						return;
					} else {
						form.append('image', document.getElementById('sd_image_to_image').files[0]);	
					}
				} else if (task == 'sd-image-upscale') {
					if (document.getElementById('sd_image_upscale').files.length === 0) {
						Swal.fire('{{ __('Image Upscale Task Warning') }}', '{{ __('Please select an image file first for this task') }}', 'warning');
						return;
					} else {
						form.append('image', document.getElementById('sd_image_upscale').files[0]);
					}
				} else if (task == 'sd-image-masking') {
					if (document.getElementById('sd_image_masking').files.length === 0) {
						Swal.fire('{{ __('Image Masking Task Warning') }}', '{{ __('Please select an image file first for this task') }}', 'warning');
						return;
					} else {
						form.append('image', document.getElementById('sd_image_masking').files[0]);
					}
				}
			} 

			if (openai_task != 'none') {
			 	if (openai_task == 'openai-image-masking') {
					if (document.getElementById('openai_image_masking_target').files.length === 0 || document.getElementById('openai_image_masking_mask').files.length === 0) {
						Swal.fire('{{ __('Image Masking Task Warning') }}', '{{ __('Please include both target and mask images for OpenAI image masking task') }}', 'warning');
						return;
					} else {
						form.append('image_target', document.getElementById('openai_image_masking_target').files[0]);
						form.append('image_mask', document.getElementById('openai_image_masking_mask').files[0]);
					}
				} else if (openai_task == 'openai-image-variations') {
					if (document.getElementById('openai_image_variations').files.length === 0) {
						Swal.fire('{{ __('Image Masking Task Warning') }}', '{{ __('Please select an image file first for this task') }}', 'warning');
						return;
					} else {
						form.append('image_target', document.getElementById('openai_image_variations').files[0]);
					}
				}
			} 

			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				method: 'POST',
				url: 'images/process',
				data: form,
				contentType: false,
				processData: false,
				cache: false,
				beforeSend: function() {
					$('#image-generate').html('<i class="fa-sharp fa-solid fa-wand-magic-sparkles fa-beat-fade mr-2"></i>{{ __("Generating...") }}');
					$('#image-generate').prop('disabled', true);       
				},
				complete: function() {
					$('#image-generate').prop('disabled', false);
					$('#image-generate').html('<i class="fa-sharp fa-solid fa-wand-magic-sparkles mr-2"></i>{{ __("Generate") }}');            
				},
				success: function (data) {		
						
					if (data['status'] == 'success') {		
						let images = data['images'];
						for (let i in images) {
							$(".image-container:first").before(images[i]).show().fadeIn("slow");
						}
						toastr.success('{{ __('Images were generated successfully') }}');		
						animateValue("balance-number", data['old'], data['current'], 2000);	

						clearFileInput(task);
						clearFileInputOpenai(openai_task);
					} else {						
						Swal.fire('{{ __('Image Generation Error') }}', data['message'], 'warning');
						clearFileInput(task);
						clearFileInputOpenai(openai_task);
					}
				},
				error: function(data) {
					$('#image-generate').prop('disabled', false);
            		$('#image-generate').html('<i class="fa-sharp fa-solid fa-wand-magic-sparkles mr-2"></i>{{ __("Generate") }}'); 
					clearFileInput(task);
					clearFileInputOpenai(openai_task);
					console.log(data)
				}
			});
		});


		// DELETE IMAGE RESULT
		$(document).on('click', '.deleteResultButton', function(e) {

			e.preventDefault();

			Swal.fire({
				title: '{{ __('Confirm Image Deletion') }}',
				text: '{{ __('It will permanently delete this image') }}',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: '{{ __('Delete') }}',
				reverseButtons: true,
			}).then((result) => {
				if (result.isConfirmed) {
					var formData = new FormData();
					formData.append("id", $(this).attr('id'));
					$.ajax({
						headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
						method: 'post',
						url: 'images/delete',
						data: formData,
						processData: false,
						contentType: false,
						success: function (data) {
							if (data['status'] == 'success') {
								toastr.success('{{ __('Selected image has been successfully deleted') }}');	
								location.replace(location.href);								
							} else {
								toastr.error('{{ __('There was an error while deleting this image') }}');
							}      
						},
						error: function(data) {
							Swal.fire('Oops...','{{ __('Something went wrong') }}!', 'error')
						}
					})
				} 
			})
		});


		// FETCH IMAGES FOR MOBILE
		$(document).on('touchmove', onScroll);         
		
		$(window).scroll(function(){
			let position = $(window).scrollTop();
			let bottom = $(document).height() - $(window).height();	
			if( position == bottom ){
				fetchData(); 
			}
		});

		$(document).on("click", '[data-toggle="remove-input"]', function() {
                var $this = $(this);
                var parent = $this.data("parent");
                $this.closest(parent).remove();
            }
        );

		$('[data-toggle="add-more"]').each(function() {
            var $this = $(this);
            var content = '<div class="multi-prompt-input d-flex align-items-center mt-2">' + 
							'<div class="input-box w-100 mb-0">' + 							
								'<div class="form-group">' +							    
									'<input type="text" class="form-control" name="multi_prompt[]" placeholder="{{ __('Describe what you want to see with phrases, and seperate them with commas...') }}">' +
								'</div>' +
							'</div>' +
							'<a href="#" class="ml-4 mr-4 delete-prompt-input" data-toggle="remove-input" data-parent=".multi-prompt-input"><i class="fa-solid fa-trash"></i></a>'+
						'</div>'
            var target = $this.data("target");

            $this.on("click", function(e) {
                e.preventDefault();
                $(target).append(content);
            });
        });
	});

	function onScroll(){
		if($(window).scrollTop() > $(document).height() - $(window).height()-100) {
			fetchData(); 
		}
	}	

	function getFile(uri) {
		//window.open(data,'_blank');
		// window.location.href = data;
		var link = document.createElement("a");
            link.href = uri;
            link.setAttribute("download", "download");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            delete link;
		return false;
	}

	function animateValue(id, start, end, duration) {
		if (start === end) return;
		var range = end - start;
		var current = start;
		var increment = end > start? 1 : -1;
		var stepTime = Math.abs(Math.floor(duration / range));
		var obj = document.getElementById(id);
		var timer = setInterval(function() {
			current += increment;
			obj.innerHTML = current;
			if (current == end) {
				clearInterval(timer);
			}
		}, stepTime);
	}
 
    // Check if the page has enough content or not. If not then fetch records
    function checkWindowSize(){
        if($(window).height() >= $(document).height()){
            fetchData();
        }
    }
 
    // Fetch records
    function fetchData(){
        var start = Number($('#start').val());
        var allcount = Number($('#totalrecords').val());
        var rowperpage = Number($('#rowperpage').val());
        start = start + rowperpage;
 
        if(start <= allcount){
            $('#start').val(start);
 
            $.ajax({
                url:"{{route('user.images.load')}}",
                data: {start:start},
                dataType: 'json',
                    success: function(response){
                    $(".image-container:last").after(response.html).show().fadeIn("slow");
 
                    // Check if the page has enough content or not. If not then fetch records
                    checkWindowSize();
                }
            });
        }
    }

	$(document).on('click', ".copy-image-prompt", function (e) {	
		var r = document.createRange();
		r.selectNode(document.getElementById('image-prompt-text'));
		window.getSelection().removeAllRanges();
		window.getSelection().addRange(r);
		document.execCommand('copy');
		window.getSelection().removeAllRanges();
		toastr.success('{{ __('Image prompt has been copied') }}');
	});

	$(document).on('click', ".copy-image-negative-prompt", function (e) {	
		var r = document.createRange();
		r.selectNode(document.getElementById('image-negative-prompt-text'));
		window.getSelection().removeAllRanges();
		window.getSelection().addRange(r);
		document.execCommand('copy');
		window.getSelection().removeAllRanges();
		toastr.success('{{ __('Image prompt has been copied') }}');
	});

	var loadFile = function(event) {
		var output = document.getElementById('source-image');
		output.style.display = 'block';
		output.src = URL.createObjectURL(event.target.files[0]);
		output.onload = function() {
			URL.revokeObjectURL(output.src) // free memory
		}
	};

	var loadFileScale = function(event) {
		var output = document.getElementById('source-image-scale');
		output.style.display = 'block';
		output.src = URL.createObjectURL(event.target.files[0]);
		output.onload = function() {
			URL.revokeObjectURL(output.src) // free memory
		}
	};

	var loadFileMask = function(event) {
		var output = document.getElementById('source-image-mask');
		output.style.display = 'block';
		output.src = URL.createObjectURL(event.target.files[0]);
		output.onload = function() {
			URL.revokeObjectURL(output.src) // free memory
		}
	};

	var loadFileMaskTarget = function(event) {
		var output = document.getElementById('source-image-mask-target');
		output.style.display = 'block';
		output.src = URL.createObjectURL(event.target.files[0]);
		output.onload = function() {
			URL.revokeObjectURL(output.src) // free memory
		}
	};

	var loadFileMaskOpenai = function(event) {
		var output = document.getElementById('source-image-mask-openai');
		output.style.display = 'block';
		output.src = URL.createObjectURL(event.target.files[0]);
		output.onload = function() {
			URL.revokeObjectURL(output.src) // free memory
		}
	};

	var loadFileVariations = function(event) {
		var output = document.getElementById('source-image-variations');
		output.style.display = 'block';
		output.src = URL.createObjectURL(event.target.files[0]);
		output.onload = function() {
			URL.revokeObjectURL(output.src) // free memory
		}
	};

	function clearFileInput(task) {
		switch (task) {
			case 'sd-image-to-image':
				document.getElementById('sd_image_to_image').value=null;
				var output = document.getElementById('source-image');
				output.style.display = 'none';
				break;
			case 'sd-image-upscale':
				document.getElementById('sd_image_upscale').value=null;
				var output = document.getElementById('source-image-scale');
				output.style.display = 'none';
				break;
			case 'sd-image-masking':
				document.getElementById('sd_image_masking').value=null;
				var output = document.getElementById('source-image-mask');
				output.style.display = 'none';
				break;
			case 'openai-image-variations':
				document.getElementById('openai_image_variations').value=null;
				var output = document.getElementById('source-image-variations');
				output.style.display = 'none';
				break;
			case 'openai-image-masking':
				document.getElementById('openai_image_masking_target').value=null;
				document.getElementById('openai_image_masking_mask').value=null;
				var output = document.getElementById('source-image-mask-target');
				var output = document.getElementById('source-image-mask-openai');
				output.style.display = 'none';
				break;
			default:
				break;
		}
	}

	function clearFileInputOpenai(openai_task) {
		switch (openai_task) {
			case 'openai-image-variations':
				document.getElementById('openai_image_variations').value=null;
				var output = document.getElementById('source-image-variations');
				output.style.display = 'none';
				break;
			case 'openai-image-masking':
				document.getElementById('openai_image_masking_target').value=null;
				document.getElementById('openai_image_masking_mask').value=null;
				var target = document.getElementById('source-image-mask-target');
				var mask = document.getElementById('source-image-mask-openai');
				target.style.display = 'none';
				mask.style.display = 'none';
				break;
			default:
				break;
		}
	}

</script>





<script>
    $(document).ready(function(){
        // Function to handle the button click
        function handleButtonClick(event, buttonId, spinnerId, actionType) {
            event.preventDefault(); // Prevents the default form submission action

            var $button = $('#' + buttonId); // Reference to the button
            var $spinner = $('#' + spinnerId); // Reference to the spinner
            var $messageBox = $('#message-box'); // Reference to the message box
			var inputContent = $('#prompt').val(); // Gets the content from the #prompt input
			var languageValue = $('#language').val(); // Gets the content from the #prompt input

			var ModelValue = $('#model').val(); // Gets the content from the #prompt input

			var audio_model=$('#audio_model').val(); 




            // Show spinner and disable button
            $spinner.show();
            $button.prop('disabled', true);

            // Dummy data, replace with actual data as needed			var inputContent = $('#prompt').val(); // Gets the content from the #prompt input

            var requestData = { 
				action: actionType ,
				content: inputContent, // Add the input content to the request data
				language:languageValue,
				model:ModelValue,
				audio_model:audio_model,
			}; 

			let textarea = document.querySelector('.richText-editor').innerHTML;
			let title = document.getElementById('document').value;

            $.ajax({
                url: window.location.href +'/submit', // The URL to which the request is sent
                type: 'POST', // The HTTP method to use for the request
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
                contentType: 'application/json', // Specify the content type
                data: JSON.stringify(requestData), // Convert the object to a JSON string
                success: function(response) {
                    // Display success message
                    $messageBox.text(actionType +"==="+ response + ' generated successfully!').show();

					// document.querySelector('#document_title').innerHTML = response.title;
					document.querySelector('.richText-editor').innerHTML=response.content;
					document.getElementById('document').value = response.title;



				},
                error: function(xhr, status, error) {
                    // Display error message
                    $messageBox.text('Error generating ' + actionType + ': ' + error).show();
					
                },
                complete: function() {
                    // Hide spinner and enable button
                    $spinner.hide();
                    $button.prop('disabled', false);
                }
            });
        }

        // Event listener for the summary button
        $('#generate-summary').click(function(event) {
            handleButtonClick(event, 'generate-summary', 'spinner-summary', 'Summary');

        });


		$('#article-generate').click(function(event) {
            handleButtonClick(event, 'article-generate', 'spinner-article', 'Article');
        });
		
        // Event listener for the transcript button
        $('#generate-transcript').click(function(event) {
            handleButtonClick(event, 'generate-transcript', 'spinner-transcript', 'Transcript');
        });
    });
</script>

@endsection
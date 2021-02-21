@extends('backend.layouts.app')

@section('subheader')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ translate('Add New Category')}}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard')}}" class="text-muted">{{translate('Dashboard')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.articles.index')}}" class="text-muted">{{ translate('Articles')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted">{{ translate('Add New Article')}}</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
@endsection


@section('content')

<div class="row">
    <div class="col-lg-7 mx-auto">
		<div class="card card-custom gutter-b example example-compact">
			<form class="form" action="{{ route('admin.articles.store') }}" id="kt_form_1" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="card-header">
					<h6 class="fw-600 mb-0">{{ translate('Add New Article') }}</h6>
				</div>
				<div class="card-body">
					<div class="form-group row">
						<label class="col-sm-2 col-from-label" for="name">{{translate('Title')}} <span class="text-danger">*</span></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{ old('title') }}" required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-from-label" for="slug">{{translate('Link')}} <span class="text-danger">*</span></label>
						<div class="col-sm-10">
							<div class="input-group">
								<div class="input-group-prepend"><span class="input-group-text">{{ route('home') }}/</span></div>
								<input type="text" class="form-control" id="slug" placeholder="{{ translate('Slug') }}" value="{{ old('slug') }}" name="slug" required>
							</div>
							<small class="form-text text-muted">{{ translate('Use character, number, hypen only') }}</small>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-lg-2 col-from-label" for="type">{{translate('Format')}}</label>
						<div class="col-lg-10">
							<div class="aiz-radio-inline" id="type">
								<label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="{{translate('Article')}}">
									<input
										type="radio"
										name="type"
										value="article"
										checked
									>
									<span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
										<i class="las la-file la-flip-horizontal la-2x"></i>
									</span>
								</label>
								<label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="{{translate('Video')}}">
									<input
										type="radio"
										name="type"
										value="video"
									>
									<span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
										<i class="las la-video la-flip-horizontal la-2x"></i>
									</span>
								</label>
								<label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="{{translate('Audio')}}">
									<input
										type="radio"
										name="type"
										value="audio"
									>
									<span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
										<i class="las la-audio-description la-flip-horizontal la-2x"></i>
									</span>
								</label>
								<label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="{{translate('Gallery')}}">
									<input
										type="radio"
										name="type"
										value="gallery"
									>
									<span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
										<i class="las la-images la-flip-horizontal la-2x"></i>
									</span>
								</label>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-from-label" for="name">{{translate('Category')}}</label>
						<div class="col-sm-10">
							<select class="form-control" id="kt_multipleselectsplitter_2" name="categories[]" multiple="multiple">
								<optgroup label="Group 1">
									<option value="1" selected="selected">Option 1</option>
									<option value="2">Option 2</option>
									<option value="3">Option 3</option>
									<option value="4">Option 4</option>
								</optgroup>
								<optgroup label="Group 2">
									<option value="5">Option 5</option>
									<option value="6">Option 6</option>
									<option value="7">Option 7</option>
									<option value="8">Option 8</option>
								</optgroup>
								<optgroup label="Group 3">
									<option value="5">Option 9</option>
									<option value="6">Option 10</option>
									<option value="7">Option 11</option>
									<option value="8">Option 12</option>
								</optgroup>
								<optgroup label="Group 4">
									<option value="5">Option 13</option>
									<option value="6">Option 14</option>
									<option value="7">Option 15</option>
									<option value="8">Option 16</option>
								</optgroup>
								<optgroup label="Group 5">
									<option value="5">Option 17</option>
									<option value="6">Option 18</option>
									<option value="7">Option 19</option>
									<option value="8">Option 20</option>
								</optgroup>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-from-label" for="name">{{translate('Tags')}}</label>
						<div class="col-sm-10">
							<input id="kt_tagify_2" name="tags[]" class="form-control tagify" placeholder='type...' value='Back to the Future, Whiplash' data-blacklist='.NET,PHP' />
							<div class="mt-3 text-muted">In this example, the field is pre-occupied with 3 tags, and last tag is not included in the whitelist, and will be removed because the enforce whitelist option flag is set to true</div>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-from-label" for="name">{{translate('Featured Image')}}</label>
						<div class="col-sm-10">
							<div class="input-group " data-toggle="aizuploader" data-type="image">
									<div class="input-group-prepend">
										<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
									</div>
									<div class="form-control file-amount">{{ translate('Choose File') }}</div>
									<input type="hidden" name="featured_image" class="selected-files" value="{{old('featured_image')}}">
							</div>
							<div class="file-preview">
							</div>
						</div>
					</div>

					<div class="form-group row d-none article_type" id="video_type">
						<label class="col-sm-2 col-from-label" for="video_link">{{translate('Video Link')}}</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" placeholder="Video Link" value="{{ old('video_link') }}" name="video_link" required>
						</div>
					</div>

					<div class="form-group row d-none article_type" id="audio_type">
						<label class="col-sm-2 col-from-label" for="voice_link">{{translate('Voice Link')}}</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" placeholder="Voice Link" value="{{ old('voice_link') }}" name="voice_link" required>
						</div>
					</div>

					<div class="form-group row d-none article_type" id="gallery_type">
						<label class="col-sm-2 col-from-label" for="name">{{translate('Gallery')}}</label>
						<div class="col-sm-10">
							<div class="input-group " data-toggle="aizuploader" data-type="image" data-multiple="true">
									<div class="input-group-prepend">
											<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
									</div>
									<div class="form-control file-amount">{{ translate('Choose File') }}</div>
									<input type="hidden" name="gallery" class="selected-files" value="{{old('gallery')}}">
							</div>
							<div class="file-preview">
							</div>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-from-label">{{translate('Excerpt')}}</label>
						<div class="col-sm-10">
							<textarea name="excerpt" rows="8" class="form-control">{{ old('excerpt') }}</textarea>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-from-label" for="name">{{translate('Article Content')}} <span class="text-danger">*</span></label>
						<div class="col-sm-10">
							<textarea
								class="aiz-text-editor form-control"
								data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]'
								placeholder="Content.."
								data-min-height="300"
								name="content"
								required
							>{{ old('content') }}</textarea>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-from-label" for="voice_link">{{translate('Publish')}}</label>
						<div class="col-sm-10">
							<span class="switch switch-success">
								<label>
									<input type="checkbox" checked="checked" name="published" value="1" checked />
									<span></span>
								</label>
							</span>
						</div>
					</div>
				</div>

				<div class="card-header">
					<h6 class="fw-600 mb-0">{{ translate('Seo Fields') }}</h6>
				</div>
				<div class="card-body">

					<div class="form-group row">
							<label class="col-sm-2 col-from-label" for="name">{{translate('Meta Title')}}</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" placeholder="Title" name="meta_title" value="{{ old('meta_title') }}">
							</div>
					</div>

					<div class="form-group row">
							<label class="col-sm-2 col-from-label" for="name">{{translate('Meta Description')}}</label>
							<div class="col-sm-10">
								<textarea class="resize-off form-control" placeholder="Description" name="meta_description">{{ old('meta_description') }}</textarea>
							</div>
					</div>

					<div class="form-group row">
							<label class="col-sm-2 col-from-label" for="name">{{translate('Keywords')}}</label>
							<div class="col-sm-10">
								<textarea class="resize-off form-control" placeholder="Keyword, Keyword" name="keywords">{{ old('keywords') }}</textarea>
								<small class="text-muted">{{ translate('Separate with coma') }}</small>
							</div>
					</div>

					<div class="form-group row">
							<label class="col-sm-2 col-from-label" for="name">{{translate('Meta Image')}}</label>
							<div class="col-sm-10">
								<div class="input-group " data-toggle="aizuploader" data-type="image">
										<div class="input-group-prepend">
												<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
										</div>
										<div class="form-control file-amount">{{ translate('Choose File') }}</div>
										<input type="hidden" name="meta_image" class="selected-files">
								</div>
								<div class="file-preview">
								</div>
							</div>
					</div>
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-primary mr-2">{{translate('Save')}}</button>
				</div>
			</form>
		</div>
    </div>
</div>

@endsection

@section('script')

	<script type="text/javascript">
   		$(document).ready(function(){
			$('#type label').on('click', function(){
				$('.article_type').addClass('d-none');
				var type = $(this).find('input').val();
				switch (type) {
					case 'video':
							$('#video_type').removeClass('d-none');
						break;
					case 'audio':
							$('#audio_type').removeClass('d-none');
						break;
					case 'gallery':
							$('#gallery_type').removeClass('d-none');
						break;
				
					default:
						break;
				}
			});

			$('#title').on('change', function(){
				$('#slug').attr('disabled',true);
				$.get('{{route('admin.articles.checkslug')}}',
					{'title': $(this).val()},
					function( data ) {
						$('#slug').val(data.slug);
						$('#slug').attr('disabled',false);
					}
				);
			});
			$('#kt_multipleselectsplitter_2').multiselectsplitter();
		});
		FormValidation.formValidation(
			document.getElementById('kt_form_1'),
			{
				fields: {
					title: {
						validators: {
							notEmpty: {
								message: '{{translate("This is required!")}}'
							}
						}
					},

					slug: {
						validators: {
							notEmpty: {
								message: '{{translate("This is required!")}}'
							}
						}
					},
					content: {
						validators: {
							notEmpty: {
								message: '{{translate("This is required!")}}'
							},
							stringLength: {
								min: 100,
								message: '{{translate("This must have at least 100 characters!")}}'
							},
						}
					},
				},

				plugins: {
					autoFocus: new FormValidation.plugins.AutoFocus(),
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap(),
					// Validate fields when clicking the Submit button
					submitButton: new FormValidation.plugins.SubmitButton(),
					// Submit the form when all fields are valid
					defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
					icon: new FormValidation.plugins.Icon({
						valid: 'fa fa-check',
						invalid: 'fa fa-times',
						validating: 'fa fa-refresh',
					}),
				}
			}
		);

		var e=document.getElementById("kt_tagify_2");
		new Tagify(e,{
			enforceWhitelist:!0,
			whitelist:[
				"The Shawshank Redemption","The Godfather","The Godfather: Part II","The Dark Knight","12 Angry Men","Schindler's List","Pulp Fiction","The Lord of the Rings: The Return of the King","The Good, the Bad and the Ugly","Fight Club","The Lord of the Rings: The Fellowship of the Ring","Star Wars: Episode V - The Empire Strikes Back","Forrest Gump","Inception","The Lord of the Rings: The Two Towers","One Flew Over the Cuckoo's Nest","Goodfellas","The Matrix","Seven Samurai","Star Wars: Episode IV - A New Hope","City of God","Se7en","The Silence of the Lambs","It's a Wonderful Life","The Usual Suspects","Life Is Beautiful","LÃ©on: The Professional","Spirited Away","Saving Private Ryan","La La Land","Once Upon a Time in the West","American History X","Interstellar","Casablanca","Psycho","City Lights","The Green Mile","Raiders of the Lost Ark","The Intouchables","Modern Times","Rear Window","The Pianist","The Departed","Terminator 2: Judgment Day","Back to the Future","Whiplash","Gladiator","Memento","Apocalypse Now","The Prestige","The Lion King","Alien","Dr. Strangelove or: How I Learned to Stop Worrying and Love the Bomb","Sunset Boulevard","The Great Dictator","Cinema Paradiso","The Lives of Others","Paths of Glory","Grave of the Fireflies","Django Unchained","The Shining","WALLÂ·E","American Beauty","The Dark Knight Rises","Princess Mononoke","Aliens","Oldboy","Once Upon a Time in America","Citizen Kane","Das Boot","Witness for the Prosecution","North by Northwest","Vertigo","Star Wars: Episode VI - Return of the Jedi","Reservoir Dogs","M","Braveheart","AmÃ©lie","Requiem for a Dream","A Clockwork Orange","Taxi Driver","Lawrence of Arabia","Like Stars on Earth","Double Indemnity","To Kill a Mockingbird","Eternal Sunshine of the Spotless Mind","Toy Story 3","Amadeus","My Father and My Son","Full Metal Jacket","The Sting","2001: A Space Odyssey","Singin' in the Rain","Bicycle Thieves","Toy Story","Dangal","The Kid","Inglourious Basterds","Snatch","Monty Python and the Holy Grail","Hacksaw Ridge","3 Idiots","L.A. Confidential","For a Few Dollars More","Scarface","Rashomon","The Apartment","The Hunt","Good Will Hunting","Indiana Jones and the Last Crusade","A Separation","Metropolis","Yojimbo","All About Eve","Batman Begins","Up","Some Like It Hot","The Treasure of the Sierra Madre","Unforgiven","Downfall","Raging Bull","The Third Man","Die Hard","Children of Heaven","The Great Escape","Heat","Chinatown","Inside Out","Pan's Labyrinth","Ikiru","My Neighbor Totoro","On the Waterfront","Room","Ran","The Gold Rush","The Secret in Their Eyes","The Bridge on the River Kwai","Blade Runner","Mr. Smith Goes to Washington","The Seventh Seal","Howl's Moving Castle","Lock, Stock and Two Smoking Barrels","Judgment at Nuremberg","Casino","The Bandit","Incendies","A Beautiful Mind","A Wednesday","The General","The Elephant Man","Wild Strawberries","Arrival","V for Vendetta","Warrior","The Wolf of Wall Street","Manchester by the Sea","Sunrise","The Passion of Joan of Arc","Gran Torino","Rang De Basanti","Trainspotting","Dial M for Murder","The Big Lebowski","The Deer Hunter","Tokyo Story","Gone with the Wind","Fargo","Finding Nemo","The Sixth Sense","The Thing","Hera Pheri","Cool Hand Luke","Andaz Apna Apna","Rebecca","No Country for Old Men","How to Train Your Dragon","Munna Bhai M.B.B.S.","Sholay","Kill Bill: Vol. 1","Into the Wild","Mary and Max","Gone Girl","There Will Be Blood","Come and See","It Happened One Night","Life of Brian","Rush","Hotel Rwanda","Platoon","Shutter Island","Network","The Wages of Fear","Stand by Me","Wild Tales","In the Name of the Father","Spotlight","Star Wars: The Force Awakens","The Nights of Cabiria","The 400 Blows","Butch Cassidy and the Sundance Kid","Mad Max: Fury Road","The Maltese Falcon","12 Years a Slave","Ben-Hur","The Grand Budapest Hotel","Persona","Million Dollar Baby","Amores Perros","Jurassic Park","The Princess Bride","Hachi: A Dog's Tale","Memories of Murder","Stalker","NausicaÃ¤ of the Valley of the Wind","Drishyam","The Truman Show","The Grapes of Wrath","Before Sunrise","Touch of Evil","Annie Hall","The Message","Rocky","Gandhi","Harry Potter and the Deathly Hallows: Part 2","The Bourne Ultimatum","Diabolique","Donnie Darko","Monsters, Inc.","Prisoners","8Â½","The Terminator","The Wizard of Oz","Catch Me If You Can","Groundhog Day","Twelve Monkeys","Zootopia","La Haine","Barry Lyndon","Jaws","The Best Years of Our Lives","Infernal Affairs","Udaan","The Battle of Algiers","Strangers on a Train","Dog Day Afternoon","Sin City","Kind Hearts and Coronets","Gangs of Wasseypur","The Help"
			],
			callbacks:{
				add:console.log,
				remove:console.log
			}
		});
	</script>

@endsection
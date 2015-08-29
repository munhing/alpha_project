@if(Session::has('flash_notification.message'))
	@if(Session::has('flash_notification.overlay'))
		@include('layouts/partials/_modal', ['modalId' => 'flash-modal', 'title' => 'Notification', 'body' => Session::get('flash_notification.message')])
	@else

		<div style="margin: 30px 30px 10px 30px;" class="alert alert-{{ Session::get('flash_notification.level') }} alert-dismissible" role="alert">

			<i class="fa fa-{{ Session::get('flash_notification.glyph') }}"></i>
		  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		  {{ Session::get('flash_notification.message') }}

		</div>

	@endif
@endif

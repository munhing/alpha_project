    {{ Form::open(array('route' => 'client_search', 'role' => 'form', 'id' => 'form_search', 'class'=>'sidebar-form')) }}
        <div class="input-group">
            
            {{ Form::text('search', null, ['class' =>'form-control', 'placeholder' => 'Search']) }}

            <span class="input-group-btn">
                <button type="button" class="btn btn-default" id="btn-search">
                    <i class="fa fa-search"></i>    
                </button>
            </span><!-- /btn-group -->
        </div><!-- /input-group -->
    {{ Form::close() }}
    {{ Form::open(array('route' => 'search', 'role' => 'form', 'id' => 'form_search', 'class'=>'sidebar-form')) }}
        <div class="input-group">
            
            {{ Form::text('search', null, ['class' =>'form-control', 'placeholder' => 'Search']) }}

            <span class="input-group-btn">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-search"></i>    
                <span class="caret"></span>
            </button>
        <ul class="dropdown-menu" role="menu">
          <li><a href="#" id="s_report">by Report #</a></li>
          <li><a href="#" id="s_item">by Item</a></li>
          <li><a href="#" id="s_cert">by Cert #</a></li>
          <li><a href="#" id="s_client">by Client</a></li>
        </ul>
      </span><!-- /btn-group -->



    </div><!-- /input-group -->
        {{ Form::close() }}
<div class="box box-warning">
    <div class="box-header">
        <i class="fa fa-info-circle fa-fw"></i>
        <h3 class="box-title">Related Items</h3>
    </div>
    <!-- /.panel-heading -->
    <div class="box-body">

 		@if(count($relatedItems) > 0)                    
            <table class="table table-striped table-hover">
            	<thead>
            		<tr>
            			<th>Serial No</th>
            			<th>Type</th>
            		</tr>
            	</thead>
            	<tbody>
					@foreach($relatedItems as $item)
						<tr>
							<td>{{ link_to_route('item_show', $item->serial_no, $item->id) }}</td>
							<td>{{ $itemType[$item->item_type_id] }}</td>
						</tr>
					@endforeach
            	</tbody>
			</table>
		@else
			No related items found.								
		@endif   				

    </div>
    <!-- /.panel-body -->

</div>
<!-- /.panel -->
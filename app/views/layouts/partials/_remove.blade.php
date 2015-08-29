<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to remove this item?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-danger" id="confirm">Yes</button>
      </div>
    </div>
  </div>
</div>


<!-- Dialog show event handler -->
<script type="text/javascript">

    $('#myModal').on('show.bs.modal', function (e) {

        $title = $(e.relatedTarget).attr('data-title');
        $(this).find('.modal-title').text($title);

        $title = $(e.relatedTarget).attr('data-body');
        $(this).find('.modal-body').text($title);             

        var form = $(e.relatedTarget).closest('form');
        $(this).find('.modal-footer #confirm').data('form', form);
    });

    $('#myModal').find('.modal-footer #confirm').on('click', function(){
        $(this).data('form').submit();
    });
 
</script>

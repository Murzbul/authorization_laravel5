<!-- Modal -->
<div id="delete_modal_{{ $id }}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ $title}}</h4>
      </div>
      <div class="modal-body">
        <p>{{ $content }}</p>
        <p>{{$route}}</p>
          <a class="btn btn-success" href="{{ route( $route, ['id' => $id]) }}">Si</a>
          <a type="button" class="btn btn-default" data-dismiss="modal">No</a>
      </div>
    </div>
  </div>
</div>

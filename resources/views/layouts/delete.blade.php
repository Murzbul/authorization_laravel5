
<div  id="delete_modal_{{ $id }}" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ $title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>{{ $content }}</p>
        <p>{{ $user->name }}</p>
      </div>
      <div class="modal-footer">
        <a class="btn btn-success" href="{{ route( $route, ['id' => $id]) }}">Si</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>

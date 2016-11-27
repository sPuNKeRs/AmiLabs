@php
    if(!isset($modal_title)) $modal_title = 'Стандартный заголовок модального окна';
    if(!isset($modal_body)) $modal_body = 'Стандартное содержимое модального окна';
    if(!isset($modal_action)) $modal_action = null;
    if(!isset($modal_id)) $modal_id = 'defaultModal';
@endphp
<!-- Modal Dialogs ======================================================================================================= -->
<!-- Default Size -->
<div class="modal fade" id="{{ $modal_id }}" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">{{ $modal_title }}</h4>
            </div>
            <div class="modal-body">
                {!! $modal_body !!}
            </div>
            <div class="modal-footer">
                {!! $modal_action !!}
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">ОТМЕНА</button>
            </div>
        </div>
    </div>
</div>
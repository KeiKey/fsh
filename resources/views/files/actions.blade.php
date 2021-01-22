<div>
    <form class="d-inline"
          action="{{ route('files.download', ['id' => $id]) }}"
          method="POST">
        @csrf
        <button type="submit" class="btn btn-xs btn-success"><i
                class="fas fa-download"></i></button>
    </form>

    <form class="d-inline"
          action="{{ route('files.softDelete', ['id' => $id]) }}"
          method="POST">
        @csrf
        <button type="submit" class="btn btn-xs btn-danger"><i
                class="fas fa-trash"></i></button>
    </form>
    <button type="button" class="btn btn-primary btn-xs btn-info" data-toggle="modal" data-target="#exampleModal">
        <i class="fas fa-share"></i>
    </button>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Share File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">


                    <form
                        method="POST"
                        action="{{route('shares.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="col-form-label">Recipient email:</label>
                            <input type="text" class="form-control" id="email">
                            <a value="{{$id}}" id="fileid"></a>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </form>


                </div>

            </div>
        </div>
    </div>

</div>
<script>
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Share file')
        modal.find('.modal-body input').val(recipient)
    })
</script>

@if($notification)
    <div class="modal fade show"
         id="myModal"
         tabindex=""
         role="dialog"
         aria-labelledby="exampleModalLabel"
            >
        <div class="modal-dialog"
             role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- w-100 class so that header
            div covers 100% width of parent div -->
                    <h5 class="modal-title w-100"
                        id="exampleModalLabel">
                        @if($notification && $notification->title){{ $notification->title }}@endif
                    </h5>
                    <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">
                              ×
                          </span>
                    </button>
                </div>

            <!--Modal body with image-->
            <div class="modal-body">
                @if($notification && $notification->image)<img src="{{$notification->image()}}" style="height: auto; width: 469px" />@endif
            </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-danger"
                            data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif



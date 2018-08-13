<!-- Modal -->
<div class="modal fade show" id="globalSettings" tabindex="-1" role="dialog" aria-labelledby="HTML Settings" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"><span class="fa fa-cogs"></span> Global Settings</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="close-modal" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-5" id="editor-area">
                        <h5 class="mb-2"><span class="fa fa-pencil"></span> Editor Settings</h5>
                        <hr>
                <div class="form-group">
                    <label for="font-size"><strong>Font-Size:</strong></label>
                    <span  id="font-size-up" class="font-size-control">
                        <strong>A</strong> <span class="fa fa-arrow-up font-size-arrow"></span>
                    </span>
                    <span id="font-size-down" class="font-size-control">
                        <strong>A</strong> <span class="fa fa-arrow-down font-size-arrow"></span>
                    </span>
                   
                </div>
                </div>
                <div class="col-sm-7" id="project-area">
                    <h5 class="mb-2"><span class="fa fa-cog"></span> Skitch Settings</h5>
                    <hr>
                    <div class="form-group">
                        <label for="title"><strong>Title:</strong></label>
                        <input type="text" class="form-control" name="title" id="title" value="{{$skitch->title}}">
                    </div>
                    <div class="form-group">
                        <label for="description"><strong>Description:</strong></label>
                        <textarea name="description" id="description" class="form-control">{{$skitch->description}}</textarea>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                
                <button type="button" id="global-settings-save-button" class="btn btn-dark settings-btn settings-save-btn"><span class="fa fa-save"></span> Save Settings</button>
                <button type="button" id="global-settings-close-button" class="btn btn-secondary settings-btn settings-close-btn">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Banner</h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
                    <strong>Failed to save banner, please check again the required fields !</strong><br> 
                    <p class="error-message"></p>
                </div>

                <form id="form" class="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="" class="col-form-label">Banner</label>
                        <div class="dropzone" id="myAttachment">
                            <div class="dz-button dz-default dz-message">
                                <span class="block mb-2 text-theme" data-inline="true"></span>
                                <div class="text-center">
                                    Click to browse or drag in your files in here
                                </div>
                            </div>
                        </div>
                        <div class="text-default mt-3">
                            File format support: JPEG, JPG, PNG, GIF
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_save">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_close">Close</button>
            </div>
        </div>
    </div>
</div>
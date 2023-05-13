<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Category</h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
                    <strong>Failed to save category, please check again the required fields !</strong><br> 
                    <p class="error-message"></p>
                </div>

                <form id="form" class="form">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="customFile" class="col-form-label">Category Image <b class="text-danger">*</b></label>
                        <img src="{{ asset('admin/img/example-image.jpg') }}" class="img-thumbnail rounded d-block mb-2" id="preview_image" style="object-fit: contain;object-position: center; width: 100%; height: 170px;">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="category_img" form="form" accept="image/*" required>
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category_name" class="col-form-label">Category Name <b class="text-danger">*</b></label>
                        <input type="text" class="form-control" name="category_name" id="category_name" required placeholder="Category Name">
                    </div>

                    <div class="form-group">
                        <label for="game_url" class="col-form-label">Game Url <b class="text-danger">*</b></label>
                        <input type="text" class="form-control" name="game_url" id="game_url" required placeholder="https://example.com">
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
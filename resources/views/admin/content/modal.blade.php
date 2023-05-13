<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Content</h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
                    <strong>Failed to save content, please check again the required fields !</strong><br> 
                    <p class="error-message"></p>
                </div>

                <form id="form" class="form">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="customFile" class="col-form-label">Content Image <b class="text-danger">*</b></label>
                        <img src="{{ asset('admin/img/example-image.jpg') }}" class="img-thumbnail rounded d-block mb-2" id="preview_image" style="object-fit: contain;object-position: center; width: 100%; height: 170px;">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="category_img" form="form" accept="image/*" required>
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category_id" class="col-form-label">Category <b class="text-danger">*</b></label>
                        <select class="form-control category" name="category_id" id="category_id" required>
                            <option value='' disabled selected>Select Category</option>
                            @foreach ($category as $ct)
                                <option value='{{ $ct->category_id }}'>{{ $ct->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label for="content_name" class="col-form-label">Content Name <b class="text-danger">*</b></label>
                                <input type="text" class="form-control" name="content_name" id="content_name" required placeholder="Content Name">
                            </div>
                            <div class="col-6">
                                <label for="content_persen" class="col-form-label">Percentage <b class="text-danger">*</b></label>
                                <input type="number" class="form-control" name="content_persen" id="content_persen" required placeholder="Percentage (%)">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="content_index" class="col-form-label">Content Index <b class="text-danger">*</b></label>
                        <input type="text" class="form-control" name="content_index" id="content_index" required placeholder="Content Index">
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

{{-- <div class="modal" id="sort" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Setting Sortlist</h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
                    <strong>Failed to save category, please check again the required fields !</strong><br> 
                    <p class="error-message"></p>
                </div>

                <div class="form-group">
                    <ul id="sortable">
                        @foreach ($content as $con)
                            <li id="{{ $con->content_id }}">{{ $con->content_name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> --}}
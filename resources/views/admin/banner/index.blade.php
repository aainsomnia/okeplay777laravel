@extends('admin.layout.app')

@section('title') Banner @endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Banner</h1>
        <div class="ml-auto">
            <button class="btn btn-primary btn-lg btn-show-add" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-plus"></i> Tambah Banner
            </button>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="datatables">
                                <thead>
                                    <tr>
                                        <th title="Banner Image">Images</th>
                                        <th class="filter" title="Banner Created">Created</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@section('modal')
@extends('admin.banner.modal')
@endsection

@section('scripts')
<script>
    var table;
    var file_data = [];

    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#myAttachment", {
        url: '{{ route("banner.store_image") }}',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        maxFiles: 10,
        maxFilesize: 5,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        timeout: 60000,
        addRemoveLinks: true,
        maxThumbnailFilesize: 20,
        createImageThumbnails: false,
        accept: function(file, done){
            var split = file.name.split('.');
            if(split.length > 2){
                done({message: 'dot in filename is not allowed'});
            } else {
                done();
            }
        },
        sending:function(file){
            var previewDiv = file.previewTemplate;
            var fileName = file.name;
            var ext = fileName.substr(fileName.lastIndexOf('.') + 1);
            $(previewDiv).find('.file_ext').html(ext.toUpperCase());
            $(previewDiv).find(".layout-filetype").hide();
            $(previewDiv).find(".layout-filename").hide();
            $(previewDiv).find(".btn-delete-file").hide();
            $(previewDiv).find(".loading-upload").show();
        },
        success: function (file, response) {
            file_data.push({file_name:response.file_name,name_original:response.name_original});
            var previewDiv = file.previewTemplate;
            $(previewDiv).find('.file_ext').html(response.ext);
            $(previewDiv).find(".layout-filetype").show();
            $(previewDiv).find(".layout-filename").show();
            $(previewDiv).find(".btn-delete-file").show();
            $(previewDiv).find(".loading-upload").hide();
        },
        error: function (file, response) {
            if(!file.accepted){
                var previewDiv = file.previewTemplate;
                $(previewDiv).remove();

                Swal.fire({
                    icon: 'error',
                    title: 'Something went wrong!',
                    text: "File " + file.name+" failed to upload <br /> ( <b>"+response.message+"</b> )",
                });
            }
        },
        removedfile: function(file) {
            if(file.file_id){
                var index_delete = 0;
                $.each(file_data,function(i,item){
                    if(file.name==item.file_name){
                        index_delete = i;
                    }
                });
                file_data.splice(index_delete, 1);
                var previewDiv = file.previewTemplate;
                $(previewDiv).remove();
            } else {
                if(file.accepted){
                    var file_name = $.parseJSON(file.xhr.response);

                    var index_delete = 0;
                    $.each(file_data,function(i,item){
                        if(file_name.file_name==item.file_name){
                        index_delete = i;
                        }
                    });
                    file_data.splice(index_delete, 1);
                    $.ajax({
                        url: "{{route('banner.delete_image')}}",
                        type: "POST",
                        data: {
                            file_name:file_name.file_name
                        },
                        success: function(data, textStatus, xhr) {
                            //
                        },
                        error: function(xhr, status){
                            console.log(xhr);
                        }
                    });
                    var previewDiv = file.previewTemplate;
                    $(previewDiv).remove();
                }
            }
        },
        init: function() {
            this.on("removedfile", function(file) {
                var file_name = file;
                var index_delete = 0;

                $.each(file_data,function(i,item){
                    if(file_name.name==item.file_name){
                        index_delete = i;
                    }
                });

                file_data.splice(index_delete, 1);

                $.ajax({
                    url: "{{route('banner.delete_image')}}",
                    type: "POST",
                    data: {
                        file_name:file_name.name
                    },
                    success: function(data, textStatus, xhr) {
                        var previewDiv = file.previewTemplate;
                        $(previewDiv).remove();
                    },
                    error: function(xhr, status){
                        console.log(xhr);
                    }
                });
            });

            this.on("complete", function (file) {
                var previewDiv = file.previewTemplate;
                $('#exampleModal').on('hide.bs.modal', function(){
                    $(previewDiv).remove();
                });
            });
        }
    });

    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': '{{csrf_token()}}'
            }
        });

        table = $('#datatables').DataTable({
            processing: true,
            serverSide: true,
            fixedHeader: true,
            orderCellsTop: true,
            dom: 'lrtip',
            ajax: {
                url: "{{ route('banner.get') }}",
                type: "POST",
            },
            columns: [
                {data: 'banner_img', orderable: false},
                {data: 'banner_created'},
                {data: 'action', orderable: false},
            ],
            order: [[1, 'desc']]
        });

        $('#exampleModal').on('hide.bs.modal', function(){
            $('.alert').hide();
            $('#form').trigger("reset");
            file_data.splice(0, file_data.length);
        });

        $('#btn_save').click(function(){
            var data = $('#form').serializeArray();
            var form = new FormData();
            var elem_button = $(this).html();

            $.each(file_data, function(i,item){
                console.log(item);
                form.append("banner_img[]",item.file_name);
            });
            
            for(var i = 0; i < data.length; i++){
                form.append(data[i]['name'] , data[i]['value']);
            }

            var url = "{{ route('banner.store') }}";

            $.ajax({
                url: url,
                method: "POST",
                data: form,
                processData: false,
                contentType: false,
                mimeType: "multipart/form-data",
                beforeSend: function() {
                    button_loading("#btn_save",'',true);
                },
                success: function(data){
                    // console.log(data);
                    button_loading("#btn_save",elem_button,false);
                    table.ajax.reload(null, false);
                    $('#exampleModal').modal('hide');
                    Swal.fire('Information', 'Banner Successfully added.', 'success');
                },
                error:function(data){
                    // console.log(data);
                    button_loading("#btn_save", elem_button, false);
                    $('.alert').show();
                    if (data.status == 500) {
                        var pesan = $.parseJSON(data.responseText);
                        var isi = [];
                        $.each(pesan, function(key, value) {
                            var result = `<li>${value}</li>`;
                            isi.push(result);
                        });
                        $('.error-message').html(isi);
                        $('.error-message').fadeIn(500);
                    }
                }
            });
        });

    });

    $(document).on('click', '.btn_add_img', function(){ 
        var html = $(".clone").html();
        $(".increment").after(html);
    });
    
    $(document).on('click', '.btn_remove_img', function(){ 
        $(this).parents(".control-group").remove();
    });

    $(document).on('click', '.btn_delete', function() {
        var id = $(this).data('id');
        var url = "{{ route('banner.delete', ':banner_img') }}";
            url = url.replace(':banner_img', id);
        Swal.fire({
            title: "Are you sure?",
            text: "You will delete this data!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "DELETE",
                    url: url,
                    success: function(data){
                        Swal.fire("Deleted!", "Your data has been deleted.", "success");
                        table.ajax.reload(null, false);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        });
    });

    $('#datatables thead tr').clone(true).appendTo('#datatables thead');
    $('#datatables thead tr:eq(1) th').each( function (i) {
        $(this).html('');
        if ($(this).hasClass("filter")){
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control form-control-sm" placeholder="Search '+title+'" />');
        }

        $('input', this).on('keyup change', delaySearchTable(function () {
            if (table.column(i).search() !== this.value) {
                table.column(i).search(this.value).draw();
            }
        }, 450));

    });
    
</script>
@endsection

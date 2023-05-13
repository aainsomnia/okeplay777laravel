@extends('admin.layout.app')

@section('title') Category @endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Category</h1>
        <div class="ml-auto">
            <button class="btn btn-primary btn-lg btn-show-add" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-plus"></i> Tambah Category
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
                                        <th title="Category Image">Images</th>
                                        <th class="filter" title="Category Name">Category</th>
                                        <th class="filter" title="Game URL">Game Url</th>
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
@extends('admin.category.modal')
@endsection

@section('scripts')
<script>
    var table;

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
                url: "{{ route('category.get') }}",
                type: "POST",
            },
            columns: [
                {data: 'category_img', orderable: false},
                {data: 'category_name'},
                {data: 'game_url_link', orderable: false},
                {data: 'action', orderable: false},
            ],
            order: [[1, 'desc']]
        });

        $("#customFile").change(function () {
            var form = $(this).attr('form');
            if(this.files.length > 0){
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.'+form+' #preview_image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            } else {
                $('.'+form+' #preview_image').attr('src', `{{ asset('admin/img/example-image.jpg') }}`);
            }
        });

        $('#exampleModal').on('hide.bs.modal', function(){
            $('input[name="id"]').val(null);
            $('.alert').hide();
            $('#form').trigger("reset");
            $("#form #customFile").val(null);
            $('#form #preview_image').attr('src', `{{ asset('admin/img/example-image.jpg') }}`);
        });

        $('#btn_save').click(function(){
            var data = $('#form').serializeArray();
            var form = new FormData();
            var elem_button = $(this).html();
            
            for(var i = 0; i < data.length; i++){
                form.append(data[i]['name'] , data[i]['value']);
            }

            form.append('category_img', $('input[type=file]')[0].files[0]); 

            var url = "{{ route('category.store') }}";
            if ($('#id').val().length > 0) {
                url = "{{ route('category.update') }}";
            }

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
                    console.log(data);
                    button_loading("#btn_save",elem_button,false);
                    table.ajax.reload(null, false);
                    $('#exampleModal').modal('hide');
                    Swal.fire('Information', 'Category Successfully saved.', 'success');
                },
                error:function(data){
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

    $(document).on('click', '.btn_edit', function(){
        var items = table.row($(this).parents('tr')).data();
        var img_link = $(this).data('img_link');

        $('input[name="id"]').val(items.category_id);
        $('#form #preview_image').attr('src', img_link);
        $('input[name="category_name"]').val(items.category_name);
        $('input[name="game_url"]').val(items.game_url);
    });

    $(document).on('click', '.btn_delete', function() {
        var id = $(this).data('id');
        var url = "{{ route('category.delete', ':category_id') }}";
            url = url.replace(':category_id', id);
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

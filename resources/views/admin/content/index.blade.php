@extends('admin.layout.app')

@section('title') Content @endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Content</h1>
        <div class="ml-auto">
            {{-- <button class="btn btn-warning btn-lg btn-sort" data-toggle="modal" data-target="#sort">
                <i class="fas fa-cog"></i> Setting Sortlist
            </button> --}}
            <button class="btn btn-primary btn-lg btn-show-add" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-plus"></i> Tambah Content
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
                                        <th title="Content Images">Images</th>
                                        <th title="Content Index">Index</th>
                                        <th class="filter" title="Content Name">Name</th>
                                        <th class="filter" title="Category">Category</th>
                                        <th class="filter" title="Percentage">Percentage (%)</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="contents">

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
@extends('admin.content.modal')
@endsection

@section('scripts')
<script>
    var table;

    // $("#sortable").sortable({
    //     stop: function() {
    //         $.map($(this).find('li'), function(el) {
    //             var id = el.id;
    //             var sorting = $(el).index();

    //             $.ajax({
    //                 url: "{{ route('content.sortlist') }}",
    //                 type: 'GET',
    //                 data: {
    //                     id: id,
    //                     sorting: sorting
    //                 },
    //                 success: function(data){
    //                     console.log(data);
    //                 },
    //                 error:function(data){
    //                     console.log(data);
    //                     Swal.fire('Error', 'Content faled to saved.', 'success');
    //                 }
    //             });
    //         });
    //     }
    // });

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
                url: "{{ route('content.get') }}",
                type: "POST",
            },
            columns: [
                {data: 'content_img', orderable: false},
                {data: 'content_index'},
                {data: 'content_name'},
                {data: 'category_name', orderable: false},
                {data: 'content_persen'},
                {data: 'action', orderable: false},
            ],
            order: [[1, 'ASC']]
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
            $('select[name="category_id"]').val('').change();
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

            form.append('content_img', $('input[type=file]')[0].files[0]); 

            var url = "{{ route('content.store') }}";
            if ($('#id').val().length > 0) {
                url = "{{ route('content.update') }}";
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
                    Swal.fire('Information', 'Content Successfully saved.', 'success');
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
        var category_id = $(this).data('category_id');

        $('input[name="id"]').val(items.content_id);
        $('#form #preview_image').attr('src', img_link);
        $('input[name="content_name"]').val(items.content_name);
        $('select[name="category_id"]').val(category_id).change();
        $('input[name="content_persen"]').val(items.content_persen);
        $('input[name="content_index"]').val(items.content_index);
    });

    $(document).on('click', '.btn_delete', function() {
        var id = $(this).data('id');
        var url = "{{ route('content.delete', ':content_id') }}";
            url = url.replace(':content_id', id);
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

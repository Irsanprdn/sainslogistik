@extends('admin')
@section('title', 'Linkedin')
@section('content')


<div class="collapse" id="collapseTambahData">
    <div class="card card-body">
        <form action="{{ route('linkedin.post') }}" enctype="multipart/form-data" method="POST" id="formPost">
            @csrf
            <div class="row">                
                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label for="image_title">Title</label>
                        <input type="text" name="image_id" class="form-control d-none" id="image_id">
                        <input type="text" name="menu" value="linkedin" class="form-control d-none" id="menu">
                        <input type="text" name="image_title" class="form-control" id="image_title" >
                    </div>
                </div>   
                <div class="col-md-10 col-12">
                    <div class="form-group">
                        <label for="image_title">Embed Linkedin</label>
                        <input type="text" name="image_id" class="form-control d-none" id="image_id">
                        <input type="text" name="menu" value="linkedin" class="form-control d-none" id="menu">
                        <input type="text" name="embed" class="form-control" id="embed" onblur="getURLFromEmbed(this)">
                        <input type="hidden" name="urlEmbed" id="urlEmbed">
                        <div class="d-none" id="placingEmbed"></div>
                    </div>
                </div>    
                <div class="col-md-2 col-12">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">Choose Status</option>
                            <option value="Draft">Draft</option>
                            <option value="Publish">Publish</option>
                        </select>
                    </div>
                </div>            
                <div class="col-md-12">
                    <p class="text-right mt-3 pb-0 mb-0">
                        <button class="btn btn-sm btn-secondary" type="button" onclick="resetForm()"><i class="bi bi-arrow-clockwise"></i> Reset Form</button>
                        <button class="btn btn-sm btn-success" type="submit"><i class="bi bi-save"></i> Simpan Data</button>
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>
@if (session('error'))
<div class="alert my-3 alert-danger">{{ session('error') }}</div>
@endif
@if (session('success'))
<div class="alert my-3 alert-success">{{ session('success') }}</div>
@endif
<div class="table-responsive">
    <table id="image-data" class="table table-striped table-hover" style="width:100%">
        <thead class="bg-base text-light">
            <tr>
                <th>Linkedin Title</th>
                <th>Linkedin Description</th>
                <th>Image</th>
                <th>Status</th>                
                <th>Updated By</th>
                <th>Updated Date</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $data as $d )
            <tr>
                <td class="imageTitle">{{ $d->image_title ?? ''}}</td>
                <td class="imageDescription">{!! $d->image_description ?? '' !!}</td>
                <td class="image">                
                    <img src="{{ $d->image ?? ''}}" alt="{{ $d->image_title ?? ''}}" width="100">
                </td>
                <td class="imageStatus">{{ $d->status ?? ''}}</td>                
                <td class="updatedBy">{{ $d->updated_by ?? ''}}</td>
                <td class="updatedDate">{{ $d->updated_date ?? '' }}</td>
                <td>                
                    <a data-url="{{ route('image.delete',[$d->image_id, 'linkedin']) }}" onclick="confirmDelete(this)" type="button" class="btn btn-sm btn-danger mx-1" title="Hapus"><i class="bi bi-trash"></i> </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="btn-add" class="d-none">
    <button class="btn btn-sm btn-primary bg-base btn-adds" data-toggle="collapse" href="#collapseTambahData" role="button" aria-expanded="false" aria-controls="collapseTambahData" type="button"><i class="bi bi-plus"></i> Tambah Data</button>
</div>
@endsection
@section('js')
<script>
    new DataTable('#image-data', {
        fixedHeader: true,
        paging: false,
        scrollCollapse: true,
        scrollX: true,
        scrollY: 350,
        bLengthChange: true,
        bInfo: false,
        "initComplete": function(settings, json) {
            $('#image-data_wrapper').children().children().first().append($('#btn-add').html())
            $('#image-data_wrapper').find('#btn-add').removeClass('d-none')
            $('#image-data_wrapper').children().children().children().attr('id', 'btn-tambah')
        }
    });

    tinymce.init({
        selector: '#mytextarea',
        promotion: false,
        menubar: false,
        toolbar: ' undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
        content_style: 'body { font-family: "Open Sans", sans-serif;font-size: 16px;}',
    });

    function confirmDelete(e) {
        if (confirm('Are you sure ?')) {
            var url = $(e).attr('data-url')
            window.location.href = url;
        } else {
            // Do nothing!
            Alert('Hapus telah dibatalkan')
        }
    }

    function getURLFromEmbed(e){
        var embed = $(e).val()
        $('#placingEmbed').html(embed)
        var urlEmbed = $('#placingEmbed').children().attr('src')
        $('#urlEmbed').val(urlEmbed)
        
    }

    function getDataEdit(e, imageId, menu) {

        var imageTitle = $(e).parent().parent().find('.imageTitle').text()
        var imageDescription = $(e).parent().parent().find('.imageDescription').text()
        var image = $(e).parent().parent().find('.image').children().attr('src');
        var imageStatus = $(e).parent().parent().find('.imageStatus').text();
        var language = $(e).parent().parent().find('.language').text();
        if ($('#collapseTambahData').hasClass('show')) {
            resetForm();
            $('#btn-tambah').click()
        } else {
            $('#grup').attr('readonly', true)
            $('#btn-tambah').click()
            $("#collapseTambahData").scrollTop();

            $('#image_id').val(imageId)
            tinymce.get("mytextarea").setContent(imageDescription);
            $('#menu').val(menu)
            $('#language').val(language)
            $('#image_title').val(imageTitle)
            $('#viewImg').attr('src', image)
            $('#status').val(imageStatus)
        }
    }

    function resetForm() {
        $('#formPost')[0].reset()
    }

    function readURL(input) {
        var defaults = "";
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#viewImg')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            $('#viewImg').attr('src', defaults);
        }
    }
</script>
@endsection
@extends('admin')
@section('title', 'Service')
@section('content')

<div class="collapse" id="collapseTambahData">
    <div class="card card-body">
        <form action="{{ route('image.post') }}" enctype="multipart/form-data" method="POST" id="formPost">
            @csrf
            <div class="row">
                <div class="col-md-2 col-12">
                    <div class="form-group">
                        <label for="language">Language</label>
                        <select name="language" id="language" class="form-control">
                            <option value="">Choose Language</option>
                            <option value="EN">English</option>
                            <option value="ID">Indonesia</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <div class="form-group">
                        <label for="image_title">Service Title</label>
                        <input type="text" name="image_id" class="form-control d-none" id="image_id">
                        <input type="text" name="menu" value="service" class="form-control d-none" id="menu">
                        <input type="text" name="image_title" class="form-control" id="image_title">
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
                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label for="image_description">Service Description</label>
                        <textarea id="mytextarea" name="image_description">
                        </textarea>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="image">Service Image <span style="font-size: 13px;">* File input must be format jpg,jpeg,png Max Size( 2 mb )</span></label>
                        <input type="file" class="form-control" name="imgFile" id="imgFile" onchange="readURL(this)">
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div id="preview" class="text-center">
                        <img id="viewImg" alt="Upload Preview" style="width: 115px;height:115px;">
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
    <table id="service-data" class="table table-striped table-hover" style="width:100%">
        <thead class="bg-base text-light">
            <tr>
                <th>Service Title</th>
                <th>Service Description</th>
                <th>Service</th>
                <th>Status</th>
                <th>Language</th>
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
                    <img src="{{ asset('assets') }}/uploads/image/{{ $d->image ?? ''}}" alt="{{ $d->image_title ?? ''}}" width="100">
                </td>
                <td class="imageStatus">{{ $d->status ?? ''}}</td>
                <td class="language">{{ $d->language ?? ''}}</td>
                <td class="updatedBy">{{ $d->updated_by ?? ''}}</td>
                <td class="updatedDate">{{ $d->updated_date ?? '' }}</td>
                <td>
                    <button onclick="getDataEdit(this, '{{ $d->image_id }}', '{{ $d->menu }}')" type="button" class="btn btn-sm btn-warning mx-1" title="Ubah"><i class="bi bi-pencil"></i> </button>
                    <a data-url="{{ route('image.delete',[$d->image_id,'service']) }}" onclick="confirmDelete(this)" type="button" class="btn btn-sm btn-danger mx-1" title="Hapus"><i class="bi bi-trash"></i> </button>
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
    new DataTable('#service-data', {
        fixedHeader: true,
        paging: false,
        scrollCollapse: true,
        scrollX: true,
        scrollY: 350,
        bLengthChange: true,
        bInfo: false,
        "initComplete": function(settings, json) {
            $('#service-data_wrapper').children().children().first().append($('#btn-add').html())
            $('#service-data_wrapper').find('#btn-add').removeClass('d-none')
            $('#service-data_wrapper').children().children().children().attr('id', 'btn-tambah')
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
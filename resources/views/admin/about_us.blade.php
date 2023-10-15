@extends('admin')
@section('title', 'About Us')
@section('content')
<div class="container">
    @if (session('error'))
    <div class="alert my-3 alert-danger">{{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if (session('success'))
    <div class="alert my-3 alert-success">{{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <form action="{{ route('about.post') }}" enctype="multipart/form-data" method="POST" id="formAbout"> @csrf
        <div class="text-right mt-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        <div class="form-group">
            <label for="">Judul</label>
            <input type="text" class="form-control w-50" name="title1" id="title1" value="{{ $data1->title ?? '' }}">
        </div>

        <div class="form-group">
            <label for="">Deskripsi</label>
            <textarea name="description1" id="description1" class="form-control" rows="5">{{ $data1->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="">Judul Struktur Organisasi</label>
            <input type="text" class="form-control w-50" name="title2" id="title2" value="{{ $data2->title ?? 'Struktur Organisasi' }}">
        </div>
        @php
        $defaultFoto = ENV('ASSET_URL') . "/assets/compro/img/slide.png";
        $default = "";
        $default = ($data2->description == '' ? $defaultFoto : ENV('ASSET_URL') . "/uploads/so/" . $data2->description);
        @endphp
        <label for="">Gambar Struktur Organisasi</label>
        <input type="file" class="form-control d-none" name="imgFile" id="imgFile" onchange="readURL(this)">
        <div id="preview" class="text-center">
            <img id="viewImg" src="{{ $default }}" alt="Upload Preview" onclick="openFormFile()" style="width: 100%;" class="img-responsive">
        </div>
    </form>
</div>
@endsection

@section('js')
<script>
    function readURL(input) {
        var defaults = "{{ $default }}";
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

    function openFormFile() {
        $('#imgFile').click();
    }
</script>
@endsection
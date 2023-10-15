@extends('admin')
@section('title', 'Home')
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
    <div class="card">
        <div class="card-header">
            <h5 class="my-1 p-0">Profile Perusahaan</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="">Nama Perusahaan</label>
                    <input type="text" class="form-control" name="nama_perusahaan">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Nama Brand</label>
                    <input type="text" class="form-control" name="nama_brand">
                </div>

            </div>
            <div class="col-md-12 mb-3">
                <div class="content">
                    <div style="height:126px;position: relative;">
                        <a class="hover-simple cursor-pointer" onclick="openModal()" style=" margin: 0;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                            <h1><i class="bi bi-plus-circle"></i></h1>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="my-1 p-0">Slider</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="">Nama Perusahaan</label>
                    <input type="text" class="form-control" name="nama_perusahaan">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Nama Brand</label>
                    <input type="text" class="form-control" name="nama_brand">
                </div>

                @php
                $defaultFoto = ENV('ASSET_URL') . "/assets/compro/img/slide.png";
                $default = "";
                @endphp
                @foreach( $data as $d )
                @php
                $default = ($d->slide == '' ? $defaultFoto : ENV('ASSET_URL') . "/uploads/slider/" . $d->slide);
                @endphp
                <div class="col-md-4 mb-3">
                    <div class="content">
                        <span class="bg-base text-light" style="position: absolute;  padding:4px 8px;">{{ $d->idx }}</span>
                        <span class="bg-base text-light" style="position: absolute; right:0px; padding:3px 20px;">{{ $d->status }}</span>
                        <div class="content-overlay"></div>
                        <img class="content-image" src="{{ $default }}" alt="Img Slider" style="width: 325px;height:126px;">
                        <div class="content-details fadeIn-bottom">
                            <a onclick="getDataHome(this)" data-id="{{ $d->home_id }}" class="cursor-pointer">
                                <h5 class="content-title"><i class="bi bi-pencil"></i> Ubah Data</h5>
                            </a>
                            <a class="cursor-pointer" data-url="{{ route('home.delete', $d->home_id ) }}" onclick="confirmDelete(this)">
                                <h5 class="content-title"><i class="bi bi-trash"></i> Hapus Data</h5>
                            </a>
                        </div>
                    </div>
                </div>

                @endforeach
                <div class="col-md-4 mb-3">
                    <div class="content">
                        <div style="height:126px;position: relative;">
                            <a class="hover-simple cursor-pointer" onclick="openModal()" style=" margin: 0;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                                <h1><i class="bi bi-plus-circle"></i></h1>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <form action="{{ route('home_social_media.post') }}" method="POST" id="formSocmed">
            @csrf
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="my-1 p-0">Social Media</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- SOSIAL MEDIA -->
                <div class="row mt-3">
                    @foreach( $dataSosmed as $ds )
                    <div class="col-md-6 col-12">
                        <label for="">{{ $ds->data_name }} {{ ($ds->data_name == 'Whatsapp' ? ($ds->data_id == '000003' ? 'Kedoya' : 'Cengkareng') : '' ) }} </label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="bi bi-{{ strtolower($ds->data_name) }}"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="{{ $ds->data_name }}" aria-label="{{ $ds->data_name }} Link" name="{{ strtolower($ds->data_id) }}" id="{{ strtolower($ds->data_name) }}_link" data-name="{{ strtolower($ds->data_name) }}" data-id="{{ $ds->data_id }}" value="{{ $ds->note ?? '' }}">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </form>
    </div>


    <div class="modal fade" id="addSlider" tabindex="-1" role="dialog" aria-labelledby="addSliderLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('home.post') }}" enctype="multipart/form-data" method="POST" id="formAddSlider"> @csrf
                    <input type="hidden" value="0" name="id" id="id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSliderLabel">Form Slider</h5>
                        <button type="button" class="close" onclick="closeModal()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for=""> File harus berformat jpg,jpeg,png Max Size( 4 mb )</label>
                        <input type="file" class="form-control d-none" name="imgFile" id="imgFile" onchange="readURL(this)">
                        <div id="preview" class="text-center">
                            <img id="viewImg" src="{{ $defaultFoto }}" alt="Upload Preview" onclick="openFormFile()" style="width: 325px;height:126px;">
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for=""><span class="text-danger">*</span> Urutan</label>
                                <input type="text" required class="form-control" required name="idx" id="idx">
                            </div>
                            <div class="col-md-6">
                                <label for=""><span class="text-danger">*</span> Status</label>
                                <select name="status" required id="status" required class="form-control">
                                    <option value="">Pilih Status</option>
                                    <option value="Draft">Draft</option>
                                    <option value="Publish">Publish</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    function getDataHome(e) {
        var id = $(e).attr('data-id')

        var data = {
            _token: '{{ csrf_token() }}',
            id: id,
        }
        var formData = JSON.stringify(data);
        $.ajax({
            type: 'POST',
            url: "{{  route('home.edit') }}",
            contentType: "application/json",
            processData: false,
            data: formData,
            success: function(response) {
                console.log(response)
                var row = response.data
                if (response.code == 200) {
                    var file = "{{ENV('ASSET_URL')}}" + "/uploads/slider/" + row.slide
                    $('#viewImg').attr('src', file)
                    $('#id').val(row.home_id)
                    $('#idx').val(row.idx)
                    $('#status').val(row.status)
                    $('#addSlider').modal('show')
                }
            }
        });
    }

    function confirmDelete(e) {
        if (confirm('Apakah anda yakin ingin menghapus data ini ?')) {
            var url = $(e).attr('data-url')
            window.location.href = url;
        } else {
            // Do nothing!
            Alert('Hapus telah dibatalkan')
        }
    }

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

    function saveLink(e) {
        var id = $(e).attr('data-id')
        var name = $(e).attr('data-name')
        var link = $(e).val()

        var data = {
            _token: '{{ csrf_token() }}',
            id: id,
            name: name,
            link: link
        }
        var formData = JSON.stringify(data);
        $.ajax({
            type: 'POST',
            url: "{{  route('home_social_media.post') }}",
            contentType: "application/json",
            processData: false,
            data: formData,
            success: function(response) {
                console.log(response)
                if (response.code == 200) {
                    alert('Berhasil menyimpan')
                } else {
                    alert('Gagal menyimpan')
                }
            }
        });
    }

    function closeModal() {
        $('#addSlider').modal('hide')
        var file = "{{ENV('ASSET_URL')}}" + "/assets/compro/img/slide.png";
        $('#viewImg').attr('src', file)
        $('#id').val(row.home_id)
        $('#idx').val(row.idx)
        $('#status').val(row.status)
    }

    function openModal() {
        $('#addSlider').modal('show')
    }
</script>
@endsection
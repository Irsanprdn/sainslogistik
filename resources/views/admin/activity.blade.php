@extends('admin')
@section('title', 'Activity')
@section('content')
<div class="container">
    <div class="row">
        @php
        $defaultFoto = ENV('ASSET_URL') . "/assets/compro/img/activity.png";
        $default = "";
        @endphp
        @foreach( $data as $d )
        @php
        $default = ($d->image == '' ? $defaultFoto : ENV('ASSET_URL') . "/uploads/activity/" . $d->image);
        @endphp
        <div class="col-md-4 mb-3">
            <div class="content rounded">
                <span class="bg-base text-light" style="position: absolute;  padding:4px 8px;">{{ $d->idx }}</span>
                <span class="bg-base text-light" style="position: absolute; right:0px; padding:3px 20px;">{{ $d->status }}</span>
                <div class="content-overlay"></div>
                <img class="content-image" src="{{ $default }}" alt="Image Activity" style="width: 320px;height:320px;">
                <div class="content-details fadeIn-bottom">
                    <a onclick="getDataActivity(this)" data-id="{{ $d->activity_id }}" class="cursor-pointer">
                        <h5 class="content-title"><i class="bi bi-pencil"></i> Ubah Data</h5>
                    </a>
                    <a data-url="{{ route('activity.delete', $d->activity_id ) }}" onclick="confirmDelete(this)" class="cursor-pointer">
                        <h5 class="content-title"><i class="bi bi-trash"></i> Hapus Data</h5>
                    </a>
                </div>
            </div>
        </div>

        @endforeach
        <div class="col-md-4 mb-3">
            <div class="content">
                <div style="height:320px;position: relative;">
                    <a class="hover-simple cursor-pointer" onclick="openModal()" style=" margin: 0;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);">
                        <h1><i class="bi bi-plus-circle"></i></h1>
                    </a>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="addActivity" tabindex="-1" role="dialog" aria-labelledby="addActivityLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('activity.post') }}" enctype="multipart/form-data" method="POST" id="formAddActivity"> @csrf
                    <input type="hidden" value="0" name="id" id="id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addActivityLabel">Form Activity</h5>
                        <button type="button" class="close" onclick="closeModal()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="">Masukan file harus berformat jpg,jpeg,png Max Size( 4 mb )</label>
                        <input type="file" class="form-control d-none" name="imgFile" id="imgFile" onchange="readURL(this)">
                        <div id="preview" class="text-center">
                            <img id="viewImg" src="{{ $defaultFoto }}" alt="Upload Preview" onclick="openFormFile()" style="width: 320px;height:320px;">
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Masukan urutan</label>
                                <input type="text" class="form-control" required name="idx" id="idx">
                            </div>
                            <div class="col-md-6">
                                <label for="">Masukan status</label>
                                <select name="status" id="status" class="form-control" required>
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
    function getDataActivity(e) {
        var id = $(e).attr('data-id')

        var data = {
            _token: '{{ csrf_token() }}',
            id: id,
        }
        var formData = JSON.stringify(data);
        $.ajax({
            type: 'POST',
            url: "{{  route('activity.edit') }}",
            contentType: "application/json",
            processData: false,
            data: formData,
            success: function(response) {
                console.log(response)
                var row = response.data
                if (response.code == 200) {
                    var file = "{{ENV('ASSET_URL')}}" + "/uploads/activity/" + row.image
                    $('#viewImg').attr('src', file)
                    $('#id').val(row.activity_id)
                    $('#idx').val(row.idx)
                    $('#status').val(row.status)
                    $('#addActivity').modal('show')
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

    function closeModal() {
        $('#addActivity').modal('hide')
        var file = "{{ENV('ASSET_URL')}}" + "/assets/compro/img/activity.png"
        $('#viewImg').attr('src', file)
        $('#id').val('')
        $('#idx').val('')
        $('#status').val('')
    }

    function openModal() {
        $('#addActivity').modal('show')
    }
</script>
@endsection
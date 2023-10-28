@extends('admin')
@section('title', 'Client')
@section('content')


<div class="collapse" id="collapseTambahData">
    <div class="card card-body">
        <form action="{{ route('client.post') }}" enctype="multipart/form-data" method="POST" id="formPost">
            @csrf
            <div class="row">
                <div class="col-md-8 col-12">
                    <div class="form-group">
                        <label for="client_name">Client Name</label>
                        <input type="text" name="client_id" class="form-control d-none" id="client_id">
                        <input type="text" name="client_name" class="form-control" id="client_name">
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">Choose Status</option>
                            <option value="Draft">Draft</option>
                            <option value="Publish">Publish</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="logoClient">Client Logo</label>
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
    <table id="client-data" class="table table-striped table-hover" style="width:100%">
        <thead class="bg-base text-light">
            <tr>
                <th>Client Name</th>
                <th>Client Logo</th>
                <th>Status</th>
                <th>Updated By</th>
                <th>Updated Date</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $data as $d )
            <tr>
                <td class="clientName">{{ $d->client_name ?? ''}}</td>
                <td class="clientLogo">
                    <img src="{{ asset('assets') }}/uploads/clients/{{ $d->client_logo ?? ''}}" alt="{{ $d->client_name ?? ''}}" width="100">
                </td>
                <td class="clientStatus">{{ $d->status ?? ''}}</td>
                <td class="updatedBy">{{ $d->updated_by ?? ''}}</td>
                <td class="updatedDate">{{ $d->updated_date ?? '' }}</td>
                <td>
                    <button onclick="getDataEdit(this, '{{ $d->client_id }}')" type="button" class="btn btn-sm btn-warning mx-1" title="Ubah"><i class="bi bi-pencil"></i> </button>
                    <a data-url="{{ route('client.delete',$d->client_id) }}" onclick="confirmDelete(this)" type="button" class="btn btn-sm btn-danger mx-1" title="Hapus"><i class="bi bi-trash"></i> </button>
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
    new DataTable('#client-data', {
        fixedHeader: true,
        paging: false,
        scrollCollapse: true,
        scrollX: true,
        scrollY: 350,
        bLengthChange: true,
        bInfo: false,
        "initComplete": function(settings, json) {
            $('#client-data_wrapper').children().children().first().append($('#btn-add').html())
            $('#client-data_wrapper').find('#btn-add').removeClass('d-none')
            $('#client-data_wrapper').children().children().children().attr('id', 'btn-tambah')
        }
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

    function getDataEdit(e, clientId) {

        var clientName = $(e).parent().parent().find('.clientName').text()
        var clientLogo = $(e).parent().parent().find('.clientLogo').children().attr('src');
        var clientStatus = $(e).parent().parent().find('.clientStatus').text();
        if ($('#collapseTambahData').hasClass('show')) {
            resetForm();
            $('#btn-tambah').click()
        } else {
            $('#grup').attr('readonly', true)
            $('#btn-tambah').click()
            $("#collapseTambahData").scrollTop();

            $('#client_id').val(clientId)
            $('#client_name').val(clientName)
            $('#viewImg').attr('src', clientLogo)
            $('#status').val(clientStatus)
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
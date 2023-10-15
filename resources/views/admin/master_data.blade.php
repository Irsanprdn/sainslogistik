@extends('admin')
@section('title', 'Master Data')
@section('content')


<div class="collapse" id="collapseTambahData">
    <div class="card card-body">
        <form action="{{ route('master_data.post') }}" method="POST" id="formPost">
            @csrf
            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Grup Data</label>
                        <select name="grup" id="grup" class="form-control" onchange="groupChange(this)" required>
                            <option value="" class="text-secondary">Pilih Grup</option>
                            @foreach( $dataListGroup as $dlg)
                            <option value="{{ $dlg->group_id }}!{{ $dlg->group_name }}" class="text-dark">{{ $dlg->group_name }}</option>
                            @endforeach
                            <option value="another" class="text-dark">Tidak tersedia ingin buat grup baru</option>
                        </select>
                        <input type="text" name="groupId" class="form-control d-none" id="groupId">
                        <input type="text" name="dataId" class="form-control d-none" id="dataId">
                        <input type="text" name="newGroup" class="form-control d-none" id="newGroup" placeholder="Masukan Grup Data Baru">
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="listData">List Data</label>
                        <input type="text" name="data" id="data" class="form-control" placeholder="Masukan List Data" required>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <input type="text" name="note" id="note" class="form-control" placeholder="Masukan Catatan">
                    </div>
                    <p class="text-right mt-3 pb-0 mb-0">
                        <button class="btn btn-sm btn-secondary" type="button" onclick="resetForm()"><i class="bi bi-arrow-clockwise"></i> Reset Form</button>
                        <button class="btn btn-sm btn-success" type="submit"><i class="bi bi-save"></i> Simpan Data</button>
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="table-responsive">

    @if (session('error'))
    <div class="alert my-3 alert-danger">{{ session('error') }}</div>
    @endif
    @if (session('success'))
    <div class="alert my-3 alert-success">{{ session('success') }}</div>
    @endif
    <div class="table-responsive">
        <table id="master-data" class="table table-striped table-hover" style="width:100%">
            <thead class="bg-base text-light">
                <tr>
                    <th>Kelompok Data</th>
                    <!-- <th>ID Data </th> -->
                    <th>Nama Data</th>
                    <th>Catatan</th>
                    <th>Di Ubah Oleh</th>
                    <th>Di Ubah Kapan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $data as $d )
                <tr>
                    <td>{{ $d->group_name ?? ''}}</td>
                    <!-- <td>{{ $d->data_id ?? ''}}</td> -->
                    <td>{{ $d->data_name ?? ''}}</td>
                    <td>{{ $d->note ?? ''}}</td>
                    <td>{{ $d->updated_by ?? ''}}</td>
                    <td>{{ $d->updated_date ?? '' }}</td>
                    <td>
                        <button onclick="getDataEdit('{{ $d->group_id }}','{{ $d->data_id }}')" type="button" class="btn btn-sm btn-warning mx-1" title="Ubah"><i class="bi bi-pencil"></i> </button>
                        <a data-url="{{ route('master_data.delete',[$d->group_id,$d->data_id]) }}" 
                        onclick="confirmDelete(this)" type="button" class="btn btn-sm btn-danger mx-1" title="Hapus"><i class="bi bi-trash"></i> </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div id="btn-add" class="d-none">
    <button class="btn btn-sm btn-primary bg-base btn-adds" data-toggle="collapse" href="#collapseTambahData" role="button" aria-expanded="false" aria-controls="collapseTambahData" type="button"><i class="bi bi-plus"></i> Tambah Data</button>
</div>
@endsection
@section('js')
<script>
    new DataTable('#master-data', {
        fixedHeader: true,
        paging: false,
        scrollCollapse: true,
        scrollX: true,
        scrollY: 350,
        bLengthChange: true,
        bInfo: false,
        "initComplete": function(settings, json) {
            $('#master-data_wrapper').children().children().first().append($('#btn-add').html())
            $('#master-data_wrapper').find('#btn-add').removeClass('d-none')
            $('#master-data_wrapper').children().children().children().attr('id', 'btn-tambah')
        }
    });

    function groupChange(e) {
        if ($(e).val() == 'another') {
            $('#newGroup').removeClass('d-none')
        } else {
            $('#newGroup').addClass('d-none')
        }
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


    function resetForm() {
        $('#formPost')[0].reset()
        $('#grup').attr('readonly', false)
    }

    function getDataEdit(groupId, dataId) {
        var data = {
            _token: '{{ csrf_token() }}',
            groupId: groupId,
            dataId: dataId
        }
        var formData = JSON.stringify(data);
        $.ajax({
            type: 'POST',
            url: "{{  route('master_data.edit') }}",
            contentType: "application/json",
            processData: false,
            data: formData,
            success: function(response) {
                console.log(response)
                if (response.code == 200) {
                    var row = response.data[0]

                    if ($('#collapseTambahData').hasClass('show')) {
                        resetForm();
                        $('#btn-tambah').click()
                    } else {
                        $('#grup').attr('readonly', true)
                        $('#btn-tambah').click()

                        $('#groupId').val(row.group_id)
                        $('#dataId').val(row.data_id)
                        $('#grup').val(row.group_id + '!' + row.group_name)
                        $('#data').val(row.data_name)
                        $('#note').val(row.note)
                    }


                }
            }
        });

    }
</script>
@endsection
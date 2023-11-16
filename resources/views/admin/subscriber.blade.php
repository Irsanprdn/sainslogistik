@extends('admin')
@section('title', 'Subsriber')
@section('content')


@if (session('error'))
<div class="alert my-3 alert-danger">{{ session('error') }}</div>
@endif
@if (session('success'))
<div class="alert my-3 alert-success">{{ session('success') }}</div>
@endif
<div class="table-responsive">
    <table id="subscriber-data-id" class="table table-striped table-hover" style="width:100%">
        <thead class="bg-base text-light">
            <tr>
                <th>Email</th>
                <th>Subscriber At</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $data as $d )
            <tr>
                <td >{!! $d->email ?? '' !!}</td>
                <td >{{ $d->created_at ?? ''}}</td>
                <td>                    
                    <a data-url="{{ route('subscriber.delete',$d->email) }}" onclick="confirmDelete(this)" type="button" class="btn btn-sm btn-danger mx-1" title="Hapus"><i class="bi bi-trash"></i> </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
@section('js')
<script>
    var dataTableId = new DataTable('#subscriber-data-id', {
        fixedHeader: true,
        paging: false,
        scrollCollapse: true,
        scrollX: true,
        scrollY: 350,
        bLengthChange: true,
        rowReorder: true,
        bInfo: false
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

</script>
@endsection
@extends('admin')
@section('title', 'Contact')
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

    <form action="{{ route('contact.post') }}" enctype="multipart/form-data" method="POST" id="formContact"> @csrf
        <div class="text-right mt-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        @foreach( $data as $d )
        <div class="row">
            <div class="col-md-6">
                <input type="hidden" name="contact_id[]" value="{{ $d->contact_id ?? '' }}">
                <div class="form-group">
                    <label for="">Lokasi</label>
                    <input type="text" class="form-control" name="name[]" id="name" value="{{ $d->name ?? '' }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Link</label>
                    <input type="text" class="form-control" name="link_name[]" id="link_name" value="{{ $d->link_name ?? '' }}">
                </div>
            </div>
            <!-- <div class="col-md-2">
                <div class="form-group">
                    <label for="">Atur Sebagai Judul</label>
                    <input type="checkbox" name="is_title[]" id="is_title" class="form-control-sm" {{  ( $d->is_title ?? '' ) == 'Y' ? 'checked' : '' }}>
                </div>
            </div> -->
        </div>
        @endforeach
    </form>
</div>
@endsection
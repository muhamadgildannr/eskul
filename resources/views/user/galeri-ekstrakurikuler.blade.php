@extends('layouts.user')

@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>{{ $data->ekstrakurikuler }}</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('userIndex') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('userIndex') }}/galeri">Galeri</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $data->ekstrakurikuler }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<section class="section">
    <div class="card">
        @if (auth()->user()->ekstrakurikuler)
        <div class="card-header">
            <div class="clearfix">
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Tambah
                </button>
            </div>
        </div>
        @endif
        <div class="card-body {{ !auth()->user()->ekstrakurikuler ? 'py-5' : '' }}">
            @forelse ($daftarGaleri as $galeri)
            @if (auth()->user()->ekstrakurikuler)
            <a class="galeri" href="{{ Request::url().'/'.$galeri->id.'/'.md5('hapus') }}">
                <img src="{{ asset('galeri/'.strtolower(str_replace(' ', '-', $data->ekstrakurikuler)).'/'.$galeri->gambar) }}" alt="">
            </a>
            @else
            <div class="galeri">
                <img src="{{ asset('galeri/'.strtolower(str_replace(' ', '-', $data->ekstrakurikuler)).'/'.$galeri->gambar) }}" alt="">
            </div>
            @endif
            @empty
            <div class="d-flex flex-column text-center text-muted py-5" style="opacity: .3">
                <i data-feather="image" style="width: 150px; height: 150px" class="mx-auto"></i>
                <h4>Galeri Kosong</h4>
            </div>
            @endforelse
        </div>
    </div>
</section>


@if (auth()->user()->ekstrakurikuler)
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Gambar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-file">
                        <label class="form-file-label d-block" for="gambar">
                            <span class="form-file-text">Pilih Gambar</span>
                        </label>
                        <input type="file" class="form-file-input" id="gambar" name="gambar">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection

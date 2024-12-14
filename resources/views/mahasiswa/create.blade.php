@extends('layouts.master')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Create Mahasiswa</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="width: 60rem">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Mahasiswa</h5>

                        <!-- Form -->
                        <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="nama">Nama Mahasiswa</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="npm">NPM</label>
                                <input type="text" class="form-control" id="npm" name="npm" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="angkatan">Angkatan</label>
                                <input type="number" class="form-control" id="angkatan" name="angkatan" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="tahun_lulus">Tahun Lulus</label>
                                <input type="date" class="form-control" id="tahun_lulus" name="tahun_lulus" required>
                            </div>

                            <div class="mb-3">
                                <label for="profile_picture" class="form-label">Profile Picture</label>
                                <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                                {{-- @error('profile_picture')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror --}}
                              </div>

                            <button type="submit" class="btn btn-primary">Create Mahasiswa</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

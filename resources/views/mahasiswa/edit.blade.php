@extends('layouts.master')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Mahasiswa</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="width: 60rem">
                    <div class="card-body">
                        <h5 class="card-title">Edit Mahasiswa</h5>

                        <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Mahasiswa Information -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $mahasiswa->user->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="npm" class="form-label">NPM</label>
                                <input type="text" class="form-control" id="npm" name="npm" value="{{ old('npm', $mahasiswa->npm) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="angkatan" class="form-label">Angkatan</label>
                                <input type="number" class="form-control" id="angkatan" name="angkatan" value="{{ old('angkatan', $mahasiswa->angkatan) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                                <input type="date" class="form-control" id="tahun_lulus" name="tahun_lulus" value="{{ old('tahun_lulus', $mahasiswa->tahun_lulus) }}" required>
                            </div>

                            <!-- Password Field -->
                            <div class="mb-3">
                                <label for="password" class="form-label">New Password (Leave blank if not changing)</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>

                            <div class="mb-3">
                                <label for="profile_picture" class="form-label">Profile Picture</label>
                                <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                                @if ($mahasiswa->user->profile_picture)
                                    <img src="{{ asset('storage/' . $mahasiswa->user->profile_picture) }}" alt="Profile Picture" class="img-thumbnail mt-2" width="150">
                                @endif
                                {{-- @error('profile_picture')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror --}}
                              </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update Mahasiswa</button>
                                <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
@endsection

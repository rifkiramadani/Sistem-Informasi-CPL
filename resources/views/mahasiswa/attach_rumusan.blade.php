@extends('layouts.master')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Attach Rumusan Dosen to Mahasiswa</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="width: 60rem">
                    <div class="card-body">
                        <h5 class="card-title">Attach Rumusan Dosen</h5>

                        <!-- Form to attach Rumusan Dosen to Mahasiswa -->
                        <form action="{{ route('mahasiswa.attachRumusanDosen', $mahasiswa->id) }}" method="POST">
                            @csrf

                            <!-- Select Rumusan Dosen -->
                            <div class="form-group mb-3">
                                <label for="rumusan_dosen_id">Rumusan Dosen</label>
                                <select class="form-control" id="rumusan_dosen_id" name="rumusan_dosen_id" required>
                                    @foreach($rumusanDosens as $rumusanDosen)
                                        <option value="{{ $rumusanDosen->id }}">
                                            {{ $rumusanDosen->dosen->user->name ?? 'Tidak ada name' }} - {{ $rumusanDosen->rumusan->mata_kuliah->name ?? 'Tidak ada mata kuliah' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Attach Rumusan Dosen</button>
                            <a href="{{ route('mahasiswa.show', $mahasiswa->id) }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
@endsection

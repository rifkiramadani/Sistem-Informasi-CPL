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
                        <form action="{{ route('mahasiswa.store') }}" method="POST">
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
                                <label for="semester_id">Semester</label>
                                <select class="form-control" id="semester_id" name="semester_id" required>
                                    @foreach($semesters as $semester)
                                        <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                                    @endforeach
                                </select>
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

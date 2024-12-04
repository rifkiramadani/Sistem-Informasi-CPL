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

                        <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="post">
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
                                <label for="semester_id" class="form-label">Semester</label>
                                <select class="form-select" id="semester_id" name="semester_id" required>
                                    <option value="" disabled>Select Semester</option>
                                    @foreach ($semesters as $semester)
                                        <option value="{{ $semester->id }}" {{ $semester->id == $mahasiswa->semester_id ? 'selected' : '' }}>
                                            {{ $semester->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Password Field -->
                            <div class="mb-3">
                                <label for="password" class="form-label">New Password (Leave blank if not changing)</label>
                                <input type="password" class="form-control" id="password" name="password">
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

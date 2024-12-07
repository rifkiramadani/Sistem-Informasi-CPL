@extends('layouts.master')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Detail Mahasiswa</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="width: 60rem">
                    <div class="card-body">
                        <h5 class="card-title">Detail Mahasiswa</h5>

                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <td>{{ $mahasiswa->user->name }}</td>
                            </tr>
                            <tr>
                                <th>NPM</th>
                                <td>{{ $mahasiswa->npm }}</td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td>{{ $mahasiswa->user->username }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $mahasiswa->user->email }}</td>
                            </tr>
                            <tr>
                                <th>Semester</th>
                                <td>{{ $mahasiswa->semester->name }}</td>
                            </tr>
                        </table>

                        <!-- List Attached Rumusan Dosen -->
                        <h6>Attached Rumusan Dosen:</h6>
                        <ul>
                            @foreach ($mahasiswa->rumusanMahasiswas as $rumusanMahasiswa)
                                <li>{{ $rumusanMahasiswa->rumusanDosen->dosen->user->name ?? 'Tidak ada name' }} - {{ $rumusanMahasiswa->rumusanDosen->rumusan->mata_kuliah->name ?? 'Tidak ada mata kuliah' }}</li>
                            @endforeach
                        </ul>

                        <!-- Button to Attach Rumusan Dosen -->
                        <a href="{{ route('mahasiswa.attachRumusanDosen', $mahasiswa->id) }}" class="btn btn-success">Attach Rumusan Dosen</a>

                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
@endsection

@extends('layouts.master')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Edit Nilai for Mahasiswa: {{ $mahasiswa->user->name }}</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Update Nilai</h5>

                            <!-- Check for errors -->
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Form to update Nilai -->
                            <form action="{{ route('mahasiswa.nilai.update', $mahasiswa->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Rumusan Dosen</th>
                                                <th>Mata Kuliah</th>
                                                <th>Rumusan CPL</th>
                                                <th>Nilai</th>
                                                <th>Skor Maks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rumusanMahasiswaNilais as $rumusanMahasiswaNilai)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $rumusanMahasiswaNilai->rumusanMahasiswa->rumusanDosen->dosen->user->name ?? 'N/A' }}</td>
                                                    <td>{{ $rumusanMahasiswaNilai->rumusanCplCpmk->rumusanCpl->rumusan->mata_kuliah->name ?? 'N/A' }}</td>
                                                    <td>{{ $rumusanMahasiswaNilai->rumusanCplCpmk->rumusanCpl->cpl->name ?? 'N/A' }}</td>
                                                    <td>
                                                        <input type="number" name="nilai[{{ $rumusanMahasiswaNilai->id }}]"
                                                               value="{{ old('nilai.' . $rumusanMahasiswaNilai->id, $rumusanMahasiswaNilai->nilai) }}"
                                                               max="{{ $rumusanMahasiswaNilai->rumusanCplCpmk->skor_maks }}"
                                                               class="form-control" />
                                                    </td>
                                                    <td>{{ $rumusanMahasiswaNilai->rumusanCplCpmk->skor_maks }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <button type="submit" class="btn btn-primary">Update Nilai</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

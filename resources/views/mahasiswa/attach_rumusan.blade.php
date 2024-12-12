@extends('layouts.master')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Attach Rumusan Dosen to Mahasiswa</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="width: 80rem">
                        <div class="card-body">
                            @if (session()->has('success'))
                                <div class="alert alert-success mt-3">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <h5 class="card-title">Attach Rumusan to {{ $mahasiswa->user->name }}</h5>

                            <!-- Form to attach Rumusan Dosen to Mahasiswa -->
                            <form action="{{ route('mahasiswa.attachRumusanDosen', $mahasiswa->id) }}" method="POST">
                            @csrf
                                @method('PUT')

                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Select</th>
                                            <th scope="col">No</th>
                                            <th>Dosen</th>
                                            <th scope="col">Kode Matkul</th>
                                            <th scope="col">Mata Kuliah</th>
                                            <th scope="col">CPL</th>
                                            <th scope="col">Deskripsi (CPL)</th>
                                            <th scope="col">CPMK</th>
                                            <th scope="col">Deskripsi (CPMK)</th>
                                            <th scope="col">Skor Maks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rumusanDosens as $rumusanDosen)
                                            <tr>
                                                <!-- Move the checkbox to the first column -->
                                                <td>
                                                    <input type="checkbox" name="rumusan_dosen_id[]"
                                                        value="{{ $rumusanDosen->id }}"
                                                        @if ($mahasiswa->rumusanMahasiswas->contains('rumusan_dosen_id', $rumusanDosen->id)) checked @endif
                                                        class="form-check-input">
                                                </td>

                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $rumusanDosen->dosen->user->name ?? 'Tidak ada name' }}</td>
                                                <td>{{ $rumusanDosen->rumusan->mata_kuliah->kode_matkul }}</td>
                                                <td>{{ $rumusanDosen->rumusan->mata_kuliah->name }}</td>
                                                <td>
                                                    @foreach ($rumusanDosen->rumusan->rumusanCpls as $cpl)
                                                        <ul>
                                                            <li>{{ $cpl->cpl->name }}</li>
                                                        </ul>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($rumusanDosen->rumusan->rumusanCpls as $cpl)
                                                        <ul>
                                                            <li>{{ $cpl->cpl->deskripsi }}</li>
                                                        </ul>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($rumusanDosen->rumusan->rumusanCpls as $cpl)
                                                        <ul>
                                                            <li>
                                                                @foreach ($cpl->rumusanCplCpmks as $cpmk)
                                                                    <ul>
                                                                        <li>{{ $cpmk->cpmk->name }}</li>
                                                                    </ul>
                                                                @endforeach
                                                            </li>
                                                        </ul>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($rumusanDosen->rumusan->rumusanCpls as $cpl)
                                                        <ul>
                                                            <li>
                                                                @foreach ($cpl->rumusanCplCpmks as $cpmk)
                                                                    <ul>
                                                                        <li>{{ $cpmk->cpmk->deskripsi }}</li>
                                                                    </ul>
                                                                @endforeach
                                                            </li>
                                                        </ul>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($rumusanDosen->rumusan->rumusanCpls as $cpl)
                                                        <ul>
                                                            <li>
                                                                @foreach ($cpl->rumusanCplCpmks as $cpmk)
                                                                    <ul>
                                                                        <li>{{ $cpmk->skor_maks }}</li>
                                                                    </ul>
                                                                @endforeach
                                                            </li>
                                                        </ul>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <button class="btn btn-primary mt-3" type="submit">Attach Rumusan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

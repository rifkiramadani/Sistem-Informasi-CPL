@extends('layouts.master')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Attach Rumusan to Dosen</h1>
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

                            <h5 class="card-title">Attach Rumusan to {{ $dosen->user->name }}</h5>

                            <form action="/dosen/{{ $dosen->id }}/attach-rumusan" method="post">
                                @csrf
                                @method('PUT')
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Select</th>  <!-- Move "Select" column to the first position -->
                                            <th scope="col">No</th>
                                            <th scope="col">Kode Matkul</th>
                                            <th scope="col">Mata Kuliah</th>
                                            <th scope="col">Semester</th>
                                            <th scope="col">CPL</th>
                                            <th scope="col">Deskripsi (CPL)</th>
                                            <th scope="col">CPMK</th>
                                            <th scope="col">Deskripsi (CPMK)</th>
                                            <th scope="col">Skor Maks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rumusans as $rumusan)
                                            <tr>
                                                <!-- Move the checkbox to the first column -->
                                                <td>
                                                    <input type="checkbox" name="rumusan_id[]" value="{{ $rumusan->id }}"
                                                        @if ($dosen->rumusanDosens->contains($rumusan->id)) checked @endif
                                                        class="form-check-input">
                                                </td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $rumusan->mata_kuliah->kode_matkul }}</td>
                                                <td>{{ $rumusan->mata_kuliah->name }}</td>
                                                <td>{{ $rumusan->mata_kuliah->semesters->name }}</td>
                                                <td>
                                                    @foreach ($rumusan->rumusanCpls as $cpl)
                                                        <ul>
                                                            <li>{{ $cpl->cpl->name }}</li>
                                                        </ul>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($rumusan->rumusanCpls as $cpl)
                                                        <ul>
                                                            <li>{{ $cpl->cpl->deskripsi }}</li>
                                                        </ul>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($rumusan->rumusanCpls as $cpl)
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
                                                    @foreach ($rumusan->rumusanCpls as $cpl)
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
                                                    @foreach ($rumusan->rumusanCpls as $cpl)
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

@extends('layouts.master')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Table Rumusan</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="width: 63rem">
                        <div class="card-body">
                            @if (session()->has('success'))
                                <div class="alert alert-success mt-3">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <h5 class="card-title">Data Rumusan <a class="btn btn-primary float-end"
                                    href="/rumusan/create">+ Tambah Rumusan</a></h5>

                            <!-- Table with hoverable rows -->
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Matkul</th>
                                        <th scope="col">Mata Kuliah</th>
                                        <th scope="col">Semester</th>
                                        <th scope="col">CPL</th>
                                        <th scope="col">Deskripsi (CPL)</th>
                                        <th scope="col">CPMK</th>
                                        <th scope="col">Deskripsi (CPMK)</th>
                                        <th scope="col">Skor Maks</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rumusans as $rumusan)
                                        <tr>
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
                                                                    <li>
                                                                        {{ $cpmk->cpmk->name }}
                                                                    </li>
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
                                                                    <li>
                                                                        {{ $cpmk->cpmk->deskripsigit  }}
                                                                    </li>
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
                                                                <li>
                                                                    {{ $cpmk->skor_maks }}
                                                                </li>
                                                            </ul>
                                                        @endforeach
                                                    </li>
                                                </ul>
                                            @endforeach
                                            </td>
                                            <td>
                                                <a href="/rumusan/{{ $rumusan->id }}/edit" class="btn btn-warning">
                                                    Edit</a>
                                                <form action="/rumusan/{{ $rumusan->id }}" method="post"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE ')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Yakin Ingin Menghapus Data???')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with hoverable rows -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

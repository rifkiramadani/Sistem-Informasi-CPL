@extends('layouts.master')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Mahasiswa List</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif

                        <h5 class="card-title">Data Mahasiswa <a class="btn btn-primary float-end" href="{{ route('mahasiswa.create') }}">+ Add Mahasiswa</a></h5>
                        <div class="search-bar float-start">
                            <form class="search-form d-flex" method="GET" action="/mahasiswa">
                                <input class="form-control" type="search" name="search" placeholder="Masukkan Nama Mahasiswa" title="Masukkan Nama Mahasiswa">
                                <button class="btn btn-secondary" type="submit" title="Search"><i class="bi bi-search"></i></button>
                              </form>
                          </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>NPM</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mahasiswas as $mahasiswa)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $mahasiswa->user->name }}</td>
                                        <td>{{ $mahasiswa->npm }}</td>
                                        <td>{{ $mahasiswa->user->email }}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{ route('mahasiswa.show', $mahasiswa->id) }}">Detail</a>
                                            <a class="btn btn-warning" href="{{ route('mahasiswa.edit', $mahasiswa->id) }}">Edit</a>
                                            <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            {{ $mahasiswas->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
@endsection

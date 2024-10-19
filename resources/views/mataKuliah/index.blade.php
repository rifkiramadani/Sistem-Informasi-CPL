@extends('layouts.master')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Table Mata Kuliah</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">General</li>
        </ol>
      </nav>
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
              <h5 class="card-title">Data Mata Kuliah <a class="btn btn-primary float-end" href="/matakuliah/create">+ Tambah Mata Kuliah</a></h5>
              <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode Matkul</th>
                    <th scope="col">Nama Mata Kuliah</th>
                    <th scope="col">Semester</th>
                    <th scope="col">CPL yang di penuhi</th>
                    <th scope="col">Deskripsi CPL</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($matakuliahs as $matakuliah)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $matakuliah->kode_matkul }}</td>
                    <td>{{ $matakuliah->name }}</td>
                    <td>{{ $matakuliah->semesters->name }}</td>
                    <td>
                      @foreach ($matakuliah->cpls as $cpl)
                          {{ $cpl->name }}<hr>
                      @endforeach
                    </td>
                    <td style="font-size: 10px;" class="fw-bold">
                      @foreach ($matakuliah->cpls as $cpl)
                          {{ $cpl->deskripsi }}<hr>
                      @endforeach
                    </td>
                    <td>
                      <a class="btn btn-warning" href="/matakuliah/{{ $matakuliah->id }}/edit">Edit</a>
                      <form action="/matakuliah/{{ $matakuliah->id }}" method="post" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger"  onclick="return confirm('Yakin Ingin Menghapus Data???')">Delete</button>
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
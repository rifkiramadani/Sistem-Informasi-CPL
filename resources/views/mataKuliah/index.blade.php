@extends('layouts.master')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Table Mata Kuliah</h1>
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
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($matakuliahs as $matakuliah)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $matakuliah->kode_matkul }}</td>
                    <td>{{ $matakuliah->name }}</td>
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
              <div>
                {{ $matakuliahs->links('pagination::bootstrap-5') }}
            </div>
              <!-- End Table with hoverable rows -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
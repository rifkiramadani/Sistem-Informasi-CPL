@extends('layouts.master')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Table CPMK</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card" style="width: 60rem">
            <div class="card-body">
              @if (session()->has('success'))
                  <div class="alert alert-success mt-3">
                    {{ session('success') }}
                  </div>
              @endif
                <h5 class="card-title">Data CPMK <a class="btn btn-primary float-end" href="/cpmk/create">+ Tambah CPMK</a></h5>
                <div class="search-bar float-start">
                  <form class="search-form d-flex" method="GET" action="/cpmk/search">
                    <input class="form-control" type="search" name="search" placeholder="Masukkan Kode CPMK" title="Masukkan Kode CPMK">
                    <button class="btn btn-secondary" type="submit" title="Search"><i class="bi bi-search"></i></button>
                  </form>
                </div>
              <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode CPMK</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($cpmks as $cpmk)
                    <tr>
                      <th scope="row">{{ $loop->iteration }}</th>
                      <td>{{ $cpmk->name }}</td>
                      <td>{{ $cpmk->deskripsi }}</td>
                      <td>
                        <a href="/cpmk/{{ $cpmk->id }}/edit" class="btn btn-warning">Edit</a>
                        <form action="/cpmk/{{ $cpmk->id }}" method="post" class="d-inline">
                          @method('DELETE')
                          @csrf
                          <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus Data???')">Hapus</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div>
                {{ $cpmks->links('pagination::bootstrap-5') }}
              </div>
              <!-- End Table with hoverable rows -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
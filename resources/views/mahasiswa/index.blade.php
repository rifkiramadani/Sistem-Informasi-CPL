@extends('layouts.master')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Table Mahasiswa</h1>
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
              <h5 class="card-title">Data Mahasiswa <a class="btn btn-primary float-end" href="/mahasiswa/create">+ Tambah Mahasiswa</a></h5>

              <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Npm</th>
                    <th scope="col">Email</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($mahasiswas as $mahasiswa)
                  <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td class="fw-bold" >{{ $mahasiswa->user->name }}</td>
                    <td>{{ $mahasiswa->npm }}</td>
                    <td>{{ $mahasiswa->user->email }}</td>
                    <td>
                      <a class="btn btn-info" href="">Detail</a>
                      <a class="btn btn-warning" href="/mahasiswa/{{ $mahasiswa->id }}/edit">Edit</a>
                      <form action="/mahasiswa/{{ $mahasiswa->id }}" method="post" class="d-inline">
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
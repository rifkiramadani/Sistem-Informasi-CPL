@extends('layouts.master')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Table Dosen</h1>
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
              <h5 class="card-title">Data Dosen <a class="btn btn-primary float-end" href="/dosen/create">+ Tambah Dosen</a></h5>

              <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nip</th>
                    <th scope="col">Mata Kuliah Di Berikan</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($dosens as $dosen)    
                    <tr>
                      <th scope="row">{{ $loop->iteration }}</th>
                      <td class="fw-bold">{{ $dosen->user->name }}</td>
                      <td>{{ $dosen->user->username }}</td>
                      <td>{{ $dosen->user->email }}</td>
                      <td>{{ $dosen->nip }}</td>
                      <td>
                        <form action="/dosen/{{ $dosen->id }}/matakuliah" method="post">
                          @csrf
                        <a href="/dosen/{{ $dosen->id }}/matakuliah" class="float-end mt-3 ms-2"><i class="bi bi-journal-text" style="width: 4rem"></i></a>
                          @foreach ($dosen->matakuliah as $matakuliah)
                            <div class="aligned-content">{{ $matakuliah->kode_matkul }}|{{ $matakuliah->name }} <hr></div>
                          @endforeach
                            </form>
                          </td>
                            <td>
                              <a class="btn btn-warning" href="/dosen/{{ $dosen->id }}/edit">Edit</a>
                              <form action="/dosen/{{ $dosen->id }}" method="post" class="d-inline">
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
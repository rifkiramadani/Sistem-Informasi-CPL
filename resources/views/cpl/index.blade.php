@extends('layouts.master')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Table CPL</h1>
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
              <h5 class="card-title">Data CPL <a class="btn btn-primary float-end" href="/cpl/create">+ Tambah CPL</a></h5>

              <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode CPL</th> {{-- name --}}
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($cpls as $cpl)    
                    <tr>
                      <th scope="row">{{ $loop->iteration }}</th>
                      <td class="fw-bold">{{ $cpl->name }}</td>
                      <td>{{ $cpl->deskripsi }}</td>
                      {{-- <td>
                        @foreach ($cpl->cpmks as $cpmk)
                            <div class="aligned-content">{{ $cpmk->name }} <hr></div>
                        @endforeach
                      </td>
                      <td style="font-size: 10px;" >
                        @foreach ($cpl->cpmks as $cpmk)
                            <div class="aligned-content">{{ $cpmk->deskripsi }}<hr></div>
                        @endforeach
                      </td> --}}
                      <td>
                        <a class="btn btn-warning" href="/cpl/{{ $cpl->id }}/edit">Edit</a>
                        <form action="/cpl/{{ $cpl->id }}" method="post" class="d-inline">
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
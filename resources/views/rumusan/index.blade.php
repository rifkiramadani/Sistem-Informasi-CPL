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
            <h5 class="card-title">Data Rumusan <a class="btn btn-primary float-end" href="/rumusan/create">+ Tambah Rumusan</a></h5>

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
                  @foreach ($rumusans as $key => $rumusan)
                      @foreach ($rumusan->cpls as $cpl)
                          @php
                              // Kelompokkan CPMK berdasarkan CPL
                              $cplCpmks = $rumusan->cplCpmks->where('pivot.cpl_id', $cpl->id);
                          @endphp
                          <tr>
                              @if ($loop->first)
                                  <td rowspan="{{ $rumusan->cpls->count() }}">{{ $key + 1 }}</td>
                                  <td rowspan="{{ $rumusan->cpls->count() }}">{{ $rumusan->mata_kuliah->kode_matkul }}</td>
                                  <td rowspan="{{ $rumusan->cpls->count() }}">{{ $rumusan->mata_kuliah->name }}</td>
                                  <td rowspan="{{ $rumusan->cpls->count() }}">{{ $rumusan->mata_kuliah->semesters->name ?? '-' }}</td>
                                  @endif
                                  <td>{{ $cpl->name }}</td>
                                  <td>{{ $cpl->deskripsi }}</td>
                                  <td>
                                    @foreach ($cplCpmks as $cpmk)
                                    {{ $cpmk->name }}<br>
                                    @endforeach
                                  </td>
                                  <td>
                                    @foreach ($cplCpmks as $cpmk)
                                    {{ $cpmk->deskripsi }}<br>
                                    @endforeach
                                  </td>
                                  <td>
                                    @foreach ($cplCpmks as $cpmk)
                                    {{ $cpmk->pivot->skor_maks }}<br>
                                    @endforeach
                                  </td>
                                  @if ($loop->first)
                                  <td rowspan="{{ $rumusan->cpls->count() }}">
                                    <a class="btn btn-warning mb-1" style="width: 5rem" href="/rumusan/{{ $rumusan->id }}/edit">Edit</a>
                                    <form action="/rumusan/{{ $rumusan->id }}" method="post" class="d-inline">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger" style="width: 5rem" onclick="return confirm('Yakin Ingin Menghapus Data?')">Delete</button>
                                      </form>
                                  </td>
                              @endif
                          </tr>
                      @endforeach
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
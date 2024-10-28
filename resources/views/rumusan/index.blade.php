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
              <h5 class="card-title">Data Rumusan</h5>

              <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode MK</th>
                    <th scope="col">Nama Mata Kuliah</th>
                    <th scope="col">Semester</th>
                    <th scope="col">CPL yang di Penuhi</th>
                    <th scope="col">Deskripsi CPL</th>
                    <th scope="col">CPMK yang di Penuhi</th>
                    <th scope="col">Deskripsi CPMK</th>
                    <th scope="col">Skor Maks</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($matakuliahs as $matakuliah)    
                    <tr>
                      <th scope="row">{{ $loop->iteration }}</th>
                      <td>{{ $matakuliah->kode_matkul }}</td>
                      <td>{{ $matakuliah->name }}</td>
                      <td>{{ $matakuliah->semesters->name }}</td>
                      <td class="fw-bold">
                        @foreach ($matakuliah->cpls as $cpl)
                           <div class="aligned-content">{{ $cpl->name }} <hr></div>
                        @endforeach
                      </td>
                      <td style="font-size: 10px;">
                        @foreach ($matakuliah->cpls as $cpl)
                            <div class="aligned-content">{{ $cpl->deskripsi }} <hr></div>
                        @endforeach
                      </td>
                      <td class="fw-bold">
                        @foreach ($matakuliah->cpls as $cpl)
                            @foreach ($cpl->cpmks as $cpmk)
                                <div class="aligned-content">{{ $cpmk->name }} <hr></div>
                            @endforeach
                        @endforeach
                      </td>
                      <td style="font-size: 10px;">
                        @foreach ($matakuliah->cpls as $cpl)
                            @foreach ($cpl->cpmks as $cpmk)
                                <div class="aligned-content">{{ $cpmk->deskripsi }} <hr></div>
                            @endforeach
                        @endforeach
                      </td>
                      <td>
                        @foreach ($matakuliah->cpls as $cpl)
                            @foreach ($cpl->cpmks as $cpmk)
                                <div class="aligned-content">{{ $cpmk->skor_maks }} <hr></div>
                            @endforeach
                        @endforeach
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
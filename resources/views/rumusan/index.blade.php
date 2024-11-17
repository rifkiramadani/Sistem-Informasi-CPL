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
                    <tr>
                      <th scope="row"></th>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
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
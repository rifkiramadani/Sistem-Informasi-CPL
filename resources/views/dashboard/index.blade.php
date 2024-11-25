@extends('layouts.master')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
            <div class="card-body">
                <div class="row">
                    <div class="col-xxl-4 col-md-3 mt-3">
                        <div class="card info-card sales-card">
                          <div class="card-body">
                            <h5 class="card-title">Admin</h5>
                            <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-person" style="font-size: 4rem"></i>
                              </div>
                              <div class="ps-3">
                                <h3>{{ $admin }}</h3>
                                <a href="/admin" class="btn btn-outline-primary btn-sm"><span class="text-muted-white pt-2 ps-1">Lihat >></span></a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                    <div class="col-xxl-4 col-md-3 mt-3">
                        <div class="card info-card sales-card">
                          <div class="card-body">
                            <h5 class="card-title">Operator</h5>
                            <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-person" style="font-size: 4rem"></i>
                              </div>
                              <div class="ps-3">
                                <h3>{{ $operator }}</h3>
                                <a href="/operator" class="btn btn-outline-primary btn-sm"><span class="text-muted-white pt-2 ps-1">Lihat >></span></a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      
                      <div class="col-xxl-4 col-md-3 mt-3">
                          <div class="card info-card sales-card">
                              <div class="card-body">
                                  <h5 class="card-title">Dosen</span></h5>
                                  <div class="d-flex align-items-center">
                                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                          <i class="bi bi-person" style="font-size: 4rem"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h3>{{ $dosen }}</h3>
                                            <a href="/dosen" class="btn btn-outline-primary btn-sm"><span class="text-muted-white pt-2 ps-1">Lihat >></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-4 col-md-3 mt-3">
                            <div class="card info-card sales-card">
                              <div class="card-body">
                                <h5 class="card-title">Mahasiswa</span></h5>
                                <div class="d-flex align-items-center">
                                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-person" style="font-size: 4rem"></i>
                                  </div>
                                  <div class="ps-3">
                                    <h3>{{ $mahasiswa }}</h3>
                                    <a href="/mahasiswa" class="btn btn-outline-primary btn-sm"><span class="text-muted-white pt-2 ps-1">Lihat >></span></a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>

                    <div class="col-xxl-4 col-md-3 mt-3">
                        <div class="card info-card sales-card">
                          <div class="card-body">
                            <h5 class="card-title">CPMK</span></h5>
                            <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-journals" style="font-size: 4rem"></i>
                              </div>
                              <div class="ps-3">
                                <h3>{{ $cpmk }}</h3>
                                <a href="/cpmk" class="btn btn-outline-primary btn-sm"><span class="text-muted-white pt-2 ps-1">Lihat >></span></a>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-md-3 mt-3">
                        <div class="card info-card sales-card">
                          <div class="card-body">
                            <h5 class="card-title">CPL</span></h5>
                            <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-journal" style="font-size: 4rem"></i>
                              </div>
                              <div class="ps-3">
                                <h3>{{ $cpl }}</h3>
                                <a href="/cpl" class="btn btn-outline-primary btn-sm"><span class="text-muted-white pt-2 ps-1">Lihat >></span></a>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-md-3 mt-3">
                        <div class="card info-card sales-card">
                          <div class="card-body">
                            <h5 class="card-title">Mata Kuliah</span></h5>
                            <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-book" style="font-size: 4rem"></i>
                              </div>
                              <div class="ps-3">
                                <h3>{{ $matakuliah }}</h3>
                                <a href="/matakuliah" class="btn btn-outline-primary btn-sm"><span class="text-muted-white pt-2 ps-1">Lihat >></span></a>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-md-3 mt-3">
                        <div class="card info-card sales-card">
                          <div class="card-body">
                            <h5 class="card-title">Rumusan</span></h5>
                            <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-file" style="font-size: 4rem"></i>
                              </div>
                              <div class="ps-3">
                                <h3>{{ $rumusan }}</h3>
                                <a href="/rumusan" class="btn btn-outline-primary btn-sm"><span class="text-muted-white pt-2 ps-1">Lihat >></span></a>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
      </div>
    </section>
  </main>
  @endsection
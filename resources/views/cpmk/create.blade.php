@extends('layouts.master')

@section('content')
<main id="main" class="main">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tambah CPMK</h5>
          @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
          @endif
          <form action="/cpmk" method="post">
            @csrf
            <div class="mb-3">
              <label for="name">Kode CPMK</label>
              <input class="form-control" type="text" name="name" id="name" value="CPMK-" required>
            </div>
            <div class="mb-3">
              <label for="deskripsi">Deskripsi</label>
              <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="5" required></textarea>
            </div>
            <div class="mb-3">
              <label for="skor_maks">Skor Maks</label>
              <input class="form-control" type="text" name="skor_maks" id="skor_maks" required>
            </div>
            <button class="btn btn-primary" type="submit">+ Tambah Data</button>
          </form>

        </div>
      </div>
    </div>
  </div>
  </main>
@endsection
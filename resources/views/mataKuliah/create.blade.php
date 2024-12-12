@extends('layouts.master')

@section('content')
<main id="main" class="main">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Tambah Mata Kuliah</h5>
            @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
            @endif
            <form action="/matakuliah" method="post">
              @csrf
              <div class="mb-3">
                <label for="kode_matkul">Kode Mata Kuliah</label>
                <input class="form-control" type="text" name="kode_matkul" id="kode_matkul" required>
              </div>
              <div class="mb-3">
                <label for="name">Nama Mata Kuliah</label>
                <input class="form-control" type="text" name="name" id="name" required>
              </div>
              <button class="btn btn-primary" type="submit">+ Tambah Data</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    </main>
@endsection
@extends('layouts.master')

@section('content')
<main id="main" class="main">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Tambah CPL</h5>
            @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
            @endif
            <form action="/cpl" method="post">
              @csrf
              <div class="mb-3">
                <label for="name">Kode CPL</label>
                <input class="form-control" type="text" name="name" id="name" value="CPL-" required>
              </div>
              <div class="mb-3">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="5" required></textarea>
              </div>
              <button class="btn btn-primary" type="submit">+ Tambah Data</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    </main>
@endsection
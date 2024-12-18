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
              {{-- <div class="mb-3">
                <label for="cpmk_id">Pilih CPMK</label>
                <div class="form-check">
                    @foreach ($cpmks as $cpmk)
                        <input type="checkbox" name="cpmk_id[]" id="cpmk_{{ $cpmk->id }}" value="{{ $cpmk->id }}" class="form-check-input">
                        <label class="form-check-label" for="cpmk_{{ $cpmk->id }}">
                            {{ $cpmk->name }} | {{ $cpmk->deskripsi }}
                        </label>
                        <br>
                    @endforeach
                </div>
              </div> --}}
              <button class="btn btn-primary" type="submit">+ Tambah Data</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    </main>
@endsection
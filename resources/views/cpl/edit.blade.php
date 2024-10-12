@extends('layouts.master')

@section('content')
<main id="main" class="main">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit CPL</h5>
            @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
            @endif
            <form action="/cpl/{{ $cpl->id }}" method="post">
              @csrf
              @method('put')
              <div class="mb-3">
                <label for="name">Kode CPL</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ $cpl->name }}" required>
              </div>
              <div class="mb-3">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="5" required>{{ $cpl->deskripsi }}</textarea>
              </div>
              <div class="mb-3">
                <label for="cpmk_id">Pilih CPMK</label>
                <select class="form-control" name="cpmk_id" id="cpmk_id">
                    @foreach ($cpmks as $cpmk)
                        <option value="{{ $cpmk->id }}" 
                            {{ $cpl->cpmk_id == $cpmk->id ? 'selected' : '' }}>
                            {{ $cpmk->name }} | {{ $cpmk->deskripsi }}
                        </option>
                    @endforeach
                </select>
              </div>
              <button class="btn btn-primary" type="submit">+ Ubah Data</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    </main>
@endsection
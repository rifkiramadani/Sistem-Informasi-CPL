@extends('layouts.master')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Berikan Mata Kuliah Ke Dosen</h1>
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

              <h5 class="card-title">{{ $dosen->user->name }}</h5>

              <form action="/dosen/{{ $dosen->id }}/matakuliah" method="post">
                @csrf
                @method('PUT')
                <label for="mata_kuliah_id">Pilih Mata Kuliah</label>
                <div class="form-check">
                    @foreach ($matakuliahs as $matakuliah)
                        <input type="checkbox" name="mata_kuliah_id[]" id="mata_kuliah_id" value="{{ $matakuliah->id }}" 
                        @if ($dosen->matakuliah->contains($matakuliah->id)) checked @endif class="form-check-input">
                        <label class="form-check-label" for="mata_kuliah_id">
                            {{ $matakuliah->kode_matkul }} | {{ $matakuliah->name }}
                        </label>
                        <br>
                     @endforeach
                </div>
                <button class="btn btn-primary mt-3" type="submit">+Set Mata Kuliah</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
</main>
@endsection

@extends('layouts.master')

@section('content')
<main id="main" class="main">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Mata Kuliah</h5>
            @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
            @endif
            <form action="/matakuliah/{{ $matakuliah->id }}" method="post">
              @csrf
              @method('put')
              <div class="mb-3">
                <label for="kode_matkul">Kode Mata Kuliah</label>
                <input class="form-control" type="text" name="kode_matkul" id="kode_matkul" value="{{ $matakuliah->kode_matkul }}" required>
              </div>
              <div class="mb-3">
                <label for="name">Nama Mata Kuliah</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ $matakuliah->name }}" required>
              </div>
              <div class="mb-3">
                <label for="semester_id">Semester</label>
                <select class="form-control" name="semester_id" id="semester_id" required>
                    @foreach ($semesters as $semester)
                        <option value="{{ $semester->id }}" 
                            {{ $matakuliah->semester_id == $semester->id ? 'selected' : '' }}>
                            {{ $semester->name }}
                        </option>
                    @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="cpl_id">Pilih CPL</label>
                <div class="form-check">
                    @foreach ($cpls as $cpl)
                        <input type="checkbox" name="cpl_id[]" id="cpl_{{ $cpl->id }}" value="{{ $cpl->id }}" 
                        @if ($matakuliah->cpls->contains($cpl->id)) checked @endif
                        class="form-check-input">
                        <label class="form-check-label" for="cpl_{{ $cpl->id }}">
                            {{ $cpl->name }} | {{ $cpl->deskripsi }}
                        </label>
                        <br>
                    @endforeach
                </div>
              </div>
              <button class="btn btn-primary" type="submit">+ Ubah Data</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    </main>
@endsection
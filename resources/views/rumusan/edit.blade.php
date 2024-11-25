@extends('layouts.master')

@section('content')
<main id="main" class="main">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Rumusan</h5>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="/rumusan/{{ $rumusan->id }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="mata_kuliah_id">Pilih Mata Kuliah</label>
                            <select class="form-control" name="mata_kuliah_id" id="mata_kuliah_id" required>
                                <option>--Pilih Mata Kuliah--</option>
                                @foreach ($mata_kuliahs as $matakuliah)
                                    <option value="{{ $matakuliah->id }}" {{ $rumusan->mata_kuliah_id == $matakuliah->id ? 'selected' : '' }}>
                                        {{ $matakuliah->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Accordion untuk CPL -->
                        <div class="accordion" id="accordionCPL">
                            @foreach ($cpls as $cpl)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $cpl->id }}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $cpl->id }}" aria-expanded="true" aria-controls="collapse{{ $cpl->id }}">
                                            <input type="checkbox" name="cpl_id[]" value="{{ $cpl->id }}" class="form-check-input me-2" id="cpl{{ $cpl->id }}" 
                                                {{ $rumusan->cpls->contains($cpl->id) ? 'checked' : '' }}>
                                            {{ $cpl->name }} | {{ $cpl->deskripsi }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $cpl->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $cpl->id }}" data-bs-parent="#accordionCPL">
                                        <div class="accordion-body">
                                            @foreach ($cpmks as $cpmk)
                                                <div>
                                                    @php
                                                        $isChecked = $rumusan->cplCpmks->where('pivot.cpl_id', $cpl->id)->contains('id', $cpmk->id);
                                                        $skorMaks = $isChecked ? $rumusan->cplCpmks->where('pivot.cpl_id', $cpl->id)->where('id', $cpmk->id)->first()->pivot->skor_maks : '';
                                                    @endphp
                                                    <input type="checkbox" name="cpmk_id[{{ $cpl->id }}][]" value="{{ $cpmk->id }}" id="cpmk{{ $cpl->id }}-{{ $cpmk->id }}" class="form-check-input" 
                                                        {{ $isChecked ? 'checked' : '' }}>
                                                    <label for="cpmk{{ $cpl->id }}-{{ $cpmk->id }}" class="form-check-label">{{ $cpmk->name }}</label>

                                                    <!-- Skor Maks -->
                                                    <div class="mt-2">
                                                        <input class="form-control" type="number" name="skor_maks[{{ $cpmk->id }}]" placeholder="Masukkan Skor Maks" 
                                                            value="{{ $skorMaks }}">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button class="btn btn-primary mt-3" type="submit">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

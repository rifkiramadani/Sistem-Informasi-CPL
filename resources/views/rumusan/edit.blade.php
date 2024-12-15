@extends('layouts.master')

@section('content')
<main id="main" class="main">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Rumusan</h5>

                    <!-- Error messages -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('rumusan.update', $rumusan->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <!-- Mata Kuliah Dropdown -->
                        <div class="mb-3">
                            <label for="mata_kuliah_id" class="form-label">Pilih Mata Kuliah</label>
                            <select class="form-control" name="mata_kuliah_id" id="mata_kuliah_id" required>
                                <option value="">--Pilih Mata Kuliah--</option>
                                @foreach ($mata_kuliahs as $matakuliah)
                                    <option value="{{ $matakuliah->id }}"
                                        {{ $rumusan->mata_kuliah_id == $matakuliah->id ? 'selected' : '' }}>
                                        {{ $matakuliah->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Accordion for CPL -->
                        <div class="accordion" id="accordionCPL">
                            @foreach ($cpls as $cpl)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $cpl->id }}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ $cpl->id }}" aria-expanded="true"
                                                aria-controls="collapse{{ $cpl->id }}">
                                            <input type="checkbox" name="cpl_id[]" value="{{ $cpl->id }}"
                                                class="form-check-input me-2" id="cpl{{ $cpl->id }}"
                                                {{ $rumusan->rumusanCpls->contains('cpl_id', $cpl->id) ? 'checked' : '' }}>
                                            {{ $cpl->name }} | {{ $cpl->deskripsi }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $cpl->id }}" class="accordion-collapse collapse"
                                         aria-labelledby="heading{{ $cpl->id }}" data-bs-parent="#accordionCPL">
                                        <div class="accordion-body">
                                            @foreach ($cpmks as $cpmk)
                                                @php
                                                    // Find the associated RumusanCpl and RumusanCplCpmk
                                                    $rumusanCpl = $rumusan->rumusanCpls->where('cpl_id', $cpl->id)->first();
                                                    $rumusanCplCpmk = $rumusanCpl ? $rumusanCpl->rumusanCplCpmks->where('cpmk_id', $cpmk->id)->first() : null;
                                                    $skorMaks = $rumusanCplCpmk ? $rumusanCplCpmk->skor_maks : null;
                                                @endphp

                                                <div class="mb-3">
                                                    <!-- CPMK checkbox -->
                                                    <div class="d-flex align-items-center mb-2">
                                                        <input type="checkbox" name="cpmk_id[{{ $cpl->id }}][]"
                                                               value="{{ $cpmk->id }}"
                                                               id="cpmk{{ $cpl->id }}-{{ $cpmk->id }}"
                                                               class="form-check-input"
                                                               {{ $rumusanCplCpmk ? 'checked' : '' }}>
                                                        <label for="cpmk{{ $cpl->id }}-{{ $cpmk->id }}" class="form-check-label">
                                                            {{ $cpmk->name }} | {{ $cpmk->deskripsi }}
                                                        </label>
                                                    </div>

                                                    <!-- Skor Maks -->
                                                    <div class="mt-2">
                                                        <input class="form-control" type="number"
                                                               name="skor_maks[{{ $cpl->id }}][{{ $cpmk->id }}]"
                                                               value="{{ $skorMaks }}"
                                                               placeholder="Masukkan Skor Maks"
                                                               >
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

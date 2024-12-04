@extends('layouts.master')

@section('content')
    <main id="main" class="main">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Rumusan</h5>

                        <!-- Success message -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

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

                        <form action="/rumusan" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="mata_kuliah_id">Pilih Mata Kuliah</label>
                                <select class="form-control" name="mata_kuliah_id" id="mata_kuliah_id" required>
                                    <option>--Pilih Mata Kuliah--</option>
                                    @foreach ($matakuliahs as $matakuliah)
                                        <option value="{{ $matakuliah->id }}">{{ $matakuliah->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Accordion untuk CPL -->
                            <div class="accordion" id="accordionCPL">
                                @foreach ($cpls as $cpl)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{ $cpl->id }}">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ $cpl->id }}" aria-expanded="true"
                                                aria-controls="collapse{{ $cpl->id }}">
                                                <input type="checkbox" name="cpl_id[]" value="{{ $cpl->id }}"
                                                    class="form-check-input me-2" id="cpl{{ $cpl->id }}">
                                                {{ $cpl->name }} | {{ $cpl->deskripsi }}
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $cpl->id }}" class="accordion-collapse collapse"
                                            aria-labelledby="heading{{ $cpl->id }}" data-bs-parent="#accordionCPL">
                                            <div class="accordion-body">
                                                @foreach ($cpmks as $cpmk)
                                                    <div>
                                                        <input type="checkbox" name="cpmk_id[{{ $cpl->id }}][]"
                                                            value="{{ $cpmk->id }}"
                                                            id="cpmk{{ $cpl->id }}-{{ $cpmk->id }}"
                                                            class="form-check-input">
                                                        <label for="cpmk{{ $cpl->id }}-{{ $cpmk->id }}"
                                                            class="form-check-label">{{ $cpmk->name }}</label>

                                                        <!-- Skor Maks -->
                                                        <div class="mt-2" style="display: none;"
                                                            data-dependant="#cpmk{{ $cpl->id }}-{{ $cpmk->id }}">
                                                            <input class="form-control" type="number"
                                                                name="skor_maks[{{ $cpl->id }}][{{ $cpmk->id }}]"
                                                                placeholder="Masukkan Skor Maks">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button class="btn btn-primary mt-3" type="submit">+ Tambah Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <style>
        /* Tampilkan div input skor saat checkbox dicentang */
        input[type="checkbox"]:checked~div[data-dependant] {
            display: block !important;
        }
    </style>
@endsection

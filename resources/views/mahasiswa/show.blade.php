@extends('layouts.master')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Detail Mahasiswa</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="width: 60rem">
                        <div class="card-body">
                            <h5 class="card-title">Detail Mahasiswa</h5>

                            <a href="{{ route('mahasiswa.print', $mahasiswa->id) }}" class="btn btn-danger" style="font-size: 1.2rem"><i class="bi bi-filetype-pdf me-2"></i>Cetak</a>

                            <table class="table">
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $mahasiswa->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>NPM</th>
                                    <td>{{ $mahasiswa->npm }}</td>
                                </tr>
                                <tr>
                                    <th>Username</th>
                                    <td>{{ $mahasiswa->user->username }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $mahasiswa->user->email }}</td>
                                </tr>
                            </table>

                            <!-- Radar Chart Section -->
                            <h6>Radar Charts (Skor Mahasiswa per Rumusan):</h6>
                            <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px;">
                                @foreach ($mahasiswa->rumusanMahasiswas as $index => $rumusanMahasiswa)
                                    <div style="width: 45%; padding-top: 20px; text-align: center;">
                                        <h6>
                                            <ul style="list-style-type: none; padding: 0;">
                                                <li>No.{{ $loop->iteration }}</li>
                                                <li><b>Dosen Pengampu: </b>{{ $rumusanMahasiswa->rumusanDosen->dosen->user->name ?? 'Tidak ada nama' }}</li>
                                                <li><b>Mata Kuliah: </b>{{ $rumusanMahasiswa->rumusanDosen->rumusan->mata_kuliah->name ?? 'Tidak ada mata kuliah' }}</li>
                                                <li><b>Nilai: </b>{{ $rumusanMahasiswa->overallGrade }}</li>
                                            </ul>
                                        </h6>
                                        <div style="width: 100%; height: 350px;">
                                            <canvas id="radarChart{{ $index }}"></canvas>
                                        </div>
                                    </div>
                                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                    <script>
                                        // Prepare data for the current RumusanMahasiswa
                                        const labels{{ $index }} = @json($rumusanMahasiswa->labels); // Labels for the chart (Cpmk names)
                                        const nilaiValues{{ $index }} = @json($rumusanMahasiswa->nilaiValues); // Skor mahasiswa
                                        const skorMaxValues{{ $index }} = @json($rumusanMahasiswa->skorMaxValues); // Skor maks

                                        // Get the context of the canvas element
                                        const ctx{{ $index }} = document.getElementById('radarChart{{ $index }}').getContext('2d');

                                        // Create the Radar Chart using Chart.js
                                        const radarChart{{ $index }} = new Chart(ctx{{ $index }}, {
                                            type: 'radar',
                                            data: {
                                                labels: labels{{ $index }},
                                                datasets: [{
                                                    label: 'Skor Mahasiswa',
                                                    data: nilaiValues{{ $index }},
                                                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                                    borderColor: 'rgba(54, 162, 235, 1)',
                                                    borderWidth: 2
                                                }, {
                                                    label: 'Skor Maks',
                                                    data: skorMaxValues{{ $index }},
                                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                                    borderColor: 'rgba(255, 99, 132, 1)',
                                                    borderWidth: 2
                                                }]
                                            },
                                            options: {
                                                scale: {
                                                    ticks: {
                                                        beginAtZero: true,
                                                        max: 100 // Adjust max value as needed
                                                    }
                                                },
                                                elements: {
                                                    line: {
                                                        tension: 0.2
                                                    }
                                                }
                                            }
                                        });
                                    </script>
                                @endforeach
                            </div>

                            <!-- Button to Attach Rumusan Dosen -->
                            @if (!Auth::user()->hasRole('Mahasiswa|Dosen'))
                                <a href="{{ route('mahasiswa.attachRumusanDosen', $mahasiswa->id) }}" class="btn btn-success">Attach Rumusan Dosen</a>
                            @endif

                            <!-- New button to edit Nilai -->
                            @if (!Auth::user()->hasRole('Mahasiswa'))
                                <a href="{{ route('mahasiswa.nilai.edit', $mahasiswa->id) }}" class="btn btn-primary">Edit Nilai</a>
                            @endif

                            @if (!Auth::user()->hasRole('Mahasiswa'))
                                <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Back to List</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection

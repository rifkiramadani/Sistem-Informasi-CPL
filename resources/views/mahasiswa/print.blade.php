<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Sistem Informasi CPL</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/assets/img/Logo-unib.png" rel="icon">
    <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/assets/css/style.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Custom Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        .card {
            box-shadow: none;
        }

        .container {
            width: 100%;
            padding: 20px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        h6 {
            font-size: 18px;
            margin-top: 20px;
        }

        /* Hide elements during print */
        @media print {
            .sidebar, .navbar, .footer, .breadcrumb, .page-title {
                display: none;
            }

            .card-body {
                width: 100%;
            }

            canvas {
                page-break-before: always;
                margin-top: 20px;
            }

            h1, h5 {
                text-align: center;
                font-size: 20px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            table th, table td {
                padding: 8px 12px;
                border: 1px solid #ddd;
                text-align: left;
            }
        }
    </style>
</head>
<body>

<main id="main" class="main" style="margin: 0; padding: 0; width: 100%;">

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="width: 100%; margin: 0 auto;">
                    <div class="card-body">
                        <h5 class="card-title">Capaian Mahasiswa</h5>

                        <table class="table">
                            <tr>
                                <center><img class="img-thumbnail mb-2" src="{{ asset('storage/' . $mahasiswa->user->profile_picture) }}" alt="foto_{{ $mahasiswa->user->name }}" width="180"></center>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ $mahasiswa->user->name }}</td>
                            </tr>
                            <tr>
                                <th>NPM</th>
                                <td>{{ $mahasiswa->npm }}</td>
                            </tr>
                            <tr>
                                <th>Angkatan</th>
                                <td>{{ $mahasiswa->angkatan }}</td>
                            </tr>
                            <tr>
                                <th>Tahun Lulus</th>
                                <td>{{ $mahasiswa->tahun_lulus }}</td>
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

                        <h6>Mata Kuliah yang Di Berikan</h6>
                        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mata Kuliah</th>
                                        <th>Dosen Pengampu</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mahasiswa->rumusanMahasiswas as $index => $rumusanMahasiswa)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $rumusanMahasiswa->rumusanDosen->rumusan->mata_kuliah->name ?? 'Tidak ada mata kuliah' }}</td>
                                        <td>{{ $rumusanMahasiswa->rumusanDosen->dosen->user->name ?? 'Tidak ada nama' }}</td>
                                        <td>{{ $rumusanMahasiswa->overallGrade }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<script>
    // Automatically trigger print dialog on page load
    window.onload = function() {
        window.print();  // This triggers the print dialog as soon as the page loads
    };
</script>

</body>
</html>

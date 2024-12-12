@extends('layouts.master')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Table Admin</h1>
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
              <h5 class="card-title">Data Admin <a class="btn btn-primary float-end" href="/admin/create">+ Tambah Admin</a></h5>

              <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nip</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($admins as $admin)    
                    <tr>
                      <th scope="row">{{ $loop->iteration }}</th>
                      <td class="fw-bold">{{ $admin->user->name }}</td>
                      <td>{{ $admin->user->username }}</td>
                      <td>{{ $admin->user->email }}</td>
                      <td>{{ $admin->nip }}</td>
                      <td>
                        <a class="btn btn-warning" href="/admin/{{ $admin->id }}/edit">Edit</a>
                        <form action="/admin/{{ $admin->id }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"  onclick="return confirm('Yakin Ingin Menghapus Data???')">Delete</button>
                        </form>
                      </td>
                      @endforeach
                    </tbody>
                  </table>
                </tr>
                <div>
                  {{ $admins->links('pagination::bootstrap-5') }}
              </div>
                <!-- End Table with hoverable rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
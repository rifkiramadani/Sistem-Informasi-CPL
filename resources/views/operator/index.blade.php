@extends('layouts.master')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Table Operator</h1>
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
              <h5 class="card-title">Data Operator <a class="btn btn-primary float-end" href="/operator/create">+ Tambah Operator</a></h5>

              <!-- Table with hoverable rows -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nip</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($operators as $operator)    
                    <tr>
                      <th scope="row">{{ $loop->iteration }}</th>
                      <td><img class="img-thumbnail" src="{{ asset('storage/' . $operator->user->profile_picture) }}" alt="foto_{{ $operator->user->name }}" width="75"></td>
                      <td class="fw-bold" style="font-size: 13px">{{ $operator->user->name }}</td>
                      <td>{{ $operator->user->username }}</td>
                      <td>{{ $operator->user->email }}</td>
                      <td>{{ $operator->nip }}</td>
                      <td>
                        <a class="btn btn-warning" href="/operator/{{ $operator->id }}/edit">Edit</a>
                        <form action="/operator/{{ $operator->id }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"  onclick="return confirm('Yakin Ingin Menghapus Data???')">Delete</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
               </table>
               <div>
                {{ $operators->links('pagination::bootstrap-5') }}
              </div>
                <!-- End Table with hoverable rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
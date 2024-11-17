@extends('layouts.master')

@section('content')
<main id="main" class="main">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Tambah Operator</h5>
            @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
            @endif
            <form action="/operator" method="post">
              @csrf
              <div class="mb-3">
                <label for="name">Nama</label>
                <input class="form-control" type="text" name="name" id="name" required>
              </div>
              <div class="mb-3">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" required></input>
              </div>
              <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" required></input>
              </div>
              <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" required></input>
              </div>
              <div class="mb-3">
                <label for="nip">Nip</label>
                <input type="text" class="form-control" name="nip" id="nip" required></input>
              </div>
              <button class="btn btn-primary" type="submit">+ Tambah Data</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    </main>
@endsection
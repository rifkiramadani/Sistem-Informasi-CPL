@extends('layouts.master')

@section('content')
<main id="main" class="main">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Operator</h5>
            @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
            @endif
            <form action="/operator/{{ $operator->id }}" method="post" enctype="multipart/form-data">
              @csrf
              @method('put')
              <div class="mb-3">
                <label for="name">Nama</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ $operator->user->name }}" required>
              </div>
              <div class="mb-3">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" value="{{ $operator->user->username }}" required></input>
              </div>
              <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ $operator->user->email }}" required></input>
              </div>
              <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" value="{{ $operator->user->password }}" required></input>
              </div>
              <div class="mb-3">
                <label for="nip">Nip</label>
                <input type="text" class="form-control" name="nip" id="nip" value="{{ $operator->nip }}" required></input>
              </div>
              <div class="mb-3">
                <label for="profile_picture" class="form-label">Profile Picture</label>
                <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                @if ($operator->user->profile_picture)
                    <img src="{{ asset('storage/' . $operator->user->profile_picture) }}" alt="Profile Picture" class="img-thumbnail mt-2" width="150">
                @endif
                {{-- @error('profile_picture')
                    <small class="text-danger">{{ $message }}</small>
                @enderror --}}
              </div>
              <button class="btn btn-primary" type="submit">+ Ubah Data</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    </main>
@endsection
@extends('layouts.master')

@section('content')
<main id="main" class="main">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Profile</h5>
            @if (session()->has('success'))
                <div class="alert alert-success mt-3">
                  {{ session('success') }}
                </div>
              @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
            @endif
            <form action="/profile" method="post" enctype="multipart/form-data">
              @csrf
              @method('put')
              <div class="mb-3">
                <label for="name">Nama</label>
                <input class="form-control" type="text" name="name" id="name" value="{{ old('name',$user->name) }}" required>
              </div>
              <div class="mb-3">
                <label for="username">Username</label>
                <input class="form-control" type="text" name="username" id="username" value="{{ old('username',$user->username) }}" required>
              </div>
              <div class="mb-3">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" value="{{ old('email',$user->email) }}" required>
              </div>
              <div class="mb-3">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" value="{{ old('name',$user->password) }}" required>
              </div>
              <div class="mb-3">
                <label for="profile_picture" class="form-label">Profile Picture</label>
                <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                @if ($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="img-thumbnail mt-2" width="150">
                @endif
                {{-- @error('profile_picture')
                    <small class="text-danger">{{ $message }}</small>
                @enderror --}}
              </div>

              <button class="btn btn-primary" type="submit">+ Edit Profile</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    </main>
@endsection
@extends('layouts.master')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Attach Rumusan to Dosen</h1>
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

                        <h5 class="card-title">Attach Rumusan to {{ $dosen->user->name }}</h5>

                        <form action="/dosen/{{ $dosen->id }}/attach-rumusan" method="post">
                            @csrf
                            @method('PUT')

                            <label for="rumusan_id">Pilih Rumusan</label>
                            <div class="form-check">
                                @foreach ($rumusans as $rumusan)
                                    <input type="checkbox" name="rumusan_id[]" id="rumusan_id" value="{{ $rumusan->id }}"
                                    @if ($dosen->rumusans->contains($rumusan->id)) checked @endif class="form-check-input">
                                    <label class="form-check-label" for="rumusan_id">
                                        {{ $rumusan->name }}
                                    </label>
                                    <br>
                                @endforeach
                            </div>
                            <button class="btn btn-primary mt-3" type="submit">Attach Rumusan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

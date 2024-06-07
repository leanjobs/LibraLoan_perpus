@extends('layouts.main')

@section('title', 'Rating')

@section('content')
    <div class="container-fluid py-4">
        <div class="container-fluid py-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Rating</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">

                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Buku name</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Username</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Review</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Rating</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ratings as $rating)
                                            <tr>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">
                                                        {{ $rating->id }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">
                                                        {{ $rating->bukus->judul }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">
                                                        {{ $rating->user->name }}</p>
                                                </td>

                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">
                                                        {{ $rating->review }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">
                                                        {{ $rating->rating }}</p>
                                                </td>
                                                <td>
                                                    <form action="{{ route('update.rating') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="rating_id" value="{{ $rating->id }}">
                                                        @if ($rating->status == 1)
                                                            <button type="submit" class="btn btn-link p-0">
                                                                <i class="fas fa-toggle-on fs-4" aria-hidden="true"
                                                                    status='Active'></i>
                                                            </button>
                                                        @else
                                                            <button type="submit" class="btn btn-link p-0">
                                                                <i class="fas fa-toggle-off fs-4" aria-hidden="true"
                                                                    status='Inactive'></i>
                                                            </button>
                                                        @endif
                                                    </form>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 1000);
        });
    </script>
@endsection

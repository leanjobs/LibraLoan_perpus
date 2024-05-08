@extends('layouts.main')

@section('title', 'Daftar User')

@section('content')
    <div class="container-fluid py-4">
        <div class="container-fluid py-4">
            <!-- Button trigger modal -->
            <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#createUser">
                Tambah Buku
            </button>
            @include('perpus.user.createUser')
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Daftar User</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <!-- <form action="{{ route('daftar_user') }}" method="post" enctype="multipart/form-data">
                                                                                                              @csrf -->
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                name</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                email</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                password</th>
                                            {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                kelas</th> --}}
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">{{ $user->name }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">{{ $user->email }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">{{ $user->password }}</p>
                                                </td>
                                                {{-- <td>
                                                    <p class="text-xs text-secondary mb-0 ps-3">
                                                        @if ($user->kelas)
                                                            {{ $user->kelas->nama_kelas }}
                                                        @else
                                                            <span class="text-danger">tidak tersedia</span>
                                                        @endif
                                                    </p>
                                                </td> --}}
                                                <td class="d-flex">

                                                    <form action="{{ route('user.delete', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger mx-1">Delete</button>

                                                    </form>
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#editUser_{{ $user->id }}"
                                                        data-book-id={{ $user->id }}>
                                                        Edit user
                                                    </button>
                                                    @include('perpus.user.updateUser')
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- </form> -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

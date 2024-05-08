<!-- Modal -->
<div class="modal fade" id="editUser_{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserLabel">edit user</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.update', ['id' => $user->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editUserId" value="{{ $user->id }}">
                    <div class="modal-body container-fluid">
                        <div class="mb-3">

                            <label for="name" class="form-label">nama user</label>
                            <input autocomplete="off" required type="text"
                                class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                value="{{ old('name', $user->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label for="email" class="form-label">email</label>
                            <input autocomplete="off" required type="text"
                                class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                value="{{ old('email', $user->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label for="password" class="form-label">password</label>
                            <input autocomplete="off" required placeholder="min 8 characters" type="password"
                                class="form-control @error('password') is-invalid @enderror" id="password"
                                name="password" value="{{ old('password', $user->password) }}">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror


                            @error('kelas_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@extends('dashboard.layout.main', ['title' => 'Tambah Setting Menu'])

@section('konten')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                    <h6 class="op-7 mb-2">Tambah Setting Menu</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('setting_menus.index') }}" class="btn btn-secondary btn-round me-2">Kembali</a>
                </div>
            </div>

            <!-- Setting Menu Form -->
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header" style="margin-top: 40px;">
                            <h2>Tambah Setting Menu</h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('setting_menus.store') }}" method="POST">
                                @csrf

                                <!-- Jenis User Dropdown -->
                                <div class="mb-3">
                                    <label for="role_id" class="form-label">Jenis User</label>
                                    <select name="role_id" id="role_id" class="form-select" required>
                                        <option value="" disabled selected>Pilih Jenis User</option>
                                        @foreach ($Roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->nama_role }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Menu Selection -->
                                <div class="mb-3">
                                    <label class="form-label">Menu</label>
                                    <div>
                                        @foreach ($menus as $menu)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="menu_id[]"
                                                    value="{{ $menu->id }}" id="menu_{{ $menu->id }}">
                                                <label class="form-check-label" for="menu_{{ $menu->id }}">
                                                    {{ $menu->nama_menu }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('setting_menus.index') }}" class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

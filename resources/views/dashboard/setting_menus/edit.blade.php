@extends('dashboard.layout.main', ['title' => 'Edit Setting Menu'])

@section('konten')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                    <h6 class="op-7 mb-2">Edit Setting Menu</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('setting_menus.index') }}" class="btn btn-secondary btn-round me-2">Kembali</a>
                </div>
            </div>

            <!-- Edit Setting Menu Form -->
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header" style="margin-top: 40px;">
                            <h2>Edit Setting Menu</h2>
                        </div>
                        <div class="card-body">
                            @if (isset($settingMenu) && count($settingMenu) > 0)
                                <form action="{{ route('setting_menus.update', $settingMenu[0]->role_id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <!-- Jenis User Dropdown -->
                                    <div class="mb-3">
                                        <label for="role_id" class="form-label">Jenis User</label>
                                        <select class="form-select" id="role_id" name="role_id" required>
                                            @foreach ($Roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ $role->id == $settingMenu[0]->role_id ? 'selected' : '' }}>
                                                    {{ $role->nama_role }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Menu Selection (Checkboxes) -->
                                    <div class="mb-3">
                                        <label class="form-label">Pilih Menu</label>
                                        @foreach ($menus as $menu)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="menu_id[]"
                                                    value="{{ $menu->id }}"
                                                    {{ in_array($menu->id, $selectedMenus) ? 'checked' : '' }}>
                                                <label class="form-check-label">{{ $menu->nama_menu }}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            @else
                                <div class="alert alert-warning">Setting menu not found.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

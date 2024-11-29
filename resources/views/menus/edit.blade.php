@extends('layout.main')

@section('konten')
    <h1>Edit Menu</h1>
    <form action="{{ route('menus.update', $menu) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ $menu->name }}" required>

        <label for="slug">Slug</label>
        <input type="text" name="slug" id="slug" value="{{ $menu->slug }}" required>

        <label for="url">URL</label>
        <input type="text" name="url" id="url" value="{{ $menu->url }}">

        <label for="parent_id">Parent Menu</label>
        <select name="parent_id" id="parent_id">
            <option value="">None</option>
            @foreach ($parentMenus as $parent)
                <option value="{{ $parent->id }}" @if($menu->parent_id == $parent->id) selected @endif>
                    {{ $parent->name }}
                </option>
            @endforeach
        </select>

        <label for="is_active">Active</label>
        <input type="checkbox" name="is_active" id="is_active" @if($menu->is_active) checked @endif>

        <button type="submit">Update</button>
    </form>
@endsection

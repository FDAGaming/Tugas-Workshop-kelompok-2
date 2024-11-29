@extends('layout.main')

@section('konten')
    <h1>Create New Menu</h1>
    <form action="{{ route('menus.store') }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>

        <label for="slug">Slug</label>
        <input type="text" name="slug" id="slug" required>

        <label for="url">URL</label>
        <input type="text" name="url" id="url">

        <label for="parent_id">Parent Menu</label>
        <select name="parent_id" id="parent_id">
            <option value="">None</option>
            @foreach ($parentMenus as $parent)
                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
            @endforeach
        </select>

        <label for="is_active">Active</label>
        <input type="checkbox" name="is_active" id="is_active" checked>

        <button type="submit">Create</button>
    </form>
@endsection

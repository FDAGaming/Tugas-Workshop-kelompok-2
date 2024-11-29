@extends('layout.main')

@section('konten')
    <h1>Menu Management</h1>
    <a href="{{ route('menus.create') }}">Create New Menu</a>

    <ul>
        @foreach ($menus as $menu)
            <li>
                {{ $menu->name }} 
                @if($menu->is_active) (Active) @else (Inactive) @endif
                <a href="{{ route('menus.edit', $menu) }}">Edit</a>
                <form action="{{ route('menus.destroy', $menu) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>

                @if ($menu->children->count())
                    <ul>
                        @foreach ($menu->children as $child)
                            <li>{{ $child->name }}</li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
@endsection

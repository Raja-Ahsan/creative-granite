@props(['editRoute', 'destroyRoute', 'confirm' => 'Delete this item?'])

<div class="flex items-center justify-end gap-3">
    <a href="{{ $editRoute }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-900">Edit</a>
    <form action="{{ $destroyRoute }}" method="POST" class="inline" onsubmit="return confirm('{{ $confirm }}')">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-900">Delete</button>
    </form>
</div>

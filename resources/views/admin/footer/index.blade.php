@extends('layouts.admin')

@section('title', 'Footer Management')
@section('page_title', 'Footer Management')

@section('content')
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h2 class="text-lg font-semibold text-white">Footer Settings</h2>
                <p class="text-gray-400 text-xs mt-1">Manage website footer information and social media links.</p>
            </div>
            <a href="{{ route('admin.footer.create') }}"
                class="bg-[#730c1e] hover:bg-[#921126] text-white px-3 py-1.5 rounded-sm flex items-center gap-1 text-xs font-bold uppercase tracking-widest transition-colors">
                <i data-lucide="plus" class="w-3 h-3"></i>
                Add
            </a>
        </div>

        @if ($footers->isEmpty())
            <div class="bg-[#1a151d] border border-white/5 rounded-sm p-8 text-center">
                <p class="text-gray-400 text-sm">No footer data yet. <a href="{{ route('admin.footer.create') }}"
                        class="text-[#730c1e] hover:text-[#921126] font-semibold">Create one</a></p>
            </div>
        @else
            <div class="space-y-3">
                @foreach ($footers as $footer)
                    <div class="bg-[#1a151d] border border-white/5 rounded-sm p-3 hover:bg-white/[0.01] transition-colors group">
                        <div class="flex items-start justify-between gap-3">
                            <!-- Logo & Info -->
                            <div class="flex items-start gap-3 flex-1 min-w-0">
                                @if ($footer->logo_path)
                                    <img src="{{ asset('storage/' . $footer->logo_path) }}" alt="{{ $footer->nama_web }}"
                                        class="w-10 h-10 rounded-sm object-cover flex-shrink-0">
                                @else
                                    <div
                                        class="w-10 h-10 bg-gradient-to-br from-[#730c1e] to-[#4a0715] rounded-sm flex items-center justify-center flex-shrink-0">
                                        <span class="text-xs font-bold text-white">{{ substr($footer->nama_web, 0, 1) }}</span>
                                    </div>
                                @endif

                                <div class="flex-1 min-w-0">
                                    <div class="font-medium text-white text-sm truncate">{{ $footer->nama_web }}</div>
                                    <p class="text-gray-400 text-xs line-clamp-1">{{ $footer->deskripsi }}</p>
                                    <div class="flex items-center gap-2 mt-1 text-xs text-gray-500">
                                        @if ($footer->email)
                                            <span class="inline-flex items-center gap-1 truncate">
                                                <i data-lucide="mail" class="w-3 h-3"></i>
                                                {{ $footer->email }}
                                            </span>
                                        @endif
                                        @if ($footer->no_hp)
                                            <span class="inline-flex items-center gap-1">
                                                <i data-lucide="phone" class="w-3 h-3"></i>
                                                {{ $footer->no_hp }}
                                            </span>
                                        @endif
                                    </div>
                                    @if ($footer->mediaSozials->count() > 0)
                                        <div class="flex items-center gap-1.5 mt-1.5">
                                            @foreach ($footer->mediaSozials as $media)
                                                <a href="{{ $media->url }}" target="_blank" rel="noopener noreferrer"
                                                    class="inline-flex items-center justify-center w-5 h-5 bg-white/5 hover:bg-white/10 rounded-xs text-gray-400 hover:text-white transition-all text-xs"
                                                    title="{{ $media->technology->nama ?? 'Social Media' }}">
                                                    @if ($media->technology?->icon)
                                                        <i data-lucide="{{ $media->technology->icon }}" class="w-3 h-3"></i>
                                                    @else
                                                        <i data-lucide="link" class="w-3 h-3"></i>
                                                    @endif
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center gap-1.5 flex-shrink-0">
                                <a href="{{ route('admin.footer.edit', $footer->id) }}"
                                    class="p-1 hover:bg-blue-600/20 text-gray-400 hover:text-blue-400 rounded-xs transition-colors text-xs"
                                    title="Edit">
                                    <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                </a>
                                <form action="{{ route('admin.footer.destroy', $footer->id) }}" method="POST"
                                    class="inline" onsubmit="return confirm('Delete this footer?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-1 hover:bg-red-600/20 text-gray-400 hover:text-red-400 rounded-xs transition-colors text-xs"
                                        title="Delete">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-4 p-3 bg-[#1a151d] border border-white/5 rounded-sm text-xs text-gray-400">
            <p><span class="font-semibold">Total Footers:</span> {{ $footers->count() }}</p>
            <p><span class="font-semibold">Total Social Media:</span> {{ $totalMedia }}</p>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/lucide@latest"></script>
        <script>
            lucide.createIcons();
        </script>
    @endpush
@endsection

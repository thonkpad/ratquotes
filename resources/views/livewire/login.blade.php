<div>
    @if (Route::has('login'))
        <nav class="flex items-center justify-end gap-4">
            @auth
                <livewire:upload />
                <div class="flex items-center gap-3 mr-4 text-nav-text">
                    @if (auth()->user()->avatar)
                        <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}'s avatar"
                            class="w-8 h-8 rounded-full ring-2 ring-nav-text/20">
                    @endif
                    <div class="text-sm">
                        <div><strong>{{ auth()->user()->name ?? 'Unknown' }}</strong></div>
                        <div class="text-xs text-nav-text/60">ID: {{ auth()->user()->discord_id ?? '—' }}</div>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="inline-block px-5 py-1.5 bg-nav-text/10 hover:bg-nav-text/20 text-nav-text border border-nav-text/20 hover:border-nav-text/30 rounded-sm text-sm leading-normal transition-colors">
                        Log out
                    </button>
                </form>
            @else
                <a href="{{ url('/login/discord') }}"
                    class="inline-block px-5 py-1.5 bg-blue-600 hover:bg-blue-500 text-white rounded-sm text-sm leading-normal no-underline transition-colors">
                    Login with Discord
                </a>
            @endauth
        </nav>
    @endif
</div>
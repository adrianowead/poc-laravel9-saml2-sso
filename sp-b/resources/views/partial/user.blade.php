<p>
    <strong>User:</strong>
    @if(auth()->check())
        <pre><code>{{ json_encode(auth()->user(), JSON_PRETTY_PRINT) }}</code></pre>
    @else
        <p>Não logado</p>
    @endif
</p>
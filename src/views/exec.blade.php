<style>
    dir { padding: 0}
    body{font-family: monospace;background-color: black; color: white;}
</style>


<div class="out">
    <div style="color: grey">{{$extra}}</div>
    @if($output)
        <pre>{{$output}}</pre>
    @else
        <pre style="color: blue">No output</pre>
    @endif
</div>
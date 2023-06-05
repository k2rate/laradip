@props(['title' => false])



<div {{ $attributes->class(['card']) }}>

    @if ($title)
        <div class="card-header">
            <p class="card-title m-0">
                {{ $title }}
            </p>
        </div>
    @endif


    <div class="card-body">
        {{ $slot }}
    </div>
</div>

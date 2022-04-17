<div class="relative" x-data="{ open: false }" @click.inside="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>
    <div x-show="open"

         @click="open = false">
        <div>
            {{ $content }}
        </div>
    </div>
</div>

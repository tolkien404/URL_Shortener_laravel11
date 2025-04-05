<div class="flex justify-center flex-wrap flex-col h-screen">
    <div class="w-full">
        <h1 class="text-center font-bold text-6xl text-indigo-700">
            Shorten Url's Easily
        </h1>
    </div>
    <div class="w-full text-center my-3">
        <input type="url" placeholder="Add Url Here" class="input input-bordered w-full max-w-xs" wire:model='url'/>
        <p class="text-red-500">
            @error('url')
            {{ $message }}
            @enderror
        </p>
    </div>

    <div class="w-full text-center flex justify-center mb-3">
        <label class="form-control w-full max-w-xs">
            <div class="label">
                <span class="label-text">Expires After (Optional)</span>
            </div>
            <input type="datetime-local" wire:model='expires_at' class="input input-bordered w-full max-w-xs"/>
            <p class="text-red-500">
                @error('expires_at')
                {{ $message }}
                @enderror
            </p>
        </label>
    </div>

    @if ($result)
    <div class="mb-3 text-center w-full flex justify-center">
        <div role="alert" class="alert alert-success w-1/4 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <a target="_blank" class="link link-primary text-white" x-ref="result" id="result" href="{{ $result }}"> {{
                $result }}</a>
        </div>
    </div>

    <div class="flex justify-center my-3">
        {!! $qr !!}
    </div>

    @endif

    <div class="w-full text-center" x-data="{
        result: '',
    copy() {
        const textToCopy = this.$refs.result;
        const range = document.createRange();
        range.selectNodeContents(textToCopy);
        const selection = window.getSelection();
        selection.removeAllRanges();
        selection.addRange(range);

        try {
            const successful = document.execCommand('copy');
            if (successful) {
                alert('Text copied to clipboard');
            } else {
                console.error('Copy command was unsuccessful');
            }
        } catch (err) {
            console.error('Unable to copy text: ', err);
        }

        selection.removeAllRanges();
    }
    }" @resultGenerated.window="console.log('Result generated event received')">

        <button wire:click='submit' class="btn btn-accent text-white">Shorten</button>
        @if ($result)
        <button @click="copy" class="btn btn-success text-white">Copy</button>
        @endif
    </div>
</div>

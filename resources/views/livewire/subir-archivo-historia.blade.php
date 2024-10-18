<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="guardarArchivo">
        <label for="archivo_examen">Subir Examen (PDF, Imágenes):</label>
        <input type="file" wire:model="archivo_examen" id="archivo_examen" accept=".pdf,.jpg,.jpeg,.png">
        
        @error('archivo_examen') <span class="error">{{ $message }}</span> @enderror

        <button type="submit">Subir Archivo</button>
    </form>

    <div wire:loading wire:target="archivo_examen">Subiendo archivo...</div>
</div>


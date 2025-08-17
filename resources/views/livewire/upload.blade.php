<?php

use Livewire\WithFileUploads;
use function Livewire\Volt\{state, rules, uses, action};

uses([WithFileUploads::class]);

state(
    [
        'photo' => null,
        'message' => '',
        'id' => null,
    ]
);

rules(
    [
        'photo' => 'required|image|max:5120',
    ]
);

$save = action(function () {

    $this->validate();

    try {
        $path = $this->photo->store('', 'r2');

        logger('File uploaded to R2: ' . $path);

        $this->message = 'Photo uploaded successfully!';
        $this->photo = null;

        auth()->user()->posts()->create([
            'filepath' => $path,
            'uploaded_at' => now(),
        ]);

        return redirect()->to(request()->url());

    } catch (\Exception $e) {
        logger('R2 Upload Error: ' . $e->getMessage());
        $this->message = 'Upload failed: ' . $e->getMessage();
    }
});

?>

<div class="flex items-center">
    <form wire:submit="save">
        <div class="mb-4">
            <input type="file" wire:model="photo" accept="image/*">
            @error('photo')
                <span class="error text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Save photo
        </button>

        @if(!empty($message))
            <div class="mt-2 p-2 bg-green-100 text-green-700 rounded">
                {{ $message }}
            </div>
        @endif

        <!-- Loading indicator -->
        <div wire:loading wire:target="photo" class="mt-2">
            <span class="text-gray-500">Uploading...</span>
        </div>
    </form>
</div>
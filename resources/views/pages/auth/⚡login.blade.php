<?php

use Livewire\Component;

new class extends Component {
    public string $email = '';
    public string $password = '';
};
?>

<div class="border border-gray-100 rounded-md p-6 bg-white shadow-md w-full max-w-md">
    <h1>Login to your account</h1>
    <form class="mt-4 space-y-4">
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input wire:model="email" type="email" id="email"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" wire:model="password"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
        </div>
        <div>
            <button type="submit"
                class="w-full cursor-pointer bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">Login</button>
        </div>
    </form>
</div>

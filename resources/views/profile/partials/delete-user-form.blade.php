<div class="normal-case font-sans">
    <p class="text-sm text-ink-soft mb-6">
        Once your account is deleted, all of its resources and data will be permanently deleted. Please download any data you wish to keep before proceeding.
    </p>

    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition"
    >
        <i class="fa-regular fa-trash-can text-xs"></i>
        Delete Account
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 normal-case font-sans">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-ink">
                Are you sure you want to delete your account?
            </h2>

            <p class="mt-2 text-sm text-ink-soft">
                Please enter your password to confirm you would like to permanently delete your account.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full rounded-lg"
                    placeholder="Password"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex items-center justify-end gap-3">
                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="inline-flex items-center px-4 py-2.5 border border-bone rounded-lg text-sm font-medium text-ink-soft hover:bg-cream/50 transition"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition"
                >
                    Delete Account
                </button>
            </div>
        </form>
    </x-modal>
</div>

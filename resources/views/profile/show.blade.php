<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        @if (auth()->user()->isAdmin())
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('upload.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="file" class="form-label">Choose a file</label>
                <input type="file" class="form-control" id="file" name="file" required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Select a category</label>
                <select class="form-select" id="category" name="category" required>
                    <option value="pitch_deck">Pitch Deck</option>
                    <option value="reports">Reports</option>
                    <option value="private_documents">Private Documents</option>
                    <option value="legal_disclaimers">Legal Disclaimers</option>
                    <option value="performance">Performance</option>
                    <option value="investor_reports">Investor Reports</option>
                    <option value="fund_information">Fund Information</option>
                    
                    <!-- Add more options for additional categories if needed -->
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Upload File</button>
        </form>

        </div>
        @else
        @endif
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

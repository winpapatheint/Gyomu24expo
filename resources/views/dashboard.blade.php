<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('aaaaaaaDashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!xxxxxxxxxxxxxxxxx
		            <div class="pull-right">
		                <a class="btn btn-success" href="{{ route('seminars.create') }}"> Create New Zoom meeting</a>
		            </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>

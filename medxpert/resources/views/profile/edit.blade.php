<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 ">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg ">
                <div class="max-w-xl" flex justify-center>
                    <h1>Patient History</h1>
                    <table class="table-auto w-full border-collapse border border-gray-300 ">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Chronic Diseases</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Medications</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Allergies</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Notes</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patientHistory as $patient)
                                <tr class="odd:bg-white even:bg-gray-50">
                                    <td class="border border-gray-300 px-4 py-2">{{ $patient->id }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $patient->chronic_diseases }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $patient->medications }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $patient->allergies }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $patient->notes }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <button 
                                            style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px;"
                                            onclick="document.getElementById('editModal-{{ $patient->id }}').classList.remove('hidden')">
                                            Edit
                                        </button>

                                        <div id="editModal-{{ $patient->id }}" class="fixed z-10 inset-0 overflow-y-auto hidden">
                                            <div class="flex items-center justify-center min-h-screen">
                                                <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                                                    <h2 class="text-lg font-semibold mb-4">Edit Patient History</h2>
                                                    <form method="POST" action="{{ route('patient-history.update', $patient->id) }}">
                                                        @csrf
                                                        @method('post')
                                                        <div class="mb-4">
                                                            <label for="chronic_diseases" class="block text-sm font-medium text-gray-700">Chronic Diseases</label>
                                                            <input type="text" name="chronic_diseases" id="chronic_diseases" value="{{ $patient->chronic_diseases }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="medications" class="block text-sm font-medium text-gray-700">Medications</label>
                                                            <input type="text" name="medications" id="medications" value="{{ $patient->medications }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="allergies" class="block text-sm font-medium text-gray-700">Allergies</label>
                                                            <input type="text" name="allergies" id="allergies" value="{{ $patient->allergies }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                                                            <textarea name="notes" id="notes" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $patient->notes }}</textarea>
                                                        </div>
                                                        <div class="flex justify-end">
                                                            <button type="button" 
                                                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2" 
                                                                onclick="document.getElementById('editModal-{{ $patient->id }}').classList.add('hidden')">
                                                                Cancel
                                                            </button>
                                                            <button type="submit" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px;">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex justify-center">
                <div class="max-w-xl">
                    <h1>Appointments History</h1>
                    <table class="table-auto w-full border-collapse border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2 text-left">User ID</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Doctor ID</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Appointment Date</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Appointment Time</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($userAppointments as $appointment)
                                <tr class="odd:bg-white even:bg-gray-50">
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->user_id }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->doctor_id }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->appointment_date }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->appointment_time }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->status }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $appointment->notes }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>            
        </div>
    </div>
</x-app-layout>
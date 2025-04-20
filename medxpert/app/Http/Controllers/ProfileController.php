<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\PatientMedicalHistory;
use App\Models\Appointment;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // get patient histor 
        $patientHistory = PatientMedicalHistory::where('user_id', Auth::id())
            ->with('patient')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $userAppointments = Appointment::where('user_id', Auth::id())
            ->with('doctor')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('profile.edit', [
            'user' => $request->user(),
            'patientHistory' => $patientHistory,
            'userAppointments' => $userAppointments,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
=======
use App\Models\admin\Appointment;
use App\Models\admin\Doctor;
use App\Models\admin\DoctorDetails;
use Illuminate\Http\Request;
use App\Models\Admin\User;
use App\Models\Admin\Patient;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $patient = $user->patient;
        $appointments = Appointment::where('user_id', $patient->id)
            ->with(['doctor.user'])
            ->get();

        $patientMedicalHistory = $patient->medicalHistory;

        return view('profile.index', compact('user', 'patient', 'appointments', 'patientMedicalHistory'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();


        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'age' => 'required|integer|min:1|max:120',
            'chronic_diseases' => 'required|string|max:255',
            'medications' => 'required|string|max:255',
            'allergies' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            $user = User::findOrFail($user->id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // Calculate age from birth date if provided
            $age = null;
            if ($request->birth_date) {
                $birthDate = new \DateTime($request->birth_date);
                $today = new \DateTime();
                $age = $birthDate->diff($today)->y;
            }

            // Update patient information
            $patient = $user->patient;
            if ($patient) {
                $patient->update([
                    'age' => $age ?? $patient->age,
                    // Gender stays the same as it's not part of the profile update form in your image
                ]);
            }
            $patientMedicalHistory = $patient->medicalHistory;
            if ($patientMedicalHistory) {
                $patientMedicalHistory->update([
                    'chronic_diseases' => $request->chronic_diseases,
                    'medications' => $request->medications,
                    'allergies' => $request->allergies,
                    'notes' => $request->notes,
                ]);
            } else {
                // Create a new medical history record if it doesn't exist
                $patient->medicalHistory()->create([
                    'chronic_diseases' => $request->chronic_diseases,
                    'medications' => $request->medications,
                    'allergies' => $request->allergies,
                    'notes' => $request->notes,
                ]);
            }


            DB::commit();

            return redirect()->route('patientprofile')->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to update profile: ' . $e->getMessage()]);
        }
    }

    public function showChangePasswordForm()
    {
        return view('profile.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = Auth::user();
        $user = User::findOrFail($user->id);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('patientprofile')->with('success', 'Password changed successfully');
>>>>>>> f07bc98923b74382b670049a39a542fa90369dea
    }
}

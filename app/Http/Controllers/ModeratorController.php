<?php

namespace App\Http\Controllers;

use App\Models\TemporaryPass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\UserType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\GatePassLog;
class ModeratorController extends Controller
{
    /**
     * Show the moderator registration form.
     */
    public function showRegisterForm()
    {
        $userTypes = UserType::pluck('name'); // ['student', 'teacher', etc.]

        return view('moderator.pages.register', compact('userTypes'));
    }

    /**
     * Handle registration of new users by moderator.
     */
//     public function register(Request $request)
//     {
//     $validated = $request->validate([
//         'first_name'    => 'required|string|max:100',
//         'last_name'     => 'required|string|max:100',
//         'email'         => 'required|email|unique:users,email',
//         'phone_number'  => 'required|string|max:20',   // ✅ Correct key
//         'user_type'     => 'required|string',
//         // 'department'    => 'required|string|max:100',
//         'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//         'password'      => 'required|confirmed|min:6',
//     ]);

//     $user = new User();
//     $user->first_name   = $request->first_name;
//     $user->last_name    = $request->last_name;
//     $user->name         = $request->first_name . ' ' . $request->last_name;
//     $user->email        = $request->email;
//     $user->phone_number = $request->phone_number;     // ✅ Match DB column
//     $user->user_type    = $request->user_type;
//     // $user->department   = $request->department;
//     $user->password     = Hash::make($request->password);
//     $user->verified     = false; // optional: pending approval

//      if ($request->hasFile('profile_image')) {
//         $imageName = time() . '.' . $request->profile_image->extension();
//         $request->profile_image->move(public_path('uploads/profile_images'), $imageName);
//         $user->profile_image = $imageName;
//     }

//     $user->save();

//     return redirect()->route('moderator.register.form')
//         ->with('success', 'User registered successfully! Please wait for admin approval.');
// }

    /**
     * Show the moderator login form.
     */
    // public function showLoginForm()
    // {
    //     return view('moderator.pages.login');
    // }

    /**
     * Handle moderator login request.
     */
    // ✅ Login Method (only verified users allowed)
 /* public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // ✅ Check if the user is not approved by admin
        if (!$user->verified) {
            Auth::logout(); // force logout
            return redirect()->route('moderator.login.form')->withErrors([
                'email' => 'You are not approved by admin yet.'
            ]);
        }

        // ✅ Allow only admin and moderator
        if ($user->hasRole('admin') || $user->hasRole('moderator')) {
            return redirect()->route('moderator.dashboard');
        }

        // ❌ Other roles (e.g., student/teacher) not allowed
        Auth::logout();
        return redirect()->route('moderator.login.form')->withErrors([
            'email' => 'Only Admins and Moderators can login here.'
        ]);
    }

    // ❌ Invalid credentials
    return redirect()->route('moderator.login.form')->withErrors([
        'email' => 'Invalid email or password.'
    ]);
}*/


    /**
     * Handle moderator logout.
     */
   public function logout(Request $request)
{
    Auth::logout(); // Log out the current user

    $request->session()->invalidate();      // Invalidate session
    $request->session()->regenerateToken(); // Regenerate CSRF token

    return redirect()->route('moderator.logout')->with('success', 'You have been logged out.');
}

    public function reports()
{
    return view('moderator.pages.reports'); // path: resources/views/moderator/pages/reports.blade.php
}
 public function visitor()
{
    $visitor=GatePassLog::where('user_type_id','=',3)->with(['visitor', 'location']) 
    ->orderBy('scanned_at', 'desc')// eager load to avoid N+1
                ->paginate(10); 
    return view('moderator.pages.visitors',compact('visitor')); // path: resources/views/moderator/pages/reports.blade.php
}
 public function user()
{
    $user = GatePassLog::where('user_type_id', '!=', 3)
            ->with(['user', 'location']) // eager load relations
            ->orderBy('scanned_at', 'desc') // sort by date, newest first
            ->paginate(10); // paginate 10 per page

return view('moderator.pages.users', compact('user')); // path: resources/views/moderator/pages/reports.blade.php
}
public function showProfile()
{
    $user = Auth::user(); // ✅ Logged-in user

    return view('moderator.pages.profile', compact('user'));
}

public function updateProfile(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'user_name' => ['required','string','max:255','regex:/^[a-zA-Z0-9\s]+$/','unique:users,user_name,' . $user->id],
        
        'phone_number' => 'nullable|string|max:20',
        
    ]);

    $user->name = $request->name;
    $user->user_name = $request->user_name;
    $user->phone_number = $request->phone_number;
    if ($request->hasFile('profile_image')) {
    $imageName = time() . '.' . $request->profile_image->extension();
    $request->profile_image->move(public_path('uploads/profile_images'), $imageName);
    $user->profile_image = $imageName;
}

    $user->save();

    return redirect()->back()->with('success', 'Profile updated successfully.');
}
// ModeratorController.php (သို့မဟုတ် တခြား Controller)
public function myQrcode()
{
    $user = Auth::user();

    if (!$user->verified) {
        return redirect()->route('moderator.dashboard')->with('error', 'You are not verified.');
    }

    $qrData = json_encode([
        'name' => $user->name,
        'email' => $user->email,
        'type' => $user->user_type,
    ]);

    $qrCode = QrCode::size(200)->generate($qrData);

    return view('moderator.pages.my-qrcode', compact('user', 'qrCode'));
}



    public function checkQRCode(Request $request)
{
       $qr = trim((string) $request->input('qr_code', ''));

    if (!$qr) {
        return response()->json(['status' => 'error', 'message' => 'QR code is required.']);
    }

    // 1) Try USER by NRC number
    $user = User::where('nrc_number', $qr)->first();
    if ($user) {
        try {
            GatePassLog::create([
                'user_id'      => $user->id,
                'user_type_id' => $user->user_type_id,
                'location_id'  => $request->location_id,
                'scan_type'    => 'entry',   // ✅ Always entry
                'scanned_at'   => now(),
            ]);
        } catch (\Throwable $e) {
            Log::error('Gate pass insert failed (user)', ['err' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Log insert failed: '.$e->getMessage()
            ]);
        }

        return response()->json([
            'status' => 'success',
            'user' => [
                'name'       => $user->name,
                'nrc_number' => $user->nrc_number,
                'user_type'  => optional($user->userType)->name ?? 'N/A',
                'scan_type'  => 'entry',
                'location'=>$user->location_id
            ]
        ]);
    }

    // 2) Try VISITOR by NRC number
   $visitor = TemporaryPass::where('nrc_number', $qr)->first();
    if ($visitor) {
        // Check validity window
        if (now()->lt($visitor->valid_from) || now()->gt($visitor->valid_until)) {
            return response()->json(['status' => 'error', 'message' => 'Pass expired.']);
        }

        // Get last scan (anywhere)
       // Get last scan at this location
$lastLogSameLocation = GatePassLog::where('temporary_pass_id', $visitor->id)
    ->where('location_id', $request->location_id)
    ->orderBy('scanned_at', 'desc')
    ->first();

$scanType = 'entry'; // default

if ($lastLogSameLocation) {
    // If last scan at this location was entry → now exit, else entry
    $scanType = ($lastLogSameLocation->scan_type === 'entry') ? 'exit' : 'entry';
} else {
    // No record for this location yet → treat as entry
    $scanType = 'entry';
}


        try {
            GatePassLog::create([
                'temporary_pass_id' => $visitor->id,
                'user_type_id'      => 3, // assuming 3 = Visitor
                'location_id'       => $request->location_id,
                'scan_type'         => $scanType,
                'scanned_at'        => now(),
            ]);
        } catch (\Throwable $e) {
            Log::error('Gate pass insert failed (visitor)', ['err' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Log insert failed: ' . $e->getMessage()
            ]);
        }

        return response()->json([
            'status' => 'success',
            'user' => [
                'name'       => $visitor->visitor_name,
                'nrc_number' => $visitor->nrc_number,
                'user_type'  => 'Visitor',
                'scan_type'  => $scanType,
                'location'   => $request->location_id,
            ]
        ]);
    }

    /**
     * =====================
     * 3) Nothing found
     * =====================
     */
    return response()->json(['status' => 'error', 'message' => 'Not found.']);

}





public function scan()
{
     $locations = \App\Models\Location::all(); // Fetch all l
    return view('moderator.pages.scan',compact('locations'));
}


public function home()
{
    return view('moderator.pages.home');
}

public function profile()
{
    $user = Auth::user();
    return view('moderator.pages.profile', compact('user'));
}

public function dashboard()
{

    $userTypeData = GatePassLog::select('user_type_id', DB::raw('COUNT(*) as total'))
        ->groupBy('user_type_id')
        ->with('userType') // assuming relationship
        ->get()
        ->map(function ($item) {
            return [
                'label' => $item->userType->name ?? 'Unknown',
                'count' => $item->total
            ];
        });

    // ====== 2. Attendance by Location ======
    $locationData = GatePassLog::select('location_id', DB::raw('COUNT(*) as total'))
        ->groupBy('location_id')
        ->with('location') // assuming relationship
        ->get()
        ->map(function ($item) {
            return [
                'label' => $item->location->name ?? 'Unknown',
                'count' => $item->total
            ];
        });
    $visitor=GatePassLog::where('user_type_id',3)->get();
    $teacher=GatePassLog::where('user_type_id',2)->get();
    $student=GatePassLog::where('user_type_id',1)->get();
    $staff=GatePassLog::where('user_type_id',4)->get();
    $user=GatePassLog::all();

$recent = GatePassLog::with(['visitor', 'user', 'location'])
    ->whereDate('created_at', Carbon::today())
    ->orderBy('scanned_at', 'desc')
    ->paginate(10); // show 10 per page

    return view('moderator.pages.dashboard',compact('visitor','teacher','student','staff','user','recent'),[
        'userTypeLabels' => $userTypeData->pluck('label'),
        'userTypeCounts' => $userTypeData->pluck('count'),
        'locationLabels' => $locationData->pluck('label'),
        'locationCounts' => $locationData->pluck('count'),
    ]);
}
}
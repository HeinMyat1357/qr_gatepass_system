<?php

namespace App\Http\Controllers;

use App\Models\GatePassLog;
use App\Models\TemporaryPass;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\GdImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use Illuminate\Support\Facades\DB;
use BaconQrCode\Writer;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
class AdminController extends Controller
{
    public function viewUsers()
    {
        $users = User::with(['roles','userType'])->get(); // eager load userType if relationship exists
        return view('admin.view-users', compact('users')); // use view-users.blade.php
    }

//     public function approve($id)
// {
//     $user = User::findOrFail($id);
//     $user->verified = true;
//     $user->save();

//     return redirect()->back()->with('success', 'User approved successfully.');
// }




public function approveUser($id)
{
    $user = User::findOrFail($id);

    // Approve user
    $user->verified = true;
    $user->save();

    // Generate QR code PNG using GD backend
   $qrCodeImage = QrCode::format('svg')
    ->size(300)
    ->errorCorrection('H')
    ->generate((string) $user->nrc_number);

$fileName = 'qrcodes/' . $user->nrc_number . '.svg';  // Add .svg extension

Storage::disk('public')->put($fileName, $qrCodeImage);

$user->qr_code_path = $fileName;  // Save with extension
$user->save();



    return back()->with('success', 'User approved and QR code generated successfully (GD backend).');
}



/**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('admin.pages.auth.login');
    }

    /**
     * Handle the login form submission.
     */
    public function login(Request $request)
    {
        // Validate login credentials
        $credentials = $request->only('email', 'password');

    // ✅ Only allow fixed admin email to login
    if ($credentials['email'] !== 'admin@gmail.com') {
        return back()->withErrors([
            'email' => 'Only the official admin account can log in here.',
        ])->onlyInput('email');
    }

    // ✅ Try login
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('admin.dashboard');
    }

    return back()->withErrors([
        'email' => 'Invalid admin credentials.',
    ])->onlyInput('email');
}

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Admin Dashboard (sample)
     */
    
    public function dashboard()
    {
        // All users
        $all_users = User::all();
        $verified_users = User::where('verified', '1')->get();
        $unverified_users = User::where('verified', '0')->get();

        // Gate pass logs and visitors
        $gate = GatePassLog::all();
        $visitor = TemporaryPass::all();

        // Recent unverified users today
        $recent_users = User::where('verified', 0)
            ->whereDate('created_at', Carbon::today())
            ->get();

        // Monthly user stats for chart
        $userStats = User::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->get();

        $months = [];
        $counts = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = date('F', mktime(0, 0, 0, $i, 10));
            $counts[] = $userStats->firstWhere('month', $i)->count ?? 0;
        }

        // Calendar events from users
       $calendarEvents = User::select(
        DB::raw('DATE(created_at) as date'),
        DB::raw('COUNT(*) as count')
    )
    ->groupBy('date')
    ->get()
    ->map(function($item) {
        return [
            'title' => $item->count . ' user(s)',
            'start' => $item->date,
        ];
    });


        // Users by role (if using pivot table user_role)
        // Assuming you have 'roles' table and 'user_role' pivot
        $roles = DB::table('roles')->pluck('name')->toArray();
        $roleCounts = [];
        foreach ($roles as $role) {
            $roleCounts[] = DB::table('users')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->where('roles.name', $role)
                ->count();
        }
             
        // Pass all data to the Blade
        return view('admin.pages.dashboard', compact(
            'months', 'counts', 'calendarEvents',
            'verified_users', 'all_users', 'unverified_users',
            'visitor', 'gate', 'recent_users',
            'roles', 'roleCounts'
        ));
    }
}


// public function myQrcode()
// {
//     $user = auth()->user();

//     if (!$user->verified || !$user->qr_token) {
//         return redirect()->route('moderator.dashboard')->with('error', 'You are not verified or QR not available.');
//     }

//     $qrData = json_encode([
//         'name' => $user->name,
//         'email' => $user->email,
//         'phone' => $user->phone_number,
//         'type' => $user->user_type,
//         'token' => $user->qr_token,
//     ]);

//     $qrCode = QrCode::size(200)->generate($qrData);

//     return view('moderator.pages.my-qrcode', compact('user', 'qrCode'));
// }


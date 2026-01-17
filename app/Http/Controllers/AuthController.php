<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\UserType;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\TemporaryPass;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AuthController extends Controller
{
   public function login(Request $request)
{
    // Validate input
    $request->validate([
        'login'    => 'required|string',  // email or username
        'password' => 'required|string',
    ]);

    $loginInput = $request->input('login');
    $password   = $request->input('password');

    // Determine if login input is email or username
    $fieldType = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'user_name';

    // --------- Check User ---------
    $user = \App\Models\User::where($fieldType, $loginInput)->first();

    if ($user && Hash::check($password, $user->password)) {
        if (!$user->verified) {
            return back()->withErrors([
                'login' => 'Your account is not approved by admin yet.'
            ])->withInput();
        }

        Auth::guard('web')->login($user);

        // Redirect based on role
        if ($user->hasRole('moderator')) {
            return redirect()->route('moderator.dashboard');
        }

        return redirect()->route('user.pages.home');
    }

    // --------- Check Visitor ---------
    $visitor = \App\Models\TemporaryPass::where('visitor_email', $loginInput)
                                        ->orWhere('user_name', $loginInput)
                                        ->first();

    if ($visitor && Hash::check($password, $visitor->password)) {
        Auth::guard('visitor')->login($visitor);

        return redirect()->route('visitor.pages.home');
    }

    // Invalid credentials
    return back()->withErrors([
        'login' => 'Invalid email/username or password.'
    ])->withInput();
}








    public function showRegisterForm()
    {
        $userTypes = UserType::all();
        return view('register', compact('userTypes'));
    }

    public function register(Request $request)
{
    // Build full NRC number
    // $nrc_full = $request->nrc_state . '/' . $request->nrc_township . $request->nrc_type . $request->nrc_number;
    $user=User::where('user_name',$request->user_name)->first();
      $visitor=TemporaryPass::where('user_name',$request->user_name)->first();
    if($user||$visitor)
    {
         return redirect()->route('register.test')
        ->with('error', 'User_name is already exist');
    }
    // Validation
    $request->validate([
        'name'         => 'required|string|max:255',
        'user_name' => ['required','string','max:255','regex:/^[a-zA-Z0-9\s]+$/'],
        // 'nrc_state'    => 'required|numeric|min:1|max:14',
        // 'nrc_township' => 'required|string|max:10',
        // 'nrc_type'     => 'required|in:(N),(P),(C)',
     'nrc_number'   => $request->user_type_id == 3
    ? 'required|string|unique:temporary_passes,nrc_number'
        : 'required|string|unique:users,nrc_number',    
        'phone_number' => 'required|regex:/^[0-9]{7,20}$/',
        'user_type_id' => 'required|exists:user_types,id',
        'password'     => 'required|string|min:6|confirmed',
        'profile_image'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'email' => $request->user_type_id == 3
    ? 'nullable|email|unique:temporary_passes,visitor_email'
    : ($request->user_type_id == 9
        ? 'nullable|email|unique:users,email'
        : 'required|email|unique:users,email'),
        'roll_no'      => $request->user_type_id == 1 ? 'required|string|max:50' : '', // only for students
        'purpose'      => $request->user_type_id == 3 ? 'required|string|max:255' : '', // only for visitors
    ]);

    // --- Visitor Registration ---
    if ($request->user_type_id == 3) {
        $visitor = new TemporaryPass();
        $visitor->visitor_name  = $request->name;
        $visitor->user_name     = $request->user_name;
        $visitor->nrc_number    = $request->nrc_number;
        $visitor->visitor_email = $request->email;
        $visitor->visitor_phone = $request->phone_number;
        $visitor->password      = Hash::make($request->password);
        $visitor->purpose       = $request->purpose;
        $visitor->valid_from    = now();
        $visitor->valid_until   = now()->addHours(6);

        // Generate QR code
        $qrCodeImage = QrCode::format('svg')
            ->size(300)
            ->errorCorrection('H')
            ->generate((string) $request->nrc_number);

        $fileName = 'qrcodes/' . $request->nrc_number . '.svg';
        Storage::disk('public')->put($fileName, $qrCodeImage);
        $visitor->qr_code_path = $fileName;

        // Profile image
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/profile_images'), $imageName);
            $visitor->profile_image = $imageName;
        }

        $visitor->save();

        // Assign role
        // $role = Role::where('name', 'user')->first();
        // if ($role) {
        //     DB::table('role_user')->insert([
        //         'user_id' => $visitor->id,
        //         'role_id' => $role->id,
        //     ]);
        // }

        return redirect()->route('register.test')
            ->with('success', 'Visitor registered successfully! Your temporary pass is valid for 6 hours.');
    }

    // --- User Registration (Student/Teacher/Staff) ---
    $user = new User();
    $user->name         = $request->name;
    $user->user_name    = $request->user_name;
    $user->nrc_number   = $request->nrc_number;
    $user->email        = $request->email;
    $user->phone_number = $request->phone_number;
    $user->user_type_id = $request->user_type_id;
    $user->password     = Hash::make($request->password);
    $user->verified     = false;

    // Optional Roll Number for students
    if ($request->user_type_id == 1) {
        $user->roll_no = $request->roll_no;
    }

    // Profile image
    if ($request->hasFile('profile_image')) {
        $image = $request->file('profile_image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/profile_images'), $imageName);
        $user->profile_image = $imageName;
    }

    $user->save();

    // Assign role
    $role = Role::where('name', 'user')->first();
    if ($role) {
        DB::table('role_user')->insert([
            'user_id' => $user->id,
            'role_id' => $role->id,
        ]);
    }

    return redirect()->route('register.test')
        ->with('success', 'User registered successfully! Please wait for admin approval before login.');
}



    // ✅ Logout Method
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.test');
    }

    // ✅ Forgot Password
    public function forgot_password(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'Password reset link sent!')
            : back()->withErrors(['email' => $status]);
    }

    // ✅ Reset Password
    public function reset_password(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect('/login')->with('status', 'Password has been reset!')
            : back()->withErrors(['email' => $status]);
    }
    /**
     * Show the moderator login form.
     */
    public function showLoginForm()
    {
        return view('login');
    }
}
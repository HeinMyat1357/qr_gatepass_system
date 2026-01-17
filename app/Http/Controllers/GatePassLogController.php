<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GatePassLog;
use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class GatePassLogController extends Controller
{
   public function myQRCode()
{
    $index = Auth::guard('visitor')->user();
    $user = GatePassLog::findOrFail($index->id);
    return view('visitor.pages.my-qrcode', compact('user'));
}
public function downloadQR($id)
{
    $user =  GatePassLog::findOrFail($id);

    if (!$user->qr_code_path) {
        return back()->withErrors(['QR Code not available.']);
    }

    // Correct path to storage/app/public
    $filePath = storage_path('app/public/' . $user->qr_code_path);

    if (!file_exists($filePath)) {
        return back()->withErrors(['QR code file not found.']);
    }

    // Force download
    return response()->download($filePath, basename($filePath), [
        'Content-Type' => mime_content_type($filePath)
    ]);
}
public function profile()
{
    return view('visitor.pages.profile');
}
    public function index()
    {
        // Visitor type data only
        $gate =  GatePassLog::all();

        return view('admin.pages.gate-pass-logs', compact('gate'));
    }

    public function create()
    {
        $locations = Location::all();
        return view('admin.pages.create-temp-pass', compact('locations'));
    }


public function store(Request $request)
{
    $request->validate([
        'visitor_name' => 'required|string|max:255',
        'visitor_email' => 'nullable|email|max:255',
        'visitor_phone' => 'nullable|string|max:20',
        'purpose' => 'required|string',
        'location_id' => 'required|exists:locations,id',
        'valid_from' => 'required|date',
        'valid_until' => 'required|date|after:valid_from',
        'status' => 'required|in:pending,approved',
    ]);

    // Step 1: Create Temporary Pass
    $temporaryPass = new  GatePassLog();
    $temporaryPass->visitor_name = $request->visitor_name;
    $temporaryPass->visitor_email = $request->visitor_email;
    $temporaryPass->visitor_phone = $request->visitor_phone;
    $temporaryPass->purpose = $request->purpose;
    $temporaryPass->location_id = $request->location_id;
    $temporaryPass->issued_by = Auth::check() ? Auth::id() : 1;
    $temporaryPass->valid_from = $request->valid_from;
    $temporaryPass->valid_until = $request->valid_until;
    $temporaryPass->status = $request->status;
    $temporaryPass->qr_code_token = Str::uuid(); // Unique token for QR
    $temporaryPass->save();

    // Step 2: Generate QR code (SVG)
    $qrCodeImage = QrCode::format('svg')
        ->size(300)
        ->errorCorrection('H')
        ->generate($temporaryPass->qr_code_token);

    // Step 3: Save QR code file to storage/app/public/qrcodes/
    $fileName = 'qrcodes/' . $temporaryPass->id . '.svg';
    Storage::disk('public')->put($fileName, $qrCodeImage);

    // Step 4: Save QR code path in database
    $temporaryPass->qr_code_path = $fileName;
    $temporaryPass->save();

    return redirect()->route('temp_passes.index')->with('success', 'Temporary Pass created successfully.');
}


    public function edit($id)
    {
        $pass =  GatePassLog::findOrFail($id);
        $locations = Location::all();
        return view('admin.pages.edit-temp-pass', compact('pass', 'locations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'visitor_name' => 'required|string|max:255',
            'visitor_email' => 'nullable|email|max:255',
            'visitor_phone' => 'nullable|string|max:20',
            'purpose' => 'required|string',
            'location_id' => 'required|exists:locations,id',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after:valid_from',
            'status' => 'required|in:pending,approved,used,expired',
        ]);

        $temporaryPass = GatePassLog::findOrFail($id);
        $temporaryPass->update([
            'visitor_name' => $request->visitor_name,
            'visitor_email' => $request->visitor_email,
            'visitor_phone' => $request->visitor_phone,
            'purpose' => $request->purpose,
            'location_id' => $request->location_id,
            'valid_from' => $request->valid_from,
            'valid_until' => $request->valid_until,
            'status' => $request->status,
        ]);

        return redirect()->route('temp_passes.index')->with('success', 'Temporary Pass updated successfully.');
    }

    public function destroy($id)
    {
        $temporaryPass =  GatePassLog::findOrFail($id);
        $temporaryPass->delete();

        return redirect()->back()->with('success', 'Gate Pass deleted successfully.');
    }
    
}

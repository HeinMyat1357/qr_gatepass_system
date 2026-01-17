<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemporaryPass;
use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\GatePassLog;


class TemporaryPassController extends Controller
{
    public function myQRCode()
{
    $index = Auth::guard('visitor')->user();
    $user = TemporaryPass::findOrFail($index->id);
    // Fetch latest 5 visitor logs
    $visitorLogs = GatePassLog::where('temporary_pass_id', $index->id) // Assuming 3 = Visitor
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

   // return view('moderator.pages.visitors', compact('visitorLogs'));
    return view('visitor.pages.my-qrcode', compact('user','visitorLogs'));
}
public function downloadQR($id)
{
    $user = TemporaryPass::findOrFail($id);

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
        $visitor = TemporaryPass::all();

        return view('admin.pages.view-temp-passes', compact('visitor'));
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
    $temporaryPass = new TemporaryPass();
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
        $pass = TemporaryPass::findOrFail($id);
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
            // 'status' => 'required|in:pending,approved,used,expired',
        ]);

        $temporaryPass = TemporaryPass::findOrFail($id);
        $temporaryPass->update([
            'visitor_name' => $request->visitor_name,
            'visitor_email' => $request->visitor_email,
            'visitor_phone' => $request->visitor_phone,
            'purpose' => $request->purpose,
            'location_id' => $request->location_id,
            'valid_from' => $request->valid_from,
            'valid_until' => $request->valid_until,
            // 'status' => $request->status,
        ]);

        return redirect()->route('temp_passes.index')->with('success', 'Temporary Pass updated successfully.');
    }

    public function destroy($id)
    {
        $temporaryPass = TemporaryPass::findOrFail($id);
        $temporaryPass->delete();

        return redirect()->route('temp_passes.index')->with('success', 'Temporary Pass deleted successfully.');
    }
}

@extends('moderator.layouts.layout1')

@section('title', 'Register - QR Code Gate Pass System')

@section('main-content')
<div class="login-container">
    <div class="login-card">
       <div class="login-header text-center">
    <h3 id="register_heading"><i class="fas fa-user-plus me-2"></i> Register</h3>
</div>


       @if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger text-center">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger text-center">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif


        <!-- ✅ Added enctype for file upload -->
        <form method="POST" action="{{ route('register.perform') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
    <label for="user_type" class="form-label">User Type</label>
    <div class="input-group">
        <span class="input-group-text"><i class="fas fa-users"></i></span>
        <select name="user_type_id" id="user_type" class="form-control neon-input">
            <option value="">-- Select User Type --</option>
            @foreach($userTypes as $type)
                <option value="{{ $type->id }}" data-name="{{ strtolower($type->name) }}">
                    {{ ucfirst($type->name) }}
                </option>
            @endforeach
        </select>
    </div>
</div>
            <div class="form-group mb-3">
                <label for="name" class="form-label">Full Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control neon-input" name="name" id="name" placeholder="Enter full name" required>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="user_name" class="form-label">User Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control neon-input" name="user_name" id="user_name" placeholder="Enter user name" required>
                </div>
            </div>

           

<!-- Roll Number Field (hidden by default) -->
<div class="form-group mb-3" id="roll_no_field" style="display:none;">
    <label for="roll_no" class="form-label">Roll Number</label>
    <div class="input-group">
        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
        <input type="text" name="roll_no" id="roll_no" class="form-control neon-input" placeholder="Enter Roll Number">
    </div>
</div>

<div class="form-group mb-3" id="purpose_field" style="display:none;">
    <label for="purpose" class="form-label">Purpose</label>
    <div class="input-group">
        <span class="input-group-text"><i class="fas fa-sticky-note"></i></span>
        <textarea name="purpose" id="purpose" class="form-control neon-input" placeholder="Enter purpose of visit" rows="3"></textarea>
    </div>
</div>


    <div class="form-group mb-3">
    <label for="nrc_number" class="form-label">NRC</label>
    <div class="input-group">

        <!-- State/Region Code -->
        {{-- <select name="nrc_state" class="form-select" required>
            <option value=""  disabled>State/Region</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="7">7</option>
            <option value="12">12</option>
            <!-- add all 14 states/regions -->
        </select>

        <!-- Slash -->
        <span class="input-group-text">/</span>

        <!-- Township Code -->
        <select name="nrc_township" class="form-select" required>
            <option value="" disabled>Township</option>
            <option value="MaLaNa">MaLaNa</option>
            <option value="KaPaTa">KaPaTa</option>
            <option value="BaMaNa">BaMaNa</option>
            <!-- add all NRC township codes -->
        </select>

        <!-- Citizen Type -->
        <select name="nrc_type" class="form-select" required>
            <option value=""  disabled>Type</option>
            <option value="(N)">(N)</option>
            <option value="(P)">(P)</option>
            <option value="(C)">(C)</option>
        </select> --}}

        <!-- NRC Number (6 digits) -->
      
    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
    <input type="text" id="nrc_number" name="nrc_number" 
           class="form-control neon-input" 
           placeholder="Enter NRC Number" required>



    </div>
</div>

            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control neon-input" name="email" id="email" placeholder="Enter email address" >
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="phone_number" class="form-label">Phone</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    <input type="text" class="form-control neon-input" name="phone_number" id="phone_number" placeholder="Enter phone number" required>
                </div>
            </div>

            

            <div class="form-group mb-3">
                <label for="profile_image" class="form-label">Profile Image</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-image"></i></span>
                    <input type="file" class="form-control neon-input" name="profile_image" id="profile_image" accept="image/*">
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control neon-input" name="password" id="password" placeholder="Enter password" required>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control neon-input" name="password_confirmation" id="password_confirmation" placeholder="Confirm password" required>
                </div>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-3d-neon">Register</button>
            </div>
        </form>

        <div class="text-center mt-3 text-white">
            <p>Already have an account? <a href="{{ route('login.test') }}" class="fw-semibold text-decoration-none neon-link">Login</a></p>
        </div>
    </div>
</div>

<!-- ✅ Reuse the same styles from login page -->
<style>
/* Background & Card */
.login-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
}

.login-card {
    background: #1c1c1c;
    padding: 2.5rem;
    border-radius: 20px;
    width: 100%;
    max-width: 520px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.5);
    border: 1px solid rgba(255,255,255,0.1);
}

.login-header h3 {
    color: #fff;
    font-weight: 700;
    margin-bottom: 1.5rem;
}

/* Inputs */
.neon-input {
    border-radius: 12px;
    border: 1px solid #444;
    background: #1c1c1c;
    color: #fff;
    padding: 12px;
    box-shadow: 0 0 5px #007bff inset;
    transition: 0.3s;
}

.neon-input:focus {
    outline: none;
    box-shadow: 0 0 8px #00ffff;
    border-color: #00ffff;
}

.input-group-text {
    background: #111;
    border: none;
    color: #00ffff;
}

/* Button */
.btn-3d-neon {
    background: linear-gradient(135deg, #00ffff, #007bff);
    color: #fff;
    font-weight: 600;
    border-radius: 50px;
    padding: 12px;
    font-size: 1.1rem;
    border: none;
    box-shadow: 0 6px #00bfff;
    text-transform: uppercase;
    transition: all 0.3s ease;
}

.btn-3d-neon:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px #00bfff;
    background: linear-gradient(135deg, #00bfff, #00ffff);
}

.btn-3d-neon:active {
    transform: translateY(2px);
    box-shadow: 0 4px #007bff;
}

/* Links */
.neon-link {
    color: #00ffff;
    transition: 0.3s;
}

.neon-link:hover {
    color: #00bfff;
    text-decoration: underline;
}

/* Labels */
label {
    color: #fff;
    font-weight: 500;
}
</style>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function() {
    const userTypeSelect = document.getElementById('user_type');
    const rollNoField = document.getElementById('roll_no_field');
    const purposeField = document.getElementById('purpose_field');
    const submitButton = document.querySelector('.btn-3d-neon');
    const loginText = document.querySelector('.text-center.mt-3 p');
    const registerHeading = document.getElementById('register_heading');

    const originalTexts = {
        register_heading: 'Register',
        submit_button: 'Register',
        login_text: 'Already have an account? <a href="{{ route("login.test") }}" class="fw-semibold text-decoration-none neon-link">Login</a>',
        name: { label: 'Full Name', placeholder: 'Enter full name' },
        user_name: { label: 'User Name', placeholder: 'Enter user name' },
        roll_no: { label: 'Roll Number', placeholder: 'Enter Roll Number' },
        purpose: { label: 'Purpose', placeholder: 'Enter purpose of visit' },
        nrc_number: { label: 'NRC', placeholder: '123456' },
        email: { label: 'Email', placeholder: 'Enter email address' },
        phone_number: { label: 'Phone', placeholder: 'Enter phone number' },
        password: { label: 'Password', placeholder: 'Enter password' },
        password_confirmation: { label: 'Confirm Password', placeholder: 'Confirm password' }
    };

    const myanmarTexts = {
        register_heading: 'မှတ်ပုံတင်ခြင်း',
        submit_button: 'မှတ်ပုံတင်ပါ',
        login_text: 'အကောင့်ရှိပြီးသားလား? <a href="{{ route("login.test") }}" class="fw-semibold text-decoration-none neon-link">ဝင်မည်</a>',
        name: { label: 'အမည်အပြည့်အစုံ', placeholder: 'အမည်အပြည့်အစုံထည့်ပါ' },
        user_type: { label: 'အသုံးပြုသူအမျိုးအစား' },
        profile_image: { label: 'အသုံးပြုသူ၏ဓာတ်ပုံ' },
        user_name: { label: 'အသုံးပြုသူအမည်', placeholder: 'အသုံးပြုသူအမည်ထည့်ပါ' },
        roll_no: { label: 'စာရင်းနံပါတ်', placeholder: 'စာရင်းနံပါတ်ထည့်ပါ' },
        purpose: { label: 'ရည်ရွယ်ချက်', placeholder: 'လာရောက်ရည်ရွယ်ချက်ထည့်ပါ' },
        nrc_number: { label: 'မှတ်ပုံတင်အမှတ်', placeholder: '123456' },
        email: { label: 'အီးမေးလ်', placeholder: 'အီးမေးလ်ထည့်ပါ' },
        phone_number: { label: 'ဖုန်းနံပါတ်', placeholder: 'ဖုန်းနံပါတ်ထည့်ပါ' },
        password: { label: 'စကားဝှက်', placeholder: 'စကားဝှက်ထည့်ပါ' },
        password_confirmation: { label: 'စကားဝှက်အတည်ပြု', placeholder: 'စကားဝှက်အတည်ပြုထည့်ပါ' }
    };

    function updateFormTexts(toMyanmar) {
        const texts = toMyanmar ? myanmarTexts : originalTexts;

        // Update heading
        if(registerHeading) registerHeading.innerHTML = `<i class="fas fa-user-plus me-2"></i> ${texts.register_heading}`;

        // Update submit button
        if(submitButton) submitButton.innerText = texts.submit_button;

        // Update login text
        if(loginText) loginText.innerHTML = texts.login_text;

        // Update labels and placeholders for inputs
        for (const key in texts) {
            if(['register_heading','submit_button','login_text'].includes(key)) continue;
            const element = document.getElementById(key);
            const label = document.querySelector(`label[for="${key}"]`);
            if(element && texts[key].placeholder) element.placeholder = texts[key].placeholder;
            if(label && texts[key].label) label.innerText = texts[key].label;
        }
    }

    userTypeSelect.addEventListener('change', function() {
        const selectedOption = userTypeSelect.options[userTypeSelect.selectedIndex];
        const typeName = selectedOption.getAttribute('data-name');

        // Show/hide Roll Number for students
        rollNoField.style.display = typeName === 'student' ? 'block' : 'none';
        // Show/hide Purpose for visitors
        purposeField.style.display = typeName === 'visitor' ? 'block' : 'none';

        // Switch form text to Myanmar if visitor, otherwise English
        updateFormTexts(typeName === 'visitor');
    });
});
</script>


@extends('user.layouts.app')

@section('title')
    Create Profile | Shubhkamna Private Limited
@endsection

@section('meta_description')
    Edit your profile details.
@endsection

@section('meta_keywords')
    profile, edit profile, user account
@endsection

@section('style')
    <style>
        .user-profile-section {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 15px;
        }

        .profile-card {
            width: 100%;
            max-width: 600px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .profile-header {
            background-color: #6c1212;
            color: #fff;
            padding: 30px 20px;
            text-align: center;
        }

        .profile-header h3 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 600;
            color: #ffffff;
        }

        .profile-body {
            padding: 30px;
        }

        .profile-item {
            margin-bottom: 20px;
        }

        .profile-item label {
            font-weight: 600;
            color: #6c1212;
        }

        .profile-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-top: 5px;
        }

        .btn-save {
            background-color: #6c1212;
            color: #fff;
            width: 100%;
            border-radius: 8px;
            padding: 10px;
            transition: all 0.3s;
            border: 1px solid rgb(226, 225, 225) !important;
        }

        .btn-save:hover {
            background-color: #921d1d;
            color: white !important;
        }

        .read-only-input-head input {
            background-color: rgb(226, 225, 225);
        }

        .astrick {
            padding-left: 0.2rem;
        }
    </style>
@endsection

@section('content')

    <section class="user-profile-section">
        <div class="profile-card">
            <div class="profile-header">
                <h3>Edit Profile</h3>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="profile-body">
                <form action="{{ route('user.profile.update') }}" method="POST">
                    @csrf

                    <!-- Name -->
                    <div class="profile-item">
                        <label>Name <span class="astrick">*</span></label>
                        <input type="text" name="name" class="profile-input"
                            value="{{ old('name', $user->name ?? '') }}" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email (read-only) -->
                    <div class="profile-item read-only-input-head">
                        <label>Email ID<span class="astrick">*</span></label>
                        <input type="email" name="email" class="profile-input"
                            value="{{ old('email', $user->email ?? '') }}" readonly required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- education  --}}
                    <div class="profile-item ">
                        <label>Education<span class="astrick">*</span></label>
                        <input type="education" name="education" class="profile-input"
                            value="{{ old('education', $user->education ?? '') }}"  required>
                        @error('education')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="profile-item">
                        <label>Phone No.<span class="astrick">*</span></label>
                        <input type="text" name="phone" class="profile-input"
                            value="{{ old('phone', $address_main->phone ?? '') }}" required
                            oninput="this.value = this.value.replace(/[^0-9+\- ]/g, '')">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Street -->
                    <div class="profile-item">
                        <label>Street<span class="astrick">*</span></label>
                        <input type="text" name="street" class="profile-input" placeholder="Street / House No. / Area"
                            value="{{ old('street', $address_main->street ?? '') }}" required>
                        @error('street')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Landmark -->
                    <div class="profile-item">
                        <label>Landmark</label>
                        <input type="text" name="landmark" class="profile-input" placeholder="Nearby landmark"
                            value="{{ old('landmark', $address_main->landmark ?? '') }}">
                        @error('landmark')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- City -->
                    <div class="profile-item">
                        <label>City<span class="astrick">*</span></label>
                        <input type="text" name="city" class="profile-input" placeholder="Your city"
                            value="{{ old('city', $address_main->city ?? '') }}" required>
                        @error('city')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- State -->
                    <div class="profile-item">
                        <label>State<span class="astrick">*</span></label>
                        <input type="text" name="state" class="profile-input" placeholder="Your state"
                            value="{{ old('state', $address_main->state ?? '') }}" required>
                        @error('state')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Country -->
                    <div class="profile-item">
                        <label>Country<span class="astrick">*</span></label>
                        <input type="text" name="country" class="profile-input" placeholder="Your country"
                            value="{{ old('country', $address_main->country ?? '') }}" required>
                        @error('country')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Postal Code -->
                    <div class="profile-item">
                        <label>Postal Code<span class="astrick">*</span></label>
                        <input type="text" name="postal_code" class="profile-input" placeholder="PIN / ZIP Code"
                            value="{{ old('postal_code', $address_main->postal_code ?? '') }}" required>
                        @error('postal_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-save mt-3">Update Profile</button>
                </form>
            </div>
        </div>
    </section>



@endsection

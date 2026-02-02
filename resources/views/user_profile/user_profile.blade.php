@extends('user.layouts.app')

@section('title')
    Profile | Shubhkamna Private Limited
@endsection

@section('meta_description')
    User profile details.
@endsection

@section('meta_keywords')
    profile, user account, details
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
            max-width: 700px;
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
            position: relative;
        }

        .profile-header h3 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 600;
            color: #ffffff;
        }

        .edit_head {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .edit_head i {
            color: #fff;
            font-size: 1.6rem;
            cursor: pointer;
        }

        .profile-body {
            padding: 30px;
        }

        .profile-item {
            margin-bottom: 15px;
        }

        .profile-item label {
            font-weight: 600;
            color: #6c1212;
            display: block;
        }

        .profile-item p {
            margin: 5px 0 0;
            color: #333;
        }

        .btn-logout {
            background-color: #6c1212;
            color: #fff;
            width: 100%;
            border-radius: 8px;
            padding: 10px;
            transition: all 0.3s;
            border: 1px solid #6c1212 !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .btn-logout:hover {
            background-color: #921d1d;
        }
    </style>
@endsection

@section('content')
    <section class="user-profile-section">
        <div class="profile-card">
            <div class="profile-header">
                <h3>Your Profile</h3>
                <div class="edit_head">
                    <a href="{{ route('user.profile.edit') }}"><i class="fa fa-edit"></i></a>
                </div>
            </div>

            <div class="profile-body">
                <div class="profile-item">
                    <label>Name</label>
                    <p>{{ $user->name ?? '-' }}</p>
                </div>

                <div class="profile-item">
                    <label>Email ID</label>
                    <p>{{ $user->email ?? '-' }}</p>
                </div>


                <div class="profile-item">
                    <label>Education</label>
                    <p>{{ $user->education ?? '-' }}</p>
                </div>
                <div class="profile-item">
                    <label>Phone No.</label>
                    <p>{{ $address_main->phone ?? '-' }}</p>
                </div>

                <div class="profile-item">
                    <label>Street</label>
                    <p>{{ $address_main->street ?? '-' }}</p>
                </div>

                <div class="profile-item">
                    <label>Landmark</label>
                    <p>{{ $address_main->landmark ?? '-' }}</p>
                </div>

                <div class="profile-item">
                    <label>City</label>
                    <p>{{ $address_main->city ?? '-' }}</p>
                </div>

                <div class="profile-item">
                    <label>State</label>
                    <p>{{ $address_main->state ?? '-' }}</p>
                </div>

                <div class="profile-item">
                    <label>Country</label>
                    <p>{{ $address_main->country ?? '-' }}</p>
                </div>

                <div class="profile-item">
                    <label>Postal Code</label>
                    <p>{{ $address_main->postal_code ?? '-' }}</p>
                </div>


                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-logout mt-3">Logout</button>
                </form>

            </div>
        </div>
    </section>
@endsection

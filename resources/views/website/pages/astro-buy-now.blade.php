@extends('website.layouts.app')

@section('title')
    Buy {{ $product->name }} | Prajapati Ghatasutra
@endsection

@section('style')
    <style>
        /* ===== Buy Page Custom CSS ===== */
        .buy-wrapper {
            max-width: 1100px;
            margin: auto;
            padding: 4rem 1rem;
        }

        .buy-card {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            background: #fff;
            padding: 2.5rem;
            border-top-left-radius: 14px;
            border-top-right-radius: 14px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        .buy-image img,
        .buy-image video {
            width: 100%;
            height: 320px;
            object-fit: contain;
            border-radius: 12px;
            background: #f7f7f7;
        }

        .buy-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .buy-desc {
            color: #555;
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }

        .buy-price {
            font-size: 26px;
            font-weight: 700;
            color: var(--orange-color);
        }

        .buy-form label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .buy-form input,
        .buy-form textarea {
            width: 100%;
            padding: 12px 14px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-bottom: 1.2rem;
            outline: none;
        }

        .buy-form input:focus,
        .buy-form textarea:focus {
            border-color: var(--orange-color);
        }

        .buy-btn {
            background: var(--orange-color);
            color: #fff;
            border: none;
            padding: 14px 30px;
            font-size: 16px;
            border-radius: 30px;
            cursor: pointer;
        }

        .buy-btn:hover {
            opacity: 0.9;
        }

        @media(max-width: 991px) {
            .buy-card {
                grid-template-columns: 1fr;
            }
        }

        .form-section {
            background-color: white;
            padding: 2rem;
            border-bottom-right-radius: 14px;
            border-bottom-left-radius: 14px;
        }

        label {
            color: var(--blue-color);
        }
    </style>
@endsection

@section('content')
    <div class="buy-wrapper">
        <div class="buy-card">

            <!-- LEFT: Product -->
            <div class="buy-image">
                @if (\Illuminate\Support\Str::endsWith($product->photo, ['.mp4', '.webm']))
                    <video autoplay muted loop playsinline>
                        <source src="{{ asset($product->photo) }}">
                    </video>
                @else
                    <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}">
                @endif
            </div>

            <!-- RIGHT: Buy Form -->
            <div>
                <h2 class="buy-title">{{ $product->name }}</h2>

                <div class="buy-desc">
                    {!! $product->short_description !!}
                </div>

                <div class="buy-price">
                    ₹ {{ number_format($product->price ?? 0) }}
                </div>
                <span style="color:#959090;">( Price includes delivery and all applicable taxes. )</span>

            </div>


        </div>
        <div class="form-section">
            <form class="buy-form" method="POST" action="#">
                @csrf

                <div class="row">

                    <div class="col-lg-6">
                        <label>Full Name</label>
                        <input type="text" name="name" placeholder="Enter your full name" value="{{ old('name') }}"
                            required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label>Mobile Number</label>
                        <input type="tel" name="phone" placeholder="Enter your mobile number"
                            value="{{ old('phone') }}" required>
                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="Enter your email address"
                            value="{{ old('email') }}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label>Pincode</label>
                        <input type="text" name="pincode" placeholder="Enter delivery pincode"
                            value="{{ old('pincode') }}">
                        @error('pincode')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-lg-12">
                        <label>Delivery Address</label>
                        <textarea name="address" rows="3" placeholder="Enter complete delivery address">{{ old('address') }}</textarea>
                        @error('address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-lg-12">
                        <button type="submit" class="buy-btn">
                            Confirm Order
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>
@endsection

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

        .astrick {
            color: red;

        }
    </style>
@endsection

@section('script')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        document.getElementById('buyForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = {
                name: document.querySelector('[name=name]').value.trim(),
                phone: document.querySelector('[name=phone]').value.trim(),
                email: document.querySelector('[name=email]').value.trim(),
                pincode: document.querySelector('[name=pincode]').value.trim(),
                address: document.querySelector('[name=address]').value.trim(),
            };

            fetch("{{ route('buy.create', $product) }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formData)
                })
                .then(async res => {
                    const text = await res.text();

                    // 🔥 Debug once if needed
                    console.log('RAW RESPONSE:', text);

                    try {
                        return JSON.parse(text);
                    } catch (e) {
                        throw new Error('Server did not return JSON');
                    }
                })
                .then(data => {
                    console.log('PARSED RESPONSE:', data);

                    // ✅ Handle Laravel validation (default format)
                    if (data.errors && Object.keys(data.errors).length > 0) {
                        let msg = Object.values(data.errors)
                            .map(err => err[0])
                            .join('\n');
                        alert(msg);
                        return;
                    }

                    // ✅ Handle custom failure
                    if (data.success === false) {
                        alert(data.message || 'Unable to create order');
                        return;
                    }

                    // ❌ Safety check
                    if (!data.order_id || !data.key) {
                        alert('Payment initialization failed');
                        return;
                    }

                    // ✅ Razorpay options
                    const options = {
                        key: data.key,
                        amount: data.amount,
                        currency: "INR",
                        name: "Prajapati Ghatasutra",
                        description: "Product Purchase",
                        order_id: data.order_id,
                        prefill: {
                            name: data.name,
                            email: data.email || '',
                            contact: data.phone
                        },
                        handler: function(response) {
                            console.log('RAZORPAY RESPONSE:', response);

                            const payload = {
                                razorpay_payment_id: response.razorpay_payment_id,
                                razorpay_order_id: response.razorpay_order_id,
                                razorpay_signature: response.razorpay_signature,

                                // ✅ extra data (safe to send)
                                product_id: "{{ $product->id }}"
                            };

                            fetch("{{ route('payment.verify') }}", {
                                    method: "POST",
                                    headers: {
                                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                                        'Accept': 'application/json',
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify(payload)
                                })
                                .then(res => res.json())
                                .then(result => {
                                    console.log('VERIFY RESPONSE:', result);

                                    if (result.success) {

                                        document.getElementById('successOrderId').innerText =
                                            'Order ID: ' + response.razorpay_order_id;

                                        document.getElementById('successPaymentId').innerText =
                                            'Payment ID: ' + response.razorpay_payment_id;

                                        const successModal = new bootstrap.Modal(
                                            document.getElementById('paymentSuccessModal')
                                        );
                                        successModal.show();

                                    } else {
                                        alert(result.message || 'Payment verification failed');
                                    }
                                });
                        }


                    };

                    new Razorpay(options).open();
                })
                .catch(error => {
                    alert('Something went wrong. Please try again.');
                    console.error('FETCH ERROR:', error);
                });
        });
    </script>
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
            <form id="buyForm" class="buy-form" method="POST">
                @csrf

                <div class="row">

                    <div class="col-lg-6">
                        <label>Full Name <span class="astrick">*</span></label>
                        <input type="text" name="name" placeholder="Enter your full name" value="{{ old('name') }}"
                            required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label>Mobile Number <span class="astrick">*</span></label>
                        <input type="tel" name="phone" placeholder="Enter your mobile number"
                            value="{{ old('phone') }}" required>
                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label>Email Address <span class="astrick">*</span></label>
                        <input type="email" name="email" placeholder="Enter your email address"
                            value="{{ old('email') }}" required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-lg-6">
                        <label>Pincode <span class="astrick">*</span></label>
                        <input type="text" name="pincode" placeholder="Enter delivery pincode"
                            value="{{ old('pincode') }}">
                        @error('pincode')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-lg-12">
                        <label>Delivery Address <span class="astrick">*</span></label>
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

        <!-- Payment Success Modal -->
        <div class="modal fade" id="paymentSuccessModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header  text-white" style="background: var(--orange-color)">
                        <h5 class="modal-title" style="color:white">Payment Successful 🎉</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body text-center">
                        <p class="mb-2"><strong>Thank you for your order!</strong></p>
                        <p id="successOrderId"></p>
                        <p id="successPaymentId"></p>
                    </div>

                    <div class="modal-footer">
                        <button class="btn " data-bs-dismiss="modal" style="background: var(--orange-color);color:white">
                            Continue
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

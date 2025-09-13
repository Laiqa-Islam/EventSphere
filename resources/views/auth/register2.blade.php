<x-website-layout>
    <section class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb3.jpg);">
        <div class="bradcumbContent" style="    text-align: center;
    padding: 30px 35%;">
            <p>See what's new</p>
            <h1 style="color: #FF2D55; font-weight:bold;">REGISTER NOW</h1>
        </div>
    </section>

    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Login Area Start ##### -->
    <section class="login-area section-padding-100" style="padding: 0 15%;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="login-content">
                        <h3>Let's Get Started</h3>
                        <!-- Login Form -->
                        <div class="login-form">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- Username -->
                                <div class="form-group">
                                    <label for="name">Username</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name') }}" required autofocus autocomplete="username"
                                        placeholder="Enter Username">
                                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Full Name -->
                                <div class="form-group">
                                    <label for="full_name">Full Name</label>
                                    <input type="text" name="full_name" id="full_name" class="form-control"
                                        value="{{ old('full_name') }}" required autocomplete="name"
                                        placeholder="Enter Full Name">
                                    @error('full_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Mobile -->
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" name="mobile" id="mobile" class="form-control"
                                        value="{{ old('mobile') }}" autocomplete="tel" placeholder="Enter Mobile">
                                    @error('mobile') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Department -->
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <input type="text" name="department" id="department" class="form-control"
                                        value="{{ old('department') }}" placeholder="Enter Department">
                                    @error('department') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Enrollment Number -->
                                <div class="form-group">
                                    <label for="enrollment_no">Enrollment No</label>
                                    <input type="text" name="enrollment_no" id="enrollment_no" class="form-control"
                                        value="{{ old('enrollment_no') }}" placeholder="Enter Enrollment No">
                                    @error('enrollment_no') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="{{ old('email') }}" required autocomplete="username"
                                        placeholder="Enter Email">
                                    <small id="emailHelp" class="form-text text-muted"><i
                                            class="fa fa-lock mr-2"></i>We'll never share your email with anyone
                                        else.</small>
                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" required
                                        autocomplete="new-password" placeholder="Enter Password">
                                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control" required autocomplete="new-password"
                                        placeholder="Confirm Password">
                                    @error('password_confirmation') <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Buttons -->
                                <button type="submit" class="btn oneMusic-btn mt-30">Register</button>
                                <br><br>
                                <a href="{{ route('login') }}" style="color: black;">Already Have An Account? Log in</a>
                                <br>
                                <a href="{{ route('register.organizer') }}" style="color: black;">Register as an
                                    Organizer?</a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-website-layout>
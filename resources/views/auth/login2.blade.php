<x-website-layout>
    <section class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb3.jpg);">
        <div class="bradcumbContent" style="    text-align: center;
    padding: 30px 35%;">
            <!-- <p>See what’s new</p> -->
            <h1 style="color: #FF2D55; font-weight:bold;">Your Gateway to Events</h1>
        </div>
    </section>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Login Area Start ##### -->
    <section class="login-area section-padding-100" style="padding: 0 15%;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="login-content">
                        <h3>Welcome Back</h3>
                        <!-- Login Form -->
                        <div class="login-form">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Enter E-mail">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" :value="old('email')"
                                        required autofocus autocomplete="username" />
                                    <small id="emailHelp" class="form-text text-muted"><i class="fa fa-lock mr-2"></i>
                                        We'll never share your email with anyone
                                        else.</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" name="password" class="form-control"
                                        id="exampleInputPassword1" placeholder="Password" required
                                        autocomplete="current-password">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                                </div>
                                @if (Route::has('password.request'))
                                    <a class="text-decoration-underline fs-6 text-muted hover-text-dark rounded"
                                        href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                                <button type="submit" class="btn oneMusic-btn mt-30" name="login">Login</button><br><br>
                                <a href="{{route('register')}}" style="color: black;">Don't have an Account ? Sign up</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</x-website-layout>
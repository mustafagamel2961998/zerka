<x-front.layout title="{{ __('global.sign_in') }}">
<!-- فورمة تسجيل الدخول -->
<section class="bg0 p-t-40 p-b-116">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 p-b-50">
                
                <!-- الفلتر أو الإطار الخارجي للفورم متناسق مع استايل CozaStore -->
                <div class="bor10 p-lr-40 p-t-50 p-b-40 m-l-63 m-r-32 m-lr-0-xl p-lr-15-sm">
                    
                    <h4 class="mtext-105 cl2 txt-center p-b-30">
                        Sign In
                    </h4>

                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <!-- حقل اسم المستخدم أو الهاتف -->
                        <div class="m-b-20 how-pos4-parent">
                            <label class="stext-110 cl2 p-b-5 d-block" for="login">
								{{ __('global.login_label') }}
							</label>
                            <div class="bor8 bg0 w-full pos-relative">
                                <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30  
									@error('login')
										is-invalid
									@enderror" 
									type="text" id="login" name="login" placeholder="{{ __('global.login_input_placeholder') }}" required value="{{ old('login') }}">
									 @error('login')
										<div id="validationServer03Feedback" class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
                                <div class="how-pos4 pointer-none flex-c-m">
                                    <i class="zmdi zmdi-account text-muted fs-18"></i>
                                </div>
                            </div>
                            @error('login')
                                <span class="text-danger stext-111 m-t-5 d-block">
									{{ $message }}
								</span>
                            @enderror
                        </div>

                        <!-- حقل الرقم السري -->
                        <div class="m-b-25 how-pos4-parent">
                            <label class="stext-110 cl2 p-b-5 d-block" for="password">
								{{ __('global.password_label') }}
							</label>
                            <div class="bor8 bg0 w-full pos-relative">
                                <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30  
								@error('password') is-invalid @enderror" 
								type="password" id="password" name="password" placeholder="{{ __('global.password_input_placeholder') }}" required>
                                <div class="how-pos4 pointer-none flex-c-m">
                                    <i class="zmdi zmdi-lock text-muted fs-18"></i>
                                </div>
                            </div>
							@error('password')
								<div id="validationServer03Feedback" class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
                        </div>

                        <!-- تذكرني ونسيت كلمة السر -->
                        <div class="flex-w flex-sb-m p-b-30">
                             <div class="mb-3">
								<div class="form-check">
									<input type="checkbox" class="form-check-input" id="checkbox-signin">
									<label class="form-check-label" for="checkbox-signin">
										{{ __('global.remember_me_text') }}
									</label>
								</div>
							</div>

                            <a href="#" class="stext-111 cl6 hov-cl1 trans-04 m-tb-5">
								{{__('global.forgot_password_text')}}
                            </a>
                        </div>

                        <!-- زرار تسجيل الدخول -->
                        <button type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer w-full">
                            {{ __('global.sign_in') }}
                        </button>
                    </form>

                    <!-- رابط لإنشاء حساب جديد في حال لو مش مسجل -->
                    <div class="txt-center p-t-30">
                        <span class="stext-111 cl6">
                            {{ __('global.no_account_text') }}
                        </span>
                        <a href="#" class="stext-111 cl1 hov-cl1 trans-04 font-weight-bold">
                            {{ __('global.sign_up') }}
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

</x-front.layout>
@extends('home.master')

@section('title', $setting->configs['site_name'])

@section('description', $setting->configs['des'])

@section('keywords', $setting->configs['keyword'])

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-9">
            @include('errors.alert')
            <!-- Top Apps -->
            <div class="nborder">
                <div class="breadcrumbs">
                    <h1 class="pull-left">Contact Us</h1>
                </div>
                <form class="form-horizontal" method="post" action="{{ url('contact-us') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="panel-body">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name" class="col-sm-2 control-label">Your Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Your Name" value="{{ old('name') }}">
                            @if( $errors->has('name'))
                                <p class="help-block">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                    </div> <!-- / .form-group -->
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="inputPassword" class="col-sm-2 control-label">Your Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                            @if( $errors->has('email'))
                                <p class="help-block">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                    </div> <!-- / .form-group -->

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Reason for Contact</label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="reason" id="optionsRadios1" value="1" class="px" checked="">
                                    <span class="lbl">Website feedback</span>
                                </label>
                            </div> <!-- / .radio -->
                            <div class="radio">
                                <label>
                                    <input type="radio" name="reason" id="optionsRadios2" value="2" class="px">
                                    <span class="lbl">DMCA takedown request</span>
                                </label>
                            </div> <!-- / .radio -->
                            <div class="radio">
                                <label>
                                    <input type="radio" name="reason" id="optionsRadios2-2" value="3" class="px">
                                    <span class="lbl">Other</span>
                                </label>
                            </div> <!-- / .radio -->
                        </div> <!-- / .col-sm-10 -->
                    </div> <!-- / .form-group -->

                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="inputPassword" class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="subject" placeholder="Subject" value="{{ old('subject') }}">
                            @if( $errors->has('subject'))
                                <p class="help-block">{{ $errors->first('subject') }}</p>
                            @endif
                        </div>
                    </div> <!-- / .form-group -->
                    <div class="form-group">
                        <label for="asdasdas" class="col-sm-2 control-label">Message</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" name="message">{{ old('message') }}</textarea>
                        </div>
                    </div> <!-- / .form-group -->
                    <div class="form-group {{ $errors->has('g-recaptcha-response') ? 'has-error' : '' }}">
                        <label for="asdasdas" class="col-sm-2 control-label">Are you a human?</label>
                        <div class="col-sm-10">
                            {!! app('captcha')->display() !!}
                        </div>
                    </div> <!-- / .form-group -->
                    <div class="form-group" style="margin-bottom: 0;">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">SEND</button>
                        </div>
                    </div> <!-- / .form-group -->
                </div>
            </form>
                @include('home.module.ga')

                <div class="clearfix"></div>
            </div>
            <!-- End Top Apps -->



        </div>
        <div class="col-xs-12 col-sm-3">

            @include('home.module.ga')


        </div>
    </div>



<script>
    $(document).ready(function() {
        $("#currentPage").val(1);
    });

</script>


@endsection
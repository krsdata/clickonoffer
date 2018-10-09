<!DOCTYPE html>

<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>{{ $setting->website_title ?? 'admin' }} </title>
        @if(isset($setting->website_logo))
        <link rel="shortcut icon" type="image/png" href="{{ URL::asset('storage/uploads/img/'.$setting->website_logo ) }}" /> 
        @endif
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css"> 
 
        <link href="{{ URL::asset('assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/css/core.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/css/components.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ URL::asset('assets/css/colors.css')}}" rel="stylesheet" type="text/css">
        
        <link href="{{ URL::asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{ URL::asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />
 
        <link href="{{ URL::asset('assets/pages/css/profile.min.css')}}" rel="stylesheet" type="text/css" />



        <script>
        var base_url = "{{url('/')}}";
        </script>
    </head>

 
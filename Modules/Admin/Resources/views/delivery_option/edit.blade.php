
@extends('admin::layouts.master')

  @section('content') 
  @include('admin::partials.navigation')
  @include('admin::partials.breadcrumb')   

  @include('admin::partials.sidebar')  
  <div class="panel panel-white"> 


    <div class="panel panel-flat">
        <div class="panel-heading">
          <h6 class="panel-title"><b>Create {{$heading ?? ''}}</b><a class="heading-elements-toggle"><i class="icon-more"></i></a>  </h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li> <a type="button" href="{{route('deliveryoption')}}" class="btn btn-primary text-white   btn-rounded "> View Option<span class="legitRipple-ripple" ></span></a></li> 
                </ul>
          </div>
        </div> 
    </div>

    {!! Form::model($deliveryOption, ['method' => 'PATCH', 'route' => ['deliveryoption.update', $deliveryOption->id],'class'=>'form-basic ui-formwizard user-form','id'=>'form_sample_3','enctype'=>'multipart/form-data']) !!}

    @include('admin::delivery_option.form', compact('deliveryOption'))

    {!! Form::close() !!} 
<!-- END FORM-->
</div>
<!-- END VALIDATION STATES-->
                     

        
@stop
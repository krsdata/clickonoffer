@extends('admin::layouts.master')
 
    @section('content') 
      @include('admin::partials.navigation')
      @include('admin::partials.breadcrumb')   

       @include('admin::partials.sidebar')  
      <div class="panel panel-white"> 

 
			<div class="panel panel-flat">
                      <div class="panel-heading">
                    <h6 class="panel-title"><b>Create {{$heading ?? ''}}</b><a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                    <div class="heading-elements">
                      <ul class="icons-list">
                        <li> <a type="button" href="{{route('categories')}}" class="btn btn-primary text-white   btn-rounded "> View Categories<span class="legitRipple-ripple" ></span></a></li> 
                      </ul>
                    </div>
                  </div> 
            </div>


            {!! Form::model($category, ['route' => ['categories.store'],'class'=>'form-basic ui-formwizard user-form','id'=>'category-form','enctype'=>'multipart/form-data']) !!}
                               
                @include('admin::category.form')

            {!! Form::close() !!}  
                     
        </div> 
@stop

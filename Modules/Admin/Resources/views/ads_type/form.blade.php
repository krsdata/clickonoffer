
    <fieldset class="step ui-formwizard-content" id="step1" style="display: block;">
        
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{ $errors->first('category_name', ' has-error') }}  @if(session('field_errors')) {{ 'has-error' }} @endif">
                    <label class="control-label col-md-2">Title <span class="required"> * </span></label>
                    <div class="col-md-6"> 
                        {!! Form::text('title',null, ['class' => 'form-control','data-required'=>1])  !!} 
                        
                        <span class="help-block" style="color:red">{{ $errors->first('title', ':message') }} @if(session('field_errors')) {{ 'The type name already been taken!' }} @endif</span>
                    </div>
                </div> 
            </div>

            <div class="col-md-12">
               <div class="form-group  {{ $errors->first('image', ' has-error') }}">
                    <label class="control-label col-md-2"> Image Upload <span class="required"> * </span></label>
                    <div class="col-md-6">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <img src=" {{ $url ?? 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image'}}" alt=""> </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>
                            <div>
                                <span class="btn default btn-file">
                                    <span class="fileinput-new"> Select image </span>
                                    <span class="fileinput-exists"> Change </span>
                                   
                {!! Form::file('image',null,['class' => 'form-control form-cascade-control input-small'])  !!}


                                     </span>
                                      <span class="help-block" style="color:#e73d4a">{{ $errors->first('image', ':message') }}</span>
                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                            </div>
                        </div>
                       <!--  <div class="clearfix margin-top-10">
                            <span class="help-block">NOTE!</span> Image preview only works in IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+. In older browsers the filename is shown instead. </div> -->
                    </div>
                </div>
            </div>

             <div class="col-md-12">
                  <div class="form-group pull-right ">
                {!! Form::submit(' Save ', ['class'=>'btn  btn-primary text-white','id'=>'saveBtn']) !!}

                 <a href="{{route('category')}}">
            {!! Form::button('Back', ['class'=>'btn btn-warning text-white']) !!} </a>
                     </div>   
            </div> 

        </div> 
 
    </fieldset > 

    <fieldset class="step ui-formwizard-content" id="step1" style="display: block;">
        
        <div class="row">
            <div class="col-md-6">
                 <div class="form-group {{ $errors->first('name', ' has-error') }}">
                    <label>Name: <span class="text-danger">*</span></label>
                    
                     {!! Form::text('offer_name',null, ['class' => 'form-control','data-required'=>1])  !!} 
                      <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                </div>
            </div>

           
             <div class="col-md-12">
                
                  <div class="form-group pull-right ">
                {!! Form::submit(' Save ', ['class'=>'btn  btn-primary text-white','id'=>'saveBtn']) !!}


                <a href="{{route('offer_type')}}">
                    {!! Form::button('Back', ['class'=>'btn btn-warning text-white']) !!} </a>
                     </div>   
            </div> 

        </div> 
 
    </fieldset >
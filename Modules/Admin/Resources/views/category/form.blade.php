
    <fieldset class="step ui-formwizard-content" id="step1" style="display: block;">
        
        <div class="row">
            <div class="col-md-6">
                 <div class="form-group {{ $errors->first('name', ' has-error') }}">
                    <label>Name: <span class="text-danger">*</span></label>
                    
                     {!! Form::text('name',null, ['class' => 'form-control','data-required'=>1])  !!} 
                      <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                </div>
            </div>

             <div class="col-md-6">
                <div class="form-group {{ $errors->first('description', ' has-error') }}">
                    <label>Description: <span class="text-danger">*</span></label> 
                     {!! Form::text('description',null, ['class' => 'form-control required' ,'data-required'=>1])  !!} 
                      <span class="help-block">{{ $errors->first('description', ':message') }}</span>
                </div>
            </div>
			
			 <div class="col-md-6">
                <div class="form-group {{ $errors->first('image', ' has-error') }}">
                    <label>Image: <span class="text-danger">*</span></label> 
					<div class="fileinput fileinput-new" data-provides="fileinput">
				<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
					 @if(!$category->image)
							<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""> 
							@else
							 <img src="{{url('public/'.$category->image)}}" alt="image"> 
							@endif
				</div>
				<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> 
				</div>
				<div>
					<span class="btn default btn-file">
					<span class="fileinput-new"> Select image </span>
					<span class="fileinput-exists"> Change </span>
						   
					{!! Form::file('image',null,['class' => 'form-actionsontrol form-cascade-control input-small'])  !!} 
					</span>
					<span class="help-block" style="color:#e73d4a">{{ $errors->first('image', ':message') }}</span>
					<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove    
						</a>
				</div>
			</div>
				</div>
            </div>
			
 

             <div class="col-md-12">
                
                  <div class="form-group pull-right ">
                {!! Form::submit(' Save ', ['class'=>'btn  btn-primary text-white','id'=>'saveBtn']) !!}


                <a href="{{route('categories')}}">
                    {!! Form::button('Back', ['class'=>'btn btn-warning text-white']) !!} </a>
                     </div>   
            </div> 

        </div> 
 
    </fieldset >
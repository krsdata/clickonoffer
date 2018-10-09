
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
                <div class="form-group {{ $errors->first('role_type', ' has-error') }}">
                    <label>Role Type: <span class="text-danger">*</span></label> 
                     
                        {!!  Form::select('role_type', 
                             $role_type, 
                             null,['class' => 'form-control']) 
                        !!}


                      <span class="help-block">{{ $errors->first('role_type', ':message') }}</span>
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-group {{ $errors->first('description', ' has-error') }}">
                    <label>Description: <span class="text-danger">*</span></label> 
                     {!! Form::text('description',null, ['class' => 'form-control required' ,'data-required'=>1])  !!} 
                      <span class="help-block">{{ $errors->first('description', ':message') }}</span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group table-responsive">
                    <label>Permission: <span class="text-danger">*</span></label> 
                <table class="table table-striped table-hover table-bordered" id="contact">                                         
                    <thead>
                      <tr>
                          <th class="text-center">Permission</th> 
                           @foreach($role_type as $role )
                           <th colspan="3" class="text-center">{{$role }} </th>
                            @endforeach
                        
                      </tr>
                       <tr>
                          <th class="text-center">Permission</th> 
                           @foreach($role_type as $role )
                           <th class="text-center"> Read</th>
                            <th class="text-center"> Write</th>
                             <th class="text-center"> Delete</th>
                            @endforeach
                        
                      </tr> 
                     
                  </thead>
                  </tbody>                        
                   @foreach($controllers as $route )
                    <tr>
                           <td>{{$route}}</td>
                        @foreach($role_type as $role )
                        <?php
                        $canRead = isset($permissions->$route->$role->read)?true:false;
                        $canWrite = isset($permissions->$route->$role->write)?true:false;
                        $canDelete = isset($permissions->$route->$role->delete)?true:false;
                        ?>
                         <td class="text-center"> 
                             <input type="checkbox" name="permission[{{$route}}][{{$role}}][read]" value="1"   @if($canRead)  checked="checked" @endif >
                         </td>  
                         <td class="text-center"> <input type="checkbox" name="permission[{{$route}}][{{$role}}][write]" value="1"  @if($canWrite)  checked="checked" @endif>
                         </td> 
                         <td class="text-center">  <input type="checkbox" name="permission[{{$route}}][{{$role}}][delete]" value="1"  @if($canDelete)  checked="checked" @endif>
                         </td>
                            @endforeach
                     </tr>     
                    @endforeach
                    </tbody>
                </table>     
                </div>
            </div>

     

                 <div class="col-md-12">
                    
                      <div class="form-group pull-right ">
                    {!! Form::submit(' Save ', ['class'=>'btn  btn-primary text-white','id'=>'saveBtn']) !!}


                    <a href="{{route('role')}}">
                        {!! Form::button('Back', ['class'=>'btn btn-warning text-white']) !!} </a>
                         </div>   
                </div> 
            </div> 

        </div> 
 
    </fieldset >
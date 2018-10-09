@extends('admin::layouts.master')
 
    @section('content') 
      @include('admin::partials.navigation')
      @include('admin::partials.breadcrumb')   

       @include('admin::partials.sidebar')  

            <div class="panel panel-white"> 
  		          <div class="panel panel-flat">
                  <div class="panel-heading">
                    <h6 class="panel-title"><b> {{$heading }} List</b><a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                    <div class="heading-elements">
                      <ul class="icons-list">
                        <li> <a type="button" href="{{route('offer_type.create')}}" class="btn btn-primary text-white btn-labeled btn-rounded "><b><i class="icon-plus3"></i></b> Add Offer Type<span class="legitRipple-ripple" ></span></a></li> 
                      </ul>
                    </div>
                  </div> 
  		        </div>  
		        
  		        <div class="table-responsive">
  		            <table class="table datatable-basic table-bordered table-hover" id="roles_list">
  		                <thead>
  		                    <tr>
  		                        <th>#Sno</th>
  		                        <th>Offer Name</th> 
  		                        <th>Created at</th> 
  		                        <th class="text-center">Actions</th>
  		                    </tr>
  		                </thead>
  		                    <tbody>
                          @foreach($list as $key => $result)
                              <tr>
                               <th> {{++$key}} </th> 
                               <td> {{$result->offer_name }} </td>
                                   <td>
                                      {!! Carbon\Carbon::parse($result->created_at)->format('Y-m-d'); !!}
                                  </td>
                                  
                                  <td> 
                                      <a href="{{ route('offer_type.edit',$result->id)}}" class="btn btn-primary btn-xs" style="margin-left: 20px">
                                          <i class="fa fa-edit" title="edit"></i> Edit
                                      </a>

                                      {!! Form::open(array('class' => 'form-inline pull-left deletion-form', 'method' => 'DELETE',  'id'=>'deleteForm_'.$result->id, 'route' => array('offer_type.destroy', $result->id))) !!}

                                      <button class='delbtn btn btn-danger btn-xs' type="submit" name="remove_levels" value="delete" id="{{$result->id}}"><i class="fa fa-trash" title="Delete"></i> Delete
                                      </button>
                                      
                                       {!! Form::close() !!}
                                  </td>
                                 
                              </tr>
                             @endforeach
                              
                          </tbody>
  		            </table> 
  		        </div> 
 		       </div>
	     </div> 
   @stop
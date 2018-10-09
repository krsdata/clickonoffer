<div class="page-container" style="min-height:360px">

<!-- Page content -->
<div class="page-content">

<!-- Main sidebar -->
<div class="sidebar sidebar-main sidebar-default">
<div class="sidebar-content">
<!-- Main navigation -->
<div class="sidebar-category sidebar-category-visible">
    <div class="category-content no-padding">
        <ul class="navigation navigation-main navigation-accordion">
        <!-- Main -->
            <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="" data-original-title="admin"></i></li>
            <li class="active"><a href="{{url('/')}}" class="legitRipple"><i class="icon-home4"></i> <span>Dashboard</span></a></li>

            <li class="{{($viewPage=='role')?'active':''}}">
                <a href="{{route('role')}}" class="has-ul legitRipple"><i class="icon-stack2"></i> <span>Manage Roles</span>
                    <span class="legitRipple-ripple"></span></a>
                <ul class="hidden-ul" style="display: none;">
                    <li><a href="{{route('role.create')}}" class="legitRipple">Create Role</a></li> 
                    <li><a href="{{route('role')}}" class="legitRipple">View Roles</a></li> 
                </ul>
            </li>
             
            <li class="{{($viewPage=='adstype')?'active':''}}">
                <a href="{{route('adstype')}}" class="has-ul legitRipple"><i class="icon-stack2"></i> <span>Manage Ads Type</span>
                    <span class="legitRipple-ripple"></span></a>
                <ul class="hidden-ul" style="display: none;">
                <li><a href="{{route('adstype.create')}}" class="legitRipple">Create Type</a></li> 
                <li><a href="{{route('adstype')}}" class="legitRipple">View Type</a></li> 
                </ul>
            </li>

            <li class="{{($viewPage=='categories')?'active':''}}">
                <a href="{{route('categories')}}" class="has-ul legitRipple"><i class="icon-stack2"></i> <span>Manage Ads Category</span>
                    <span class="legitRipple-ripple"></span></a>
                <ul class="hidden-ul" style="display: {{($viewPage=='Categories')?'block':'none'}};">

                    <li class="{{($viewPage=='categories')?'active':''}}">
                        <a href="{{route('categories')}}" class="has-ul legitRipple"><i class="icon-stack2"></i> <span>Main Categories</span>
                            <span class="legitRipple-ripple"></span></a>
                        <ul class="hidden-ul" style="display: {{($viewPage=='Users')?'block':'none'}};">
                            <li><a href="{{route('categories.create')}}" class="legitRipple">Create Category</a></li> 
                            <li><a href="{{route('categories')}}" class="legitRipple">View Category</a></li>
                        </ul>
                    </li>
                    
                    <li class="{{($viewPage=='subcategories')?'active':''}}">
                        <a href="{{route('subcategories')}}" class="has-ul legitRipple"><i class="icon-stack2"></i> <span>Sub Categories</span>
                            <span class="legitRipple-ripple"></span></a>
                        <ul class="hidden-ul" style="display: {{($viewPage=='subcategories')?'block':'none'}};">
                            <li><a href="{{route('subcategories.create')}}" class="legitRipple">Create SubCategory</a></li> 
                            <li><a href="{{route('subcategories')}}" class="legitRipple">View SubCategory</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
			<li class="">
                <a href="{{route('offer_type')}}" class="has-ul legitRipple"><i class="icon-stack2"></i> <span>Manage Offer Type</span>
                    <span class="legitRipple-ripple"></span></a>
                <ul class="hidden-ul" style="display: none;">
                <li><a href="{{route('offer_type.create')}}" class="legitRipple">Create Offer Type</a></li> 
                <li><a href="{{route('offer_type')}}" class="legitRipple">View Offer Type</a></li> 
                </ul>
            </li>

            <li class="{{($viewPage=='deliveryoption')?'active':''}}">
                <a href="{{route('deliveryoption')}}" class="has-ul legitRipple"><i class="icon-stack2"></i> <span>Manage Delivery Option</span>
                    <span class="legitRipple-ripple"></span></a>
                <ul class="hidden-ul" style="display: none;">
                    <li><a href="{{route('deliveryoption.create')}}" class="legitRipple">Create Option</a></li> 
                    <li><a href="{{route('deliveryoption')}}" class="legitRipple">View Option</a></li> 
                </ul>
            </li>
            <li class="{{($viewPage=='deliverytype')?'active':''}}">
                <a href="{{route('deliverytype')}}" class="has-ul legitRipple"><i class="icon-stack2"></i> <span>Manage Delivery Type</span>
                    <span class="legitRipple-ripple"></span></a>
                <ul class="hidden-ul" style="display: none;">
                    <li><a href="{{route('deliverytype.create')}}" class="legitRipple">Create Type</a></li> 
                    <li><a href="{{route('deliverytype')}}" class="legitRipple">View Type</a></li> 
                </ul>
            </li>

            <li class="{{($viewPage=='Users')?'active':''}}">
                <a href="#" class="has-ul legitRipple"><i class="icon-stack2"></i> <span>Manage User</span>
                    <span class="legitRipple-ripple"></span></a>
                <ul class="hidden-ul" style="display: {{($viewPage=='Users')?'block':'none'}};">
                    <li><a href="{{route('adminUser')}}" class="legitRipple">Admin User</a></li> 
                    <li><a href="{{route('singleUser')}}" class="legitRipple">Single Users</a></li>
                    <li><a href="{{route('advertiser')}}" class="legitRipple">Advertiser</a></li> 
                </ul>
            </li>         


            <li><a href="{{route('contactuser')}}" class="legitRipple"><i class="icon-stack2"></i> <span>Manage Contact User </span></a></li> 

             <li class="">
                <a href="{{route('setting')}}" class="has-ul legitRipple"><i class="icon-stack2"></i> <span>Website Settings</span>
                    <span class="legitRipple-ripple"></span></a>
                <ul class="hidden-ul" style="display: none;">
                <li><a href="{{route('setting')}}" class="legitRipple">Settings</a></li>  
                </ul>
            </li>

           
        </ul>
    </div>
</div>
<!-- /main navigation -->               
</div>
</div>
 <div class="content-wrapper">



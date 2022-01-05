<!-- 
=========================================================
 Light Bootstrap Dashboard - v2.0.1
=========================================================

 Product Page: https://www.creative-tim.com/product/light-bootstrap-dashboard
 Copyright 2019 Creative Tim (https://www.creative-tim.com) & Updivision (https://www.updivision.com)
 Licensed under MIT (https://github.com/creativetimofficial/light-bootstrap-dashboard/blob/master/LICENSE)

 Coded by Creative Tim & Updivision

=========================================================

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.  -->
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('light-bootstrap/img/apple-icon.png') }}">
        <link rel="icon" type="image/png" href="{{ asset('light-bootstrap/img/favicon.ico') }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>{{ $title }}</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
        <!-- CSS Files -->
        <link href="{{ asset('light-bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('light-bootstrap/css/light-bootstrap-dashboard.css?v=2.0.0') }} " rel="stylesheet" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<!-- Added custom CSS file for admin -->
		<link rel="stylesheet" href="{{ asset('light-bootstrap/css/custom.css') }}" />
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link href="{{ asset('light-bootstrap/css/demo.css') }}" rel="stylesheet" />
    </head>

    <body>
        <div class="wrapper @if (!auth()->check() || request()->route()->getName() == "") wrapper-full-page @endif">

            @if (auth()->check() && request()->route()->getName() != "")
                @include('layouts.navbars.sidebar')
                @include('pages/sidebarstyle')
            @endif

            <div class="@if (auth()->check() && request()->route()->getName() != "") main-panel @endif">
                @include('layouts.navbars.navbar')
                @yield('content')
                @include('layouts.footer.nav')
            </div>

        </div>
       


    </body>
        <!--   Core JS Files   -->
    <script src="{{ asset('light-bootstrap/js/core/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
    
    <script src="{{ asset('light-bootstrap/js/core/popper.min.js') }}" type="text/javascript"></script>
    
    <script src="{{ asset('light-bootstrap/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="{{ asset('sweetalert/sweetalert2.all.min.js') }}" type="text/javascript"></script>
    <link rel="stylesheet" href="{{ asset('sweetalert/sweetalert2.min.css') }}">
    
    <script src="{{ asset('light-bootstrap/js/plugins/jquery.sharrre.js') }}"></script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="{{ asset('light-bootstrap/js/plugins/bootstrap-switch.js') }}"></script>
    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!--  Chartist Plugin  -->
    <script src="{{ asset('light-bootstrap/js/plugins/chartist.min.js') }}"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('light-bootstrap/js/plugins/bootstrap-notify.js') }}"></script>
    <!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
    <script src="{{ asset('light-bootstrap/js/light-bootstrap-dashboard.js?v=2.0.0') }}" type="text/javascript"></script>
    <!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ asset('light-bootstrap/js/demo.js') }}"></script>
    @stack('js')
    <script>
      $(document).ready(function () {
        
        $('#facebook').sharrre({
          share: {
            facebook: true
          },
          enableHover: false,
          enableTracking: false,
          enableCounter: false,
          click: function(api, options) {
            api.simulateClick();
            api.openPopup('facebook');
          },
          template: '<i class="fab fa-facebook-f"></i> Facebook',
          url: 'https://light-bootstrap-dashboard-laravel.creative-tim.com/login'
        });

        $('#google').sharrre({
          share: {
            googlePlus: true
          },
          enableCounter: false,
          enableHover: false,
          enableTracking: true,
          click: function(api, options) {
            api.simulateClick();
            api.openPopup('googlePlus');
          },
          template: '<i class="fab fa-google-plus"></i> Google',
          url: 'https://light-bootstrap-dashboard-laravel.creative-tim.com/login'
        });

        $('#twitter').sharrre({
          share: {
            twitter: true
          },
          enableHover: false,
          enableTracking: false,
          enableCounter: false,
          buttons: {
            twitter: {
              via: 'CreativeTim'
            }
          },
          click: function(api, options) {
            api.simulateClick();
            api.openPopup('twitter');
          },
          template: '<i class="fab fa-twitter"></i> Twitter',
          url: 'https://light-bootstrap-dashboard-laravel.creative-tim.com/login'
        });
      });
    </script>
    <script>
    $(document).ready(function() {
      $("#addProducts").validate({
        rules: {
          title: {
            required: true,
            maxlength: 40,
          },
          brand_name:{
            required: true,
            maxlength: 40,
          },
          sku_number: {
            required: true,
            maxlength: 50
          },
          supplier_name: {
            required: true,
          },
          product_weight: {
            required: true,
          },
          description: {
            required: true,
          },
          product_weight: {
            required: true,
          },
          // main_image: {
          // 	required: true,
          // },
        },
        messages: {
          title: {
            required: "First Product name is required",
            maxlength: "First name cannot be more than 40 characters"
          },
          brand_name: {
            required: "Brand name is required",
            maxlength: "Brand name cannot be more than 40 characters"
          },
          sku_number: {
            required: "Sku Number is required",
            maxlength: "Email cannot be more than 50 characters",
          },
          supplier_name: {
            required: "Supplier Name number is required",
            minlength: "Phone number must be of 10 digits"
          },
          product_weight: {
            required: "Product Weight is required",
          },	
          description: {
            required: "Product Description is required",
          },
          // main_image: {
          // 	required: "Image Fiel is required",
          // }
        }
      });
    });


	// Change the ststus of the Product
    $('body').on('click','.product-status',function(){
		var productId = $(this).data('id');
		status = $(this).data('status');
		var statusHtml = $(this).parent();
		Swal.fire({
			title: 'Are you sure?',
			text: "You want to "+status,
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, '+status+ ' it!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: '/product/change_status/'+productId,
					method: 'GET',
					data: {"status":status},
					// headers: {
					// 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					// },
					success: function(data){
						let res = JSON.parse(data);
						if(res.status=='success'){
							statusHtml.html(" ");
							if(status=='active')
								statusHtml.append('<span class="badge badge-success product-status" data-id="'+productId+'" data-status="Inactive">active</span>');
							else
								statusHtml.append('<span class="badge badge-danger product-status" data-id="'+productId+'" data-status="active">Inative</span>');
							Swal.fire(
								'Success!',
								'Status Has been Changed',
								'success'
							);
						}
					},
				});
				
			}
		});
    });

	// Delete the Products
    $('body').on('click','.delete-product',function(){
		var productId = $(this).data('id');
		var data = $(this).closest('.delete-form').find('.submit-delete');
		Swal.fire({
			title: 'Are you sure?',
			text: "You want to Delete It?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				data.trigger('click');
			}
		});
    });
</script>
<style>
label.error {
    color: red;
}
</style>
</html>
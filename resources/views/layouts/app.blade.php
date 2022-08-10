<!DOCTYPE html>
<html>

<head>
	<title> @yield('title','Laravel Livewire') </title>

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

	<!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}"> -->

	<!--fontawsome -->

	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

	<!--Alertify css-->
	<!-- CSS -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
	<!--mycss-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}?ver=1.1">

	@livewireStyles
</head>

<body>


	{{$slot}}



	{{-- <div class="wrapper">

	@include('partial.nav')


	@include('partial.messages')

	
   @yield('content')



  	@include('partial.footer')

</div> --}}






	<!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
	<script src="{{asset('js/jquery-3.6.0.min.js')}}"> </script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
	<!--Alertify Js-->
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

	<script src="{{asset('js/myscript.js')}}"></script>

	{{--@yield('scripts')--}}

	@livewireScripts

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script type="text/javascript">
		window.addEventListener('show-delete-confirmation', event => {
			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.isConfirmed) {
					Livewire.emit('deleteConfirmed');
				}
			})
		})

		window.addEventListener('deleteAlert', event => {
			Swal.fire('Deleted', 'Deleted Successfully.', 'success');
		})
	</script>
</body>

</html>
<link rel="shortcut icon" href="{{ asset('assets/adminTemplate/assets/images/favicon.ico') }}">
<!--Chartist Chart CSS -->
<link rel="stylesheet" href="{{ asset('assets/adminTemplate/assets/plugins/chartist/css/chartist.min.css') }}">
<!-- App css -->
<link href="{{ asset('assets/adminTemplate/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/adminTemplate/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/adminTemplate/assets/css/metisMenu.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/adminTemplate/assets/css/style.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/adminTemplate/assets/css/main.css') }}" rel="stylesheet" type="text/css">
<!-- spinner loader -->
<link href="{{ asset('assets/adminTemplate/assets/css/spinner-loader.css') }}" rel="stylesheet" type="text/css">
@yield('style_custom')
<style media="screen">
	.size-icon {
		background-size: 20px 18px;
	}
	.rollto {
		position: fixed;
		right: calc((100% - 1010px) / 2 - 20px);
		bottom: 50%;
		z-index: 999;
	}
	.rollto a {
		background: #049ba7;
		color: #fff;
		border-radius: 2px;
		overflow: hidden;
		display: block;
		width: 36px;
		height: 36px;
		cursor: pointer;
		margin: 1px 0;
		opacity: 0.8;
	}
	.rollto a i {
		width: 36px;
		top: 0;
		margin: 0;
		padding: 5px 10px;
		cursor: pointer;
		font-size: 25px;
		color: #fff;
	}
	.rollto a:hover {
		background: #07b5c3;
		color: #fff;
	}
	.padding-side{
		padding-left: 15px;
	}
	/* Loader */

	.br-loader {
		border-radius: 8px;
	}
	.w80-loader {
		width: 80%;
	}
	.card-loader {
		border: 2px solid #fff;
		box-shadow:0px 0px 10px 0 #a9a9a9;
		padding: 30px 40px;
		width: 80%;
		margin: 50px auto;
	}
	.wrapper-loader {
		width: 0px;
		animation: fullView 0.5s forwards cubic-bezier(0.250, 0.460, 0.450, 0.940);
	}
	.comment-loader {
		height: 10px;
		background: #777;
		margin-top: 20px;
	}

	@keyframes fullView {
		100% {
			width: 100%;
		}
	}


  .animate-loader {
    animation: shimmer 2s infinite linear;
    background: linear-gradient(to right, #3b466b 4%, #3e4661 25%, #35406b 36%) !important;
    background-size: 1000px 100% !important;
}

	@keyframes shimmer {
		0% {
			background-position: -1000px 0;
		}
		100% {
			background-position: 1000px 0;
		}
	}
	/* End loader */
</style>

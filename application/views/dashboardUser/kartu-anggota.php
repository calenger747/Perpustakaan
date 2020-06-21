
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">
		body{
			background-color: #8BDFE2;
		}
		.profile-badge{
			border:1px solid #c1c1c1;
			padding:5px;
			position: relative;
		}
		.profile-badge img{
			height: 200px;
			width: 100%;
		}
		.user-detail{
			background-color: #fff;
			position: relative;
			padding:65px 0px 10px 0px;
			color:#8B8B89;
		}
		.user-detail h3, h4{
			margin: 0px;
			margin:0px 0px 5px 0px;
			color: #000;
		}
		.user-detail p{
			font-size:14px;
		}
		.user-detail .btn{
			margin-bottom:10px;
			background-color: #fff;
			border:1px solid #DEDEDE;
			border-radius: 0px;
			color:black;
		}
		.user-detail .btn i{
			color:#D35B4D;
			padding-right:18px;
		}
		.profile-pic{
			position: absolute;
			height:120px;
			width:120px;
			left: 50%;
			transform: translateX(-50%);
			top: 140px;
			z-index: 1001;
			background: url(../../../app-assets/assets/img/logo.svg);
		}
		.profile-pic img{
			height: 100%;
			width: 100%;
			border-radius: 50%;
			box-shadow: 0px 0px 5px 0px #c1c1c1;
		}
		.hover-detail{
			background-color: #fff;
			border:1px solid #7C7C7C;
			position: absolute;
			width: 200px;
			box-shadow: 0px 0px 6px 0px #7C7C7C; 
			display:none;
			top: 145px;
			left: 50%;
			transform: translateX(-50%);
		}
		.hover-detail:hover,
		.user-detail .btn:hover ~ .hover-detail{
			display: block;
		}
		.checkbox label{
			text-align: left;
			width: 100%;
		}
		.Following label{
			padding-bottom: 5px;
			border-bottom:1px solid #c2c2c2;
		}
		.checkbox label span{
			float:right;
		}
		.hover-detail{
			padding:5px;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-sm-6 col-xs-12 profile-badge">
				<img src="<?= base_url(); ?>app-assets/assets/img/01.jpg">
				<div class="profile-pic">
					<!-- <img src="/app-assets/assets/img/logo.svg"> -->
				</div>
				<div class="user-detail text-center">
					<h3>Kang Yogik</h3>
					<h4>Harvard University</h4>
					<p>Web Developer</p>
					<button class="btn btn-defualt"><i class="fa fa-google-plus" aria-hidden="true"></i> Follow</button><br>
					<div class="hover-detail">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12 checkbox Following">
								<label><input type="checkbox" value="">Following<span>8</span></label>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12 checkbox">
								<label><input type="checkbox" value="">Followers<span>120</span></label>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12 checkbox">
								<label><input type="checkbox" value="">Family<span>100</span></label>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12 checkbox">
								<label><input type="checkbox" value="">Friends<span>8</span></label>
							</div>
						</div>
					</div>
					<span>120K Followers</span>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
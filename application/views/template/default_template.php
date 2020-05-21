<!DOCTYPE html>
<html lang="en">
<head>
	<?= $page["meta"]; ?>
	<?= $page["head"]; ?>
</head>
<body class="sidebar-noneoverflow">
	<!-- BEGIN LOADER -->
	<div id="load_screen"> 
		<div class="loader"> 
			<div class="loader-content">
				<div class="spinner-grow align-self-center"></div>
			</div>
		</div>
	</div>
	<!--  END LOADER -->
	<?= $page["navbar"]; ?>
	<!--  BEGIN MAIN CONTAINER  -->
	<div class="main-container" id="container">
		<div class="overlay"></div>
		<div class="search-overlay"></div>
		<?= $page["sidebar"]; ?>
		<!--  BEGIN CONTENT AREA  -->
		<div id="content" class="main-content">
			<div class="layout-px-spacing">
				<?= $content; ?>
			</div>
			<?= $page["footer"]; ?>
		</div>
		<!--  END CONTENT AREA  -->
	</div>
	<!-- END MAIN CONTAINER -->
</body>
<?= $page["js"]; ?>
</html>
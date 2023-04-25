<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<?php include('header.php');
    include('connection.php');
?>

			<section id="breadcrumbs" class="breadcrumbs_section cs section_padding_25 gradient table_section table_section_md">
				<div class="container">
					<div class="row">
						<div class="col-md-6 text-center text-md-left">
							<h1 class="thin">Obavijesti</h1>
						</div>
						<div class="col-md-6 text-center text-md-right">
							<ol class="breadcrumb">
								<li>
									<a href="index.php">
										<span>
											<i class="rt-icon2-home"></i>
										</span>
									</a>
								</li>
								
								<li  class="active">Obavijesti</li>
							</ol>
						</div>
					</div>
				</div>
			</section>

			<section id="content" class="ls section_padding_top_100 section_padding_bottom_75">
				<div class="container">
					<div class="row">

						<div class="col-sm-12">

							<div id="isotope_container" class="isotope masonry-layout row">
    
    
                                <?php 
                                $sql = "SELECT * FROM obavijesti WHERE aktivan=1";
                                $result = $conn->query($sql);
                                
                                while($row = $result->fetch_assoc()){
                                ?>
								<article class="isotope-item col-lg-6 col-md-6 post format-standard">

									<div class="entry-thumbnail">

										<div class="entry-meta-corner">
											<span class="date">
												<time datetime="<?= $row['datum'] ?>" class="entry-date">
													<strong><?= explode('-', $row['datum'])[2] ?></strong>
													<?= explode('-', $row['datum'])[1] ?>
												</time>
											</span>

											
										</div>

										<img src="<?= $row['url'] ?>" alt="<?= $row['naslov'] ?>">
									</div>

									<div class="post-content">
										<div class="entry-content">
											<header class="entry-header">
												<h3 class="entry-title">
													<a href="vijest.php?id=<?= $row['obavijest_id'] ?>" rel="bookmark"><?= $row['naslov'] ?></a>
												</h3>
											</header>
											<!-- .entry-header -->

											<p><?= $row['kratki_tekst'] ?></p>


										</div>
										<!-- .entry-content -->

									</div>
									<!-- .post-content -->
								</article>
								
							    <?php }?>
								<!-- .post -->
							</div>
							<!-- eof #isotope_container -->

							<!--<ul class="pagination">-->
							<!--	<li>-->
							<!--		<a href="#">-->
							<!--			<i class="fa fa-angle-left"></i>-->
							<!--		</a>-->
							<!--	</li>-->
							<!--	<li class="active">-->
							<!--		<a href="#">1</a>-->
							<!--	</li>-->
							<!--	<li>-->
							<!--		<a href="#">2</a>-->
							<!--	</li>-->
							<!--	<li>-->
							<!--		<a href="#">3</a>-->
							<!--	</li>-->
							<!--	<li>-->
							<!--		<a href="#">4</a>-->
							<!--	</li>-->
							<!--	<li>-->
							<!--		<a href="#">5</a>-->
							<!--	</li>-->
							<!--	<li>-->
							<!--		<a href="#">-->
							<!--			<i class="fa fa-angle-right"></i>-->
							<!--		</a>-->
							<!--	</li>-->
							<!--</ul>-->


						</div>
						<!--eof .col-sm-8 (main content)-->

					</div>
				</div>
			</section>


			

			<?php include('footer.php'); ?>
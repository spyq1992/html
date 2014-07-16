<? $this->load->view('inc/header_view') ?>
<body>
<? $this->load->view('inc/nav_view') ?>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div id="myCarousel" class="carousel slide">
			  <ol class="carousel-indicators">
			    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			    <li data-target="#myCarousel" data-slide-to="1"></li>
			    <li data-target="#myCarousel" data-slide-to="2"></li>
			  </ol>
			  <!-- Carousel items -->
			  <div class="carousel-inner">
			    <div class="active item">
			    	<img src="<?=base_url('resource/images/carousel/bg1.jpg') ?>">
			    	<div class="carousel-caption">
                      <h4>聚会神器</h4>
                      <p>关注好友最新最炫酷的腐败动向！</p>
                    </div>
			    </div>
			    <div class="item">
			    	<img src="<?=base_url('resource/images/carousel/bg2.jpg') ?>">
			    	<div class="carousel-caption">
                      <h4>聚会神器</h4>
                      <p>最便捷发起一场惊天动地的聚会！</p>
                    </div>
			    </div>
			    <div class="item">
			    	<img src="<?=base_url('resource/images/carousel/bg3.jpg') ?>">
			    	<div class="carousel-caption">
                      <h4>聚会神器</h4>
                      <p>精确筛选最适合你的聚会场所！</p>
                    </div>
			    </div>
			  </div>
			  <!-- Carousel nav -->
			  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
			  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<div class="hero-unit info-block">
				<h3>
					甜蜜约会
				</h3>
				<p>
					找到最让Ta开心的地方！
				</p>
				<p>
					<a class="btn btn-success btn-large" href="<?=site_url('/social') ?>">走起 »</a>
				</p>
			</div>
		</div>
		<div class="span6">
			<div class="hero-unit info-block">
				<h3>
					基友聚会
				</h3>
				<p>
					最便捷发起一场惊天动地的聚会！
				</p>
				<p>
					<a class="btn btn-danger btn-large" href="#">走起 »</a>
				</p>
			</div>
		</div>
	</div>
</div>
</body>
<? $this->load->view('inc/footer_view') ?>
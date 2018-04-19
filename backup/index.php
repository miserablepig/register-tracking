<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
<title>ANGRY DROP - Premium HTML Template</title>
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
@-moz-document url-prefix()
{
.spec-border, .flickr {border: 1px solid #4c4f55 !important;}
.on-light .spec-border {border: 1px solid #dedede !important;}
}
</style>
<!--[if IE]>
<link href="css/ie.css" rel="stylesheet" type="text/css" />
<![endif]-->
<link href="css/colorpicker.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/nivo-default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript">var runFancy = true;</script>
<!--[if IE]>
<script type="text/javascript">
    runFancy = false;
</script>
<![endif]-->
<script type="text/javascript">
	if (runFancy) {
         jQuery.noConflict()(function($){
		 // On window load. This waits until images have loaded which is essential
		$(window).load(function(){
		// Fade in images so there isn't a color "pop" document load and then on window load
		$(".item img").fadeIn(500);
		// clone image
		$('.item img').each(function(){
		var el = $(this);
		el.css({"position":"absolute"}).wrap("<div class='img_wrapper' style='display: inline-block'>").clone().addClass('img_grayscale').css({"position":"absolute","z-index":"998","opacity":"0"}).insertBefore(el).queue(function(){
		var el = $(this);
		el.parent().css({"width":this.width,"height":this.height});
		el.dequeue();
		});
		this.src = grayscale(this.src);
		});
		// Fade image
		$('.item img').mouseover(function(){
		$(this).parent().find('img:first').stop().animate({opacity:1}, 1000);
		})
		$('.img_grayscale').mouseout(function(){
		$(this).stop().animate({opacity:0}, 1000);
		});
		});
		// Grayscale w canvas method
		function grayscale(src){
		var canvas = document.createElement('canvas');
		var ctx = canvas.getContext('2d');
		var imgObj = new Image();
		imgObj.src = src;
		canvas.width = imgObj.width;
		canvas.height = imgObj.height;
		ctx.drawImage(imgObj, 0, 0);
		var imgPixels = ctx.getImageData(0, 0, canvas.width, canvas.height);
		for(var y = 0; y < imgPixels.height; y++){
		for(var x = 0; x < imgPixels.width; x++){
		var i = (y * 4) * imgPixels.width + x * 4;
		var avg = (imgPixels.data[i] + imgPixels.data[i + 1] + imgPixels.data[i + 2]) / 3;
		imgPixels.data[i] = avg;
		imgPixels.data[i + 1] = avg;
		imgPixels.data[i + 2] = avg;
		}
		}
		ctx.putImageData(imgPixels, 0, 0, 0, 0, imgPixels.width, imgPixels.height);
		return canvas.toDataURL();
		}
		});
    }
</script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/tabs.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" src="js/slides.min.jquery.js"></script>
<script type="text/javascript" src="js/nivo-slider/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript" src="js/superfish-menu/hoverIntent.js"></script>
<script type="text/javascript" src="js/superfish-menu/superfish.js"></script>
<script type="text/javascript" src="js/scrolltop/scrolltopcontrol.js"></script>
<script type="text/javascript" src="js/prettyPhoto/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="js/jquery.featureList-1.0.0.js"></script>
<script type="text/javascript" src="js/swfobject/swfobject.js"></script>
<script type="text/javascript" src="js/easing/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/kwicks/jquery.kwicks-1.5.1.pack.js"></script>
<script type="text/javascript" src="js/mosaic/mosaic.1.0.1.js"></script>
<script type="text/javascript" src="js/jquery.tipsy.js"></script>
<script type="text/javascript">
	var sukablyadIE=false;
</script>
<!–[if IE]>
	<script type="text/javascript" src="js/DD_roundies_0.0.2a-min.js"></script>
    <script type="text/javascript">
        var sukablyadIE=true;
        DD_roundies.addRule('.spec-border-ie', '14px');
    </script>
<![endif]–>
<!--GOOGLE FONTS-->
<link href='http://fonts.googleapis.com/css?family=Shanti' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Mako' rel='stylesheet' type='text/css' />
<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Crimson+Text:regular,regularitalic,600,600italic,bold,bolditalic' type='text/css'/>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Terminal+Dosis+Light' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Crushed' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Puritan' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Anonymous+Pro' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=OFL+Sorts+Mill+Goudy+TT' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Nobile' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Molengo' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Allerta' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Metrophobic' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Francois+One' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Rokkitt' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Didact+Gothic' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=News+Cycle' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Special+Elite' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Kreon' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Radley' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Bentham' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css' />
<!--GOOGLE FONTS-->
<!-- DEMO ONLY -->
<script type="text/javascript" src="js/colorpicker.js"></script>
<script type="text/javascript" src="js/colorpicker-color.js"></script>
<script type="text/javascript" src="js/switcher/tabslide.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<!-- alternate css for colors -->
<script type="text/javascript" src="js/switcher/switchstylesheet1.js"></script>
<script type="text/javascript" src="js/switcher/switchstylesheet.js"></script>
</head>
<body>
	<!-- TOP LINE -->
	<div class="top-line">
    	<div class="top-wrapper">
        	<div class="three-fourth notopmargin">
                <div class="menu-left left"></div>
                <ul class="sf-menu left">
                    <li><a href="index.html" class="menu-active">Home</a>
                        <ul>
                            <li class="menu-first"></li>
                            <li><a class="menu-link" href="index.html">Default Homepage</a></li>
                            <li><a class="menu-link" href="index-1.html">Homepage Style II</a></li>
                        </ul>
                    </li>
                    <li><a class="menu-link" href="#">Features</a>
                        <ul>
                            <li class="menu-first"></li>
                            <li><a class="menu-link" href="index.html">Nivo Slider (Default)</a></li>
                            <li><a class="menu-link" href="homepage-accordian-slider.html">Accordian Slider</a></li>
                            <li><a class="menu-link" href="homepage-3d-slider.html">3D Slider</a></li>
                            <li><a class="menu-link" href="homepage-video-block.html">Video Block</a></li>
                            <li><a class="menu-link" href="homepage-grid.html">Grid Homepage</a></li>
                            <li class="menu-last"><a class="menu-link" href="homepage-static.html">Static Homepage</a></li>
                        </ul>
                    </li>
                    <li><a class="menu-link" href="#">Pages</a>
                        <ul>
                            <li class="menu-first"></li>
                            <li><a class="menu-link" href="typography.html">Typography</a>
                                <ul>
                                    <li class="menu-nextlevel-first"><a class="menu-link" href="headings.html">Headings</a></li>
                                    <li><a class="menu-link" href="blockquotes.html">Blockquotes</a></li>
                                    <li><a class="menu-link" href="dropcaps.html">Dropcaps</a></li>
                                    <li><a class="menu-link" href="highlight.html">Text Highlight</a></li>
                                    <li><a class="menu-link" href="column-layouts.html">Column Layouts</a></li>
                                    <li><a class="menu-link" href="pricing-tables.html">Pricing and Tables</a></li>
                                    <li><a class="menu-link" href="buttons.html">Buttons</a></li>
                                    <li class="menu-last"><a class="menu-link" href="icons.html">Icons</a></li>
                                </ul>
                            </li>
                            <li><a class="menu-link" href="">4 column Layout</a>
                                <ul>
                                    <li class="menu-nextlevel-first"><a class="menu-link" href="leftcont.html">Left + Content</a></li>
                                    <li><a class="menu-link" href="leftleftcont.html">Left + Left + Content</a></li>
                                    <li><a class="menu-link" href="contright.html">Content + Right</a></li>
                                    <li><a class="menu-link" href="contrightright.html">Content + Right + Right</a></li>
                                    <li><a class="menu-link" href="leftcontright.html">Left + Content + Right</a></li>
                                    <li class="menu-last"><a class="menu-link" href="fullwidh.html">Full Width</a></li>
                                </ul>
                            </li>
                            <li><a class="menu-link" href="about-us.html">About Us</a></li>
                            <li><a class="menu-link" href="news.html">News Archive</a></li>
                            <li><a class="menu-link" href="services.html">Our Services</a></li>
                            <li><a class="menu-link" href="our-team.html">Our Team</a></li>
                            <li><a class="menu-link" href="testimonials.html">Clients Testimonials</a></li>
                            <li><a class="menu-link" href="jobs.html">Career and Job</a></li>
                            <li><a class="menu-link" href="faq.html">F.A.Q</a></li>
                            <li class="menu-last"><a class="menu-link" href="404.html">404 Error</a></li>
                        </ul>
                    </li>
                    <li><a class="menu-link" href="#">Portfolio</a>
                        <ul>
                            <li class="menu-first"></li>
                            <li><a class="menu-link" href="1-column-portfolio.html">1 Column Portfolio</a></li>
                            <li><a class="menu-link" href="2-column-portfolio.html">2 Columns Portfolio</a></li>
                            <li><a class="menu-link" href="3-column-portfolio.html">3 Columns Portfolio</a></li>
                            <li><a class="menu-link" href="4-column-portfolio.html">4 Columns Portfolio</a></li>
                            <li><a class="menu-link" href="portfolio-with-sidebar.html">Portfolio With Sidebar</a></li>
                            <li><a class="menu-link" href="gallery.html">Gallery</a></li>
                            <li class="menu-last"><a class="menu-link" href="portfolio-details.html">Portfolio Details</a></li>
                        </ul>
                    </li>
                    <li><a class="menu-link" href="#">Blog</a>
                        <ul>
                            <li class="menu-first"></li>
                            <li><a class="menu-link" href="blog.html">Blog</a></li>
                            <li><a class="menu-link" href="blog-2.html">Blog Style II</a></li>
                            <li class="menu-last"><a class="menu-link" href="blog-post.html">Blog Post</a></li>
                        </ul>
                    </li>
                    <li><a class="menu-link" href="contact-us.html">Contact us</a></li>		
                </ul>
                <div class="menu-right left"></div>
            </div>
        	<div class="one-fourth last notopmargin">
                <div class="drible-icon right last">
                    <a href="index.html" id='drible' title='Dribbble'><img src="images/1px.png" alt="" width="33px" height="32px" /></a>
                </div>
                <div class="facebook-icon right">
                    <a href="index.html" id='facebook' title='Facebook'><img src="images/1px.png" alt="" width="33px" height="32px" /></a>
                </div>
                <div class="vimeo-icon right">
                    <a href="index.html" id='vimeo' title='Vimeo'><img src="images/1px.png" alt="" width="33px" height="32px" /></a>
                </div>
                <div class="tweet-icon right">
                    <a href="index.html" id='twitter' title='Twitter'><img src="images/1px.png" alt="" width="33px" height="32px" /></a>
                </div>
            </div>
        </div>
    </div>
    <!-- END TOP LINE -->
    <div class="wrapper">
    	<div class="one-half logo">
        	<a href="" title=""><img src="images/logol.png" alt="Angry Drop" /></a>
        </div>
        <div class="one-half slogan-area last">
        	<h1 class="uppercase">Premium HTMl Template</h1>
        </div>
        <!-- SLIDER -->
        <div class="one slider-area slider-bg">
        	<div class="theme-default">
                <div id="slider" class="nivoSlider">
                    <img src="images/slide-1.jpg" alt="" />
                    <a href=""><img src="images/slide-2.jpg" alt="" title="This is an example of a caption" /></a>
                    <img src="images/slide-3.jpg" alt="" />
                    <img src="images/slide-4.jpg" alt="" title="#htmlcaption" />
                </div>
                <div id="htmlcaption" class="nivo-html-caption">
                    <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>.
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <!-- END SLIDER -->
    <!-- MAIN CONTENT -->
	<div class="wrapper on-light">
    	<div class="separator margin30"></div>
        <h2 class="text-align-center margin20">I'm Happy To Announce New Premium HTML / CSS  Template "<a class="link dark" href="index.html">ANGRY DROP</a>"</h2>
        <h3 class="text-align-center italic gray">Please feel free to browse, enjoy and please leave comments</h3>
        <div class="clear separator margin20 nobottommargin"></div>
		<div class="one notopmargin">
        	<div class="two-third margin30">
            	<div class="two-third notopmargin last">
                    <h2>Our services</h2>
                    <p class="italic">Vivamus volutpat euismod ullamcorper. Mauris quam tortor, convallis eu tincidunt in, vestibulum nec dui. Nulla ullamcorper, neque et sodales eleifend, orci quam convallis erat, vitae porttitor.</p>
                </div>
                <div class="one-third margin10 service-left">
                    <div class="service-title">
                        <div class="big-rounded-icon-white left margin15">
                            <div class="icon-white-big icon95-white"></div>
                        </div>
                        <h3 class="left"><a href="index.html" class="service-tipsy north" title='Web sites from 999.99$'>Internet marketing</a></h3>
                    </div>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Sed non metus a sapien pellentesque auctor.</p>
            		<a class="button_readmore"  href="">Read more</a>
                </div>
                <div class="one-third margin10 last service-right">
                    <div class="service-title">
                        <div class="big-rounded-icon-white left margin15">
                            <div class="icon-white-big icon74-white"></div>
                        </div>
                        <h3 class="left"><a href="index.html" class="service-tipsy north" title='Save an extra $99'>Moving services</a></h3>
                    </div>
                    <p>Nulla sit amet venenatis tortor. Sed non metus a sapien pellentesque auctor. Sed ut augue non justo porta sagittis.</p>
            		<a class="button_readmore"  href="">Read more</a>
                </div>
                <div class="two-third margin20 dot-separator last"></div>
                <div class="one-third margin10 service-left">
                    <div class="service-title">
                        <div class="big-rounded-icon-white left margin15">
                            <div class="icon-white-big icon44-white"></div>
                        </div>
                        <h3 class="left"><a href="index.html" class="service-tipsy north" title='Another awesome title'>Pure programming</a></h3>
                    </div>
                    <p>Ed porta lectus eget purus sodales tincidunt. Mauris faucibus tincidunt urna eu porttitor. Vestibulum aliquet, nisi id.</p>
            		<a class="button_readmore"  href="">Read more</a>
                </div>
                <div class="one-third margin10 last service-right">
                    <div class="service-title">
                        <div class="big-rounded-icon-white left margin15">
                            <div class="icon-white-big icon208-white"></div>
                        </div>
                        <h3 class="left"><a href="index.html" class="service-tipsy north" title='Simply dummy text'>Walls painting</a></h3>
                    </div>
                    <p>Nulla ullamcorper, neque et sodales eleifend, orci quam convallis erat, vitae porttitor lectus turpis auctor mauris.</p>
            		<a class="button_readmore"  href="">Read more</a>
                </div>
            </div>
            <div class="one-third spec-offer margin30 last item">
            <h2>Curent special offer</h2>
                <a href="images/slide-1-1.jpg" class="item-preview spec-border-ie margin15" rel="prettyPhoto" title=""><img class="img-preview spec-border"  src="images/gallery/spec.png" alt=" "/></a>
                <h3>HTML5 & jQuery Grayscale</h3>
                <p>Contrary to popular belief, Lorem Ipsum is not simply random text.</p>
                <a class="button_readmore"  href="">Read more</a>
            </div>
        </div>
  		<div class="one separator"></div>
        <div class="one margin30">
        	<div class="one-third notopmargin">
            	<h2>Recent projects</h2>
                <p>Nulla ullamcorper, neque et sodales eleifend, orci quam convallis erat, vitae porttitor lectus turpis auctor mauris.<br/><br/><span class="small-italic">Sed sit amet nulla et ligula consequat vestibulum in et diam, nascetur ridiculus mus.</span></p>
            	<a class="button_readmore"  href="">View the Portfolio</a>
            </div>
            <div class="two-third notopmargin last">
            	<div id="slides">
                    <div class="slides_container">
                    	<div class="two-third notopmargin last">
                            <div class="one-third notopmargin item">
                                <div><a href="images/slide-1-1.jpg" class="item-preview spec-border-ie" rel="prettyPhoto" title=""><img class="img-preview spec-border"  src="images/gallery/3col-3.png" alt=" "/></a></div>
                                <h3><a href="index.html">Some project name</a></h3>
                                <p class="notopmargin">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                <a class="button_readmore"  href="">Read more</a>
                            </div>
                            <div class="one-third notopmargin item last">
                                <div><a href="images/slide-1-1.jpg" class="item-preview spec-border-ie" rel="prettyPhoto" title=""><img class="img-preview spec-border"  src="images/gallery/3col-2.png" alt=" "/></a></div>
                                <h3><a href="index.html">Awesome work</a></h3>
                                <p class="notopmargin">Sed sit amet nulla et ligula consequat vestibulum in et diam, nascetur ridiculus mus.</p>
                                <a class="button_readmore"  href="">Read more</a>
                            </div>
                            <div class="two-third margin20 dot-separator last"></div>
                        </div>
                    	<div class="two-third notopmargin last">
                        	<div class="two notopmargin item">
                                <div><a href="images/slide-1-1.jpg" class="item-preview spec-border-ie" rel="prettyPhoto" title=""><img class="img-preview spec-border"  src="images/gallery/blog-2.png" alt=" "/></a></div>
                                <h3><a href="index.html">Some project name</a></h3>
                                <p class="notopmargin">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Ed porta lectus eget purus sodales tincidunt. Mauris faucibus tincidunt urna eu porttitor. Vestibulum aliquet, nisi id.</p>
                                <a class="button_readmore"  href="">Read more</a>
                            </div>
                            <div class="two-third margin20 dot-separator last"></div>
                        </div>
                        <div class="two-third notopmargin last">
                            <div class="one-third notopmargin item">
                                <div><a href="images/slide-1-1.jpg" class="item-preview spec-border-ie" rel="prettyPhoto" title=""><img class="img-preview spec-border"  src="images/gallery/3col-1.png" alt=" "/></a></div>
                                <h3><a href="index.html">Some project name</a></h3>
                                <p class="notopmargin">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                <a class="button_readmore"  href="">Read more</a>
                            </div>
                            <div class="one-third notopmargin item last">
                                <div><a href="images/slide-1-1.jpg" class="item-preview spec-border-ie" rel="prettyPhoto" title=""><img class="img-preview spec-border"  src="images/gallery/3col-4.png" alt=" "/></a></div>
                                <h3><a href="index.html">Awesome work</a></h3>
                                <p class="notopmargin">Sed sit amet nulla et ligula consequat vestibulum in et diam, nascetur ridiculus mus.</p>
                                <a class="button_readmore"  href="">Read more</a>
                            </div>
                            <div class="two-third margin20 dot-separator last"></div>
                        </div>
                        <div class="two-third notopmargin last">
                        	<div class="two notopmargin item">
                                <div><a href="images/slide-1-1.jpg" class="item-preview spec-border-ie" rel="prettyPhoto" title=""><img class="img-preview spec-border"  src="images/gallery/blog-1.png" alt=" "/></a></div>
                                <h3><a href="index.html">Some project name</a></h3>
                                <p class="notopmargin">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Ed porta lectus eget purus sodales tincidunt. Mauris faucibus tincidunt urna eu porttitor. Vestibulum aliquet, nisi id.</p>
                                <a class="button_readmore"  href="">Read more</a>
                            </div>
                            <div class="two-third margin20 dot-separator last"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <!-- END MAIN CONTENT -->
    <!-- FOOTER -->
    <div class="footer-top">
    	<div class="wrapper">
        	<div class="one notopmargin">
            	<div class="footer-ribbon left"></div>
                <p class="ondark">Check out this great #themeforest item "<a class="link light" href="index.html">QARK Modern - HTML Template http://themeforest.net/item/qark-modern-html-template/434749</a>"</p>
            	<span class="dark-text italic">// <a class="link light" href="index.html">28 minutes ago</a>. By <a class="link light" href="index.html">OrangeIdea</a></span>
			</div>
        </div>
    </div>
    <div class="footer-cont">
    	<div class="wrapper ondark">
        	<div class="one notopmargin">
            	<div class="one-third margin20 left sidebar1-3-left">
                	<h5 class="light">Fresh from blog</h5>
                    <div class="small-round-icon-white left margin15">
                        <div class="icon-white-small icon33-white"><a href="index.html"><img src="images/1px.png" alt="" width="24px" height="24px" /></a></div>
                    </div>
                    <h6><a class="link light" href="index.html">Some Blog Post Title</a></h6>
                    <div class="footer-blog left margin10">
                    	<p>Nulla suscipit fringilla sapien id pretium. Integer sed nisi ac eros facilisis molestie.</p>
                    	<a class="button_readmore"  href="">Read more</a>
                    </div>
                </div>
                <div class="one-third margin20 left">
                    <h5 class="notopmargin light">Our Photostream</h5>
                	<div class="flickr item left"><a class="" href=""><img src="images/gallery/flickr-1.png" alt="" /></a></div>
                	<div class="flickr item left"><a class="" href=""><img src="images/gallery/flickr-2.png" alt="" /></a></div>
                    <div class="flickr item left"><a class="" href=""><img src="images/gallery/flickr-3.png" alt="" /></a></div>
                    <div class="flickr item left"><a class="" href=""><img src="images/gallery/flickr-4.png" alt="" /></a></div>
                    <div class="flickr item left last"><a class="" href=""><img src="images/gallery/flickr-5.png" alt="" /></a></div>
                    <div class="flickr item left"><a class="" href=""><img src="images/gallery/flickr-6.png" alt="" /></a></div>
                    <div class="flickr item left"><a class="" href=""><img src="images/gallery/flickr-7.png" alt="" /></a></div>
                    <div class="flickr item left"><a class="" href=""><img src="images/gallery/flickr-8.png" alt="" /></a></div>
					<div class="flickr item left"><a class="" href=""><img src="images/gallery/flickr-9.png" alt="" /></a></div>
                	<div class="flickr item left"><a class="" href=""><img src="images/gallery/flickr-10.png" alt="" /></a></div>
                </div>
                <div class="one-third margin20 last sidebar1-3">
                	<h5 class="notopmargin light">Contact info</h5>
                    <div class="margin15">
                        <p class="light">123456 Street Name, Los Angeles<br/>Phone: (1800) 765-4321</p>
                        <p class="small-italic">Contrary to popular belief, Lorem Ipsum is not simply random text. Nulla suscipit fringilla sapien.</p>
                	</div>
                </div>
            </div>	
        </div>
    </div>
    <div class="footer-sep"></div>
    <div class="footer-bottom">
    	<div class="wrapper ondark">
        	<div class="one notopmargin">
            	<div class="one-third margin20">
                    <p>© Copyright 2011 "ANGRY DROP". By <a class="link" href="http://themeforest.net/user/OrangeIdea/portfolio" target="_blank">OrangeIdea</a></p>
                </div>
                <div class="two-third margin20 last">
                	<p class="right"><a class="link" href="">Home</a> / <a class="link" href="">Features</a> / <a class="link" href="">Pages</a> / <a class="link" href="">Portfolio</a> / <a class="link" href="">Blog</a> / <a class="link" href="">Contact us</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-line"></div>
    <div class="clear"></div>
	<!-- END FOOTER -->
    <!-- DEMO ONLY -->
    <div class="slide-out-div">
        <a class="handle" href="#">Content</a>
        <h3 class="clear"><span>COLORS:</span></h3>
        <div class="separator margin10"></div>
        <div class="margin10" id="colorpicker" style="text-shadow:none">ICONS</div>
        <div class="separator margin10"></div>
        <div class="margin15">
            <h3 class="clear"><span>Headers:</span></h3>
            <select name="headings-font" id="headings-font">
            <option value="Allerta">Allerta</option>
            <option value="Josefin Sans">Josefin Sans</option>
            <option value="Molengo">Molengo</option>
            <option value="Special Elite">Special Elite</option>
            <option value="Nobile" selected='selected'>Nobile</option>
            <option value="Radley">Radley</option>
            <option value="Anonymous Pro">Anonymous Pro</option>
            <option value="Vollkorn">Vollkorn</option>
            <option value="Oswald" selected='selected'>Oswald</option>
            <option value="Yanone Kaffeesatz">Yanone Kaffeesatz</option>
            <option value="News Cycle">News Cycle</option>
            <option value="Kreon">Kreon</option>
            <option value="Bentham">Bentham</option>
            <option value="Orbitron">Orbitron</option>
            <option value="Puritan">Puritan</option>
            <option value="Terminal Dosis Light">Terminal Dosis Light</option>
            <option value="Crushed">Crushed</option>
            <option value="Pacifico">Pacifico</option>
            <option value="Francois One">Francois One</option>
            <option value="Play">Play</option>
            <option value="Shanti">Shanti</option>
            <option value="Metrophobic">Metrophobic</option>
            <option value="Rokkitt">Rokkitt</option>
            <option value="Mako">Mako</option>
            <option value="Didact Gothic">Didact Gothic</option>
            <option value="Ubuntu">Ubuntu</option>
            <option value="Arial">Arial</option>
            <option value="verdana">Verdana</option>
            <option value="Droid Sans">Droid Sans</option>
            <option value="Crimson Text">Crimson Text</option>
        </select>
        </div>
        <div class="margin15">
            <h3 class="clear"><span>Body:</span></h3>
            <select name="body-font" id="body-font">
            <option value="Allerta">Allerta</option>
            <option value="Josefin Sans">Josefin Sans</option>
            <option value="Molengo">Molengo</option>
            <option value="Special Elite">Special Elite</option>
            <option value="Nobile">Nobile</option>
            <option value="Radley">Radley</option>
            <option value="Anonymous Pro">Anonymous Pro</option>
            <option value="Vollkorn">Vollkorn</option>
            <option value="Oswald">Oswald</option>
            <option value="Yanone Kaffeesatz">Yanone Kaffeesatz</option>
            <option value="News Cycle">News Cycle</option>
            <option value="Kreon">Kreon</option>
            <option value="Bentham">Bentham</option>
            <option value="Orbitron">Orbitron</option>
            <option value="Puritan">Puritan</option>
            <option value="Terminal Dosis Light">Terminal Dosis Light</option>
            <option value="Crushed">Crushed</option>
            <option value="Pacifico">Pacifico</option>
            <option value="Francois One">Francois One</option>
            <option value="Play">Play</option>
            <option value="Shanti">Shanti</option>
            <option value="Metrophobic">Metrophobic</option>
            <option value="Rokkitt">Rokkitt</option>
            <option value="Mako">Mako</option>
            <option value="Didact Gothic">Didact Gothic</option>
            <option value="Ubuntu">Ubuntu</option>
            <option value="Arial" selected='selected'>Arial</option>
            <option value="verdana">Verdana</option>
            <option value="Droid Sans">Droid Sans</option>
            <option value="Crimson Text">Crimson Text</option>
        </select>
        </div>
        <div class="margin15">
            <h3 class="clear"><span>patterns:</span></h3>
            <a rel="1px" class="pattern-box" href=""></a>
            <a rel="body-bg-1" class="pattern-box" href=""></a>
            <a rel="1w" class="pattern-box white" href=""></a>
            <a rel="2w" class="pattern-box white" href=""></a>
            <a rel="3w" class="pattern-box white" href=""></a>
            <a rel="4w" class="pattern-box white" href=""></a>
            <a rel="5w" class="pattern-box white" href=""></a>
            <a rel="6w" class="pattern-box white" href=""></a>
            <a rel="7w" class="pattern-box white" href=""></a>
            <a rel="8w" class="pattern-box white" href=""></a>
            <a rel="9w" class="pattern-box white" href=""></a>
            <a rel="10w" class="pattern-box white" href=""></a>
            <a rel="12w" class="pattern-box white" href=""></a>
            <a rel="13w" class="pattern-box white" href=""></a>
            <a rel="14w" class="pattern-box white" href=""></a>
            <a rel="15w" class="pattern-box white" href=""></a>
            <a rel="16w" class="pattern-box white" href=""></a>
            <a rel="17w" class="pattern-box white" href=""></a>
            <a rel="18w" class="pattern-box white" href=""></a>
            <a rel="19w" class="pattern-box white" href=""></a>
            </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-30641321-1']);
  _gaq.push(['_setDomainName', 'orange-idea.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>
<?php
/**
 * Read RSS Feed
 * @param string $lang
 */
function getFeed($lang = '') {  
	$url = 'http://libyanspider.com/arabic/m/kbrrs.php';
	if ($lang != '') {
		$url .= '?lang=' . $lang;
	}
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 0);
    $content = curl_exec($curl);
    curl_close($curl);
    //echo $content;
#    $x = new SimpleXmlElement($content);  
    $rtVal = "";  
    foreach($x->channel->item as $entry) {  
        $rtVal .= "<li><a href='$entry->link' title='$entry->title'>" . $entry->title . "</a></li>";  
    }  
    return $rtVal;
} 
?><!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title><?php echo $_SERVER['SERVER_NAME']; ?></title>
	<meta name="description" content="">
	<meta name="author" content="LibyanSpider.com">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="style.css">
	<!--script src="js/modernizr-2.5.0.min.js"></script-->
	<script type="text/javascript">
	function activateLang(lang){
	
		document.getElementById('wrapper-en').style.display='none';
		document.getElementById('wrapper-ar').style.display='none';
	
		document.getElementById('wrapper-'+lang).style.display='';
	
	}
	function toggleLanguage(matchClass) {
		//console.log('toggle');
		var elems = document.getElementsByTagName('*'), i;
		var showClass, hideClass;
		
		if (matchClass == 'en-content') {
            showClass = 'en-content';
			hideClass = 'ar-content';
        } else {
			showClass = 'ar-content';
			hideClass = 'en-content';
		}
		
		for (i in elems) {
			if((' ' + elems[i].className + ' ').indexOf(' ' + hideClass + ' ')
					> -1) {
				elems[i].style.display = 'none';
			}
			if((' ' + elems[i].className + ' ').indexOf(' ' + showClass + ' ')
					> -1) {
				elems[i].style.display = '';
			}
		}
		
		/*if (matchClass == 'en-content') {
            document.getElementById('en-link').style.display = 'none';
			document.getElementById('ar-link').style.display = '';
        } else {
			document.getElementById('en-link').style.display = '';
			document.getElementById('ar-link').style.display = 'none';
		}*/
	}
</script>
</head>
<body onload="toggleLanguage('ar-content')">
	<header>
		<a href="" class="logo"><img src="images/logo.png"></a>
		<a href="#" onclick="toggleLanguage('ar-content')" class="en-content sw-lang arabic rtl">عربي</a>
		<a href="#" onclick="toggleLanguage('en-content')" class="ar-content sw-lang arabic rtl">English</a>
	</header>
	
	<div class="subheader en-content">
		<div class="message">
			<span>Congratulation</span>
			<h4>your website <?php echo $_SERVER['SERVER_NAME']; ?> is active</h5>
		</div>
	</div>
	<div class="content en-content">
		<p>
			This is the default webhosting page, to replace this page with your website, please upload your files via cPanel (File Manager) or any ftp software. Libyan Spider recommends FileZilla, <a href="http://filezilla-project.org/download.php">you can download it from here</a>, also check our tutorial for <a href="https://help.libyanspider.com/kb-article/connect-to-my-website-using-ftp/">How to upload your website via FileZilla?</a>
		</p>
		<div class="knowledge-base en-content">
			<h1>Knowledge base</h1>
			<p>
				The knowledgebase is organized into different categories to help you use our services. Either choose an article from below or click "more tutorials" to view all articles.
			</p>
			<ul>
				<?php echo getFeed('en'); ?>
			</ul>

			<p></p>
			<a href="https://help.libyanspider.com/" class="button">more tutorials</a>		
			<p class="last">
				Your website hosted by <a href="http://libyanspider.com">Libyan Spider, LLC</a> if you need any help please conatct our support department.
			</p>
			
	
		</div>
		<div class="contact en-content">
			<h1>Contact</h1>
			<h2>Address</h2>
			<p>Bab Ben Ghashir, P.O.Box: 82510 - Tripoli, Libya</p>
			<dl>
				<dt>Tel:</dt>
				<dd>+218 21 363 1322</dd>
			</dl>
			<dl>
				<dt>Tel:</dt>
				<dd>+218 21 363 1256</dd>
			</dl>
			<dl>
				<dt>Fax:</dt>
				<dd>+218 21 361 6336</dd>
			</dl>
			<h2 class="support-title">Email Support / Sales by submitting a ticket</h2>
			<p>If you can't find a solution to your problems in our knowledgebase, you can submit a ticket by selecting the appropriate department below.</p>
			<dl class="support">
				<dt>Sales:</dt>
				<dd><img src="images/b_sa.jpg"></dd>
			</dl>
			<dl class="support">
				<dt>Support:</dt>
				<dd><img src="images/b_su.jpg"></dd>
			</dl>
			<dl class="support">
				<dt>Web Design:</dt>
				<dd><img src="images/b_we.jpg"></dd>
			</dl>

			<ul class="follow-us">
				<li><span>Follow us</span></li>
				<li><a href="https://www.facebook.com/libyanspider.ly" class="facebook">Facebook</a></li>
				<li><a href="https://twitter.com/libyanspider" class="twitter">Twitter</a></li>
				<li><a href="http://libyanspider.com/feed/" class="rss">RSS</a></li>
			</ul>	
		</div>		
	</div>
	<footer class="en-content">
		<!--ul>
			<li><a href=""><img src="images/footer-direcotry.png"></a></li>
			<li class="job"><a href=""><img src="images/footer-job.png"></a></li>
			<li><a href=""><img src="images/footer-domains.png"></a></li>
		</ul-->
	</footer>
	
	<!-- Arabic Content -->
	<div class="subheader ar-content">
		<div class="message">
			<span>تهانينا</span>
			<h4>لقد تم تفعيل الموقع <?php echo $_SERVER['SERVER_NAME']; ?></h5>
		</div>
	</div>
	<div class="content ar-content">
		<p>
			هذه هي الصفحة الافتراضية لإستضافة المواقع، لاستبدال هذه الصفحة ورفع موقعك، يمكنك استخدام (مدير الملفات) من لوحة التحكم، أو أي برنامج رفع ملفات. شركة العنكبوت الليبي تنصح باستخدام برنامج فايل زيلا، ويمكنك <a href="http://filezilla-project.org/download.php">تحميله من هنا</a>، ولطريقة الاستخدام يرجى <a href="http://libyanspider.com/ar/knowledgebase/client-filezilla/">زيارة هذا الرابط</a>
		</p>
		<div class="knowledge-base">
			<h1>
أسئلة وأجوبة</h1>
			<p>
				قسم الأسئلة و الأجوبة مصنف إلى عدة أقسام لمساعدتك على استخدام خدماتنا، اختر احد الأسئلة التالية أو اضغط على "المزيد من الأسئلة والأجوبة" لعرض كل الأسئلة. 
			</p>
			<ul class="rtl">
				<?php echo getFeed(); ?>
			</ul>	
			<p></p>
			<a href="https://help.libyanspider.com/ar/" class="button">المزيد من الأسئلة والأجوبة</a>

			<p class="last">
				موقعكم مستضاف لدى <a href="http://libyanspider.com">شركة العنكبوت الليبي</a>، لطلب المساعدة يرجى الاتصال بقسم الدعم الفني.
			</p>
			
	
		</div>
		<div class="contact ar-content">
			<h1>اتصل بنا</h1>
			<h2>العنوان</h2>
			<p>باب بن غشير ، ص.ب 82510 طرابلس - ليبيا</p>
			<dl>
				<dt>هاتف:</dt>
				<dd>+218 21 363 1322</dd>
			</dl>
			<dl>
				<dt>هاتف:</dt>
				<dd>+218 21 363 1256</dd>
			</dl>
			<dl>
				<dt>فاكس:</dt>
				<dd>+218 21 361 6336</dd>
			</dl>
			<h2 class="support-title">لاستفساراتكم</h2>
			<p>إذا لم تتمكن من الحصول على إجابة لاستفساراتك في قسم الأسئلة والأجوبة يمكنك اختيار أحد الأقسام التالية لارسال استفساراتك</p>
			<dl class="support">
				<dt>المبيعات:</dt>
				<dd><img src="images/b_sa.jpg"></dd>
			</dl>
			<dl class="support">
				<dt>الدعم الفني:</dt>
				<dd><img src="images/b_su.jpg"></dd>
			</dl>
			<dl class="support">
				<dt>تصميم المواقع:</dt>
				<dd><img src="images/b_we.jpg"></dd>
			</dl>

			<ul class="follow-us">
				<li><span>Follow us</span></li>
				<li><a href="https://www.facebook.com/libyanspider.ly" class="facebook">Facebook</a></li>
				<li><a href="https://twitter.com/libyanspider" class="twitter">Twitter</a></li>
				<li><a href="http://libyanspider.com/ar/feed/" class="rss">RSS</a></li>
			</ul>	
		</div>		
	</div>
	<footer class="ar-content">
		<!--ul>
			<li><a href=""><img src="images/footer-direcotry.png"></a></li>
			<li class="job"><a href=""><img src="images/footer-job.png"></a></li>
			<li><a href=""><img src="images/footer-domains.png"></a></li>
		</ul-->
	</footer>
	<!-- JavaScript at the bottom for fast page loading -->
	<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
	<!--script src="js/jquery-1.7.1.min.js"></script-->
	<!--[if lt IE 7 ]>
		<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
		<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
	<![endif]-->
</body>
</html>
<?php

$input_lines = '
<!DOCTYPE html>
<html lang="pl">
<head>
<title>Synonimy słowa "obrotowy"</title>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<meta name="robots" content="index, follow">
<meta name="apple-itunes-app" content="app-id=543136651">
<m"all"/>
<link rel="stylesheet" type="text/css" href="/s/css/style.c11e2d4948a0.css" media="all"/>
<link rel="icon" type="image/png" href="/s/images/favicon.da73c7ff85c0.png"/>
<script type="text/javascript" src="/s/jquery/js/jquery-1.8.2.min.cfa9051cc0b0.js"></script>
<script type="text/javascript" src="/s/jqueryui/js/jquery-ui-1.8.23.custom.min.4e95f736ba4e.js"></script>
<script type="text/javascript" src="/s/jquery/js/spin.min.40b401681f25.js"></script>
<script type="text/javascript" src="/s/jquery/js/jquery.spin.ee12c0db4661.js"></script>
<script type="text/javascript" src="/s/custom/js/search.45653d0e5c9c.js"></script>
<script type="text/javascript" src="/s/custom/js/register.a93f98113163.js"></script>
<script type="text/javascript" src="/s/jquery/js/jquery.validate.min.4558baefe235.js"></script>
<script type="text/javascript" src="/s/custom/js/validation.57c65f71d0c7.js"></script>
<script>
        function cookie_info(a) {
            if (a > 0) {
         =
            }
        }


<header class="top">
<div class="container">
<h1 class="brand"><a href="/">Synonimy.pl</a></h1>
<nav class="main-nav">
<ul>
<li><a href="/" class="home">Strona główna</a></li>
<li><a href="/o-slowniku/">O
słowniku</a></li>
<li class="selected"><a class="double-line" href="/szukaj/">Szukaj
synonimów</a></li>
<li><a href="/skroty/">Skróty i symbole</a></li>
<li><a class="double-line" href="/slownik-papierowy/">Wydanie
książkowe</a></li>
</ul>
</nav>
</div> 
</header>

<div class="term">
<dl>
<dt>Synonimy do słowa obrotowy
<small><i></i></small>
</dt>
<dd class="last">1.
<span><small><i></i></small>
<a class="load_word" href="/synonim/rotacyjny/">rotacyjny</a>
, </span><span><small><i></i></small>
<a class="load_word" href="/synonim/wirowy/">wirowy</a>
, </span><span><small><i></i></small>
<a class="load_word" href="/synonim/kr%C4%99cony/">kręcony</a></span></dd>
</dl>
</div>
<div class="ads-wrap">
 

<noscript>
<a href="http://diff3.smartadserver.com/call/pubjumpi/75652/561587/6642/S/[timestamp]/?" target="_blank">
<img src="http://diff3.smartadserver.com/call/pubi/75652/561587/6642/S/[timestamp]/?" border="0" alt=""/></a>
</noscript>
</div>
</div>
</div> 
 
</div>
</div>
</section>
<footer id="footer">
<div class="container">
<div id="foot-left-side">
<a href="" class="small-logo">Synonimy.pl</a>
<p>Wszelkie prawa zastrzeżone. <a href="/contact/">Skontaktuj się</a> z nami w celu
uzyskania informacji</p>
</div> 
<div id="foot-right-side">
<span>Projekt i wykonanie</span>
<a href="https://www.futuremind.com/" target="_blank">Futuremind</a>
</div> 
<div class="clearfix"></div>
<div class="social-items">
<span>Odwiedź nas na:</span>
<a href="https://plus.google.com/+SynonimyPlabc/about" target="_blank"><i class="googleP-link"></i></a>
</div>
</div> 
</footer> 


</body>
</html>
';

// nazwa | URI | data dostępu

preg_match_all("/<a class=\"load_word\"[\W|\w]*\/\">([\W|\w]*)<\/a>/sU", $input_lines, $output_array);

for($i=0; $i < 3; $i++)
	echo $output_array[1][$i].'<br />'; 

?>
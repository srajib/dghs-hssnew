<html >
    <head>
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
         
     
    <!-- / fim dos arquivos utilizados pelo jQuery lightBox plugin -->
    <script type="text/javascript" src="lightBox/js/jquery.js"></script>
    <script type="text/javascript" src="lightBox/js/jquery.lightbox-0.5.js"></script>
   
    <link rel="stylesheet" type="text/css" href="lightBox/css/jquery.lightbox-0.5.css" media="screen" />    
     
 
    <script type="text/javascript">
    $(function() {
        $('#gallery a').lightBox();
    });
    </script>
   	<style type="text/css">
	/* jQuery lightBox plugin - Gallery style */
	#gallery {
		background-color: #444;
		padding: 10px;
		width: 520px;
	}
	#gallery ul { list-style: none; }
	#gallery ul li { display: inline; }
	#gallery ul img {
		border: 5px solid #3e3e3e;
		border-width: 5px 5px 20px;
	}
	#gallery ul a:hover img {
		border: 5px solid #fff;
		border-width: 5px 5px 20px;
		color: #fff;
	}
	#gallery ul a:hover { color: #fff; }
	</style>
    </head>
<body>

<h2 id="example">Example</h2>
<p>Click in the image and see the <strong>jQuery lightBox plugin</strong> in action.</p>
<div id="gallery">
    <ul>
        <li>
            <a href="upload/q_1_10000083_09-2013_1.jpg" title="Utilize a flexibilidade dos seletores da jQuery e crie um grupo de imagens como desejar.$('#gallery a').lightBox();>
                <img src="upload/q_1_10000083_09-2013_1.jpg" width="72" height="72" alt="" />
            </a>
        </li>
        <li>
            <a href="upload/q_1_10000083_09-2013_2.jpg" title="Utilize a flexibilidade dos seletores da jQuery e crie um grupo de imagens como desejar. $('#gallery a').lightBox();">
                <img src="upload/q_1_10000083_09-2013_2.jpg" width="72" height="72" alt="" />
            </a>
        </li>
        <li>
            <a href="upload/q_1_10000006_10-2013_1.jpg" title="Utilize a flexibilidade dos seletores da jQuery e crie um grupo de imagens como desejar. $('#gallery a').lightBox();">
                <img src="upload/q_1_10000006_10-2013_1.jpg" width="72" height="72" alt="" />
            </a>
        </li>
        <li>
            <a href="upload/q_1_10000006_10-2013_2.jpg" title="Utilize a flexibilidade dos seletores da jQuery e crie um grupo de imagens como desejar. $('#gallery a').lightBox();">
                <img src="upload/q_1_10000006_10-2013_2.jpg" width="72" height="72" alt="" />
            </a>
        </li>
        <li>
            <a href="upload/q_1_10000006_10-2013_3.jpg" title="Utilize a flexibilidade dos seletores da jQuery e crie um grupo de imagens como desejar. $('#gallery a').lightBox();">
                <img src="upload/q_1_10000006_10-2013_3.jpg" width="72" height="72" alt="" />
            </a>
        </li>
    </ul>
</div>

</body>
</html> 
<?php
	//Welcome 2020 Voucher Template

	global $post;
	global $pdf_output;
	global $pdf_header;
	global $pdf_footer;

	global $pdf_template_pdfpage;
	global $pdf_template_pdfpage_page;
	global $pdf_template_pdfdoc;

	global $pdf_html_header;
	global $pdf_html_footer;

	//Set a pdf template. if both are set the pdfdoc is used. (You didn't need a pdf template)
	$pdf_template_pdfpage 		= ''; //The filename off the pdf file (you need this for a page template)
	$pdf_template_pdfpage_page 	= 1;  //The page off this page (you need this for a page template)

	$pdf_template_pdfdoc  		= ''; //The filename off the complete pdf document (you need only this for a document template)

	$pdf_html_header 			= true; //If this is ture you can write instead of the array a html string on the var $pdf_header
	$pdf_html_footer 			= true; //If this is ture you can write instead of the array a html string on the var $pdf_footer

	//Set the Footer and the Header
	$pdf_header = '';
	$pdf_footer = '';


	$pdf_output = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
		<html xml:lang="en"><head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<title>' . get_bloginfo() . '</title>
		</head>
		<body xml:lang="en">
			<bookmark content="'.htmlspecialchars(get_bloginfo('name'), ENT_QUOTES).'" level="0" /><tocentry content="'.htmlspecialchars(get_bloginfo('name'), ENT_QUOTES).'" level="0" />';
			$pdf_output = '<section class="vouchersection">';
			if(have_posts()) :

			while (have_posts()) : the_post();
		//	$url = get_permalink();
		//	$qr = new qrcode();
		//	$qr->text($url);
		//	$content = $qr->get_link();


						//<img src="'.	$content.'" alt="QR CODE"/>
				$pdf_output .= '<div class="voucher-sidea">
														<img src="https://up.pt/welcome/wp-content/uploads/sites/444/2020/09/voucher-sidea-pdf.jpg" alt="" />
													</div>

													<div class="voucher-sideb">
														<div class="kitimage">
															<img src="'.plugins_url().'/uportovouchers/tmp/'.get_the_title().'-qr.jpg" />
														</div>
														<div class="vouchernumber">
															<h1>'.get_the_title().'</h1>
															<p>'.get_the_content().'</p>
														</div>
													</div>';
			endwhile;
		else :
			$pdf_output .= '<h2 class="center">Voucher ainda não disponível</h2>
				<p class="center">Este voucher não está disponível. Por favor tente mais tarde.</p>';
		endif;

		$pdf_output .= '</section>';


	$pdf_output .= '</body>
		</html>';
?>

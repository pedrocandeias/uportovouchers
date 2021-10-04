<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WP_Bootstrap_Starter
 */



 get_header();
 if ( 'POST' == $_SERVER['REQUEST_METHOD'] && ! empty($_POST['post_id']) && isset($_POST['update_post_nonce']) )
 {
		 $post_id   = $_POST['post_id'];
		 $post_type = get_post_type($post_id);
		 $capability = ( 'page' == $post_type ) ? 'edit_page' : 'edit_post';
		 if ( current_user_can($capability, $post_id) && wp_verify_nonce( $_POST['update_post_nonce'], 'update_post_'. $post_id ) )
		 {
				 $post = array(
						 'ID'             => esc_sql($post_id),
				 );
				 wp_update_post($post);

				 if ( isset($_POST['uportovouchers_dropdown']) ) update_post_meta($post_id, 'uportovouchers_dropdown', esc_sql($_POST['uportovouchers_dropdown']) );
		 }
		 else
		 {
				 wp_die("You can't do that");
		 }
 }

 while ( have_posts() ) : the_post();

 		//get value from options
 		$style = liquid_helper()->get_option( 'post-style', 'cover-spaced' ); ?>

		<article <?php liquid_helper()->attr( 'post', array( 'class' => 'blog-single' ) ) ?>>

			<div class="container">

				<div class="row">

					<div class="col-md-12 contents-container">
						<div class="blog-single-content entry-content">

							<?php

							$voucher_status = get_post_meta( get_the_ID(), 'uportovouchers_dropdown', true);

							if( current_user_can('editor') || current_user_can('administrator') ) {
								if(empty($voucher_status)){
									$voucher_status = 'Ativo';
								}
                 ?>
							<section class="vc_row wpb_row vc_row-fluid vouchervalidatorcontainer">
								<div class="ld-container container">
									<div class="row ld-row">
										<div class="wpb_column vc_column_container vc_col-sm-6">
											<div class="vc_column-inner">
												<div class="wpb_wrapper ">
													<div class="wpb_wrapper-inner">
														<?php if($voucher_status == 'Usado'){?>
															<div class="vc_message_box vc_message_box-standard vc_message_box-rounded vc_color-pink">
																<div class="vc_message_box-icon">
																	<i class="fas fa-exclamation-triangle"></i>
																</div>
																<p>Voucher usado</p>
															</div>
														<?php } ?>
														<?php if($voucher_status == 'Ativo'){?>
															<div class="vc_message_box vc_message_box-standard vc_message_box-rounded vc_color-vista_blue">
																<div class="vc_message_box-icon">
																	<i class="far fa-thumbs-up"></i>
																</div>
																<p>Voucher ativo</p>
															</div>
														<?php } ?>
														<?php if($voucher_status == 'Inativo'){?>
														<div class="vc_message_box vc_message_box-standard vc_message_box-rounded vc_color-orange">
															<div class="vc_message_box-icon">
																<i class="fas fa-info-circle"></i>
															</div>
															<p>Voucher inativo</p>
														</div>
													<?php } ?>
													</div>
												</div>
											</div>
										</div>
                    <div class="wpb_column vc_column_container vc_col-sm-6">
                      <?php
                        $post_to_edit = get_post( get_the_ID()); ?>
                          <!-- edit Post Form -->
                          <div id="postbox">
                            <form id="post" class="post-edit front-end-form" method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                <input class="form-control form-control-lg" type="hidden" name="post_id" value="<?php the_ID(); ?>" />
                              </div>
                              <?php wp_nonce_field( 'update_post_'. get_the_ID(), 'update_post_nonce' ); ?>
                              <div class="form-group">
                                <input type="submit" name="uportovouchers_dropdown"  value="Usado"  class="form-control form-control-lg btn-solid text-uppercase voucherbtn  voucherbtnusado" id="submit" />
                                <input type="submit" name="uportovouchers_dropdown"  value="Inativo"  class="form-control form-control-lg  btn-solid text-uppercase voucherbtn voucherbtninativo" id="submit" />
                                <input type="submit" name="uportovouchers_dropdown"  value="Ativo"  class="form-control form-control-lg btn-solid text-uppercase  voucherbtn voucherbtnativo" id="submit" />

                              </div>
                              <!-- <input type="text" id="uportovouchers_dropdown" name="uportovouchers_dropdown" value="<?php echo $voucher_status; ?>" /> -->

                            </form>
                          </div>
                    </div>
                  </div>
								</div>
							</section>




									<section class="vc_row wpb_row vc_row-fluid vouchervalidationcontainer vc_row-has-fill vc_column-gap-0 vc_row-o-equal-height vc_row-flex  vouchervalidatorcontainer">
										<div class="ld-container container">
											<div class="row ld-row">
												<div class="wpb_column vc_column_container vc_col-sm-12">
													<div class="vc_column-inner">
														<div class="wpb_wrapper ">
															<div class="wpb_wrapper-inner">
																<header class="fancy-title vouchervalidatecontent">
																	<h2>Ver aluno na....</h2>
																	<div class="st-desc">
																		<ul>
																			<li><a href="https://sigarra.up.pt/faup/pt/fest_geral.cursos_list?pv_num_unico=<?php echo get_the_title(); ?>">FAUP</a></li>
																			<li><a href="https://sigarra.up.pt/fbaup/pt/fest_geral.cursos_list?pv_num_unico=<?php echo get_the_title(); ?>">FBAUP</a></li>
																			<li><a href="https://sigarra.up.pt/fcup/pt/fest_geral.cursos_list?pv_num_unico=<?php echo get_the_title(); ?>">FCUP</a></li>
																			<li><a href="https://sigarra.up.pt/fcnaup/pt/fest_geral.cursos_list?pv_num_unico=<?php echo get_the_title(); ?>">FCNAUP</a></li>
																			<li><a href="https://sigarra.up.pt/fadeup/pt/fest_geral.cursos_list?pv_num_unico=<?php echo get_the_title(); ?>">FADEUP</a></li>
																			<li><a href="https://sigarra.up.pt/fdup/pt/fest_geral.cursos_list?pv_num_unico=<?php echo get_the_title(); ?>">FDUP</a></li>
																			<li><a href="https://sigarra.up.pt/fep/pt/fest_geral.cursos_list?pv_num_unico=<?php echo get_the_title(); ?>">FEP</a></li>
																			<li><a href="https://sigarra.up.pt/feup/pt/fest_geral.cursos_list?pv_num_unico=<?php echo get_the_title(); ?>">FEUP</a></li>
																			<li><a href="https://sigarra.up.pt/ffup/pt/fest_geral.cursos_list?pv_num_unico=<?php echo get_the_title(); ?>">FFUP</a></li>
																			<li><a href="https://sigarra.up.pt/flup/pt/fest_geral.cursos_list?pv_num_unico=<?php echo get_the_title(); ?>">FLUP</a></li>
																			<li><a href="https://sigarra.up.pt/fmup/pt/fest_geral.cursos_list?pv_num_unico=<?php echo get_the_title(); ?>">FMUP</a></li>
																			<li><a href="https://sigarra.up.pt/fmdup/pt/fest_geral.cursos_list?pv_num_unico=<?php echo get_the_title(); ?>">FMDUP</a></li>
																			<li><a href="https://sigarra.up.pt/fpceup/pt/fest_geral.cursos_list?pv_num_unico=<?php echo get_the_title(); ?>">FPCEUP</a></li>
																			<li><a href="https://sigarra.up.pt/icbas/pt/fest_geral.cursos_list?pv_num_unico=<?php echo get_the_title(); ?>">ICBAS</a></li>
																		</ul>
																	</div>
																</header>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</section>

						<?php } ?>


            <section class="vc_row wpb_row vc_row-fluid vc_row-o-equal-height vc_row-o-content-middle vc_row-flex vouchercontainer">
              <div class="ld-container container">
                <div class="row ld-row">
                  <div class="wpb_column vc_column_container vc_col-sm-6 text-center voucher-sidea vc_col-has-fill">
                    <div class="vc_column-inner">
                      <div class="wpb_wrapper">
                        <div class="wpb_wrapper-inner">
                        	<div class="wpb_single_image wpb_content_element vc_align_center">
                        		<figure class="wpb_wrapper vc_figure">
                        			<div class="vc_single_image-wrapper   vc_box_border_grey loaded">
                                <img width="727" height="805" src="https://up.pt/welcome/wp-content/uploads/sites/444/2020/09/voucher-sidea.png" class="vc_single_image-img attachment-full ld-lazyload loaded" alt="" loading="lazy" srcset="https://up.pt/welcome/wp-content/uploads/sites/444/2020/09/voucher-sidea.png 727w, https://up.pt/welcome/wp-content/uploads/sites/444/2020/09/voucher-sidea-271x300.png 271w" sizes="(max-width: 727px) 100vw, 727px" data-src="https://up.pt/welcome/wp-content/uploads/sites/444/2020/09/voucher-sidea.png" data-srcset="https://up.pt/welcome/wp-content/uploads/sites/444/2020/09/voucher-sidea.png 727w, https://up.pt/welcome/wp-content/uploads/sites/444/2020/09/voucher-sidea-271x300.png 271w" data-aspect="0.90310559006211" data-was-processed="true">
                              </div>
                        		</figure>
                        	</div>
                        </div>
                      </div>
                    </div>
                  </div>
                <div class="wpb_column vc_column_container vc_col-sm-6 voucher-sideb vc_col-has-fill">
                  <div class="vc_column-inner">
                    <div class="wpb_wrapper">
                      <div class="wpb_wrapper-inner">
                        <div class="vc_row wpb_row vc_inner vc_row-fluid vc_column-gap-0 vc_row-o-content-middle vc_row-flex">
                          <div class="wpb_column vc_column_container vc_col-sm-12 text-center vc_col-has-fill">
                            <div class="vc_column-inner">
                              <div class="wpb_wrapper">
                                <div class="wpb_wrapper-inner">
                                	<div class="wpb_single_image wpb_content_element vc_align_center">
                                      <?php 	//$url = get_permalink();
                                        //$qr = new qrcode();
                                        //$qr->text($url);
                                        //$content = $qr->get_link();
                                        //$url = $content;
                                        //echo $url;
                                        //$destination_folder = plugin_dir_path( __DIR__ ).'tmp/';
                                        //$newfname = $destination_folder.get_the_title().'-qr.png';
                                        // echo $newfname;
                                        //$file = fopen ($url, "rb");
                                        //if ($file) {
                                      //    $newf = fopen ($newfname, "a"); // to overwrite existing file
                                      //  }
                                      //  if ($newf) {
                                      //    while(!feof($file)) {
                                      //          fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
                                      //    }
                                      //  }
                                      //  if ($file) {
                                      //    fclose($file);
                                      //  }
                                      //  if ($newf) {
                                      //    fclose($newf);
                                      //  }
                                      $pngimage = get_the_post_thumbnail_url($post->ID, 'full');
                                      $jpnimage = '';
                                      $image = imagecreatefrompng($pngimage);
                                      imagejpeg(  $image, plugin_dir_path( __DIR__ ).'tmp/'.get_the_title().'-qr.jpg', 100);
                                      imagedestroy($image);
                                      //$bg = imagecreatetruecolor(imagesx($image), imagesy($image));
                                      //imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
                                      //imagealphablending($bg, TRUE);
                                      //imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
                                      //imagedestroy($image);
                                      //$quality = 50; // 0 = worst / smaller file, 100 = better / bigger file
                                      //imagejpeg($bg, $jpnimage.'-qr.jpg', $quality);
                                      //imagedestroy($bg);
                                      //echo '<img src="'.imagejpeg($bg, $jpnimage.'-qr.jpg', $quality).'" />';?>
                                      <div class="vc_single_image-wrapper   vc_box_border_grey loaded">
                                        <img width="330" height="330" src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>" class="vc_single_image-img attachment-full ld-lazyload loaded" alt="" data-aspect="1" srcset="" data-was-processed="true">
                                      </div>
                                    </figure>
                                  </div>
                                  <div class="ld-fancy-heading text-center vouchernumber vouchertext">
                                  	<h1 class="lqd-highlight-underline lqd-highlight-grow-left">
                                      <span class="ld-fh-txt"><?php the_title();?></span>
                                    </h1>
                                    <p><?php the_content();?></p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>



						<section class="vc_row wpb_row vc_row-fluid voucherbtnscontainer">
							<div class="ld-container container">
								<div class="row ld-row">
									<div class="wpb_column vc_column_container vc_col-sm-12">
										<div class="vc_column-inner">
											<div class="wpb_wrapper ">
												<div class="wpb_wrapper-inner">
													<a href="<?php echo get_permalink(); ?>&output=pdf" class="btn btn-solid btn-sm circle btn-bordered border-thin downloadvoucherbtn">
														<span>
															<span class="btn-txt">Descarregar o voucher em PDF</span>
															<span class="btn-icon"><i class="fas fa-file-pdf"></i></span>
														</span>
													</a>
													<a href="https://up.pt/welcome/como-levantar-o-kit/" class="btn btn-solid btn-sm circle btn-bordered border-thin levantarkitbtn">
														<span>
															<span class="btn-txt">Como levantar o kit de boas-vindas</span>
															<span class="btn-icon"><i class="fas fa-link"></i></span>
														</span>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>
						</div><!-- /.blog-single-content entry-content -->

						<footer class="blog-single-footer entry-footer">

						</footer><!-- /.blog-single-footer entry-footer -->

				</div><!-- /.row -->

			</div><!-- /.container -->

		</article><!-- /.blog-single -->

 	<?php endwhile;

 get_footer();

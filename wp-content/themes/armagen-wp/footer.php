<?php
/**
 * Footer template
 *
 * @package ArmaGen
 */
?>

<footer id="contact" class="footer clearfix">
    <div class="foot1">
        <a class="logo-footer" href="<?php echo home_url(); ?>" title="ArmaGen Technologies">
            <img src="<?php echo get_template_directory_uri(); ?>/images/armagen_logo_rev.svg" alt="ArmaGen Technologies">
            <h1>ArmaGen Technologies</h1>
        </a>
    </div>
    
    
    <div class="foot2">
        <div class="footer__nav--primary">
            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
        </div>
        <div class="footer__nav--secondary">
            <?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'nav-menu' ) ); ?>
        </div>
    </div>


    <div class="foot3">
        <p class="col small caps coal">
            P: <a href="tel:8182528200" title="email">(818) 252-8200</a><br />
            F: (818) 252-8214<br />
            <a href="mailto:contact@armagen.com" title="email">contact@armagen.com</a>
        </p>
        <p class="col small caps copper">
            26679 Agoura Road<br />
            Suite 100<br />
            Calabasas, CA 91302 
        </p>
    </div>

    <div class="clearfix"></div>
    <p class="colfull"><strong>ArmaGen Technologies, Inc.</strong>&nbsp;&nbsp; <small>&copy;Copyright <?php echo date("Y") ?>.  All rights reserved.</small></p>
    </div>
</footer>

<a href="#wrapper" class="backtop rotate" title="Back-to-top"><span>&rsaquo;</span></a>

</div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>
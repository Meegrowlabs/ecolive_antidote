<?php
/**
 * Site footer — deep panel matching the EcoLive marketing design.
 *
 * @package ecolive-organic
 */
$eco_blog_url = ecolive_blog_url();
?>
</div><!-- #site-content -->

<footer class="w-full rounded-t-[3rem] mt-20 bg-primary text-on-primary">
  <div class="grid grid-cols-1 md:grid-cols-4 gap-12 max-w-7xl mx-auto px-8 py-16">
    <div class="col-span-1">
      <a class="mb-6 block" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/ecolive-logo.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="h-7 brightness-0 invert">
      </a>
      <p class="text-sm leading-relaxed text-primary-fixed/80 mb-8">Conserve, reuse, recharge and govern water by every practical means.</p>
      <div class="flex gap-4">
        <span class="material-symbols-outlined text-primary-fixed/70">public</span>
        <span class="material-symbols-outlined text-primary-fixed/70">eco</span>
        <span class="material-symbols-outlined text-primary-fixed/70">water</span>
      </div>
    </div>
    <div class="col-span-1">
      <h4 class="font-bold text-secondary-fixed mb-6">Solutions</h4>
      <div class="flex flex-col gap-4 text-sm">
        <a class="text-primary-fixed/70 hover:text-secondary-fixed transition-all" href="<?php echo esc_url( home_url( '/#solutions' ) ); ?>">4R framework</a>
        <a class="text-primary-fixed/70 hover:text-secondary-fixed transition-all" href="<?php echo esc_url( home_url( '/#tools' ) ); ?>">WaterWise tools</a>
        <a class="text-primary-fixed/70 hover:text-secondary-fixed transition-all" href="<?php echo esc_url( home_url( '/#method' ) ); ?>">Water audits</a>
        <a class="text-primary-fixed/70 hover:text-secondary-fixed transition-all" href="<?php echo esc_url( home_url( '/#challenge' ) ); ?>">Compliance gaps</a>
      </div>
    </div>
    <div class="col-span-1">
      <h4 class="font-bold text-secondary-fixed mb-6">Company</h4>
      <div class="flex flex-col gap-4 text-sm">
        <a class="text-primary-fixed/70 hover:text-secondary-fixed transition-all" href="<?php echo esc_url( $eco_blog_url ); ?>">Blogs</a>
        <a class="text-primary-fixed/70 hover:text-secondary-fixed transition-all" href="<?php echo esc_url( home_url( '/#method' ) ); ?>">Method</a>
        <a class="text-primary-fixed/70 hover:text-secondary-fixed transition-all" href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
      </div>
    </div>
    <div class="col-span-1">
      <h4 class="font-bold text-secondary-fixed mb-6">Contact</h4>
      <div class="flex flex-col gap-4 text-sm">
        <a class="text-primary-fixed/70 hover:text-secondary-fixed transition-all" href="mailto:connect@ecolive.in">connect@ecolive.in</a>
        <a class="text-primary-fixed/70 hover:text-secondary-fixed transition-all" href="tel:+919871472211">+91 98714 72211</a>
        <a class="text-primary-fixed/70 hover:text-secondary-fixed transition-all" href="<?php echo esc_url( home_url( '/#contact' ) ); ?>">Gurugram and Jaipur offices</a>
      </div>
    </div>
  </div>
  <div class="max-w-7xl mx-auto px-8 py-8 flex flex-col md:flex-row justify-between items-center gap-4 bg-primary-container/50 rounded-t-3xl">
    <p class="text-sm leading-relaxed text-primary-fixed/70">&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
    <span class="text-xs text-primary-fixed/60">Wellness of Nature &amp; Nature for Wellness</span>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

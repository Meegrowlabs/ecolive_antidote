<?php
/**
 * Front page — EcoLive marketing homepage (ported from index.html).
 *
 * @package ecolive-organic
 */
get_header();

$tpl              = get_template_directory_uri();
$runoff_url       = ecolive_page_url( 'runoff-calculator' );
$balance_url      = ecolive_page_url( 'water-balance-optimiser' );
$blog_url         = ecolive_blog_url();
?>
<main>
  <!-- Hero -->
  <section class="relative pt-40 pb-24 md:pt-56 md:pb-40 px-6 overflow-hidden">
    <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-secondary-fixed/30 via-surface to-surface"></div>
    <div class="absolute -top-20 -right-20 w-96 h-96 bg-secondary-fixed/30 rounded-full blur-3xl"></div>
    <div class="absolute top-1/2 -left-20 w-64 h-64 bg-tertiary-fixed/30 rounded-full blur-3xl"></div>
    <div class="max-w-7xl mx-auto flex flex-col items-start">
      <div class="inline-flex items-center gap-2 px-4 py-2 bg-secondary-fixed/40 text-primary rounded-full mb-8 font-semibold text-sm">
        <span class="material-symbols-outlined text-sm">eco</span>
        EcoLive Ventures Private Ltd
      </div>
      <h1 class="font-headline text-6xl md:text-8xl font-extrabold tracking-tighter text-on-surface max-w-4xl leading-[0.9] mb-10">
        Water balance is the next <span class="text-gradient">growth infrastructure.</span>
      </h1>
      <p class="text-xl md:text-2xl text-on-surface-variant max-w-2xl leading-relaxed mb-12">
        EcoLive helps consumers, institutions, industries and urban communities conserve water by reducing demand, reusing treated water, recharging rainwater and closing compliance gaps at the point of consumption.
      </p>
      <div class="flex flex-wrap gap-6">
        <a class="px-8 py-4 btn-primary-gradient text-on-primary rounded-full font-bold text-lg shadow-[0_10px_40px_rgba(24,28,27,0.12)] hover:opacity-95 transition-all inline-block" href="#contact">Request a WaterWise assessment</a>
        <a class="px-8 py-4 bg-surface/70 backdrop-blur-md ghost-border rounded-full font-bold text-lg text-primary hover:bg-surface-container-low transition-all inline-block" href="#solutions">Explore solutions</a>
      </div>
    </div>
    <div class="max-w-7xl mx-auto mt-20 relative">
      <div class="aspect-[21/9] rounded-xl overflow-hidden shadow-2xl bg-surface-container flex items-center justify-center">
        <img alt="4R water balance framework showing Reduce, Reuse, Recharge and Recycle" class="w-full h-full object-contain p-6" src="<?php echo esc_url( $tpl . '/assets/four-r-water-balance.svg' ); ?>"/>
      </div>
    </div>
  </section>

  <!-- Impact metric band -->
  <section class="py-20 md:py-28 px-6 bg-surface-container-low reveal-on-scroll">
    <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-10">
      <div><strong class="block font-headline text-4xl md:text-6xl font-extrabold tracking-tighter text-primary">1,150</strong><span class="text-on-surface-variant">Completed projects</span></div>
      <div><strong class="block font-headline text-4xl md:text-6xl font-extrabold tracking-tighter text-primary">652M+</strong><span class="text-on-surface-variant">Litres of water saved</span></div>
      <div><strong class="block font-headline text-4xl md:text-6xl font-extrabold tracking-tighter text-primary">11</strong><span class="text-on-surface-variant">States across India</span></div>
      <div><strong class="block font-headline text-4xl md:text-6xl font-extrabold tracking-tighter text-primary">4R</strong><span class="text-on-surface-variant">Reduce, Reuse, Recharge, Recycle</span></div>
    </div>
  </section>

  <!-- Challenge -->
  <section id="challenge" class="py-24 md:py-32 px-6 bg-surface reveal-on-scroll">
    <div class="max-w-7xl mx-auto">
      <div class="mb-20 max-w-3xl">
        <p class="text-secondary font-bold text-sm uppercase tracking-widest mb-4">The challenge</p>
        <h2 class="font-headline text-4xl md:text-5xl font-bold tracking-tight mb-6">India does not only need more water. It needs better water behavior.</h2>
        <p class="text-lg text-on-surface-variant">Water stress shows up as dry borewells, urban flooding, tanker dependence, unused rainwater, inefficient fixtures, underperforming recharge systems and wastewater that is discharged instead of reused.</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
        <div class="group p-8 bg-surface-container-lowest rounded-xl transition-all duration-500 hover:shadow-[0_20px_50px_rgba(24,28,27,0.06)] hover:-translate-y-1 h-full flex flex-col">
          <div class="w-14 h-14 bg-tertiary-fixed/40 text-primary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform"><span class="material-symbols-outlined text-3xl">trending_down</span></div>
          <h3 class="text-2xl font-bold mb-4">Rain becomes drainage</h3>
          <p class="text-on-surface-variant leading-relaxed flex-1">Hard surfaces move rainfall away quickly. The same rain that floods roads could recharge aquifers or support non-potable demand.</p>
        </div>
        <div class="group p-8 bg-surface-container-lowest rounded-xl transition-all duration-500 hover:shadow-[0_20px_50px_rgba(24,28,27,0.06)] hover:-translate-y-1 h-full flex flex-col">
          <div class="w-14 h-14 bg-secondary-fixed/40 text-secondary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform"><span class="material-symbols-outlined text-3xl">sync</span></div>
          <h3 class="text-2xl font-bold mb-4">Water use stays linear</h3>
          <p class="text-on-surface-variant leading-relaxed flex-1">Freshwater is extracted, used once and discharged. Circular reuse needs practical design, operations and consumer confidence.</p>
        </div>
        <div class="group p-8 bg-surface-container-lowest rounded-xl transition-all duration-500 hover:shadow-[0_20px_50px_rgba(24,28,27,0.06)] hover:-translate-y-1 h-full flex flex-col">
          <div class="w-14 h-14 bg-surface-variant text-tertiary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform"><span class="material-symbols-outlined text-3xl">fact_check</span></div>
          <h3 class="text-2xl font-bold mb-4">Compliance is not performance</h3>
          <p class="text-on-surface-variant leading-relaxed flex-1">Systems may exist on paper, but filters, pits, STPs, meters and fixtures need inspection, maintenance and measurable outcomes.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Solutions -->
  <section id="solutions" class="py-24 md:py-32 px-6 bg-surface-container-low reveal-on-scroll">
    <div class="max-w-7xl mx-auto">
      <div class="mb-20 max-w-3xl">
        <p class="text-secondary font-bold text-sm uppercase tracking-widest mb-4">WaterWise solutions</p>
        <h2 class="font-headline text-4xl md:text-5xl font-bold tracking-tight mb-6">Practical interventions across the full water balance.</h2>
        <p class="text-lg text-on-surface-variant">EcoLive's work sits where engineering, behavior, compliance and maintenance meet. The goal is not installation for its own sake; the goal is verified water improvement.</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 items-stretch">
        <div class="group p-8 bg-surface-container-lowest rounded-xl transition-all duration-500 hover:shadow-[0_20px_50px_rgba(24,28,27,0.06)] hover:-translate-y-1 h-full flex flex-col">
          <div class="w-14 h-14 bg-secondary-fixed/40 text-secondary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform"><span class="material-symbols-outlined text-3xl">remove</span></div>
          <h3 class="text-2xl font-bold mb-4">Reduce</h3>
          <p class="text-on-surface-variant leading-relaxed flex-1">Water audits, leakage checks, efficient fixtures, aerators, dual flush systems, metering and usage baselines.</p>
        </div>
        <div class="group p-8 bg-surface-container-lowest rounded-xl transition-all duration-500 hover:shadow-[0_20px_50px_rgba(24,28,27,0.06)] hover:-translate-y-1 h-full flex flex-col">
          <div class="w-14 h-14 bg-tertiary-fixed/40 text-primary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform"><span class="material-symbols-outlined text-3xl">cycle</span></div>
          <h3 class="text-2xl font-bold mb-4">Reuse</h3>
          <p class="text-on-surface-variant leading-relaxed flex-1">RO reject reuse, greywater routing, treated wastewater utilization and fit-for-purpose non-potable water planning.</p>
        </div>
        <div class="group p-8 bg-surface-container-lowest rounded-xl transition-all duration-500 hover:shadow-[0_20px_50px_rgba(24,28,27,0.06)] hover:-translate-y-1 h-full flex flex-col">
          <div class="w-14 h-14 bg-surface-variant text-tertiary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform"><span class="material-symbols-outlined text-3xl">water</span></div>
          <h3 class="text-2xl font-bold mb-4">Recharge</h3>
          <p class="text-on-surface-variant leading-relaxed flex-1">Rainwater harvesting, lateral filtration, groundwater recharge, recharge efficiency checks and maintenance protocols.</p>
        </div>
        <div class="group p-8 bg-surface-container-lowest rounded-xl transition-all duration-500 hover:shadow-[0_20px_50px_rgba(24,28,27,0.06)] hover:-translate-y-1 h-full flex flex-col">
          <div class="w-14 h-14 bg-secondary-fixed/40 text-primary-container rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform"><span class="material-symbols-outlined text-3xl">recycling</span></div>
          <h3 class="text-2xl font-bold mb-4">Recycle</h3>
          <p class="text-on-surface-variant leading-relaxed flex-1">Moving buildings and campuses from a linear water model toward conscious, circular and measurable water systems.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Water balance loop (dark panel) -->
  <section class="py-24 md:py-32 px-6 bg-surface reveal-on-scroll">
    <div class="max-w-7xl mx-auto btn-primary-gradient text-on-primary rounded-xl p-12 md:p-20 relative overflow-hidden">
      <div class="absolute -top-20 -right-20 w-96 h-96 bg-secondary-fixed/10 rounded-full blur-3xl pointer-events-none"></div>
      <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <div>
          <p class="text-secondary-fixed font-bold text-sm uppercase tracking-widest mb-4">Water balance loop</p>
          <h2 class="font-headline text-4xl md:text-5xl font-bold leading-tight mb-8">Every site has a water story. EcoLive makes it visible.</h2>
          <p class="text-lg text-secondary-fixed leading-relaxed mb-10 max-w-lg">Instead of looking at water as only supply or only drainage, EcoLive maps the full loop: what comes in, what is consumed, what is wasted, what can be reused, and what rain can be recharged.</p>
          <a class="px-8 py-4 bg-surface text-primary rounded-full font-bold text-lg hover:bg-surface-container-low transition-all inline-block" href="#contact">Map my site's water balance</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="bg-white/10 backdrop-blur-xl p-6 rounded-xl border border-white/15"><strong class="block text-secondary-fixed mb-2">Source</strong><span class="text-sm text-primary-fixed/80">Municipal supply, tanker, borewell, rain and stored water.</span></div>
          <div class="bg-white/10 backdrop-blur-xl p-6 rounded-xl border border-white/15"><strong class="block text-secondary-fixed mb-2">Use</strong><span class="text-sm text-primary-fixed/80">Drinking, bathing, flushing, cleaning, gardening and processes.</span></div>
          <div class="bg-white/10 backdrop-blur-xl p-6 rounded-xl border border-white/15"><strong class="block text-secondary-fixed mb-2">Recover</strong><span class="text-sm text-primary-fixed/80">RO reject, greywater, treated wastewater and stormwater.</span></div>
          <div class="bg-white/10 backdrop-blur-xl p-6 rounded-xl border border-white/15"><strong class="block text-secondary-fixed mb-2">Recharge</strong><span class="text-sm text-primary-fixed/80">Filter, store and return rainwater to the ground where feasible.</span></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Tools -->
  <section id="tools" class="py-24 md:py-32 px-6 bg-surface-container-low reveal-on-scroll">
    <div class="max-w-7xl mx-auto">
      <div class="mb-20 max-w-3xl">
        <p class="text-secondary font-bold text-sm uppercase tracking-widest mb-4">WaterWise tools</p>
        <h2 class="font-headline text-4xl md:text-5xl font-bold tracking-tight mb-6">Decision tools for measurable water action.</h2>
        <p class="text-lg text-on-surface-variant">Estimate water opportunity before calling an expert — for consumers, RWAs, institutions and industries.</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
        <article class="group p-8 bg-surface-container-lowest rounded-xl transition-all duration-500 hover:shadow-[0_20px_50px_rgba(24,28,27,0.06)] hover:-translate-y-1 h-full flex flex-col">
          <div class="w-14 h-14 bg-tertiary-fixed/40 text-primary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform"><span class="material-symbols-outlined text-3xl">rainy</span></div>
          <h3 class="text-2xl font-bold mb-4">Runoff Calculator</h3>
          <p class="text-on-surface-variant leading-relaxed flex-1 mb-8">Runoff estimation by city rainfall, premise preset, surface areas, runoff coefficients, event rainfall, collection efficiency and first-flush losses.</p>
          <a class="inline-flex items-center gap-2 font-bold text-primary group-hover:gap-3 transition-all" href="<?php echo esc_url( $runoff_url ); ?>">Open calculator <span class="material-symbols-outlined">arrow_forward</span></a>
        </article>
        <article class="group p-8 bg-surface-container-lowest rounded-xl transition-all duration-500 hover:shadow-[0_20px_50px_rgba(24,28,27,0.06)] hover:-translate-y-1 h-full flex flex-col">
          <div class="w-14 h-14 bg-secondary-fixed/40 text-secondary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform"><span class="material-symbols-outlined text-3xl">balance</span></div>
          <h3 class="text-2xl font-bold mb-4">Water Balance Optimiser</h3>
          <p class="text-on-surface-variant leading-relaxed flex-1 mb-8">Scenario simulator comparing existing and post-4R water balance through rainfall, area, population, consumption and recharge efficiency.</p>
          <a class="inline-flex items-center gap-2 font-bold text-primary group-hover:gap-3 transition-all" href="<?php echo esc_url( $balance_url ); ?>">Open optimiser <span class="material-symbols-outlined">arrow_forward</span></a>
        </article>
        <article class="group p-8 bg-surface-container-lowest rounded-xl transition-all duration-500 hover:shadow-[0_20px_50px_rgba(24,28,27,0.06)] hover:-translate-y-1 h-full flex flex-col">
          <div class="w-14 h-14 bg-surface-variant text-tertiary rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform"><span class="material-symbols-outlined text-3xl">checklist</span></div>
          <h3 class="text-2xl font-bold mb-4">Consumer Compliance Checklist</h3>
          <p class="text-on-surface-variant leading-relaxed flex-1 mb-8">Check RO need, RWH/GWR condition, leakages, motor usage, discharge practices, aerators, dual flush and metering gaps.</p>
          <a class="inline-flex items-center gap-2 font-bold text-outline" href="#contact">Coming soon <span class="material-symbols-outlined">schedule</span></a>
        </article>
      </div>
      <p class="text-sm text-outline max-w-3xl mt-10">Tool data method: these tools use editable baseline data and planning assumptions. Values must be verified against latest IMD, municipal, CGWB and project-site records before engineering decisions.</p>
    </div>
  </section>

  <!-- Urban flooding split -->
  <section class="py-24 md:py-32 px-6 bg-surface reveal-on-scroll">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
      <div>
        <p class="text-secondary font-bold text-sm uppercase tracking-widest mb-4">Urban flooding as opportunity</p>
        <h2 class="font-headline text-4xl md:text-5xl font-bold tracking-tight mb-6">The runoff problem can become a recharge advantage.</h2>
        <p class="text-lg text-on-surface-variant mb-8">As green and soil cover declines, rainwater runoff rises. EcoLive reframes this as an opportunity: catch, filter, store and recharge distributed rainwater before it becomes flooding, damage and wasted freshwater potential.</p>
        <ul class="space-y-4">
          <li class="flex items-start gap-3"><span class="material-symbols-outlined text-secondary mt-0.5">check_circle</span><span class="text-on-surface-variant">Rejuvenate remaining water bodies and natural drainage paths.</span></li>
          <li class="flex items-start gap-3"><span class="material-symbols-outlined text-secondary mt-0.5">check_circle</span><span class="text-on-surface-variant">Use building, colony and campus surfaces as distributed catchments.</span></li>
          <li class="flex items-start gap-3"><span class="material-symbols-outlined text-secondary mt-0.5">check_circle</span><span class="text-on-surface-variant">Check whether RWH/GWR systems are functional, cleaned and sized for actual rainfall.</span></li>
        </ul>
      </div>
      <div class="aspect-[4/3] rounded-xl overflow-hidden shadow-2xl">
        <img alt="Slide listing rainwater recharge, water body rejuvenation and drain improvement ideas" class="w-full h-full object-cover" src="<?php echo esc_url( $tpl . '/assets/urban-recharge-slide.jpg' ); ?>"/>
      </div>
    </div>
  </section>

  <!-- Quote band -->
  <section class="py-24 px-6 bg-surface-container-low reveal-on-scroll">
    <div class="max-w-4xl mx-auto text-center">
      <span class="material-symbols-outlined text-5xl text-secondary-fixed-dim">format_quote</span>
      <blockquote class="font-headline text-3xl md:text-5xl font-bold tracking-tight leading-tight mt-6">Water security is not a slogan. It is a daily operating discipline.</blockquote>
      <cite class="block text-on-surface-variant mt-6 not-italic font-semibold">EcoLive WaterWise principle</cite>
    </div>
  </section>

  <!-- Blogs -->
  <section id="blogs" class="py-24 md:py-32 px-6 bg-surface reveal-on-scroll">
    <div class="max-w-7xl mx-auto">
      <div class="mb-16 flex flex-col md:flex-row md:items-end md:justify-between gap-6">
        <div class="max-w-2xl">
          <p class="text-secondary font-bold text-sm uppercase tracking-widest mb-4">Blogs and field notes</p>
          <h2 class="font-headline text-4xl md:text-5xl font-bold tracking-tight mb-6">Water literacy for people who want to act.</h2>
          <p class="text-lg text-on-surface-variant">Explainers, practical guides, case notes, compliance updates and simple calculators that demystify water conservation.</p>
        </div>
        <a href="<?php echo esc_url( $blog_url ); ?>" class="inline-flex items-center gap-2 px-6 py-3 btn-primary-gradient text-on-primary rounded-full font-bold whitespace-nowrap self-start md:self-auto hover:opacity-95 transition-all">Read the blog <span class="material-symbols-outlined">arrow_forward</span></a>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
        <?php
        $eco_latest = new WP_Query( array(
          'post_type'           => 'post',
          'posts_per_page'      => 3,
          'ignore_sticky_posts' => true,
          'no_found_rows'       => true,
        ) );
        if ( $eco_latest->have_posts() ) :
          $eco_fallback_icons = array( 'flood', 'water_drop', 'plumbing' );
          $eco_i = 0;
          while ( $eco_latest->have_posts() ) : $eco_latest->the_post();
            $eco_icon = $eco_fallback_icons[ $eco_i % 3 ];
            $eco_i++;
        ?>
        <a href="<?php the_permalink(); ?>" class="group flex flex-col h-full">
          <div class="aspect-[4/3] rounded-xl overflow-hidden mb-6 bg-surface-container flex items-center justify-center">
            <?php if ( has_post_thumbnail() ) : ?>
              <?php the_post_thumbnail( 'ecolive-card', array( 'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-700' ) ); ?>
            <?php else : ?>
              <span class="material-symbols-outlined text-6xl text-outline"><?php echo esc_html( $eco_icon ); ?></span>
            <?php endif; ?>
          </div>
          <span class="text-[11px] uppercase tracking-widest font-bold text-secondary mb-3"><?php echo esc_html( ecolive_organic_primary_category() ?: 'Insight' ); ?></span>
          <h3 class="font-headline text-xl font-bold mb-3 leading-snug group-hover:text-primary transition-colors"><?php the_title(); ?></h3>
          <p class="text-sm text-on-surface-variant leading-relaxed flex-1"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 26 ) ); ?></p>
        </a>
        <?php endwhile; wp_reset_postdata(); else : ?>
          <p class="text-on-surface-variant col-span-3">New field notes are on the way. Check back soon.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- Method timeline -->
  <section id="method" class="py-24 md:py-40 px-6 bg-surface-container-low overflow-hidden reveal-on-scroll">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-24 max-w-3xl mx-auto">
        <p class="text-secondary font-bold text-sm uppercase tracking-widest mb-4">How engagements work</p>
        <h2 class="font-headline text-4xl md:text-6xl font-extrabold tracking-tighter mb-6">From site diagnosis to measurable action.</h2>
        <p class="text-xl text-on-surface-variant">A clear process keeps water work practical, inspectable and repeatable.</p>
      </div>
      <div class="relative">
        <div class="absolute top-10 left-0 w-full h-1 bg-gradient-to-r from-primary/5 via-primary to-primary/5 hidden md:block rounded-full"></div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 relative z-10">
          <div class="flex flex-col items-center text-center">
            <div class="w-20 h-20 rounded-full bg-white shadow-[0_10px_30px_rgba(24,28,27,0.06)] flex items-center justify-center mb-8 border-4 border-secondary-fixed/40"><span class="text-2xl font-bold text-primary">01</span></div>
            <h4 class="text-xl font-bold mb-3">Assess</h4>
            <p class="text-sm text-on-surface-variant max-w-[220px]">Map sources, consumption, leakages, fixtures, RO use, rainwater, wastewater and compliance gaps.</p>
          </div>
          <div class="flex flex-col items-center text-center md:translate-y-8">
            <div class="w-20 h-20 rounded-full bg-white shadow-xl flex items-center justify-center mb-8 border-4 border-primary/20"><span class="text-2xl font-bold text-primary">02</span></div>
            <h4 class="text-xl font-bold mb-3">Prioritize</h4>
            <p class="text-sm text-on-surface-variant max-w-[220px]">Rank interventions by water impact, cost, feasibility, maintenance needs and urgency.</p>
          </div>
          <div class="flex flex-col items-center text-center">
            <div class="w-20 h-20 rounded-full bg-white shadow-xl flex items-center justify-center mb-8 border-4 border-primary/30"><span class="text-2xl font-bold text-primary">03</span></div>
            <h4 class="text-xl font-bold mb-3">Implement</h4>
            <p class="text-sm text-on-surface-variant max-w-[220px]">Coordinate solutions through trained teams, technicians, partners and site owners.</p>
          </div>
          <div class="flex flex-col items-center text-center md:translate-y-8">
            <div class="w-20 h-20 rounded-full btn-primary-gradient shadow-[0_15px_40px_rgba(24,28,27,0.18)] flex items-center justify-center mb-8"><span class="material-symbols-outlined text-white text-3xl">check</span></div>
            <h4 class="text-xl font-bold mb-3">Verify</h4>
            <p class="text-sm text-on-surface-variant max-w-[220px]">Track what changed: consumption reduced, rain captured, water reused and systems maintained.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- For whom -->
  <section class="py-24 md:py-32 px-6 bg-surface reveal-on-scroll">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
      <div class="aspect-[4/3] rounded-xl overflow-hidden shadow-2xl order-2 lg:order-1">
        <img alt="EcoLive presentation explaining post-urbanization water runoff" class="w-full h-full object-cover" src="<?php echo esc_url( $tpl . '/assets/waterwise-stage.jpg' ); ?>"/>
      </div>
      <div class="order-1 lg:order-2">
        <p class="text-secondary font-bold text-sm uppercase tracking-widest mb-4">For whom</p>
        <h2 class="font-headline text-4xl md:text-5xl font-bold tracking-tight mb-8">Built for water users who want outcomes, not only installations.</h2>
        <div class="flex flex-wrap gap-3">
          <span class="px-4 py-2 bg-surface-container rounded-full text-sm font-semibold text-on-surface-variant">Homes and villas</span>
          <span class="px-4 py-2 bg-surface-container rounded-full text-sm font-semibold text-on-surface-variant">Schools and colleges</span>
          <span class="px-4 py-2 bg-surface-container rounded-full text-sm font-semibold text-on-surface-variant">RWAs and townships</span>
          <span class="px-4 py-2 bg-surface-container rounded-full text-sm font-semibold text-on-surface-variant">Hotels and offices</span>
          <span class="px-4 py-2 bg-surface-container rounded-full text-sm font-semibold text-on-surface-variant">Factories and warehouses</span>
          <span class="px-4 py-2 bg-surface-container rounded-full text-sm font-semibold text-on-surface-variant">Bus stands and railway stations</span>
          <span class="px-4 py-2 bg-surface-container rounded-full text-sm font-semibold text-on-surface-variant">Highways and public campuses</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact -->
  <section id="contact" class="py-24 md:py-32 px-6 bg-surface-container-high reveal-on-scroll">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
      <div>
        <p class="text-secondary font-bold text-sm uppercase tracking-widest mb-4">Start WaterWise</p>
        <h2 class="font-headline text-4xl md:text-5xl font-extrabold tracking-tighter mb-6">If you also wish to care for water like us, let us connect.</h2>
        <p class="text-xl text-on-surface-variant mb-10 leading-relaxed">Share your site, challenge or idea. We can begin with a conversation and then move toward a WaterWise assessment, 4R plan, tool or project.</p>
        <div class="space-y-6">
          <div class="flex items-center gap-4"><div class="w-12 h-12 bg-secondary-fixed/40 rounded-full flex items-center justify-center"><span class="material-symbols-outlined text-primary">mail</span></div><div><p class="font-bold text-on-surface">Email Us</p><p class="text-on-surface-variant text-sm">connect@ecolive.in</p></div></div>
          <div class="flex items-center gap-4"><div class="w-12 h-12 bg-secondary-fixed/40 rounded-full flex items-center justify-center"><span class="material-symbols-outlined text-primary">call</span></div><div><p class="font-bold text-on-surface">Call Us</p><p class="text-on-surface-variant text-sm">+91 98714 72211</p></div></div>
          <div class="flex items-center gap-4"><div class="w-12 h-12 bg-secondary-fixed/40 rounded-full flex items-center justify-center"><span class="material-symbols-outlined text-primary">location_on</span></div><div><p class="font-bold text-on-surface">Gurugram Office</p><p class="text-on-surface-variant text-sm">Vipul Trade Centre, Sohna Road, Sector 48, Gurugram, Haryana</p></div></div>
          <div class="flex items-center gap-4"><div class="w-12 h-12 bg-secondary-fixed/40 rounded-full flex items-center justify-center"><span class="material-symbols-outlined text-primary">location_on</span></div><div><p class="font-bold text-on-surface">Jaipur Office</p><p class="text-on-surface-variant text-sm">Rajendra Prasad Nagar, Jaipur, Rajasthan</p></div></div>
        </div>
      </div>
      <div class="bg-surface-container-lowest/80 backdrop-blur-xl p-10 rounded-xl shadow-[0_30px_60px_rgba(24,28,27,0.06)]">
        <h3 class="text-2xl font-extrabold text-primary mb-8">Send us a message</h3>
        <?php ecolive_contact_form(); ?>
      </div>
    </div>
  </section>
</main>
<?php
get_footer();

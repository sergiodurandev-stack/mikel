<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$page_id = get_the_ID();

// ── DEFAULTS (from original content.js) ──────────────────────────────────────
$default_stats = [
    [ 'number' => '24', 'suffix' => '',  'label' => 'ACTIVE PROJECTS', 'decimals' => 0 ],
    [ 'number' => '18', 'suffix' => '',  'label' => 'COUNTRIES',       'decimals' => 0 ],
    [ 'number' => '12', 'suffix' => '',  'label' => 'YEARS ACTIVE',    'decimals' => 0 ],
    [ 'number' => '4.2','suffix' => 'M', 'label' => 'HECTARES',        'decimals' => 1 ],
];
$default_expertise = [
    [ 'subtitle' => 'Seeds',       'title' => 'Strategic Communication & Branding',       'desc' => 'Where ideas take shape. Crafting narratives and communication strategies that allow complex agendas to take root.',                                                                       'tags' => "Microsoft Mkt & Operations - Europe HQ\nIberia Airlines – Proudly Serving ARAEX Wines\nMercedes Benz Trophy – Villa Conchi Cava" ],
    [ 'subtitle' => 'Roots',       'title' => 'Global Partnerships & Platforms',           'desc' => 'Strong initiatives grow through connection. Designing international platforms and partnerships that bring institutions, sectors and regions together.',                                     'tags' => "Wine Routes of the World, Publication– UN Tourism\nSpanish Fine Wines Institute – ICEX\nOECD Webinars" ],
    [ 'subtitle' => 'Growth',      'title' => 'Institutional Transformation & Innovation', 'desc' => 'Creating environments where change can grow. Supporting organizations in transformation, new ways of working and institutional innovation.',                                               'tags' => "World Bank Workplace Standards – Change Management\nMission 300 - COMESA & WB Partnership Community of Practice" ],
    [ 'subtitle' => 'Territories', 'title' => 'Cities, Tourism & Territorial Development', 'desc' => 'Places matter. Projects focused on cities, regional identity, tourism and sustainable territorial strategies.',                                                                          'tags' => "Vitoria-Gasteiz Urban Innovation 2030 Agenda\nIDB Regional Housing Forum (Mexico)\nIDB – U20 Brazil during G20, Mayors Summit" ],
    [ 'subtitle' => 'Climate',     'title' => 'Sustainability & Environmental Initiatives', 'desc' => 'Healthy ecosystems enable long-term growth. Communication and initiatives supporting climate transition and sustainability agendas.',                                                    'tags' => "COP16 Cali - Knowledge Platform\nCOP30 Belen - Amazonian Cities Network" ],
];
$default_about_paras = [
    [ 'paragraph' => 'The Basque Country has a strong sense of place. Mountains, forests and coastlines are not just scenery, but part of daily life and identity. That early connection to territory shaped how I see the world: local roots matter, but ideas travel.' ],
    [ 'paragraph' => 'Curiosity about that wider world led me to study communication and international relations, exploring how narratives, institutions and cultures interact across borders.' ],
    [ 'paragraph' => 'My career began in the private sector coordinating international initiatives and partnerships across Europe and global markets. Over time my work moved closer to sustainability, cities and international cooperation, leading to collaborations with organizations such as the Inter-American Development Bank and later the World Bank Group.' ],
    [ 'paragraph' => 'Today my work focuses on helping institutions translate complex agendas into initiatives that people can understand, support and grow.' ],
];
$default_about_stats = [
    [ 'number' => '18+', 'label' => 'Countries' ],
    [ 'number' => '60+', 'label' => 'Projects Led' ],
    [ 'number' => '12',  'label' => 'Years Active' ],
    [ 'number' => 'UN',  'label' => 'Collaborator' ],
];

// ── HERO ─────────────────────────────────────────────────────────────────────
$hero_video          = get_field( 'hero_video', $page_id ) ?: 'kling-3.0_A_hyper-realistic_cinematic_shot_of_planet_Earth_floating_in_deep_space._The_cam-0.mp4';
$hero_subtitle       = get_field( 'hero_subtitle', $page_id ) ?: 'Turning complex agendas into living initiatives';
$hero_heading        = mikel_tagged( get_field( 'hero_heading', $page_id ) ?: 'From local roots to [global impact]' );
$hero_based_in       = get_field( 'hero_based_in', $page_id ) ?: 'Basque Country';
$hero_active_since   = get_field( 'hero_active_since', $page_id ) ?: '2012';
$hero_projects_count = get_field( 'hero_projects_count', $page_id ) ?: '55+';

// ── INTRO ─────────────────────────────────────────────────────────────────────
$intro_heading   = mikel_tagged( get_field( 'intro_heading', $page_id ) ?: 'Cultivating [Ideas] That Grow Into Impact' );
$intro_paragraph = get_field( 'intro_paragraph', $page_id ) ?: 'Turning complex ideas into living initiatives that connect institutions, people and places. From global agendas to tangible action.';

// ── PROJECTS ──────────────────────────────────────────────────────────────────
$projects_heading   = mikel_tagged( get_field( 'projects_heading', $page_id ) ?: 'Ideas need [fertile ground] to grow' );
$projects_paragraph = get_field( 'projects_paragraph', $page_id ) ?: 'Every initiative begins as an idea. Some remain concepts. Others take root, connect people and grow into real change. I help institutions turn complex ideas into initiatives that connect places, people, policies and reimagine territories through innovation.';
$projects_stats_raw = get_field( 'projects_stats', $page_id );
$projects_stats     = ( $projects_stats_raw && count( $projects_stats_raw ) ) ? $projects_stats_raw : $default_stats;

// ── EXPERTISE ─────────────────────────────────────────────────────────────────
$expertise_cards_raw = get_field( 'expertise_cards', $page_id );
$expertise_cards     = ( $expertise_cards_raw && count( $expertise_cards_raw ) ) ? $expertise_cards_raw : $default_expertise;

// ── ABOUT ─────────────────────────────────────────────────────────────────────
$about_photo       = get_field( 'about_photo', $page_id ) ?: home_url( '/Mikel/image.png' );
$about_name        = get_field( 'about_name', $page_id ) ?: 'Mikel Saez de Vicuña Blanco';
$about_headline    = mikel_tagged( get_field( 'about_headline', $page_id ) ?: 'From Local Roots to [Global Impact]' );
$about_paras_raw   = get_field( 'about_paragraphs', $page_id );
$about_paragraphs  = ( $about_paras_raw && count( $about_paras_raw ) ) ? $about_paras_raw : $default_about_paras;
$about_cta         = get_field( 'about_cta', $page_id ) ?: "LET'S COLLABORATE";
$about_stats_raw   = get_field( 'about_stats', $page_id );
$about_stats       = ( $about_stats_raw && count( $about_stats_raw ) ) ? $about_stats_raw : $default_about_stats;

// ── IMPACT ────────────────────────────────────────────────────────────────────
$impact_heading = mikel_tagged( get_field( 'impact_heading', $page_id ) ?: 'Ideas that [took root]' );
$impact_p1      = get_field( 'impact_p1', $page_id ) ?: 'Over the past decade I have worked across continents, sectors and institutions helping ideas grow into initiatives with real impact.';
$impact_p2      = get_field( 'impact_p2', $page_id ) ?: 'From international platforms and global events to urban sustainability programs and institutional transformation projects, my role has focused on connecting strategy, communication and partnerships. Many of these initiatives have brought together public institutions, private sector actors and civil society organizations to translate complex agendas into collaborative action.';
$impact_logos   = get_field( 'impact_logos', $page_id ) ?: [];

// ── CONTACT ───────────────────────────────────────────────────────────────────
$contact_heading   = mikel_tagged( get_field( 'contact_heading', $page_id ) ?: "Let's cultivate [something meaningful]" );
$contact_paragraph = get_field( 'contact_paragraph', $page_id ) ?: 'Open to collaboration on international initiatives, communication strategy and sustainability projects.';
$contact_email     = get_field( 'contact_email', $page_id ) ?: 'hello@mikelsaez.com';
$contact_linkedin  = get_field( 'contact_linkedin', $page_id ) ?: '#';

// ── FOOTER ────────────────────────────────────────────────────────────────────
$footer_text = get_field( 'footer_text', $page_id ) ?: '© ' . date('Y') . ' Mikel Saez. All rights reserved.';

// ── MAP PINS (JS data) ────────────────────────────────────────────────────────
$default_pins = [
    [ 'pin_id'=>'1',  'pin_country'=>'Europe',              'pin_title'=>'Microsoft Mkt & Operations Europa HQ',              'pin_category'=>'SEEDS',      'pin_class'=>'pin-gold',   'pin_image'=>'', 'pin_desc'=>'Marketing and Operations support to Europe HQ team, in NATO and EU Institutions stakeholders coordination events.',                                                                                              'pin_x'=>48, 'pin_y'=>29 ],
    [ 'pin_id'=>'2',  'pin_country'=>'Spain',               'pin_title'=>'Iberia Airlines – Inflight Wine & Dining Experience','pin_category'=>'SEEDS',      'pin_class'=>'pin-gold',   'pin_image'=>'', 'pin_desc'=>'Strategic communication and branding coordination for pioneering wines serving in all business class routes.',                                                                                                    'pin_x'=>40, 'pin_y'=>30 ],
    [ 'pin_id'=>'3',  'pin_country'=>'Spain',               'pin_title'=>'Mercedes Benz Fashion Week & Golf Trophy',           'pin_category'=>'SEEDS',      'pin_class'=>'pin-gold',   'pin_image'=>'', 'pin_desc'=>'Strategic communication and branding support for Madrid Fashion Week and Golf Trophy Tournament.',                                                                                                               'pin_x'=>41, 'pin_y'=>45 ],
    [ 'pin_id'=>'4',  'pin_country'=>'Global',              'pin_title'=>'"Wine Routes of the World" – UN Tourism',            'pin_category'=>'ROOTS',      'pin_class'=>'pin-green',  'pin_image'=>'', 'pin_desc'=>'Designing international platforms and partnerships across institutions, sectors and regions.',                                                                                                                   'pin_x'=>42, 'pin_y'=>33 ],
    [ 'pin_id'=>'5',  'pin_country'=>'Spain',               'pin_title'=>'Spanish Fine Wines Institute – ICEX',                'pin_category'=>'ROOTS',      'pin_class'=>'pin-green',  'pin_image'=>'', 'pin_desc'=>'Designing international knowledge and learning platforms across institutions, sectors and wine regions.',                                                                                                       'pin_x'=>44, 'pin_y'=>50 ],
    [ 'pin_id'=>'6',  'pin_country'=>'Africa',              'pin_title'=>'Mission 300 - Africa Energy Summit (Comesa)',         'pin_category'=>'ROOTS',      'pin_class'=>'pin-orange', 'pin_image'=>'', 'pin_desc'=>'Supporting the coordination of Community of Practice, knowledge products, webinars forum sessions and workshops with partnerships across the region.',                                                         'pin_x'=>48, 'pin_y'=>28 ],
    [ 'pin_id'=>'7',  'pin_country'=>'USA',                 'pin_title'=>'World Bank Workplace Standards – Change Management',  'pin_category'=>'GROWTH',     'pin_class'=>'pin-blue',   'pin_image'=>'', 'pin_desc'=>'Supporting organizations teams worldwide in transformation, new ways of working and institutional innovation, enabling change.',                                                                                 'pin_x'=>26, 'pin_y'=>33 ],
    [ 'pin_id'=>'8',  'pin_country'=>'Spain (Basque Country)','pin_title'=>'Vitoria-Gasteiz Urban Innovation',                 'pin_category'=>'TERRITORIES','pin_class'=>'pin-orange', 'pin_image'=>'', 'pin_desc'=>'Projects focused on cities, local identity, sustainable development and 2030 Agenda territorial strategies.',                                                                                                  'pin_x'=>52, 'pin_y'=>30 ],
    [ 'pin_id'=>'9',  'pin_country'=>'Mexico',              'pin_title'=>'IDB Regional Housing Forum',                         'pin_category'=>'TERRITORIES','pin_class'=>'pin-orange', 'pin_image'=>'', 'pin_desc'=>'Projects focused on housing market, regional development, urban and sustainable territorial strategies.',                                                                                                      'pin_x'=>20, 'pin_y'=>45 ],
    [ 'pin_id'=>'10', 'pin_country'=>'Brazil',              'pin_title'=>'IDB – Brazil G20 Mayors Summit',                     'pin_category'=>'TERRITORIES','pin_class'=>'pin-orange', 'pin_image'=>'', 'pin_desc'=>'Latin American Mayors Network Summit, focused on cities, regional development, lesson learned and sustainable territorial strategies.',                                                                        'pin_x'=>34, 'pin_y'=>60 ],
    [ 'pin_id'=>'11', 'pin_country'=>'Colombia',            'pin_title'=>'COP16 & COP30 - Amazon Cities Network',              'pin_category'=>'CLIMATE',    'pin_class'=>'pin-pink',   'pin_image'=>'', 'pin_desc'=>'Community of Practice and communication initiatives supporting climate transition lessons learned and sustainability agendas from Amazonian cities best practices.',                                             'pin_x'=>23, 'pin_y'=>55 ],
    [ 'pin_id'=>'12', 'pin_country'=>'Asia',                'pin_title'=>'VINEXPO Shanghai & Hong Kong',                       'pin_category'=>'TERRITORIES','pin_class'=>'pin-orange', 'pin_image'=>'', 'pin_desc'=>'Trade show stand design and build, with coordinated brand presence and sales campaigns to grow market share in Asia.',                                                                                        'pin_x'=>75, 'pin_y'=>38 ],
];
$map_pins_raw = get_field( 'map_pins', $page_id ) ?: [];
$map_pins_raw = ( $map_pins_raw && count( $map_pins_raw ) ) ? $map_pins_raw : $default_pins;
$map_pins_js  = [];
foreach ( $map_pins_raw as $pin ) {
    $map_pins_js[] = [
        'id'       => $pin['pin_id'] ?? uniqid(),
        'country'  => $pin['pin_country'] ?? '',
        'title'    => $pin['pin_title'] ?? '',
        'category' => $pin['pin_category'] ?? '',
        'pinClass' => $pin['pin_class'] ?? 'pin-gold',
        'image'    => $pin['pin_image'] ?? '',
        'desc'     => $pin['pin_desc'] ?? '',
        'x'        => floatval( $pin['pin_x'] ?? 50 ),
        'y'        => floatval( $pin['pin_y'] ?? 50 ),
    ];
}

// ── LOGOS (JS data) ───────────────────────────────────────────────────────────
$logos_js = [];
foreach ( $impact_logos as $logo ) {
    $logos_js[] = [
        'src' => $logo['logo_image'] ?? '',
        'alt' => $logo['logo_alt'] ?? '',
    ];
}

// ── SVG ICONS per expertise subtitle ─────────────────────────────────────────
$exp_icons = [
    'Seeds'       => '<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><ellipse cx="20" cy="26" rx="7" ry="9" stroke="#C4B99A" stroke-width="1.5"/><line x1="20" y1="17" x2="20" y2="8" stroke="#C4B99A" stroke-width="1.5" stroke-linecap="round"/><path d="M20 14 Q14 11 13 6" stroke="#C4B99A" stroke-width="1.5" stroke-linecap="round" fill="none"/></svg>',
    'Roots'       => '<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><line x1="20" y1="8" x2="20" y2="20" stroke="#C4B99A" stroke-width="1.5" stroke-linecap="round"/><line x1="20" y1="20" x2="11" y2="32" stroke="#C4B99A" stroke-width="1.5" stroke-linecap="round"/><line x1="20" y1="20" x2="29" y2="32" stroke="#C4B99A" stroke-width="1.5" stroke-linecap="round"/><line x1="20" y1="26" x2="14" y2="34" stroke="#C4B99A" stroke-width="1.5" stroke-linecap="round"/><line x1="20" y1="26" x2="26" y2="34" stroke="#C4B99A" stroke-width="1.5" stroke-linecap="round"/></svg>',
    'Growth'      => '<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><line x1="20" y1="36" x2="20" y2="8" stroke="#C4B99A" stroke-width="1.5" stroke-linecap="round"/><path d="M20 28 Q13 24 13 17" stroke="#C4B99A" stroke-width="1.5" stroke-linecap="round" fill="none"/><path d="M20 20 Q27 16 27 9" stroke="#C4B99A" stroke-width="1.5" stroke-linecap="round" fill="none"/><path d="M20 14 Q14 11 14 6" stroke="#C4B99A" stroke-width="1.5" stroke-linecap="round" fill="none"/></svg>',
    'Territories' => '<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="5" y="20" width="8" height="14" stroke="#C4B99A" stroke-width="1.5" stroke-linejoin="round"/><rect x="16" y="13" width="8" height="21" stroke="#C4B99A" stroke-width="1.5" stroke-linejoin="round"/><rect x="27" y="17" width="8" height="17" stroke="#C4B99A" stroke-width="1.5" stroke-linejoin="round"/><line x1="3" y1="34" x2="37" y2="34" stroke="#C4B99A" stroke-width="1.5" stroke-linecap="round"/></svg>',
    'Climate'     => '<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="14" stroke="#C4B99A" stroke-width="1.5"/><path d="M20 6 Q26 13 26 20 Q26 27 20 34" stroke="#C4B99A" stroke-width="1.5" stroke-linecap="round" fill="none"/><path d="M20 6 Q14 13 14 20 Q14 27 20 34" stroke="#C4B99A" stroke-width="1.5" stroke-linecap="round" fill="none"/><line x1="6" y1="20" x2="34" y2="20" stroke="#C4B99A" stroke-width="1.5" stroke-linecap="round"/></svg>',
];

// ── WORLD SVG MAP ─────────────────────────────────────────────────────────────
$svg_path  = get_template_directory() . '/assets/world.svg';
$world_svg = '';
if ( file_exists( $svg_path ) ) {
    $world_svg = file_get_contents( $svg_path );
    // 1. Remove XML declaration
    $world_svg = preg_replace( '/<\?xml[^?]*\?>\s*/i', '', $world_svg );
    // 2. Remove top-level comments (e.g. "Generator: Adobe Illustrator...")
    $world_svg = preg_replace( '/<!--.*?-->\s*/s', '', $world_svg );
    // 3. Replace the opening <svg ...> tag with a clean one that only keeps viewBox and xmlns
    //    Preserve viewBox value from original
    preg_match( '/viewBox=["\']([^"\']+)["\']/', $world_svg, $vb_match );
    $viewbox = $vb_match[1] ?? '0 0 950 620';
    $world_svg = preg_replace(
        '/<svg\b[^>]*>/s',
        '<svg class="world-map-svg" xmlns="http://www.w3.org/2000/svg" viewBox="' . esc_attr( $viewbox ) . '" preserveAspectRatio="xMidYMid meet" width="100%" height="auto">',
        $world_svg,
        1
    );
}

// ── VIDEO URL ─────────────────────────────────────────────────────────────────
// Try uploads first, then fallback to legacy /Mikel/ folder
$video_url = ( strpos( $hero_video, 'http' ) === 0 )
    ? $hero_video
    : home_url( '/Mikel/' . $hero_video );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- Cursors -->
<div class="cursor-dot"></div>
<div class="cursor-glow"></div>

<!-- NAV -->
<nav>
    <div class="logo"><?php echo esc_html( $about_name ); ?></div>
    <div class="nav-links">
        <a href="#projects">WORK</a>
        <a href="#world-map">MAP</a>
        <a href="#about">ABOUT</a>
        <a href="#contact">CONTACT</a>
    </div>
    <button class="nav-hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
    </button>
</nav>

<!-- MOBILE NAV OVERLAY -->
<nav class="mobile-nav" aria-label="Mobile navigation">
    <button class="mobile-nav-close" aria-label="Close menu">✕</button>
    <a href="#projects">WORK</a>
    <a href="#world-map">MAP</a>
    <a href="#about">ABOUT</a>
    <a href="#contact">CONTACT</a>
</nav>

<!-- ═══ HERO ═══════════════════════════════════════════════════════════════ -->
<section class="hero">
    <div class="video-container">
        <video class="hero-video" autoplay muted loop playsinline>
            <source src="<?php echo esc_url( $video_url ); ?>" type="video/mp4">
        </video>
        <div class="overlay"></div>
    </div>
    <div class="hero-fade-bottom"></div>

    <div class="hero-content">
        <div class="subtitle"><?php echo esc_html( $hero_subtitle ); ?></div>
        <h1 class="main-title"><?php echo $hero_heading; ?></h1>
    </div>

    <div class="bottom-bar">
        <div class="bottom-col left">
            <div class="label">BASED IN</div>
            <div class="value italic"><?php echo esc_html( $hero_based_in ); ?></div>
        </div>
        <div class="bottom-col center">
            <div class="label">DISCOVER</div>
            <div class="animated-line-container"><div class="animated-line"></div></div>
            <div class="label">ACTIVE SINCE</div>
            <div class="value"><?php echo esc_html( $hero_active_since ); ?></div>
        </div>
        <div class="bottom-col right">
            <div class="label">PROJECTS</div>
            <div class="value"><?php echo esc_html( $hero_projects_count ); ?></div>
        </div>
    </div>
</section>

<!-- ═══ INTRO ══════════════════════════════════════════════════════════════ -->
<section class="intro-section" id="intro">
    <h2 class="intro-heading serif"><?php echo $intro_heading; ?></h2>
    <div class="intro-divider"></div>
    <p class="intro-paragraph"><?php echo esc_html( $intro_paragraph ); ?></p>
</section>

<!-- ═══ PROJECTS ═══════════════════════════════════════════════════════════ -->
<section class="projects-section" id="projects">
    <div class="projects-inner">
        <div class="projects-label-container">
            <div class="projects-line"></div>
            <div class="projects-label">PROJECTS IN GROWTH</div>
        </div>
        <h2 class="projects-heading serif"><?php echo $projects_heading; ?></h2>
        <p class="projects-paragraph"><?php echo esc_html( $projects_paragraph ); ?></p>
        <div class="projects-stats-grid">
            <?php foreach ( $projects_stats as $stat ) :
                $num    = esc_html( $stat['number'] ?? '0' );
                $suffix = esc_html( $stat['suffix'] ?? '' );
                $lbl    = esc_html( $stat['label']  ?? '' );
            ?>
            <div class="stat-item">
                <div class="stat-number-wrapper">
                    <span class="stat-number"><?php echo $num; ?></span><?php if ( $suffix ) : ?><span class="stat-suffix"><?php echo $suffix; ?></span><?php endif; ?>
                </div>
                <div class="stat-label"><?php echo $lbl; ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ═══ EXPERTISE ══════════════════════════════════════════════════════════ -->
<section class="expertise-section" id="expertise">
    <div class="expertise-label-container" id="exp-label">
        <div class="projects-line"></div>
        <div class="projects-label">EXPERTISE</div>
    </div>
    <h2 class="expertise-heading" id="exp-heading">Ideas grow where <i>collaboration takes root</i></h2>
    <div class="expertise-grid">
        <?php foreach ( $expertise_cards as $idx => $card ) :
            $subtitle = $card['subtitle'] ?? '';
            $title    = esc_html( $card['title'] ?? '' );
            $desc     = esc_html( $card['desc'] ?? '' );
            $tags_raw = $card['tags'] ?? '';
            $tags     = array_filter( array_map( 'trim', explode( "\n", $tags_raw ) ) );
            $icon     = $exp_icons[ $subtitle ] ?? $exp_icons['Seeds'];
            $num_pad  = str_pad( $idx + 1, 2, '0', STR_PAD_LEFT );
        ?>
        <div class="exp-card" id="exp-card-<?php echo $idx + 1; ?>">
            <span class="exp-number"><?php echo $num_pad; ?></span>
            <span class="exp-icon"><?php echo $icon; ?></span>
            <div class="exp-subtitle"><?php echo esc_html( $subtitle ); ?></div>
            <h3 class="exp-title"><?php echo $title; ?></h3>
            <p class="exp-desc"><?php echo $desc; ?></p>
            <div class="exp-projects">
                <?php foreach ( $tags as $tag ) : ?>
                <span class="exp-tag"><?php echo esc_html( $tag ); ?></span>
                <?php endforeach; ?>
            </div>
            <span class="exp-arrow">→</span>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- ═══ MAP ════════════════════════════════════════════════════════════════ -->
<section class="map-section" id="world-map">
    <div class="map-header">
        <div class="map-header-label">— ROUTES</div>
        <h2 class="serif map-header-heading">Cultivating ideas that <i style="color:#C4B99A;">travel across borders</i></h2>
    </div>
    <div class="map-glow"></div>
    <div class="map-container" id="mapCtn">
        <?php echo $world_svg; ?>
        <!-- Pins rendered by JS -->
        <div class="map-tooltip" id="mapTooltip">
            <div class="tooltip-image" id="ttImage"><span class="tooltip-image-placeholder">Project Image</span></div>
            <div class="tooltip-category" id="ttCat"></div>
            <div class="tooltip-title" id="ttTitle"></div>
            <div class="tooltip-tags" id="ttTags"></div>
            <div class="tooltip-desc" id="ttDesc"></div>
        </div>
    </div>
</section>

<!-- ═══ ABOUT ══════════════════════════════════════════════════════════════ -->
<section class="about-section" id="about">
    <div class="about-inner">
        <div class="about-media">
            <div class="about-media-inner">
                <img src="<?php echo esc_url( $about_photo ); ?>" alt="<?php echo esc_attr( $about_name ); ?>">
            </div>
        </div>
        <div class="about-content">
            <div class="about-content-top">
                <div class="about-eyebrow" id="ab-eyebrow">&#8212; ABOUT</div>
                <div class="about-person-name"><?php echo esc_html( $about_name ); ?></div>
                <h2 class="about-headline" id="ab-headline"><?php echo $about_headline; ?></h2>
                <div class="about-body" id="ab-body">
                    <?php foreach ( $about_paragraphs as $para ) : ?>
                    <p><?php echo esc_html( $para['paragraph'] ); ?></p>
                    <?php endforeach; ?>
                </div>
                <a href="#contact" class="about-cta" id="ab-cta"><?php echo esc_html( $about_cta ); ?> <span>&#8594;</span></a>
            </div>
            <div>
                <div class="about-divider" id="ab-divider"></div>
                <div class="about-stats" id="ab-stats">
                    <?php foreach ( $about_stats as $stat ) : ?>
                    <div class="about-stat-item">
                        <div class="about-stat-num"><?php echo esc_html( $stat['number'] ); ?></div>
                        <div class="about-stat-label"><?php echo esc_html( $stat['label'] ); ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══ IMPACT ═════════════════════════════════════════════════════════════ -->
<section class="impact-section" id="impact">
    <div class="impact-inner">
        <div class="impact-label-container">
            <div class="impact-line"></div>
            <div class="impact-label">IMPACT</div>
        </div>
        <h2 class="impact-heading" id="impact-heading"><?php echo $impact_heading; ?></h2>
        <div class="impact-body" id="impact-body">
            <?php if ( $impact_p1 ) : ?><p><?php echo esc_html( $impact_p1 ); ?></p><?php endif; ?>
            <?php if ( $impact_p2 ) : ?><p><?php echo esc_html( $impact_p2 ); ?></p><?php endif; ?>
        </div>
        <div class="impact-logos-label">Worked with</div>
        <div class="impact-logos-wrap">
            <div class="impact-logos" id="impact-logos">
                <?php if ( empty( $impact_logos ) ) : ?>
                <div class="impact-logo-item"><span>Logo</span></div>
                <div class="impact-logo-item"><span>Logo</span></div>
                <div class="impact-logo-item"><span>Logo</span></div>
                <div class="impact-logo-item"><span>Logo</span></div>
                <?php endif; ?>
            </div>
            <div class="impact-logos-nav" id="impact-logos-nav" style="display:none">
                <button class="ic-btn ic-prev" aria-label="Anterior">&#8592;</button>
                <span class="ic-counter"></span>
                <button class="ic-btn ic-next" aria-label="Siguiente">&#8594;</button>
            </div>
        </div>
    </div>
</section>

<!-- ═══ CONTACT ════════════════════════════════════════════════════════════ -->
<section class="contact-section" id="contact">
    <h2 class="contact-heading"><?php echo $contact_heading; ?></h2>
    <p class="contact-body"><?php echo esc_html( $contact_paragraph ); ?></p>
    <div class="contact-links">
        <?php if ( $contact_email ) : ?>
        <a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="contact-link">Email</a>
        <?php endif; ?>
        <?php if ( $contact_linkedin && $contact_linkedin !== '#' ) : ?>
        <a href="<?php echo esc_url( $contact_linkedin ); ?>" target="_blank" rel="noopener noreferrer" class="contact-link">LinkedIn</a>
        <?php endif; ?>
    </div>
</section>

<!-- ═══ FOOTER ═════════════════════════════════════════════════════════════ -->
<footer class="site-footer">
    <p><?php echo esc_html( $footer_text ); ?></p>
</footer>

<!-- JS data — injected inline so it's available before main.js runs -->
<script>
window.mikelData = <?php echo wp_json_encode( [ 'pins' => $map_pins_js, 'logos' => $logos_js ] ); ?>;
</script>

<?php wp_footer(); ?>
</body>
</html>

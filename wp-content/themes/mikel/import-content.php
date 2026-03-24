<?php
/**
 * Importador de contenido Mikel Saez → ACF
 * Uso: visita /wp-content/themes/mikel/import-content.php desde el navegador
 * Solo funciona si estás logueado como administrador de WordPress.
 *
 * BORRA O RENOMBRA ESTE ARCHIVO después de importar.
 */

// Bootstrap WordPress
$wp_root = dirname( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) );
require_once $wp_root . '/wp-load.php';

// Solo admins
if ( ! current_user_can( 'manage_options' ) ) {
    wp_die( 'Acceso denegado. Debes estar logueado como administrador.' );
}

// Verificar que ACF está activo
if ( ! function_exists( 'update_field' ) ) {
    wp_die( 'ACF Pro no está activo. Actívalo primero.' );
}

// Obtener el ID de la página de inicio
$page_id = get_option( 'page_on_front' );
if ( ! $page_id ) {
    wp_die( 'No hay una página estática configurada como portada. Ve a Ajustes → Lectura y configura "Una página estática".' );
}

$done = [];
$errors = [];

function ms_save( $field, $value, $page_id ) {
    $result = update_field( $field, $value, $page_id );
    return $result;
}

// ═══════════════════════════════════════════════════════════════
// HERO
// ═══════════════════════════════════════════════════════════════
ms_save( 'hero_video',          'kling-3.0_A_hyper-realistic_cinematic_shot_of_planet_Earth_floating_in_deep_space._The_cam-0.mp4', $page_id );
ms_save( 'hero_subtitle',       'Turning complex agendas into living initiatives', $page_id );
ms_save( 'hero_heading',        'From local roots to [global impact]', $page_id );
ms_save( 'hero_based_in',       'Basque Country', $page_id );
ms_save( 'hero_active_since',   '2012', $page_id );
ms_save( 'hero_projects_count', '55+', $page_id );
$done[] = 'Hero';

// ═══════════════════════════════════════════════════════════════
// INTRO
// ═══════════════════════════════════════════════════════════════
ms_save( 'intro_heading',   'Cultivating [Ideas] That Grow Into Impact', $page_id );
ms_save( 'intro_paragraph', 'Turning complex ideas into living initiatives that connect institutions, people and places. From global agendas to tangible action.', $page_id );
$done[] = 'Intro';

// ═══════════════════════════════════════════════════════════════
// PROYECTOS
// ═══════════════════════════════════════════════════════════════
ms_save( 'projects_heading',   'Ideas need [fertile ground] to grow', $page_id );
ms_save( 'projects_paragraph', 'Every initiative begins as an idea. Some remain concepts. Others take root, connect people and grow into real change. I help institutions turn complex ideas into initiatives that connect places, people, policies and reimagine territories through innovation.', $page_id );
ms_save( 'projects_stats', [
    [ 'number' => '24',  'suffix' => '',  'label' => 'ACTIVE PROJECTS', 'decimals' => 0 ],
    [ 'number' => '18',  'suffix' => '',  'label' => 'COUNTRIES',       'decimals' => 0 ],
    [ 'number' => '12',  'suffix' => '',  'label' => 'YEARS ACTIVE',    'decimals' => 0 ],
    [ 'number' => '4.2', 'suffix' => 'M', 'label' => 'HECTARES',        'decimals' => 1 ],
], $page_id );
$done[] = 'Proyectos + Estadísticas';

// ═══════════════════════════════════════════════════════════════
// EXPERTISE
// ═══════════════════════════════════════════════════════════════
ms_save( 'expertise_cards', [
    [
        'subtitle' => 'Seeds',
        'title'    => 'Strategic Communication & Branding',
        'desc'     => 'Where ideas take shape. Crafting narratives and communication strategies that allow complex agendas to take root.',
        'tags'     => "Microsoft Mkt & Operations - Europe HQ\nIberia Airlines – Proudly Serving ARAEX Wines\nMercedes Benz Trophy – Villa Conchi Cava",
    ],
    [
        'subtitle' => 'Roots',
        'title'    => 'Global Partnerships & Platforms',
        'desc'     => 'Strong initiatives grow through connection. Designing international platforms and partnerships that bring institutions, sectors and regions together.',
        'tags'     => "Wine Routes of the World, Publication– UN Tourism\nSpanish Fine Wines Institute – ICEX\nOECD Webinars",
    ],
    [
        'subtitle' => 'Growth',
        'title'    => 'Institutional Transformation & Innovation',
        'desc'     => 'Creating environments where change can grow. Supporting organizations in transformation, new ways of working and institutional innovation.',
        'tags'     => "World Bank Workplace Standards – Change Management\nMission 300 - COMESA & WB Partnership Community of Practice",
    ],
    [
        'subtitle' => 'Territories',
        'title'    => 'Cities, Tourism & Territorial Development',
        'desc'     => 'Places matter. Projects focused on cities, regional identity, tourism and sustainable territorial strategies.',
        'tags'     => "Vitoria-Gasteiz Urban Innovation 2030 Agenda\nIDB Regional Housing Forum (Mexico)\nIDB – U20 Brazil during G20, Mayors Summit",
    ],
    [
        'subtitle' => 'Climate',
        'title'    => 'Sustainability & Environmental Initiatives',
        'desc'     => 'Healthy ecosystems enable long-term growth. Communication and initiatives supporting climate transition and sustainability agendas.',
        'tags'     => "COP16 Cali - Knowledge Platform\nCOP30 Belen - Amazonian Cities Network",
    ],
], $page_id );
$done[] = 'Expertise (5 tarjetas)';

// ═══════════════════════════════════════════════════════════════
// ABOUT (foto: se sube manualmente desde WP Media Library)
// ═══════════════════════════════════════════════════════════════
ms_save( 'about_name',     'Mikel Saez de Vicuña Blanco', $page_id );
ms_save( 'about_headline', 'From Local Roots to [Global Impact]', $page_id );
ms_save( 'about_paragraphs', [
    [ 'paragraph' => 'The Basque Country has a strong sense of place. Mountains, forests and coastlines are not just scenery, but part of daily life and identity. That early connection to territory shaped how I see the world: local roots matter, but ideas travel.' ],
    [ 'paragraph' => 'Curiosity about that wider world led me to study communication and international relations, exploring how narratives, institutions and cultures interact across borders.' ],
    [ 'paragraph' => 'My career began in the private sector coordinating international initiatives and partnerships across Europe and global markets. Over time my work moved closer to sustainability, cities and international cooperation, leading to collaborations with organizations such as the Inter-American Development Bank and later the World Bank Group.' ],
    [ 'paragraph' => 'Today my work focuses on helping institutions translate complex agendas into initiatives that people can understand, support and grow.' ],
], $page_id );
ms_save( 'about_cta', "LET'S COLLABORATE", $page_id );
ms_save( 'about_stats', [
    [ 'number' => '18+', 'label' => 'Countries' ],
    [ 'number' => '60+', 'label' => 'Projects Led' ],
    [ 'number' => '12',  'label' => 'Years Active' ],
    [ 'number' => 'UN',  'label' => 'Collaborator' ],
], $page_id );
$done[] = 'About (sin foto — súbela desde Medios → Campo "Foto" en ACF)';

// ═══════════════════════════════════════════════════════════════
// IMPACT (logos: se suben manualmente)
// ═══════════════════════════════════════════════════════════════
ms_save( 'impact_heading', 'Ideas that [took root]', $page_id );
ms_save( 'impact_p1', 'Over the past decade I have worked across continents, sectors and institutions helping ideas grow into initiatives with real impact.', $page_id );
ms_save( 'impact_p2', 'From international platforms and global events to urban sustainability programs and institutional transformation projects, my role has focused on connecting strategy, communication and partnerships. Many of these initiatives have brought together public institutions, private sector actors and civil society organizations to translate complex agendas into collaborative action.', $page_id );
$done[] = 'Impact (logos: súbelos manualmente desde el editor de la página)';

// ═══════════════════════════════════════════════════════════════
// CONTACTO
// ═══════════════════════════════════════════════════════════════
ms_save( 'contact_heading',   "Let's cultivate [something meaningful]", $page_id );
ms_save( 'contact_paragraph', 'Open to collaboration on international initiatives, communication strategy and sustainability projects.', $page_id );
ms_save( 'contact_email',     'hello@mikelsaez.com', $page_id );
ms_save( 'contact_linkedin',  'https://www.linkedin.com/in/mikelvicuna/', $page_id );
$done[] = 'Contacto';

// ═══════════════════════════════════════════════════════════════
// FOOTER
// ═══════════════════════════════════════════════════════════════
ms_save( 'footer_text', '© 2026 Mikel Saez de Vicuna. All rights reserved.', $page_id );
$done[] = 'Footer';

// ═══════════════════════════════════════════════════════════════
// MAPA — PINS
// ═══════════════════════════════════════════════════════════════
ms_save( 'map_pins', [
    [
        'pin_id'       => '1',
        'pin_country'  => 'Europe',
        'pin_title'    => 'Microsoft Mkt & Operations Europa HQ',
        'pin_category' => 'SEEDS',
        'pin_class'    => 'pin-gold',
        'pin_image'    => '',
        'pin_desc'     => 'Marketing and Operations support to Europe HQ team, in NATO and EU Institutions stakeholders coordination events.',
        'pin_x'        => 48,
        'pin_y'        => 29,
    ],
    [
        'pin_id'       => '2',
        'pin_country'  => 'Spain',
        'pin_title'    => 'Iberia Airlines – Inflight Wine & Dining Experience Design',
        'pin_category' => 'SEEDS',
        'pin_class'    => 'pin-gold',
        'pin_image'    => '',
        'pin_desc'     => 'Strategic communication and branding coordination for pioneering wines serving in all business class routes.',
        'pin_x'        => 40,
        'pin_y'        => 30,
    ],
    [
        'pin_id'       => '3',
        'pin_country'  => 'Spain',
        'pin_title'    => 'Mercedes Benz Fashion Week & Golf Trophy',
        'pin_category' => 'SEEDS',
        'pin_class'    => 'pin-gold',
        'pin_image'    => '',
        'pin_desc'     => 'Strategic communication and branding support for Madrid Fashion Week and Golf Trophy Tournament.',
        'pin_x'        => 41,
        'pin_y'        => 45,
    ],
    [
        'pin_id'       => '4',
        'pin_country'  => 'Global',
        'pin_title'    => '"Wine Routes of the World" Book Publication – UN Tourism',
        'pin_category' => 'ROOTS',
        'pin_class'    => 'pin-green',
        'pin_image'    => '',
        'pin_desc'     => 'Designing international platforms and partnerships across institutions, sectors and regions.',
        'pin_x'        => 42,
        'pin_y'        => 33,
    ],
    [
        'pin_id'       => '5',
        'pin_country'  => 'Spain',
        'pin_title'    => 'Spanish Fine Wines Institute – ICEX',
        'pin_category' => 'ROOTS',
        'pin_class'    => 'pin-green',
        'pin_image'    => '',
        'pin_desc'     => 'Designing international knowledge and learning platforms across institutions, sectors and wine regions.',
        'pin_x'        => 44,
        'pin_y'        => 50,
    ],
    [
        'pin_id'       => '6',
        'pin_country'  => 'Africa',
        'pin_title'    => 'Mission 300 - Africa Energy Summit (Comesa)',
        'pin_category' => 'ROOTS',
        'pin_class'    => 'pin-orange',
        'pin_image'    => '',
        'pin_desc'     => 'Supporting the coordination of Community of Practice, knowledge products, webinars forum sessions and workshops with partnerships across the region.',
        'pin_x'        => 48,
        'pin_y'        => 28,
    ],
    [
        'pin_id'       => '7',
        'pin_country'  => 'USA',
        'pin_title'    => 'World Bank Workplace Standards – Change Management',
        'pin_category' => 'GROWTH',
        'pin_class'    => 'pin-blue',
        'pin_image'    => '',
        'pin_desc'     => 'Supporting organizations teams worldwide in transformation, new ways of working and institutional innovation, enabling change.',
        'pin_x'        => 26,
        'pin_y'        => 33,
    ],
    [
        'pin_id'       => '8',
        'pin_country'  => 'Spain (Basque Country)',
        'pin_title'    => 'Vitoria-Gasteiz Urban Innovation',
        'pin_category' => 'TERRITORIES',
        'pin_class'    => 'pin-orange',
        'pin_image'    => '',
        'pin_desc'     => 'Projects focused on cities, local identity, sustainable development and 2030 Agenda territorial strategies.',
        'pin_x'        => 52,
        'pin_y'        => 30,
    ],
    [
        'pin_id'       => '9',
        'pin_country'  => 'Mexico',
        'pin_title'    => 'IDB Regional Housing Forum',
        'pin_category' => 'TERRITORIES',
        'pin_class'    => 'pin-orange',
        'pin_image'    => '',
        'pin_desc'     => 'Projects focused on housing market, regional development, urban and sustainable territorial strategies.',
        'pin_x'        => 20,
        'pin_y'        => 45,
    ],
    [
        'pin_id'       => '10',
        'pin_country'  => 'Brazil',
        'pin_title'    => 'IDB – Brazil G20 Mayors Summit',
        'pin_category' => 'TERRITORIES',
        'pin_class'    => 'pin-orange',
        'pin_image'    => '',
        'pin_desc'     => 'Latin American Mayors Network Summit, focused on cities, regional development, lesson learned and sustainable territorial strategies.',
        'pin_x'        => 34,
        'pin_y'        => 60,
    ],
    [
        'pin_id'       => '11',
        'pin_country'  => 'Colombia',
        'pin_title'    => 'COP16 & COP30 - Amazon Cities Network',
        'pin_category' => 'CLIMATE',
        'pin_class'    => 'pin-pink',
        'pin_image'    => '',
        'pin_desc'     => 'Community of Practice and communication initiatives supporting climate transition lessons learned and sustainability agendas from Amazonian cities best practices.',
        'pin_x'        => 23,
        'pin_y'        => 55,
    ],
    [
        'pin_id'       => '12',
        'pin_country'  => 'Asia',
        'pin_title'    => 'VINEXPO Shanghai & Hong Kong',
        'pin_category' => 'TERRITORIES',
        'pin_class'    => 'pin-orange',
        'pin_image'    => '',
        'pin_desc'     => 'Trade show stand design and build, with coordinated brand presence and sales campaigns to grow market share in Asia.',
        'pin_x'        => 75,
        'pin_y'        => 38,
    ],
], $page_id );
$done[] = 'Mapa — 12 pins';

// ═══════════════════════════════════════════════════════════════
// RESULTADO
// ═══════════════════════════════════════════════════════════════
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Importador Mikel — Resultado</title>
<style>
  body { font-family: -apple-system, sans-serif; background: #0d1a0d; color: #d4c9a8; padding: 40px; max-width: 700px; margin: 0 auto; }
  h1 { color: #C4B99A; font-size: 22px; margin-bottom: 6px; }
  p.sub { color: rgba(212,201,168,0.5); font-size: 13px; margin-bottom: 32px; }
  .ok { background: rgba(196,185,154,0.08); border-left: 3px solid #8CB88C; padding: 10px 16px; margin: 8px 0; border-radius: 2px; font-size: 14px; }
  .ok::before { content: '✓  '; color: #8CB88C; }
  .warn { background: rgba(196,185,154,0.08); border-left: 3px solid #C4A96B; padding: 10px 16px; margin: 8px 0; border-radius: 2px; font-size: 14px; }
  .warn::before { content: '⚠  '; color: #C4A96B; }
  .actions { margin-top: 32px; display: flex; gap: 12px; flex-wrap: wrap; }
  a.btn { display: inline-block; background: #C4B99A; color: #1A2E1A; padding: 10px 24px; text-decoration: none; font-size: 12px; letter-spacing: 3px; text-transform: uppercase; font-weight: 600; border-radius: 2px; }
  a.btn.outline { background: none; border: 1px solid #C4B99A; color: #C4B99A; }
  .delete-note { margin-top: 24px; background: rgba(196,80,80,0.1); border-left: 3px solid #c47a7a; padding: 10px 16px; font-size: 13px; color: rgba(212,201,168,0.7); border-radius: 2px; }
</style>
</head>
<body>
<h1>Importación completada</h1>
<p class="sub">Página ID: <?php echo $page_id; ?></p>

<?php foreach ( $done as $item ) : ?>
<div class="ok"><?php echo esc_html( $item ); ?></div>
<?php endforeach; ?>

<div class="warn">Foto (about): sube <code>image.png</code> desde WordPress → Medios y asígnala en el editor de la página → campo "Foto"</div>
<div class="warn">Logos (impact): súbelos manualmente desde el editor de la página → tab "Impact" → campo "Logos"</div>
<div class="warn">Imágenes de pins: súbelas manualmente desde el editor → tab "Mapa / Pins" → campo "Imagen del proyecto"</div>

<div class="actions">
  <a class="btn" href="<?php echo home_url('/'); ?>" target="_blank">Ver portada →</a>
  <a class="btn outline" href="<?php echo admin_url('post.php?post=' . $page_id . '&action=edit'); ?>">Editar en ACF</a>
</div>

<div class="delete-note">
  <strong>Importante:</strong> elimina o renombra <code>import-content.php</code> después de importar para evitar re-ejecuciones accidentales.
</div>
</body>
</html>

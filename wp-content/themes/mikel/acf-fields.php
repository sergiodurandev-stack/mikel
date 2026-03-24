<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

add_action( 'acf/init', function() {

    acf_add_local_field_group( [
        'key'      => 'group_mikel_page',
        'title'    => 'Mikel Saez — Contenido de página',
        'fields'   => [

            // ── TAB: HERO ──────────────────────────────
            [ 'key' => 'field_tab_hero', 'label' => 'Hero', 'name' => '', 'type' => 'tab' ],
            [ 'key' => 'field_hero_video',         'label' => 'Video de fondo (nombre archivo)',  'name' => 'hero_video',         'type' => 'text' ],
            [ 'key' => 'field_hero_subtitle',      'label' => 'Texto pequeño encima del título',  'name' => 'hero_subtitle',      'type' => 'text' ],
            [ 'key' => 'field_hero_heading',       'label' => 'Título principal (usa [corchetes] para cursiva dorada)', 'name' => 'hero_heading',  'type' => 'text' ],
            [ 'key' => 'field_hero_based_in',      'label' => 'Ubicación (Based In)',             'name' => 'hero_based_in',      'type' => 'text' ],
            [ 'key' => 'field_hero_active_since',  'label' => 'Activo desde',                     'name' => 'hero_active_since',  'type' => 'text' ],
            [ 'key' => 'field_hero_projects_count','label' => 'Nº proyectos',                     'name' => 'hero_projects_count','type' => 'text' ],

            // ── TAB: INTRO ─────────────────────────────
            [ 'key' => 'field_tab_intro', 'label' => 'Intro', 'name' => '', 'type' => 'tab' ],
            [ 'key' => 'field_intro_heading',   'label' => 'Título (usa [corchetes])', 'name' => 'intro_heading',   'type' => 'text' ],
            [ 'key' => 'field_intro_paragraph', 'label' => 'Párrafo',                 'name' => 'intro_paragraph', 'type' => 'textarea', 'rows' => 3 ],

            // ── TAB: PROYECTOS ─────────────────────────
            [ 'key' => 'field_tab_projects', 'label' => 'Proyectos', 'name' => '', 'type' => 'tab' ],
            [ 'key' => 'field_projects_heading',   'label' => 'Título (usa [corchetes])', 'name' => 'projects_heading',   'type' => 'text' ],
            [ 'key' => 'field_projects_paragraph', 'label' => 'Párrafo descriptivo',     'name' => 'projects_paragraph', 'type' => 'textarea', 'rows' => 4 ],
            [
                'key'        => 'field_projects_stats',
                'label'      => 'Estadísticas',
                'name'       => 'projects_stats',
                'type'       => 'repeater',
                'min'        => 1,
                'layout'     => 'block',
                'sub_fields' => [
                    [ 'key' => 'field_stat_number',   'label' => 'Número',             'name' => 'number',   'type' => 'text' ],
                    [ 'key' => 'field_stat_suffix',   'label' => 'Sufijo (ej: M, +)',  'name' => 'suffix',   'type' => 'text' ],
                    [ 'key' => 'field_stat_label',    'label' => 'Etiqueta',           'name' => 'label',    'type' => 'text' ],
                    [ 'key' => 'field_stat_decimals', 'label' => 'Decimales (0 o 1)',  'name' => 'decimals', 'type' => 'number', 'default_value' => 0 ],
                ],
            ],

            // ── TAB: EXPERTISE ────────────────────────
            [ 'key' => 'field_tab_expertise', 'label' => 'Expertise', 'name' => '', 'type' => 'tab' ],
            [
                'key'        => 'field_expertise_cards',
                'label'      => 'Tarjetas de Expertise',
                'name'       => 'expertise_cards',
                'type'       => 'repeater',
                'min'        => 1,
                'layout'     => 'block',
                'sub_fields' => [
                    [ 'key' => 'field_exp_subtitle', 'label' => 'Subtítulo',                        'name' => 'subtitle', 'type' => 'text' ],
                    [ 'key' => 'field_exp_title',    'label' => 'Título',                           'name' => 'title',    'type' => 'text' ],
                    [ 'key' => 'field_exp_desc',     'label' => 'Descripción',                      'name' => 'desc',     'type' => 'textarea', 'rows' => 3 ],
                    [ 'key' => 'field_exp_tags',     'label' => 'Proyectos (uno por línea)',        'name' => 'tags',     'type' => 'textarea', 'rows' => 4,
                      'instructions' => 'Escribe un proyecto por línea' ],
                ],
            ],

            // ── TAB: ABOUT ────────────────────────────
            [ 'key' => 'field_tab_about', 'label' => 'About', 'name' => '', 'type' => 'tab' ],
            [ 'key' => 'field_about_photo',    'label' => 'Foto',                        'name' => 'about_photo',    'type' => 'image', 'return_format' => 'url' ],
            [ 'key' => 'field_about_name',     'label' => 'Nombre',                      'name' => 'about_name',     'type' => 'text' ],
            [ 'key' => 'field_about_headline', 'label' => 'Titular (usa [corchetes])',   'name' => 'about_headline', 'type' => 'text' ],
            [
                'key'        => 'field_about_paragraphs',
                'label'      => 'Párrafos de biografía',
                'name'       => 'about_paragraphs',
                'type'       => 'repeater',
                'min'        => 1,
                'layout'     => 'block',
                'sub_fields' => [
                    [ 'key' => 'field_about_para', 'label' => 'Párrafo', 'name' => 'paragraph', 'type' => 'textarea', 'rows' => 3 ],
                ],
            ],
            [ 'key' => 'field_about_cta',  'label' => 'Texto del botón CTA', 'name' => 'about_cta',  'type' => 'text' ],
            [
                'key'        => 'field_about_stats',
                'label'      => 'Estadísticas (4 cifras)',
                'name'       => 'about_stats',
                'type'       => 'repeater',
                'min'        => 1,
                'layout'     => 'block',
                'sub_fields' => [
                    [ 'key' => 'field_about_stat_num',   'label' => 'Número', 'name' => 'number', 'type' => 'text' ],
                    [ 'key' => 'field_about_stat_label', 'label' => 'Etiqueta', 'name' => 'label', 'type' => 'text' ],
                ],
            ],

            // ── TAB: IMPACT ───────────────────────────
            [ 'key' => 'field_tab_impact', 'label' => 'Impact', 'name' => '', 'type' => 'tab' ],
            [ 'key' => 'field_impact_heading', 'label' => 'Titular (usa [corchetes])', 'name' => 'impact_heading', 'type' => 'text' ],
            [ 'key' => 'field_impact_p1',      'label' => 'Párrafo 1',                'name' => 'impact_p1',      'type' => 'textarea', 'rows' => 3 ],
            [ 'key' => 'field_impact_p2',      'label' => 'Párrafo 2',                'name' => 'impact_p2',      'type' => 'textarea', 'rows' => 3 ],
            [
                'key'        => 'field_impact_logos',
                'label'      => 'Logos "Worked with"',
                'name'       => 'impact_logos',
                'type'       => 'repeater',
                'min'        => 0,
                'layout'     => 'block',
                'sub_fields' => [
                    [ 'key' => 'field_logo_image', 'label' => 'Imagen logo', 'name' => 'logo_image', 'type' => 'image', 'return_format' => 'url' ],
                    [ 'key' => 'field_logo_alt',   'label' => 'Nombre / alt', 'name' => 'logo_alt',  'type' => 'text' ],
                ],
            ],

            // ── TAB: CONTACTO ─────────────────────────
            [ 'key' => 'field_tab_contact', 'label' => 'Contacto', 'name' => '', 'type' => 'tab' ],
            [ 'key' => 'field_contact_heading',  'label' => 'Titular (usa [corchetes])', 'name' => 'contact_heading',  'type' => 'text' ],
            [ 'key' => 'field_contact_paragraph','label' => 'Párrafo',                  'name' => 'contact_paragraph','type' => 'textarea', 'rows' => 2 ],
            [ 'key' => 'field_contact_email',    'label' => 'Email',                    'name' => 'contact_email',    'type' => 'email' ],
            [ 'key' => 'field_contact_linkedin', 'label' => 'LinkedIn URL',             'name' => 'contact_linkedin', 'type' => 'url' ],

            // ── TAB: FOOTER ───────────────────────────
            [ 'key' => 'field_tab_footer', 'label' => 'Footer', 'name' => '', 'type' => 'tab' ],
            [ 'key' => 'field_footer_text', 'label' => 'Texto del footer', 'name' => 'footer_text', 'type' => 'text' ],

            // ── TAB: MAPA ─────────────────────────────
            [ 'key' => 'field_tab_map', 'label' => 'Mapa / Pins', 'name' => '', 'type' => 'tab' ],
            [
                'key'        => 'field_map_pins',
                'label'      => 'Pins de proyectos',
                'name'       => 'map_pins',
                'type'       => 'repeater',
                'min'        => 0,
                'layout'     => 'block',
                'sub_fields' => [
                    [ 'key' => 'field_pin_id',       'label' => 'ID único',             'name' => 'pin_id',       'type' => 'text' ],
                    [ 'key' => 'field_pin_country',  'label' => 'País / Región',        'name' => 'pin_country',  'type' => 'text' ],
                    [ 'key' => 'field_pin_title',    'label' => 'Título del proyecto',  'name' => 'pin_title',    'type' => 'text' ],
                    [ 'key' => 'field_pin_category', 'label' => 'Categoría',            'name' => 'pin_category', 'type' => 'text' ],
                    [
                        'key'     => 'field_pin_class',
                        'label'   => 'Color del pin',
                        'name'    => 'pin_class',
                        'type'    => 'select',
                        'choices' => [
                            'pin-gold'   => 'Dorado — Seeds',
                            'pin-green'  => 'Verde — Roots',
                            'pin-blue'   => 'Azul — Growth',
                            'pin-orange' => 'Naranja — Territories',
                            'pin-pink'   => 'Rosa — Climate',
                        ],
                        'default_value' => 'pin-gold',
                    ],
                    [ 'key' => 'field_pin_image', 'label' => 'Imagen del proyecto', 'name' => 'pin_image', 'type' => 'image', 'return_format' => 'url' ],
                    [ 'key' => 'field_pin_desc',  'label' => 'Descripción',         'name' => 'pin_desc',  'type' => 'textarea', 'rows' => 2 ],
                    [ 'key' => 'field_pin_x',     'label' => 'Posición X (0–100)',  'name' => 'pin_x',     'type' => 'number', 'min' => 0, 'max' => 100, 'step' => '0.01' ],
                    [ 'key' => 'field_pin_y',     'label' => 'Posición Y (0–100)',  'name' => 'pin_y',     'type' => 'number', 'min' => 0, 'max' => 100, 'step' => '0.01' ],
                ],
            ],

        ],
        'location' => [
            [ [ 'param' => 'page_template', 'operator' => '==', 'value' => 'front-page.php' ] ],
            [ [ 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ] ],
        ],
        'menu_order' => 0,
        'position'   => 'normal',
        'style'      => 'default',
        'label_placement' => 'top',
    ] );

} );

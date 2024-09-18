<?php

return [
  'mode'                     => 'utf-8',
  'format'                   => 'A4',
  'default_font_size'        => '12',
  'default_font'             => 'TimesNewRoman',
  'margin_left'              => 20,
  'margin_right'             => 20,
  'margin_top'               => 34,
  'margin_bottom'            => 34,
  'margin_header'            => 4,
  'margin_footer'            => 4,
  'orientation'              => 'P',
  'title'                    => 'NAB',
  'subject'                  => '',
  'author'                   => 'NAB',
  'watermark'                => '',
  'show_watermark'           => false,
  'show_watermark_image'     => false,
  'watermark_font'           => 'sans-serif',
  'display_mode'             => 'fullpage',
  'watermark_text_alpha'     => 0.1,
  'watermark_image_path'     => '',
  'watermark_image_alpha'    => 0.2,
  'watermark_image_size'     => 'D',
  'watermark_image_position' => 'P',
  'custom_font_dir'          => public_path('fonts/dz/'),
  'custom_font_data'         => [
                                  'dzongkha' => [
                                    'R'  => 'Jomolhari.ttf',    // regular font
                                    'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
                                  ],

                                  'TimesNewRoman' => [
                                    'R'  => 'TimesNewRoman.ttf',    // regular font
                                  ]
                                ],
  'auto_language_detection'  => false,
  'temp_dir'                 => public_path('temp'),
  'pdfa'                     => false,
  'pdfaauto'                 => false,
  'use_active_forms'         => false,
];

<?php

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => '',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'QatrahKSA',
	'display_mode'          => 'fullpage',
	'tempDir'               => base_path('tmp/'),
	'pdf_a'                 => false,
	'pdf_a_auto'            => false,
	'icc_profile_path'      => '',
	'font_path' => base_path('public/assets/fonts'),
	'font_data' => [
		'SSTArabic' => [
			'R'  => 'SSTArabic-Light.ttf',    // regular font
			'B'  => 'SSTArabic-Medium.ttf',       // optional: bold font
			// 'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
			'useOTL' => 0x80,
			'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
		],
		'tajawal' => [
			// 'R'  => 'Tajawal-Regular.ttf',    // regular font
			'B'  => 'Tajawal-Bold.ttf',       // optional: bold font
			// 'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
			'useOTL' => 0x80,
			'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
		],
		'cairo' => [
			'R'  => 'Cairo-Regular.ttf',    // regular font
			'B'  => 'Cairo-Bold.ttf',       // optional: bold font
			'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
			// 'useOTL' => 0x80,
			'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
		]
		// ...add as many as you want.
	]
];

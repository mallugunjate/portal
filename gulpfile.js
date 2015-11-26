var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */


// elixir(function(mix) {
//     mix.less([
//     	'variables.less',
//         'badgets_labels.less',
// 		'base.less',
// 		'buttons.less',
// 		'chat.less',
// 		'custom.less',
// 		'elements.less',
// 		'landing.less',
// 		'md-skin.less',
// 		'media.less',
// 		'metismenu.less',
// 		'mixins.less',
// 		'navigation.less',
// 		'pages.less',
// 		'rtl.less',
// 		'sidebar.less',
// 		'skins.less',
// 		'spinners.less',
// 		'style.less',
// 		'theme-config.less',
// 		'top_navigation.less',
// 		'typography.less'
//     ]);
// });

elixir(function(mix) {
    mix.sass('app.scss');

    mix.less([
		'style.less'
    ]);
});

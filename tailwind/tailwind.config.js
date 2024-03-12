const fs = require("fs");

// Set Preflight flag and Tailwind Typography class name based on the build target.
let includePreflight, typographyClassName;
if ('editor' === process.env._TW_TARGET) {
	includePreflight = false;
	typographyClassName = 'block-editor-block-list__layout';
} else {
	includePreflight = true;
	typographyClassName = 'prose';
}

// maybe we want to import tailwind colors as a baseline?
// const colors = require('tailwindcss/colors')

// Import config from theme.json and sync it with Tailwind config.
const themeJson = fs.readFileSync( './theme/theme.json' )
const theme = JSON.parse( themeJson )
const themeColors = theme.settings.color.palette.reduce(function(obj, itm) {
  obj[itm.slug] = itm.color;
  return obj;
}, {});

const fonts = theme.settings.typography.fontFamilies.reduce(function(obj, itm) {
  obj[itm.slug] = itm.fontFamily.split(',');
  return obj;
}, {});


module.exports = {
	presets: [
		// Manage Tailwind Typography's configuration in a separate file.
		require('./tailwind-typography.config.js'),
	],
	content: [
		// Ensure changes to PHP files and `theme.json` trigger a rebuild.
		'./theme/**/*.php',
		'./theme/theme.json',
	],
  // whitelisted tailwind classes
  safelist: [
    'inline',
    'h-full',
    'prose',
    'relative',
    'z-10'
    // {
    //   pattern: /bg-(red|green|blue)-(100|200|300)/,
    //   variants: ['lg', 'hover', 'focus', 'lg:hover'],
    // },
  ],
	theme: {

		screens: {
      'xxs': '420px',
      'xs': '550px',
      'sm': '640px',
      'md': '782px',
      'mobile': {'max': '781px'},
      'lg': '1024px',
      'xl': '1280px',
      '2xl': '1536px',
    },
    lineHeight: {
      '1': '1em',
      '2': '1.2em',
      '3': '1.3em',
      '4': '1.4em',
    },
		extend: {
      colors: {
        ...themeColors,
        primary: '#CC0000',
        gray: {
          DEFAULT: '#b4b4b3',
          100: '#f3f3f3', // Nav background
          200: '#e8e8e6', // add to cart button
          500: '#b4b4b3', // learn more button
        }
      },
      boxShadow: {
        'filters': '0px 0px 3px #00000029',
      },
      aspectRatio: {
        '5/2': '5 / 2',
      },

      fontFamily: fonts,
      // spacing: {
      //   '8xl': '96rem',
      //   '9xl': '128rem',
      // },
    },
    // typography: {
    //   DEFAULT: { // this is for prose class
    //     css: {
    //       a: {
    //         // change anchor color and on hover
    //         color: 'orange !important',
    //         '&:hover': { // could be any. It's like extending css selector
    //           color: '#F7941E'
    //         },
    //       }
    //     }
    //   }
    // }
	},
	corePlugins: {
		// Disable Preflight base styles in CSS targeting the editor.
		preflight: includePreflight,
	},

  darkMode: "class",

	plugins: [
		// Extract colors and widths from `theme.json`.
		require('@_tw/themejson')(require('../theme/theme.json')),

		// Add Tailwind Typography.
		require('@tailwindcss/typography')({
			className: typographyClassName,
		}),

		// Uncomment below to add additional first-party Tailwind plugins.
		// require( '@tailwindcss/forms' ),
		// require( '@tailwindcss/aspect-ratio' ),
		// require( '@tailwindcss/line-clamp' ),
		// require( '@tailwindcss/container-queries' ),
	],
};

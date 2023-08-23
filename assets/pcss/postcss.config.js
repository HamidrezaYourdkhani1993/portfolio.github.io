const _ = require('lodash'); // Import lodash

module.exports = ({ plugins }) => ({
  plugins: {
    'postcss-import': {},
    'autoprefixer': {},
    'postcss-mixins': {},
    'postcss-nesting': {},
    'postcss-hexrgba': {},
    'postcss-conditionals': {},
    'postcss-for': {},
    'postcss-pixels-to-rem': {},
    'postcss-hocus': {},
    'postcss-sass-color-functions': {},
    'postcss-remove-root': {},
    'postcss-if-media': {},
    'perfectionist': {},
  }
});

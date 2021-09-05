const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        ],
  theme: {
    themeVariants: ['dark'],
    screens: {
      'sm': '568px',
      'md': '768px',
      'lg': '1024px',
      'xl': '1280px',
    },  
  },
  plugins: [],
}

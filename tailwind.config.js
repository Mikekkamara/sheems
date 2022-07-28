/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        colors:{
            'theme-green':{
                light: '#e3f3df',
                dark: '#b7e7a8'
            },
        }
    },

  },
  plugins: [],
}

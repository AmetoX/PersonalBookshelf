/** @type {import('tailwindcss').Config} */
export default {
  content: [
    'resources/views/*blade.php', 
    'resources/js/*.js',
    './resources/**/*.vue',
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        'white': '#ffffff',
        'purple': '#3f3cbb',
        'midnight': '#121063',
        'metal': '#565584',
        'tahiti': '#3ab7bf',
        'silver': '#ecebff',
        'bubble-gum': '#ff77e9',
        'bermuda': '#78dcca',
        'palette1': '#76453B',
        'palette2' : '#B19470',
        'palette3' : '#F8FAE5',
        'palette4' : '#43766C',
        'darkermossgreen' : '#3E4A24',
        'darkmossgreen' : '#445128',
        'resedagreen' : '#6C7552',
        'mossgreen' : '#93987C',
        'sage': '#C9C9AE',
        'cornsilk': '#FEFAE0',
        'sunset': '#EECE9F',
        'eatrhyellow': '#DDA15E',
        'butterscotch': '#D59450',
        'bronze': '#CD8742',
        'rawumber': '#915C27',
        'cayote': "#855C32",
        'midnight-green': "#0E3B43",
        'dark-slate-gray': "#225755",
        'carabbian-green': "#2C655E",
        'myrtle-green': "#357266",
        'cambridge-blue': "#6C978A",
        'ash-gray': "#A3BBAD",
        'reseda-green': "#84876E",
        'field-drab': "#65532F",
        'drab-dark-brown': "#4B3C1C",
        'cafe-noir': "#312509",
        'reseda-green2': "#788F7C",

      },
      backgroundImage: theme => ({
        'favicon': "url('/public/images/favicon2.png')",
        'favicon2': "url('/public/images/comunityCover.jpg')",
      })

    },

  },
  plugins: [],
}
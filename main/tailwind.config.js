module.exports = {
  purge: {
    enabled: false,
    content: [
      './resources/views/**/*.php',
      './resources/js/**/*.vue'
    ],
  },
  darkMode: 'class', // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
}

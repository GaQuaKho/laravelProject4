module.exports = {
  mode: 'jit',
  content: [
    "./resources/*.blade.php",
    "./resources/**/*.blade.php",
    "./resources/**/**/*.blade.php",
    "./resources/**/**/**/*.blade.php",
  ],
  purge: [
    "./resources/*.blade.php",
    "./resources/**/**/*.blade.php",
    "./resources/**/**/**/*.blade.php",
    "./resources/**/**/**/*.blade.php",

  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

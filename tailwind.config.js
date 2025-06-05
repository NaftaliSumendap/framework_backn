/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue"
  ],
  theme: {
    extend: {},
  },
  plugins: [],
  safelist: ["bg-yellow-100", "bg-green-100", "bg-purple-100", "bg-blue-100", "bg-orange-100", "bg-red-100"]
}

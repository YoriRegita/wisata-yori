export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        brand: {
          50: "#F2FBF5",
          100: "#E6F7EB",
          200: "#C9EED6",
          300: "#9FE0B6",
          400: "#63C989",
          500: "#22C55E",
          600: "#16A34A",
          700: "#15803D",
          800: "#166534",
          900: "#14532D",
        },
        ink: "#111827",
        muted: "#6B7280",
        surface: "#F5F7FA",
      },

      /* ✨ tambahan untuk Nexcent-style */
      backgroundImage: {
        "hero-gradient":
          "linear-gradient(135deg, #F8FAFC 0%, #ECFDF5 60%, #E6F7EB 100%)",
      },

      boxShadow: {
        soft: "0 10px 30px rgba(0,0,0,0.06)",
      },

      borderRadius: {
        xl2: "1.25rem",
        xl3: "1.75rem",
      },
    },
  },
  plugins: [
    require("@tailwindcss/forms"),
    require("@tailwindcss/line-clamp"),
  ],
};

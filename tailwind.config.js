// tailwind.config.js
export default {
    content: [
        // Blade templates (including Livewire components)
        './resources/**/*.blade.php',
        // If you have any JS/TS that contains class names
        './resources/**/*.js',
        './resources/**/*.ts',
        // Optionally: if you use vendor-published views or packages with embedded markup,
        // include those paths too.
    ],
    safelist: [
        // Livewire sometimes renders dynamic class names; if you generate classes like
        // bg-red-500 or text-{color}-{weight} dynamically, whitelist patterns:
        {
            pattern: /^(bg|text|border)-(red|green|blue)-(500|600|700)$/,
            variants: ['hover', 'focus'],
        },
        // example: force inclusion of dark mode toggle class
        'dark',
    ],
    theme: {
        // pare down scales to only what you need
        spacing: {
            px: '1px',
            1: '0.25rem',
            2: '0.5rem',
            4: '1rem',
            6: '1.5rem',
            8: '2rem',
        },
        borderRadius: {
            none: '0',
            sm: '0.125rem',
            DEFAULT: '0.375rem',
            lg: '0.5rem',
            full: '9999px',
        },
        extend: {
            // only add extensions if you actually use them
        },
    },
    corePlugins: {
        // disable things you don't need, e.g., if you have your own form styles:
        // preflight: false,
    },
    plugins: [
        // add plugins only if used, e.g., forms, typography:
        // require('@tailwindcss/forms'),
        // require('@tailwindcss/typography'),
    ],
    darkMode: 'class', // or 'media' if you prefer automatic
};

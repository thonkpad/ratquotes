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
        extend: {
            colors: {
                background: 'var(--color-background)',
                text: 'var(--color-text)',
                'nav-bg': 'var(--color-nav-bg)',
                'nav-text': 'var(--color-nav-text)',
                surface: 'var(--color-surface)',
                border: 'var(--color-border)',
            },
            fontFamily: {
                sans: ['Instrument Sans', 'sans-serif'],
            },
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

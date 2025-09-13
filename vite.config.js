import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    // server: {
    //     host: true,  // Allows Vite to bind to all network interfaces (e.g., 0.0.0.0), making it accessible from 192.168.0.36:5173
    //     port: 5173,  // Default port; change if needed
    //     cors: {
    //         origin: [
    //             'http://192.168.0.36:8000',  // Your Laravel server origin
    //             'http://localhost:8000',     // Fallback for local testing
    //             'http://127.0.0.1:8000',     // IPv4 localhost fallback
    //         ],
    //         credentials: true,  // If your app uses cookies/auth
    //     },
    //     // Optional: Force IPv4 to avoid [::1] issues
    //     // host: '192.168.0.36',  // Explicitly bind to IPv4
    // },
});

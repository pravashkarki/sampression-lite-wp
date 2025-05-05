import { defineConfig } from 'vite';
import autoprefixer from 'autoprefixer';
import { resolve } from 'path';

export default defineConfig({
  base: './',
  build: {
    outDir: './',
    emptyOutDir: false,
    rollupOptions: {
      input: {
        style: resolve(__dirname, 'src/scss/style.scss'),
        rtl: resolve(__dirname, 'src/scss/rtl.scss'),
        'admin-style': resolve(__dirname, 'src/scss/admin-style.scss'),
        'editor-style': resolve(__dirname, 'src/scss/editor-style.scss')
      },
      output: {
        entryFileNames: 'js/[name].js',
        chunkFileNames: 'js/[name].js',
        assetFileNames: (assetInfo) => {
          const info = assetInfo.name.split('.');
          const extType = info[info.length - 1];
          
          if (extType === 'css') {
            if (info[0] === 'style') {
              return '[name][extname]';
            }
            if (info[0] === 'rtl') {
              return '[name][extname]';
            }
            if (info[0] === 'admin-style') {
              return 'lib/css/[name][extname]';
            }
            if (info[0] === 'editor-style') {
              return 'lib/css/[name][extname]';
            }
          }
          
          return 'assets/[name][extname]';
        }
      }
    },
    cssCodeSplit: true,
  },
  css: {
    preprocessorOptions: {
      scss: {
        quietDeps: true
      }
    },
    postcss: {
      plugins: [
        autoprefixer()
      ]
    }
  }
});

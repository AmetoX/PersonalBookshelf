import legacy from '@vitejs/plugin-legacy'
import image from '@rollup/plugin-image'
import VueImages from 'vite-plugin-vue-images';
import { ViteImageOptimizer } from 'vite-plugin-image-optimizer';
import laravel from 'laravel-vite-plugin'
import path from 'path'
import { defineConfig } from 'vite'


export default defineConfig({
    plugins: [
        
        image(), // npm install @rollup/plugin-image --save-dev
        VueImages(),
        ViteImageOptimizer({
            /* pass your config */
            png: {
                // https://sharp.pixelplumbing.com/api-output#png
                quality: 100,
              },
              jpeg: {
                // https://sharp.pixelplumbing.com/api-output#jpeg
                quality: 100,
              },
              jpg: {
                // https://sharp.pixelplumbing.com/api-output#jpeg
                quality: 100,
              },
          }),

        legacy({
            targets: ['defaults', 'not IE 11'],
        }),

        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            'tw-elements': path.resolve(__dirname, 'node_modules/tw-elements/dist/js/index.js'),
            refresh: true,
        }),
       
    ],

    resolve: {
      alias: {
          '@photos': path.resolve(__dirname, 'resources/photos'),
      },
  },

});
;
//npm install vite-plugin-vue-images --save-dev
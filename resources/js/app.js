import { createApp, h } from 'vue'
import { createInertiaApp, router } from '@inertiajs/vue3'
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.css'
import NProgress from 'nprogress'
import 'nprogress/nprogress.css'

NProgress.configure({ showSpinner: false, speed: 500 }) // Optional configuration

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el)
    },
})

router.on('start', () => {
    console.log('Inertia navigation started') // Debugging
    NProgress.start()
})

router.on('finish', (event) => {
    console.log('Inertia navigation finished') // Debugging
    NProgress.done()
})

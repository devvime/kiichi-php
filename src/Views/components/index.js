import { blots } from 'blots'

blots.route('/', (ctx, next) => {
  console.log('Home page');
})

blots.route('/about', (ctx, next) => {
  console.log('About page');
})

blots.start({ click: false })
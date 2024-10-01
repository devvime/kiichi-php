import { blots } from 'blots'

blots.route('/', (ctx, next) => {
  console.log('Home page');
})

blots.route('/test', (ctx, next) => {
  console.log('Test page');
})

blots.start()
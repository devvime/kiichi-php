import '../default/theme.scss'
import { blots } from 'blots'
import { state } from 'reactivity-proxy'

import { nav } from '../components/layout/nav/nav.js'
import { doc } from '../default/doc/doc.js';
import { home } from './home/home.js';
import { login } from './login/login.js';
import { dashboard } from './dashboard/dashboard.js';
import { listUsers } from './dashboard/users/list/list.js';
import { Pagination } from './layout/pagination/pagination.js';

state.registerElements([
  ['pagination-element', Pagination]
])

blots.route('/', () => home())
blots.route('/doc', () => doc())
blots.route('/login', () => login())
blots.route('/dashboard', (ctx, next) => dashboard({ ctx, next, data: false  }))
blots.route('/dashboard/users', (ctx, next) => dashboard({ ctx, next, data: {
  component: listUsers,
  title: 'Users List'
} }))

blots.start({ click: false })
import '@default/theme.scss'

import { blots } from 'blots'
import { state } from '@services/state.js'

import { doc } from '@default/doc/doc.js';
import { nav } from '@components/nav/nav.js'
import { Pagination } from '@components/pagination/pagination.js';
import { home } from '@pages/home/home.js';
import { login } from '@pages/login/login.js';
import { dashboard } from '@pages/dashboard/dashboard.js';
import { listUsers } from '@pages/dashboard/users/list/list.js';

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
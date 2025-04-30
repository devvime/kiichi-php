import '@default/theme.scss'

import { blots } from 'blots'
import { state } from 'reactivity-proxy'

import { loading } from '@components/loading/loading.js';
import { pagination } from '@components/pagination/pagination.js';
import { MultiSelect } from '@components/mult-select/mult-select.js';

import { doc } from '@default/doc/doc.js';
import { nav } from '@components/nav/nav.js'
import { home } from '@pages/home/home.js';
import { login } from '@pages/login/login.js';
import { recoverPassword } from '@pages/login/recover-password/recover';
import { dashboard } from '@pages/dashboard/dashboard.js';
import { listUsers } from '@pages/dashboard/users/list/list.js';
import { register } from '@pages/login/register/register';

state.registerElements([
  [loading.title, loading],
  [pagination.title, pagination],
  [MultiSelect.title, MultiSelect],
  [recoverPassword.title, recoverPassword],
  [register.title, register]
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
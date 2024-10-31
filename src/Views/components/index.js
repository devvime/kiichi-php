import '../default/theme.scss'
import { blots } from 'blots'

import { nav } from './layout/nav/nav.js'
import { home } from './home/home.js';
import { login } from './login/login.js';
import { doc } from '../default/doc/doc.js';

blots.route('/', () => home())
blots.route('/login', () => login())
blots.route('/doc', () => doc())

blots.start({ click: false })
import '../default/theme.scss'
import { blots } from 'blots'

import { home } from './home/home.js';
import { login } from './login/login.js';

blots.route('/', () => home())
blots.route('/login', () => login())

blots.start({ click: false })
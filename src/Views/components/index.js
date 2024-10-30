import '../default/theme.scss'
import '../../../node_modules/bootstrap/dist/css/bootstrap.css'
import { blots } from 'blots'

import { home } from './home/home.js';
import { about } from './about/about.js';

blots.route('/', () => home())
blots.route('/about', () => about())

blots.start({ click: false })
import './dashboard.scss'
import $ from 'jquery'
import Swal from 'sweetalert2'
import { api } from '../services/baseApi.js'
import { state } from '../state.js'

import { sideBarMenu } from './sidebar-menu/menu.js'

state.change('title', 'Dashboard Page')
state.change('logout', () => logOut())

export function dashboard(props) {
  if (props.data) {
    $('#dashboard-page').html(props.data.tpl)
    state.change('title', props.data.title) 
  }
  sideBarMenu()
}

function logOut() {
  api.get('/api/auth/logout').then(res => {
    if (res.success) {
      Swal.fire({
        title: res.message,
        icon:'success',
        confirmButtonText: 'OK'
      }).then(() => {
        window.location.href = '/login'
      })
    } else {
      Swal.fire({
        title: res.message,
        icon: 'error',
        confirmButtonText: 'OK'
      })
    }
  })
}
import './login.scss'
import $ from 'jquery'
import Swal from 'sweetalert2'
import { api } from '../services/baseApi.js'
import { ReactivityProxy } from 'reactivity-proxy';

const state = new ReactivityProxy()

state.set({
  title: 'Login Page',
  register: false,
  goToRegister() {
    state.change('title', 'Register Page')
    state.change('register', true)
  },
  goToLogin() {
    state.change('title', 'Login Page')
    state.change('register', false)
  }
})

state.resolve()

export const login = (ctx, next) => {
  const form = $('#login-form')
  form.on('submit', (e) => {
    e.preventDefault()
    const formData = new FormData(e.target)
    const data = {
      email: formData.get('email'),
      password: formData.get('password')
    }
    sendLogin(data)
  })
}

async function sendLogin(data) {
  await api.post('/api/auth', data).then(res => {
    if (res.success) {
      Swal.fire({
        title: res.message,
        icon:'success',
        confirmButtonText: 'OK'
      }).then(() => {
        window.location.href = '/dashboard'
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
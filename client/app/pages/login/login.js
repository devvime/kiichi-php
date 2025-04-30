import './login.scss'
import Swal from 'sweetalert2'
import { api } from '@services/baseApi.js'
import { state } from 'reactivity-proxy';

state.set({
  title: 'Login Page',
  register: false,
  recoverPass: false,
  goToRegister() {
    state.change('title', 'Register Page')
    state.change('register', true)
  },
  goToRecover() {
    state.change('title', 'Recover Password')
    state.change('recoverPass', true)
  },
  goToLogin() {
    state.change('title', 'Login Page')
    state.change('register', false)
    state.change('recoverPass', false)
  }
})

export const login = (ctx, next) => {
  const form = document.querySelector('#login-form')
  form.addEventListener('submit', (e) => {
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
  state.change('loading', true)
  await api.post('/api/auth', data).then(res => {
    if (res.success) {
      Swal.fire({
        title: res.message,
        icon:'success',
        confirmButtonText: 'OK'
      }).then(() => {
        state.change('loading', false)
        window.location.href = '/dashboard'
      })
    } else {
      Swal.fire({
        title: res.message,
        icon: 'error',
        confirmButtonText: 'OK'
      })
      state.change('loading', false)
    }
  })
}
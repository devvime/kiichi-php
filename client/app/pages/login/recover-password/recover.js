import './recover.scss'
import element from './recover.html'
import Swal from 'sweetalert2'
import { api } from '@services/baseApi.js'
import { state } from 'reactivity-proxy';

export const recoverPassword = {
  title: 'recover-password-element',
  init() {
    const form = document.querySelector('#recover-form')
    form.addEventListener('submit', (e) => {
      e.preventDefault()
      const formData = new FormData(e.target)
      const data = {
        email: formData.get('email')
      }
      sendRecover(data)
    })
    state.handleClick()
  },
  render() {
    return element
  }
}

async function sendRecover(data) {
  state.change('loading', true)
  await api.post('/api/auth/recover-pass', data).then(res => {
    if (res.success) {
      Swal.fire({
        title: `Password recovery email has been sent to ${data.email}`,
        icon: 'success',
        confirmButtonText: 'OK'
      }).then(() => {
        state.change('title', 'Login Page')
        state.change('register', false)
      })
      state.change('loading', false)
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
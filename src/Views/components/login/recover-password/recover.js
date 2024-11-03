import './recover.scss'
import $ from 'jquery'
import Swal from 'sweetalert2'
import { api } from '../../services/baseApi.js'
import { state } from '../../state.js'

export const recoverPassword = (ctx, next) => {
  const form = $('#recover-form')
  form.on('submit', (e) => {
    e.preventDefault()
    const formData = new FormData(e.target)
    const data = {
      email: formData.get('email')
    }
    sendRecover(data)
  })
}

async function sendRecover(data) {
  await api.post('/api/auth/recover-pass', data).then(res => {
    if (res.success) {
      Swal.fire({
        title: `Password recovery email has been sent to ${data.email}`,
        icon:'success',
        confirmButtonText: 'OK'
      }).then(() => {
        state.change('title', 'Login Page')
        state.change('register', false)
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
import './login.scss'
import $ from 'jquery'
import Swal from 'sweetalert2'
import { api } from '../services/baseApi.js'

const state = new Proxy({
  title: 'Título Inicial',
  description: 'Descrição Inicial'
}, {
  set(target, property, value) {
      target[property] = value
      updateDOM()
      return true
  }
});

function updateDOM() {
  document.getElementById('title').innerText = state.title
  document.getElementById('description').innerText = state.description
}

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
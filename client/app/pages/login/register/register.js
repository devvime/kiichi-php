import './register.scss'
import element from './register.html'
import Swal from 'sweetalert2'
import { api } from '@services/baseApi.js'
import { state } from 'reactivity-proxy';

export const register = {
  title: 'register-element',
  init() {
    const form = document.querySelector('#register-form')
    form.addEventListener('submit', (e) => {
      e.preventDefault()
      const formData = new FormData(e.target)
      const data = {
        name: formData.get('name'),
        email: formData.get('email'),
        password: formData.get('password')
      }
      sendRegister(data)
    })
    state.handleClick()
  },
  render() {
    return element
  }
}

async function sendRegister(data) {
  state.change('loading', true)
  await api.post('/api/register', data).then(res => {
    if (res.success) {
      Swal.fire({
        title: "User registered successfully!",
        icon:'success',
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
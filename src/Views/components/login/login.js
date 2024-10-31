import './login.scss'
import $ from 'jquery'
import { api } from '../services/baseApi.js'

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
  await api.post('/login', data).then(res => {
    console.log(res)
  }).catch(err => {
    console.log(err)
  })
}
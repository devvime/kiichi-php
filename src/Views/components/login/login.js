import './login.scss'
import $ from 'jquery'
import { api } from '../services/baseApi.js'

export const login = (ctx, next) => {
  const form = $('#login-form')
  form.on('submit', (e) => {
    e.preventDefault()
    sendLogin(form.serialize())
  })
}

async function sendLogin(data) {
  await api.post('/login', data).then(res => {
    console.log(res)
  }).catch(err => {
    console.log(err)
  })
}
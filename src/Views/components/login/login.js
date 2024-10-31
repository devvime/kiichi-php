import './login.scss'
import $ from 'jquery'

export const login = (ctx, next) => {
  const form = $('#login-form')
  form.on('submit', (e) => {
    e.preventDefault()
    console.log('Submitted!', form.serialize())
  })
}